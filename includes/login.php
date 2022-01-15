<?php 
// if login session not created then redirect to index.php page.
if(isset($_SESSION['login_id'])){
	//function for redirection
	locationRewrite('index.php');
}
//include login function page.
include 'includes/fun-login.php';
//if check login form submission.
if(isset($_POST['login'])){
	//if check querystring set or not. 
	if(isset($_GET['buy-tickets'])){
		//Get ticket id using querystring.
		$ticketid = $_GET['buy-tickets'];
	}else{
		$ticketid = null;
	}
	//call a login function
	$error = login($conn, $ticketid);
}

?>
<!-- Login form -->
<section class="register">
	<div class="container">
		<div class="row justify-content-center">
			 <div class="col-6">
			 	<div class="wrap shadow-lg p-5 mb-5 bg-white rounded">
			 		<form method="post" action="">
			 		<h2 class="text-center">Login</h2>
			 		<div class="form-group">
					    	<label for="emailadd">Email address *</label>
					    	<input type="email" name="email" class="form-control" id="emailadd" placeholder="Email Address" required>
					  </div>
					  <div class="form-group">
					    	<label for="password">Password *</label>
					    	<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
					  </div>

					  <?php 
					  if(!empty($error)){ ?>
					  		<div class="form-group">
					  			<div class="message">
					  				<?php echo $error; //display errors 
					  				?>
					  			</div>
					  		</div>
						<?php  } ?>
						<div class="form-group">
					  		<button type="submit" name="login" class="form-control btn btn-primary">Login</button>
					  	</div>	
					  	<div class="form-group">
					  		<?php if(isset($_GET['buy-tickets'])){ ?>
					  				<a class="btn btn-primary form-control" href="event.php?buy-tickets=<?php echo $_GET['buy-tickets']; ?>">Guest Login</a>
					  		<?php }else{ ?>
					  				<a class="btn btn-primary form-control" href="index.php">Guest Login</a>
					  		<?php } ?>
					  		
					  	 
					  	</div>
					  	<div class="form-group">
					  		 <a class="btn btn-primary form-control" href="index.php?action=register">Don't have an account? Register!</a>
					  		</div>
					 
					</form>
			 	</div>
			 </div>
		</div>
	</div>
</section>