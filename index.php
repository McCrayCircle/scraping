<?php

echo "OKOKOKOKOKOK";
die();


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
  <h3>New Scrapping Tools</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).</p>
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>
  <p>Tip: You can also remove the .navbar-expand-md class to ALWAYS hide navbar links and display the toggler button.</p>
  <h1 class="display-3 pb-2 d-none d-sm-inline-block">Search &amp; Extract Data<br> on the Web <span class="text-success">10x Faster</span></h1>
  <div class="mt-4">
	  <a href="http://3.138.169.141/second.php" class="btn btn-primary">Get Started</a>
  </div>
</div>

</body>
</html>


