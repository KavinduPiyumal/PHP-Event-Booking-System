<?php include 'includes/config.php'; controlSession(); 
if(isset($_SESSION['login_id'])){
	$userinfo = getUserinfo($conn, $_SESSION['login_id']);
}
?>
<!DOCTYPE html>
<head>
	<title>Events</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="lib/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
	<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo" width="100px" height="auto"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">Event</a>
	      </li>
	      <?php 
	      	if(isset($_SESSION['login_id'])){
	      		if($_SESSION['user_type']=="user"){ ?>
	      			<li class="nav-item">
			        	<a class="nav-link" href="profile.php">(<?php echo $userinfo['e_user_fname']; ?>) View Profile</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link" href="logout.php">Logout</a>
			      	</li>
	      		<?php }else if($_SESSION['user_type']=="admin"){ ?>
	      			<li class="nav-item">
			        	<a class="nav-link" href="#">Create an event</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link" href="profile.php">(<?php echo $userinfo['e_user_fname']; ?>) View Profile</a>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link" href="logout.php">Logout</a>
			      	</li>
	      		<?php }else{}
	      	}else{ ?>
			      <li class="nav-item">
			        <a class="nav-link" href="index.php?action=register">Register</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="index.php?action=login">Login</a>
			      </li>
	      <?php	}

	      ?>
	     
	      
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
	</nav>
</div>
</header>