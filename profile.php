<?php include('includes/header.php');	
//if user login not set and user type equal admin then redirect to index.php page 
if(!isset($_SESSION['login_id'])){
	locationRewrite('index.php');
}	
//Get specific tickets information from ticket table using user id
$tickets = getTicketsByUserId($conn, $_SESSION['login_id']);
?>
<section class="profilemainimage"></section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-3">
				<div class="wrap shadow-lg p-4 mb-5 bg-white rounded">
					<div class="left d-inline-block mr-2">
						<img src="img/man.jpg" alt="profile icon" width="60px" height="60px">
					</div>
					<div class="right d-inline-block align-middle">
						<h5 class="mb-1 text-uppercase"><?php echo $userinfo['e_user_fname']." ".$userinfo['last_name']; ?></h5>
						<span><?php echo $userinfo['e_email']; ?></span>
					</div>
				</div>
			</div>
			<div class="col-9">
				<div class="wrap shadow-lg p-4 mb-5 bg-white rounded">
					<?php if($_SESSION['user_type']=="user") { ?>
					<h3 class="">My Tickets</h3>
					<hr>
					<?php 
					//Get data and display (Tickets table)
						if ($tickets->num_rows > 0) {
							while($row1 = $tickets->fetch_assoc()) { ?>
							<div class="card bgcard">
								<div class="card-body">
		    						<h5 class="card-title">Event : <?php echo $row1['e_event_title']; ?></h5>
		    						<p class="card-text mb-1">Date : <?php echo $row1['e_event_date']." ".$row1['e_event_time']; ?></p>
		    						<p class="card-text">Confirmation Code : <?php echo $row1['e_confirmation_code']; ?></p>
		    					</div>
							</div>
						<?php	}
						}
					}
					?>
				</div>
				<
			</div>
		</div>
	</div>
</section>





<?php include('includes/footer.php') ?>