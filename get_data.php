<?php

    // $servername = "localhost";
    // $servername = "http://3.138.169.141";
    $servername = "127.0.0.1";
    $username = "root";
    $password = "password";
    $dbname = "scraping";

    $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $success = 0;
    include './simplehtmldom_2_0-RC2/simple_html_dom.php';  
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['state'] == "upload"){
            $data = json_decode($_POST['data']);
            for($i = 0; $i < count($data); $i ++){
                if(filter_var($data[$i], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
                    $sql = "INSERT INTO ips (ip_address) VALUES('$data[$i]')";
                    if (mysqli_query($conn, $sql)) {
                        $success ++;
                    } 
                } else {
                    $sql = "INSERT INTO domains (domain) VALUES('$data[$i]')";
                    if (mysqli_query($conn, $sql)) {
                        $success ++;
                    } 
                }
            }
            echo $success;
        }    
        else if($_POST['state'] == "get_info"){
            $pending_text = $_POST['data']['pending_text'];
            $pending_id = $_POST['data']['pending_id'];
            if(filter_var($pending_text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
                header('Content-Type: application/json');
                $row = ["domain" => get_ip_domain($pending_text), "get_ip" => "OK"];
                $sql = "UPDATE ips SET domain_name = '".$row['domain']. "', state = 1 WHERE id=$pending_id";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode($row);
                }
            } 
            if(!(filter_var($pending_text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))){
                $test_result = test_result($pending_text);
                $location = get_location($pending_text);
                $registar = get_registar($pending_text);
                $row = [
                    "registered_on" => $registar["registered_on"],
                    "expired_on" => $registar["expired_on"],
                    "age" => $registar["age"],
                    "ip" => $location["ip"],
                    "name" => $registar["registar"],
                    "location" => $location["server_location"],
                    "blacklist" => $location["blacklist"],
                    "test_result" => $test_result,
                    "community_score" => 0
                ] ;
                if($row['registered_on'] == "") {
                    $state = 0;
                } else $state = 1;
                $sql = "UPDATE domains SET state = $state,
                                            create_time = '".$row["registered_on"]."',
                                            expire_time = '".$row["expired_on"]."', 
                                            age = '".$row["age"]."', 
                                            community_score = '".$row["community_score"]."', 
                                            ip = '".$row["ip"]."', 
                                            name = '".$row["name"]."', 
                                            location = '".$row["location"]."', 
                                            blacklist = '".$row["blacklist"]."' , 
                                            test_result = '".$row["test_result"]."'
                                            WHERE id = $pending_id";
                if (mysqli_query($conn, $sql)) {
                    $sql = "SELECT * FROM domains WHERE id=$pending_id";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    header('Content-Type: application/json');
                    echo json_encode($row);
                }
            }
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
        return $test_result[0]->innertext;
    }

    function get_location($domain) {
        $xml = file_get_contents("https://www.urlvoid.com/scan/" . $domain);
        $dom = str_get_html($xml);
        if($dom->find(".label-success")){
            $blacklist = $dom->find(".label-success")[0]->innertext;
        } else $blacklist = "" ;
        if($dom->find("[alt=]")) {
            $server_location = $dom->find("[alt=]")[0]->parentNode()->plaintext;
        } else $server_location = "";
        if($dom->find("table")){
            $ip = $dom->find("table td strong")[1]->innertext;
        } else $ip = "";
        return ["blacklist"=>$blacklist, "server_location"=>$server_location, "ip" => $ip];
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
        } else {
            $registered_on = "" ;
            $expired_on = "" ;
            $age = "" ;
            $registar = "";
        }
        return ["registered_on"=>$registered_on, "expired_on"=>$expired_on, "age"=>$age, "registar"=>$registar];
    }

    function get_ip_domain($ip){
        $xml = file_get_contents('https://ipapi.com/ip_api.php?ip=' . $ip);
        $dom = json_decode($xml, true);
        return $dom['hostname'];
    }


?>