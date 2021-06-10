<?php
    require "./connect_mysql.php";
    include './simplehtmldom_2_0-RC2/simple_html_dom.php';  
    
    $pending_text = $_POST['pending_text'];
    $pending_id = $_POST['pending_id'];
    if(filter_var($pending_text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
        header('Content-Type: application/json');
        $row = ["domain" => get_ip_domain($pending_text), "get_ip" => "OK"];
        $sql = "UPDATE ips SET domain_name = '".$row['domain']. "', state = 1 WHERE id=$pending_id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode($row);
        }
    } 
    if(!(filter_var($pending_text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))){
        $times = [];
        $start_time = microtime(true);
        $test_result = test_result($pending_text);
        $times['1'] = microtime(true) - $start_time;
        $location = get_location($pending_text);
        $times['2'] = microtime(true) - $start_time;
        $registar = get_registar($pending_text);
        $times['3'] = microtime(true) - $start_time;
        $test_result = test_result($pending_text);
        $times['4'] = microtime(true) - $start_time;
        $row = [
            "registered_on" => $registar["registered_on"],
            "expired_on" => $registar["expired_on"],
            "age" => $registar["age"],
            "ip" => $location["ip"],
            "name" => $registar["registar"],
            "location" => $location["server_location"],
            "blacklist" => $location["blacklist"],
            "blacklist_url" => $location["current_url"],
            "test_result" => $test_result['test_result'],
            "test_url" => $test_result['current_url']
            // "community_score" => '0/85'
        ] ;
        if($row['registered_on'] == "") {
            $state = 0;
        } else $state = 1;
        $sql = "UPDATE domains SET state = $state,
                                    create_time = '".$row["registered_on"]."',
                                    expire_time = '".$row["expired_on"]."', 
                                    age = '".$row["age"]."', 
                                    ip = '".$row["ip"]."', 
                                    name = '".$row["name"]."', 
                                    location = '".$row["location"]."', 
                                    blacklist = '".$row["blacklist"]."' , 
                                    blacklist_url = '".$row['blacklist_url']."',
                                    test_result = '".$row["test_result"]."',
                                    test_url = '".$row['test_url']."'
                                    WHERE id = $pending_id";
        if (mysqli_query($conn, $sql)) {
            $sql = "SELECT * FROM domains WHERE id=$pending_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            header('Content-Type: application/json');
            $times['5'] = microtime(true) - $start_time;
            echo json_encode($row);
            
        }
    } 
    
    function test_result($domain){
        $ch = curl_init('https://zulu.zscaler.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // get headers too with this line
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $result = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        // get cookie
        // multi-cookie variant contributed by @Combuster in comments
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        $cookie = $cookies['_zulu_session'];

        
        $dom = str_get_html($body);
        $tag = $dom->find("[name=csrf_token]");
        $csrf_token = $tag[0]->value;
        
        $postfields = array('url'=>$domain, 'csrf_token'=>$csrf_token);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://zulu.zscaler.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        // Edit: prior variable $postFields should be $postfields;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_COOKIE, "_zulu_session=". $cookie);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
        $result = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        $dom = str_get_html($body);
        $test_result = $dom->find("#jscore");
        $current_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        if($test_result == null) {
            return ['test_result' => "", 'current_url' => ""];
        }
        if($current_url == null) {
            return ['test_result' => "", 'current_url' => ""];
        }
        return ['test_result' => $test_result[0]->innertext, 'current_url' => $current_url];
    }

    function get_location($domain) {
        $xml = file_get_contents("https://www.urlvoid.com/scan/" . $domain);
        $dom = str_get_html($xml);
        if($dom->find(".label")){
            $blacklist = $dom->find(".label")[0]->innertext;
        } else $blacklist = "" ;
        if($dom->find("[alt=]")) {
            $server_location = $dom->find("[alt=]")[0]->parentNode()->plaintext;
        } else $server_location = "";
        if(count($dom->find("table td strong")) > 1){
            $ip = $dom->find("table td strong")[1]->innertext;
        } else $ip = "";
        $current_url = "https://www.urlvoid.com/scan/" . $domain ;
        return ["blacklist"=>$blacklist, "current_url" => $current_url, "server_location"=>$server_location, "ip" => $ip];
    }

    function get_registar($domain) {
        $xml = file_get_contents("https://www.whois.com/whois/" . $domain);
        $dom = str_get_html($xml);
        if($dom->find(".df-block .df-row")) {
            $registar = $dom->find(".df-block .df-row")[1]->nodes[1]->innertext;
            $registered_on = $dom->find(".df-block .df-row")[2]->nodes[1]->innertext;
            $expired_on = $dom->find(".df-block .df-row")[3]->nodes[1]->innertext;
            $age_year = date_diff(date_create($registered_on), date_create('today'))->y;
            $age_month = date_diff(date_create($registered_on), date_create('today'))->m;
            $age = $age_year . "years, " . $age_month ."months";
            return ["registered_on"=>$registered_on, "expired_on"=>$expired_on, "age"=>$age, "registar"=>$registar];
        } else {
            $registered_on = "" ;
            $expired_on = "" ;
            $age = "" ;
            $registar = "";
            return ["registered_on"=>$registered_on, "expired_on"=>$expired_on, "age"=>$age, "registar"=>$registar];
        }
    }

    function get_ip_domain($ip){
        $xml = file_get_contents('https://ipapi.com/ip_api.php?ip=' . $ip);
        $dom = json_decode($xml, true);
        return $dom['hostname'];
    }


?>