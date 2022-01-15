<?php 
//include header file
include('includes/header.php') ?>

<?php 
$setaction = 1;
//if check querystring and user login set or not
if(empty($_GET['action']) || !isset($_GET['action']) || isset($_SESSION['login_id'])){
	$setaction  = 0;
}else if($_GET['action']=="register"){
	include 'includes/register.php';
 }else if($_GET['action']=="login"){ 
	include 'includes/login.php';
 }else{
	$setaction  = 0;
}

if($setaction == 0){ 
	$events = getAllEvents($conn); ?>
	<section class="mainvisual">
	<ul>
		<li class="one"></li>
		<li class="two"></li>
		<li class="three"></li>
	</ul>
</section>
<section class="eventswrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="mb-5">Events</h2>
			</div>
			<?php 
			//Get data and display (Event table) and display
			if ($events->num_rows > 0) {
				while($row = $events->fetch_assoc()) { ?>
			<div class="col-3">
				<div class="wrap card">
					<a class="text-danger" href="event.php?show-event=<?php echo $row['e_event_id']; ?>"><img class="card-img-top" src="img/event.jpg" alt="Card image cap"></a>
					 <div class="card-body">
					    <a class="text-danger" href="event.php?show-event=<?php echo $row['e_event_id']; ?>"><h5 class="card-title"><?php echo $row['e_event_title']; ?></h5></a>
					    <p class="mb-1"><?php echo $row['e_event_date']." ".$row['e_event_time']; ?></p>
					    <p class="card-text"><?php echo substr_replace($row['e_event_details'],"...",50); ?></p>
					    <a href="event.php?show-event=<?php echo $row['e_event_id']; ?>" class="btn btn-primary">Read more and buy tickets</a>
					  </div>
				</div>
			</div>
		<?php } } ?>
		</div>
	</div>
</section>
<?php }else{ ?>

<?php }

?>

<?php 
//include footer file
include('includes/footer.php') ?>