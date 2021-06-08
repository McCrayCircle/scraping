<?php 
    require "http://3.138.169.141/functions/connect_mysql.php"
?>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
    <style>
        .current_row{
            background-color: #eee!important;
            color: black;
            border: 2px;
        }
        .nav-link{
            color: #007bff !important;
        }
        .navbar-dark .navbar-brand {
            color: #007bff !important;
        }
        .nomean{
            border: none;
            background: transparent;
        }
        .mycontainer{
            height: 300px;
            overflow-y: auto;
            margin-bottom: 40px;
        }
    </style>
</head>
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
	  <label style="margin: 0" for="fileUpload" class="btn btn-primary upload">Upload</label>
      <button class="btn btn-info start">Start</button>
	  <button class="btn btn-success download" >Download</button>
	  <a href="index.php" class="btn btn-danger">Back</a>
  </div>
</div>
    <form method="post" enctype="multipart/form-data" class="mb-3" style="display: none">
            <input type="file" id="fileUpload" name="file" accept=".xlsx">
    </form>
    <div class="container mb-3">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:0%;display: none"></div>
        </div>
    </div>

    <?php
        $sql = "SELECT * FROM domains WHERE downloaded=0";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<div class='mycontainer'>";
            echo "<div style='padding-right: 20px; padding-left: 20px;'><table id='domains_table' class='table table-responsive table-hover table-sm table-bordered table-dark table-striped' style='text-align:center;'><thead>";
            echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Domain Name</th>";
            echo "<th>State</th>";
            echo "<th>Domain Date Created</th>";
            echo "<th>Domain Date expired</th>";
            echo "<th>Age</th>";
            echo "<th>VT Score</th>";
            echo "<th>IP address</th>";
            echo "<th>Registrar name</th>";
            echo "<th>Location</th>";
            echo "<th>Blacklist</th>";
            echo "<th>Test result</th>";
            echo "</tr>";
            echo "<t></thead></tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr id='".$row['id']."'>";
                echo "<td><button class='nomean'>". $row['id'] ."</button></td>";
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
            echo "</tbody></table></div></div>";
        } 

        $sql1 = "SELECT * FROM ips WHERE downloaded=0";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0){
            echo "<div class='mycontainer container'><table style='text-align:center' class='table table-dark table-bordered table-striped' id='tbl2'><thead><tr>";
            echo "<th>No</th>";
            echo "<th>IP address</th>";
            echo "<th>State</th>";
            echo "<th>Domain</th>";
            echo "<th>VT Score</th></tr></thead><tbody>";
            while($row = $result1->fetch_assoc()) {
                echo "<tr id='".$row['id']."'>";
                echo "<td><button class='nomean'>".$row['id']."</button></td>";
                echo "<td>".$row['ip_address']."</td>";
                echo "<td class=".($row['state']==0?'pending':'success').">". ($row['state']==0?'pending':"success") ."</td>";
                echo "<td>".$row['domain_name']."</td>";
                echo "<td>".($row['domain_name']==""?"":$row['community_score'])."</td>";
                echo "</tr>";
            }
            echo "</tbody></table></div>";
        }
    ?>
    <script src="myscript.js"></script>
</body>
</html>









