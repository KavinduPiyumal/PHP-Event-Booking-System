<?php include('includes/header.php');  //include header file.
include('includes/fun-buy-tickets.php'); //include buy tickets function. ?>
<?php 
//if check buy tickets form submission.
if(isset($_POST['buy'])){
	//call a buy tickets function
	$error = buyTickets($conn, $_GET['buy-tickets']);
}
//if check show-event querystring set 
if(isset($_GET['show-event'])){ ?>
<section class="profilemainimage eventpagebg">
	
</section>
<section class="mtop">
	<div class="eventbgcontent">
		<div class="container">
			<div class="row">
				<div class="col-12">
						<div class="card carddetail">
							<div class="row">
								<div class="col-8">
									<?php 
									//Get specific event information from event table using event id.
									$eventdetails = getEventById($conn, $_GET['show-event']); ?>
									<img class="card-img-top" src="img/event.jpg" alt="Card image cap">
									<hr>
									  <div class="card-body">
									  	<h5 class="card-title"><?php echo $eventdetails['e_event_title']; ?></h5>
									  	<p class="card-text"><?php echo $eventdetails['e_event_date']." ".$eventdetails['e_event_time']; ?></p>
									    <p class="card-text"><?php echo $eventdetails['e_event_details']; ?></p>
									    
									    <?php if(isset($_SESSION['login_id'])) {  ?>

									     <a href="event.php?buy-tickets=<?php echo $eventdetails['e_event_id']; ?>" class="btn btn-primary">Buy tickets for this event</a>
										<?php }else{ ?>
												<a href="index.php?action=login&buy-tickets=<?php echo $_GET['show-event']; ?>" class="btn btn-primary">Buy tickets for this event</a>
										<?php } ?>
									  </div>
								</div>
								<div class="col-4">
									<h4 class="mt-3 mb-3">More Events</h4>
									<?php 
									//Get 10 random events from event table
									$randevents = getTenEvents($conn); 
									//Display Random Events
									 if ($randevents->num_rows > 0) {
											while($rw = $randevents->fetch_assoc()) { ?>

									<div class="row">
										<div class="col-4">
												<a class="text-danger" href="event.php?show-event=<?php echo $rw['e_event_id']; ?>"><img class="card-img-top" src="img/event.jpg" alt="Card image cap"></a>
										</div>
										<div class="col-7">
											<a class="text-danger" href="event.php?show-event=<?php echo $rw['e_event_id']; ?>"><h5 class="mb-1"><?php echo $rw['e_event_title']; ?></h5></a>
											<p><?php echo $rw['e_event_date']." ".$rw['e_event_time']; ?></p>
										</div>
										<div class="col-11">
											<hr>
										</div>
									</div>
								<?php }} ?>

								</div>
							 </div>

					  </div>
				</div>

			</div>
		</div>
	</div>
</section>
<?php 
//if check buy-tickets querystring set, user login and event result set not empty.
}else if(isset($_GET['buy-tickets']) && rowCounts(getEventByIdempty($conn, $_GET['buy-tickets']))==1){ 
	//Get user information from user table and user login table using user id.
	$userinfo = getUserinfo($conn, $_SESSION['login_id']); 
	//Get event information from event table using event id.
	$eventinfo = getEventById($conn, $_GET['buy-tickets']); ?>
	<section class="profilemainimage eventpagebg">
		
	</section>
	<!-- Buy tickets form -->
	<section class="mtop">
		<div class="eventbgcontent">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-10">
						<div class="card carddetail">
							<div class="card-body">
								<h3 class="">Buy Tickets</h3>
								<hr>
								<div class="row">
									<div class="col-6">
								<h5 class="card-title">Event Information</h5>
					  			<hr>
					  				<div class="form-group">
						    			<label for="etitle">Event Title *</label>
						    			<input type="text" name="etitle" value="<?php echo $eventinfo['e_event_title']; ?>" class="form-control" id="etitle" placeholder="Event Title" required readonly>
						  			</div>
						  			<div class="form-group">
						    			<label for="edate">Event Date *</label>
						    			<input type="text" name="edate" value="<?php echo $eventinfo['e_event_date']." ".$eventinfo['e_event_time']; ?>" class="form-control" id="edate" placeholder="Event Date" required readonly>
						  			</div>
						  		</div>
						  		<div class="col-6">
						  			<?php if(isset($_SESSION['login_id'])) { ?>
								<h5 class="card-title">User Information</h5>
								<hr>
									<div class="form-group">
						    			<label for="fname">First Name *</label>
						    			<input type="text" name="fname" value="<?php echo $userinfo['e_user_fname']; ?>" class="form-control" id="fname" placeholder="First Name" required readonly>
						  			</div>
						  			<div class="form-group">
								    	<label for="emailadd">Email Address *</label>
								    	<input type="email" name="email" value="<?php echo $userinfo['e_email']; ?>" class="form-control" id="emailadd" placeholder="Email Address" required readonly>
					  				</div>
					  			<?php } ?>
					  			</div>
					  			<div class="col-12">
					  			<h5 class="card-title">Payment Information</h5>
					  			<hr>
					  			<form method="post" action="">
					  			</div>
					  			<div class="col-6">
					  			<div class="form-group">
								    <label for="numberoftickets">Number of Tickets *</label>
								    <input type="number" name="numberoftickets" value="<?php echo $_POST['numberoftickets']; ?>" class="form-control" id="numberoftickets" placeholder="Number of Tickets" required>
					  			</div>
					  			<div class="form-group">
								    <label for="cardnumber">Card Number *</label>
								    <input type="number" name="cardnumber" value="<?php echo $_POST['cardnumber']; ?>" class="form-control" id="cardnumber" placeholder="XXXXXXXXXXXXXXXX" required>
					  			</div>
					  			</div>
					  			<div class="col-6">
					  			<div class="form-group">
								    <label for="cardexpirydate">Card Expiry Date *</label>
								    <input type="number" name="cardexpirydate" value="<?php echo $_POST['cardexpirydate']; ?>" class="form-control" id="cardexpirydate" placeholder="MMYY" required>
					  			</div>
					  			<div class="form-group">
								    <label for="cvv">CVV *</label>
								    <input type="number" name="cvv" value="<?php echo $_POST['cvv']; ?>" class="form-control" id="cvv" placeholder="XXX" required>
					  			</div>
					  			</div>
					  			
					  			<div class="col-12">
					  				<div class="form-group">
								    	<label for="message">Message</label>
								    	<textarea name="message" class="form-control" rows="4" cols="50" id="message"><?php echo $_POST['message']; ?></textarea>
					  				</div>
					  				<?php if(!empty($error)){ ?>
								  		<div class="form-group">
								  			<div class="message">
								  				<?php echo $error; //display errors 
								  				?>
								  			</div>
								  		</div>
									<?php  } ?>
					  			</div>
					  			<div class="col-12">
					  			
					  			 <button type="submit" name="buy" class="btn btn-primary">Buy Now</button>
					  			 </form>
					  			</div>
					  			</div>

							</div>
						</div>
					</div>
				</div>
		</div>
	</section>
<?php }else{ ?>
	<section class="profilemainimage eventpagebg">
		
	</section>
<?php }

?>

<?php include('includes/footer.php') ?>