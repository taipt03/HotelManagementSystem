<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
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
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$sql = "insert into tblcontact(Name,MobileNumber,Email,Message)values(:name,:phone,:email,:message)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':phone', $phone, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':message', $message, PDO::PARAM_STR);
	$query->execute();
	$LastInsertId = $dbh->lastInsertId();
	if ($LastInsertId > 0) {
		echo "<script>alert('Your message was sent successfully!.');</script>";
		echo "<script>window.location.href ='contact.php'</script>";
	} else {
		echo '<script>alert("Something Went Wrong. Please try again")</script>';
	}
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Sand Dollar Hotel | Hotel :: Contact Us</title>
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
				<h2>contact us</h2>
				<br />
				<p style="text-align: center; font-size: 2.2rem; font-weight: 500; padding-bottom: 2rem">Please leave your review here</p>
				<div class="contact-grids">
					<div class="col-md-6 contact-left">
						<?php
						$sql = "SELECT * from tblpage where PageType='aboutus'";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);
						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) {
						?>
								<p><?php echo htmlentities($row->PageDescription); ?>.</p><?php $cnt = $cnt + 1;
																						}
																					} ?>
						<?php
						$sql = "SELECT * from tblpage where PageType='contactus'";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);
						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) {
						?>
								<address>
									<h4><?php echo htmlentities($row->PageTitle); ?></h4>
									<p><?php echo htmlentities($row->PageDescription); ?></p>
									<p>Telephone : +<?php echo htmlentities($row->MobileNumber); ?></p>
									<p>E-mail : <?php echo htmlentities($row->Email); ?></p>
								</address><?php $cnt = $cnt + 1;
										}
									} ?>
					</div>
					<div class="col-md-6 contact-right">
						<form method="post">
							<h5>Name</h5>
							<input type="text" type="text" value="" name="name" required="true">
							<h5>Mobile Number</h5>
							<input type="text" name="phone" required="true" maxlength="10" pattern="[0-9]+">
							<h5>Email Address</h5>
							<input type="text" type="email" value="" name="email" required="true">
							<h5>Message</h5>
							<textarea rows="10" name="message" required="true"></textarea>
							<input type="submit" value="send" name="submit">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php include_once('includes/getintouch.php'); ?>
	</div>
	<!--about-->
</body>

</html>