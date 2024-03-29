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
	if (isset($_POST['submit'])) {
		$booknum = mt_rand(100000000, 999999999);
		$rid = intval($_GET['rmid']);
		$uid = $_SESSION['hbmsuid'];
		$paymentmethod = $_POST['paymentmethod'];
		$checkindate = $_POST['checkindate'];
		$checkoutdate = $_POST['checkoutdate'];

		$cdate = date('Y-m-d');
		if ($checkindate <  $cdate) {
			echo '<script>alert("Check in date must be greater than current date")</script>';
		} else if ($checkindate > $checkoutdate) {
			echo '<script>alert("Check out date must be equal to / greater than  check in date")</script>';
		} else {
			$sql = "INSERT INTO tblbooking(roomid,bookingnumber,userid,paymentmethod,checkindate,checkoutdate)values(:rid,:booknum,:uid,:paymentmethod,:checkindate,:checkoutdate)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':rid', $rid, PDO::PARAM_STR);
			$query->bindParam(':booknum', $booknum, PDO::PARAM_STR);
			$query->bindParam(':uid', $uid, PDO::PARAM_STR);
			$query->bindParam(':paymentmethod', $paymentmethod, PDO::PARAM_STR);
			$query->bindParam(':checkindate', $checkindate, PDO::PARAM_STR);
			$query->bindParam(':checkoutdate', $checkoutdate, PDO::PARAM_STR);
			$query->execute();

			$LastInsertId = $dbh->lastInsertId();
			if ($LastInsertId > 0) {
				echo '<script>alert("Your room has been book successfully. Booking Number is "+"' . $booknum . '")</script>';

				echo "<script>window.location.href ='index.php'</script>";
			} else {
				echo '<script>alert("Something Went Wrong. Please try again")</script>';
			}
		}
	}
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Sand Dollar Hotel | Hotel :: Book Room</title>
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
	<!--about-->

	<div class="content">
		<div class="contact">
			<div class="container">
				<h2>Book Your Room</h2>

				<div class="contact-grids">

					<div class="col-md-6 contact-right">
						<form method="post">
							</select>
							<?php
							$host = 'localhost';
							$dbname = 'hotel_management';
							$user = 'postgres';
							$password = 'admin';
							$dsn = "pgsql:host=$host;dbname=$dbname";
							$dbh = new PDO($dsn, $user, $password);
							$uid = $_SESSION['hbmsuid'];
							$sql = "SELECT * from  tbluser where id=:uid";
							$query = $dbh->prepare($sql);
							$query->bindParam(':uid', $uid, PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) {               ?>
									<h5>Name</h5>
									<input type="text" value="<?php echo $row->fullname; ?>" name="name" class="form-control" required="true" readonly="true">
									<h5>Mobile Number</h5>
									<input type="text" name="phone" class="form-control" required="true" maxlength="10" pattern="[0-9]+" value="<?php echo $row->mobilenumber; ?>" readonly="true">
									<?php $cnt = $cnt + 1;
								}
							} ?>
							<h5>ID Type</h5>
							<select type="text" value="" class="form-control" name="paymentmethod" required="true" class="form-control">
								<option value="">Choose ID Type</option>
								<option value="In Cash">Identification Card</option>
								<option value="Adhar Card">Visa Card</option>
								<option value="Napas">Napas</option>
							</select>
							<h5>Checkin Date</h5>
							<input type="date" value="" class="form-control" name="checkindate" required="true">
							<h5>Checkout Date</h5>
							<input type="date" value="" class="form-control" name="checkoutdate" required="true">

							<input type="submit" value="send" name="submit">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php include_once('includes/getintouch.php'); ?>
	</div>

</html><?php }  ?>