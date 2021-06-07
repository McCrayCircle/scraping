

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .current_row{
            background-color: #eee;
            color: black;
            border: 2px;
        }
    </style>
</head>
<style>
	.nav-link{
		color: #007bff !important;
	}
	.navbar-dark .navbar-brand {
		color: #007bff !important;
	}
</style>
<body style="background-color: slateblue;">

<nav class="navbar navbar-expand-md bg-light navbar-dark" style="background-color: #2d2750 !important;">
  <a class="navbar-brand" href="#">LOGO NAME or IMG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Me</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Log In</a>
      </li>    
    </ul>
  </div>  
</nav>
<br>

<div class="container">
    <h1 class="display-3 pb-2 d-none d-sm-inline-block">Search &amp; Extract Data<br> on the Web <span class="text-success">10x Faster</span></h1>
  <div class="mb-4">
	  <button class="btn btn-primary upload">Upload</button>
      <button class="btn btn-info start">Start</button>
	  <button class="btn btn-success download" >Download</button>
	  <a href="http://3.138.169.141/index.php" class="btn btn-danger">Back</a>
  </div>
</div>
    <form method="post" enctype="multipart/form-data" class="mb-3" style="display: none">
            <input type="file" id="fileUpload" name="file" accept=".xlsx">
    </form>

    <?php
        // $servername = "localhost";
    // $servername = "http://3.138.169.141";
    $servername = "127.0.0.1";

        $username = "cooker";
        $password = "Password123$";
        $dbname = "scraping";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM domains";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<div style='padding-right: 20px; padding-left: 20px;'><table id='domains_table' class='table table-responsive table-hover table-sm table-bordered table-dark table-striped'><thead>";
            echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Domain Name</th>";
            echo "<th>State</th>";
            echo "<th>Domain Date Created</th>";
            echo "<th>Domain Date expired</th>";
            echo "<th>Age of the domain</th>";
            echo "<th>community score</th>";
            echo "<th>IP address</th>";
            echo "<th>Registrar name</th>";
            echo "<th>Location</th>";
            echo "<th>Blacklist</th>";
            echo "<th>Test result</th>";
            echo "</tr>";
            echo "<t></thead></tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr id='".$row['id']."'>";
                echo "<td>". $row['id'] ."</td>";
                echo "<td>". $row['domain'] ."</td>";
                echo "<td class=".($row['state']==0?'pending':'success').">". ($row['state']==0?'pending':"success") ."</td>";
                echo "<td>". $row['create_time'] ."</td>";
                echo "<td>". $row['expire_time'] ."</td>";
                echo "<td>". $row['age'] ."</td>";
                echo "<td>". ($row['create_time']==""?"":$row['community_score']). "</td>";
                echo "<td>". $row['ip'] ."</td>";
                echo "<td>". $row['name'] ."</td>";
                echo "<td>". $row['location'] ."</td>";
                echo "<td>". $row['blacklist'] ."</td>";
                echo "<td>". $row['test_result'] ."</td>";
                echo "</tr>";
            }
            echo "</tbody></table></div>";
        } 

        $sql1 = "SELECT * FROM ips";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0){
            echo "<div class='container'><table class='table table-dark table-bordered table-striped' id='tbl2'><thead><tr>";
            echo "<th>No</th>";
            echo "<th>IP address</th>";
            echo "<th>State</th>";
            echo "<th>Domain</th>";
            echo "<th>Community Score</th></tr></thead><tbody>";
            while($row = $result1->fetch_assoc()) {
                echo "<tr id='".$row['id']."'>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['ip_address']."</td>";
                echo "<td class=".($row['state']==0?'pending':'success').">". ($row['state']==0?'pending':"success") ."</td>";
                echo "<td>".$row['domain_name']."</td>";
                echo "<td>".($row['domain_name']==""?"":$row['community_score'])."</td>";
                echo "</tr>";
            }
            echo "</tbody></table></div>";
        }
    
    
    ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".download").click(function(){
                tablesToExcel(['domains_table','tbl2'], ['Domains','IPs'], 'TestBook.xls', 'Excel');
            });
            $(".upload").click(function(){
                $("#fileUpload").click();
            });
            $("#fileUpload").on("change", function(){
                var fileUpload = document.getElementById("fileUpload");
                //Validate whether File is valid Excel file.
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();

                    //For Browsers other than IE.
                    reader.onload = function (e) {
                        GetTableFromExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                    
                } else {
                    alert("This browser does not support HTML5.");
                }
            });
            var oneRequest = function() {
                if($(".pending").length > 0){
                    var pending_ele = $(".pending").eq(0);
                    var pending_text = $(".pending").eq(0).prev().text();
                    var pending_id = $(".pending").eq(0).parent().attr("id");
                    console.log(pending_ele);
                    console.log(pending_text);
                    // pending_ele.parent().addClass("current_row");
                    pending_ele.parent().focus();
                    // if($(".yet").length > 0){
                    //     var pending_text = $(".yet").eq(0).prev().text();
                    //     var pending_id = $(".yet").eq(0).parent().attr("id");
                    // } 
                    $.ajax({
                        url: "get_data.php",
                        type: "post",
                        data: {
                            state: "get_info",
                            data: {
                                pending_text: pending_text,
                                pending_id: pending_id
                            },
                        },
                        success: function(res){

                            if(res.create_time == "") {
                                pending_ele.removeClass("pending");
                                pending_ele.addClass("yet");
                            }else if(res.create_time){
                                if(pending_ele.hasClass("pending")){
                                    pending_ele.removeClass("pending");
                                }
                                if(pending_ele.hasClass("yet")){
                                    pending_ele.removeClass("yet");
                                }
                                pending_ele.addClass("success");
                                // pending_ele.focus();
                                pending_ele.text("success");
                                pending_ele.parent().children().eq(3).text(res.create_time);
                                pending_ele.parent().children().eq(4).text(res.expire_time);
                                pending_ele.parent().children().eq(5).text(res.age);
                                pending_ele.parent().children().eq(6).text(res.community_score);
                                pending_ele.parent().children().eq(7).text(res.ip);
                                pending_ele.parent().children().eq(8).text(res.name);
                                pending_ele.parent().children().eq(9).text(res.location);
                                pending_ele.parent().children().eq(9).text(res.blacklist);
                                pending_ele.parent().children().eq(9).text(res.test_result);
                            } 
                            if(res.get_ip == "OK"){
                                pending_ele.removeClass("pending");
                                pending_ele.removeClass("success");
                                pending_ele.parent().children().eq(2).text('success');
                                pending_ele.parent().children().eq(3).text(res.domain);
                                pending_ele.parent().children().eq(4).text(0);
                            }
                            oneRequest();
                        }
                    });
                } 
            }
            $(".start").on("click", function(){
                oneRequest();
            });

            var tablesToExcel = (function() {
                var uri = 'data:application/vnd.ms-excel;base64,'
                , tmplWorkbookXML = '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
                + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
                + '<Styles>'
                + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
                + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
                + '</Styles>' 
                + '{worksheets}</Workbook>'
                , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
                , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
                , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
                return function(tables, wsnames, wbname, appname) {
                var ctx = "";
                var workbookXML = "";
                var worksheetsXML = "";
                var rowsXML = "";

                for (var i = 0; i < tables.length; i++) {
                    if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
                    for (var j = 0; j < tables[i].rows.length; j++) {
                    rowsXML += '<Row>'
                    for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
                        var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
                        var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
                        var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
                        dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
                        var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
                        dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
                        ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                            , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                            , data: (dataFormula)?'':dataValue
                            , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                            };
                        rowsXML += format(tmplCellXML, ctx);
                    }
                    rowsXML += '</Row>'
                    }
                    ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
                    worksheetsXML += format(tmplWorksheetXML, ctx);
                    rowsXML = "";
                }

                ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
                workbookXML = format(tmplWorkbookXML, ctx);

                // console.log(workbookXML);

                var link = document.createElement("A");
                link.href = uri + base64(workbookXML);
                link.download = wbname || 'Workbook.xls';
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                }
            })();
        });

   
        function GetTableFromExcel(data) {
            //Read the Excel File data in binary
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //get the name of First Sheet.
            var Sheet = workbook.SheetNames[0];
            //Read all rows from First Sheet into an JSON array.
            var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[Sheet]);
            var array = [] ;
            for (var i = 0; i < excelRows.length; i++) {
                array.push(excelRows[i]['cooltechtube.com']);
            }
            var unique = array.filter(function(elem, index, self) {
                return index === self.indexOf(elem);
            });
            $.ajax({
                type: 'post',
                data: {
                    data: JSON.stringify(unique),
                    state: "upload"
                },
                url: "get_data.php",
                success: function(res){
                    location.reload();
                    alert("You added new "+res+" rows");
                }
            });
        };

</script>    
</body>
</html>









