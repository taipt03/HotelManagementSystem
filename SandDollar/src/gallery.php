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
	<title>Sand Dollar Hotel | Hotel :: Gallery</title>
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
</head>

<body>
	<!--header-->
	<div class="header head-top">
		<div class="container">
			<?php include_once('includes/header.php'); ?>
		</div>
	</div>
	<!--header-->

	<div class="content">
		<!-- gallery -->
		<div class="gallery-top">
			<!-- container -->
			<div class="container">
				<div class="gallery-info">
					<h2>gallery</h2>
				</div>
				<div class="gallery-grids-top">
					<div class="gallery-grids">
						<?php
						$sql = "SELECT * from tblroom";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);
						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) {
						?>
								<div class="col-md-3 gallery-grid">
									<br />
									<a class="example-image-link" href="admin/images/<?php echo $row->Image; ?>" data-lightbox="example-set" data-title=""><img class="example-image" src="admin/images/<?php echo $row->Image; ?>" height="300" width="300" alt="" /></a>
								</div>
						<?php $cnt = $cnt + 1;
							}
						} ?>
						<div class="clearfix"></div>
					</div>
					<script src="js/lightbox-plus-jquery.min.js"></script>
				</div>
			</div>
			<!-- //container -->
		</div>
		<!-- //gallery -->
		<?php include_once('includes/getintouch.php'); ?>
	</div>

	<!--footer-->
	<!--footer-->
</body>

</html>