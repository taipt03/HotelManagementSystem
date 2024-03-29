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
	<title>Sand Dollar Hotel | About Us :: Page</title>
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
		<div class="about-section">
			<div class="container">
				<?php
                $host = 'localhost';
                $dbname = 'hotel_management';
                $user = 'postgres';
                $password = 'admin';
                $dsn = "pgsql:host=$host;dbname=$dbname";
                $dbh = new PDO($dsn, $user, $password);
				$sql = "SELECT * from tblpage where pagetype='aboutus'";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_OBJ);

				$cnt = 1;
				if ($query->rowCount() > 0) {
					foreach ($results as $row) {
				?>
						<h2><?php echo htmlentities($row->pagetitle); ?></h2>
						<img src="images/p1.jpg" class="img-responsive" alt="/">
						<h5><?php echo htmlentities($row->pagetitle); ?></h5>
						<p><?php echo htmlentities($row->pagedescription); ?>.</p>
				<?php $cnt = $cnt + 1;
					}
				} ?>
			</div>
		</div>
		<?php include_once('includes/getintouch.php'); ?>
	</div>
	<!--about-->
</body>

</html>