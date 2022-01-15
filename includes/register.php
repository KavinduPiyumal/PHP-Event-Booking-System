<?php 
// if login session created then redirect to index.php page.
if(isset($_SESSION['login_id'])){
	locationRewrite('index.php');
}
// include register form function
include 'includes/fun-register.php';
//if check form form submission.
if(isset($_POST['register'])){
	//call a register function
	$error = register($conn);
}

?>
<!-- User registration form-->
<section class="register">
	<div class="container">
		<div class="row justify-content-center">
			 <div class="col-6">
			 	<div class="wrap shadow-lg p-5 mb-5 bg-white rounded">
			 		<form method="post" action="">
			 		<h2 class="text-center">Register</h2>
			 		 <div class="form-group">
					    <label for="utype">User Type *</label>
					    <select name="utype" class="form-control" id="utype" required>
					      <option value="admin">Admin</option>
					      <option value="user">User</option>
					    </select>
					  </div>
					  <div class="form-group">
					    	<label for="fname">First Name *</label>
					    	<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
					  </div>
					  <div class="form-group">
					    	<label for="lname">Last Name *</label>
					    	<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
					  </div>
					  <div class="form-group">
					    	<label for="emailadd">Email address *</label>
					    	<input type="email" name="email" class="form-control" id="emailadd" placeholder="Email Address" required>
					  </div>
					  <div class="form-group">
					    	<label for="password">Password *</label>
					    	<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
					  </div>
					  <div class="form-group">
					    	<label for="cpassword">Confirm Password *</label>
					    	<input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password" required>
					  </div>
					  <?php if(!empty($error)){ ?>
					  		<div class="form-group">
					  			<div class="message">
					  				<?php echo $error; //display errors  
					  				?>
					  			</div>
					  		</div>
						<?php  } ?>
					  <button type="submit" name="register" class="btn btn-primary">Register</button>
					  </form>
			 	</div>
			 </div>
		</div>
	</div>
</section>