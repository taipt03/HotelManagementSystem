<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['hbmsuid'] == 0)) {
	header('location:logout.php');
} else {
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
	<title>Sand Dollar Hotel | Hotel :: My Booking</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

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
			<?php include_once('includes/header.php'); ?>
		</div>
	</div>
	<!--header-->
	<!-- typography -->
	<div class="typography">
		<!-- container-wrap -->
		<div class="container">
			<div class="typography-info">
				<h2 class="type">My Hotel Booking Detail</h2>
			</div>

			<div class="bs-docs-example">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Booking Number</th>
							<th>Name</th>
							<th>Mobile Number</th>
							<th>Email</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$host = 'localhost';
						$dbname = 'hotel_management';
						$user = 'postgres';
						$password = 'admin';
						$dsn = "pgsql:host=$host;dbname=$dbname";
						$dbh = new PDO($dsn, $user, $password);
						$uid = $_SESSION['hbmsuid'];
						$sql = "SELECT tbluser.*,tblbooking.bookingnumber,tblbooking.status,tblbooking.id as bid from tblbooking join tbluser on tblbooking.userid=tbluser.id where userid=:uid";

						$query = $dbh->prepare($sql);
						$query->bindParam(':uid', $uid, PDO::PARAM_STR);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) {               ?>
								<tr>
									<td><?php echo htmlentities($cnt); ?></td>
									<td><?php echo htmlentities($row->bookingnumber); ?></td>
									<td><?php echo htmlentities($row->fullname); ?></td>
									<td><?php echo htmlentities($row->mobilenumber); ?></td>
									<td><?php echo htmlentities($row->email); ?></td>
									<?php if ($row->status == "") { ?>

										<td><?php echo "Still Pending"; ?></td>
									<?php } else { ?> <td><?php echo htmlentities($row->status); ?>
										</td>
									<?php } ?>
									<td><a href="view-application-detail.php?viewid=<?php echo htmlentities($row->bid); ?>" class="btn btn-danger">View</a>
									</td>
								</tr>
						<?php $cnt = $cnt + 1;
							}
						} ?>

					</tbody>
				</table>
			</div>

		</div>
		<!-- //container-wrap -->
	</div>
	<!-- //typography -->

	<?php include_once('includes/getintouch.php'); ?>
	</div>
	<!--footer-->
</body>

</html><?php }  ?>