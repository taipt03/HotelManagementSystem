<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_SESSION['login_time'])) {
    $current_time = time();
    $session_lifetime = 24 * 60 * 60; // 24 hours

    // log out if session time exceed 24 hours
    if ($current_time - $_SESSION['login_time'] > $session_lifetime) {
        session_unset();
        session_destroy();
        echo "<script>alert('Your session has expired. Please login again.');</script>";
        echo "<script type='text/javascript'> document.location ='login.php'; </script>";
    }

    // Update time for new session
    $_SESSION['login_time'] = $current_time;
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Sand Dollar Hotel | Hotel :: Single Rooms</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="css/lightbox.css">

	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/responsiveslides.min.js"></script>
	<script>
		$(function() {
			$("#slider").responsiveSlides({
				auto: true,
				nav: true,
				speed: 500,
				namespace: "callbacks",
				pager: true,
			});
		});
	</script>
</head>

<body>
	<!--header-->
	<div class="header head-top">
		<div class="container">
			<?php include_once('includes/header.php'); 
			?>
		</div>
	</div>
	<!--header-->

	<!--rooms-->
	<div class="content">
		<div class="room-section">
			<div class="container">
				<h2>Rooms Details</h2>
				<div class="room-grids">
					<?php
					$host = 'localhost';
					$dbname = 'hotel_management';
					$user = 'postgres';
					$password = 'admin';
					$dsn = "pgsql:host=$host;dbname=$dbname";
					$dbh = new PDO($dsn, $user, $password);
					$cid = intval($_GET['catid']);
					$sql = "SELECT tblroom.*, tblroom.id as rmid , tblroom.price, tblcategory.id, tblcategory.categoryname from tblroom 
							join tblcategory on tblroom.roomtype = tblcategory.id 
							where tblroom.roomtype=:cid";
			        $sql1 = "SELECT tblfacility.facilitytitle as fname from tblroomfacility 
							join tblfacility on tblfacility.id = tblroomfacility.facility_id
							where tblroomfacility.room_id=:fid";
					$query = $dbh->prepare($sql);
					$query->bindParam(":cid", $cid, PDO::PARAM_INT);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);
					$query1 = $dbh->prepare($sql1);
					$query1->bindParam(":fid", $cid, PDO::PARAM_INT);
					$query1->execute();
					$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
					$cnt = 1;
					$cnt1 = 1;
					if ($query->rowCount() > 0) {
						foreach ($results as $row) {
					?>
							<div class="room1">
								<div class="col-md-5 room-grid" style="padding-bottom: 50px">
									<a href="#" class="mask">
										<img src="admin/images/<?php echo $row->image; ?>" class=" mask img-responsive zoom-img" alt="" /></a>
								</div>
								<div class="col-md-7 room-grid1">
									<h4>  </h4>
									<p><?php echo htmlentities($row->roomdesc); ?></p>
									<p>Max Adult:<?php echo " ", htmlentities($row->maxadult); ?></p>
									<p>Max Child:<?php echo " ", htmlentities($row->maxchild); ?></p>
									<p>No of Beds:<?php echo " ", htmlentities($row->noofbed); ?></p>
									<p>Facilities:
									<div>
										<?php
										if ($query1->rowCount() > 0) {
											foreach ($results1 as $row1) {
										?>
										<div>
											<p><?php echo "-" , " ", htmlentities($row1->fname); ?></p>										</div>
										<?php $cnt1 = $cnt1 + 1;
											}
										} ?>
									</div>
									</p>
									<p>Price: <?php echo htmlentities($row->price); ?></p>
									<button class="btn btn-success"><a href="book-room.php?rmid=<?php echo $row->rmid; ?>">Book</a></button>
								</div>
								<div class="clearfix"></div>
							</div>
					<?php $cnt = $cnt + 1;
						}
					} ?>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php include_once('includes/getintouch.php'); ?>
	</div>
	<!--rooms-->

	<!--footer-->
</body>

</html>
