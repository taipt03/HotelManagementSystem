<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsaid'] == 0)) {
	header('location:logout.php');
} else {
	try{
	if (isset($_POST['submit'])) {



		$bookingid = $_GET['bookingid'];
		$status = $_POST['status'];
		$remark = $_POST['remark'];


		$sql = "UPDATE tblbooking SET status=:status,remark=:remark WHERE bookingnumber=:bookingid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':remark', $remark, PDO::PARAM_STR);
		$query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);

		$query->execute();

		echo '<script>alert("Remark has been updated")</script>';
		echo "<script>window.location.href ='new-booking.php'</script>";
	}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Sand Dollar Hotel Admin | View Booking Details</title>

		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<!-- Graph CSS -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- jQuery -->
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- lined-icons -->
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<script src="js/simpleCart.min.js"> </script>
		<script src="js/amcharts.js"></script>
		<script src="js/serial.js"></script>
		<script src="js/light.js"></script>
		<!-- //lined-icons -->
		<script src="js/jquery-1.10.2.min.js"></script>
		<!--pie-chart--->
		<script src="js/pie-chart.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#demo-pie-1').pieChart({
					barColor: '#3bb2d0',
					trackColor: '#eee',
					lineCap: 'round',
					lineWidth: 8,
					onStep: function(from, to, percent) {
						$(this.element).find('.pie-value').text(Math.round(percent) + '%');
					}
				});

				$('#demo-pie-2').pieChart({
					barColor: '#fbb03b',
					trackColor: '#eee',
					lineCap: 'butt',
					lineWidth: 8,
					onStep: function(from, to, percent) {
						$(this.element).find('.pie-value').text(Math.round(percent) + '%');
					}
				});

				$('#demo-pie-3').pieChart({
					barColor: '#ed6498',
					trackColor: '#eee',
					lineCap: 'square',
					lineWidth: 8,
					onStep: function(from, to, percent) {
						$(this.element).find('.pie-value').text(Math.round(percent) + '%');
					}
				});


			});
		</script>
	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="inner-content">
					<!-- header-starts -->
					<?php include_once('includes/header.php'); ?>

					<!--content-->
					<div class="content">
						<div class="women_main">
							<!-- start content -->
							<div class="grids">
								<div class="progressbar-heading grids-heading">
									<h2>View Booking Details</h2>
								</div>
								<div class="panel panel-widget forms-panel">
									<div class="forms">
										<div class="form-grids widget-shadow" data-example-id="basic-forms">
											<div class="form-title">
												<h4>View Booking Details</h4>
											</div>
											<div class="form-body">

											<?php
												$bookingid = $_GET['bookingid'];

												$sql = "SELECT tblbooking.bookingnumber,tbluser.fullname,tbluser.mobilenumber,tbluser.email,tblbooking.paymentmethod,tbluser.gender,tbluser.address,tblbooking.checkindate,tblbooking.checkoutdate,tblbooking.bookingdate,tblbooking.remark,tblbooking.status,tblbooking.updationdate,tblcategory.categoryname,tblcategory.description,tblroom.price,tblroom.roomname,tblroom.maxadult,tblroom.maxchild,tblroom.roomdesc,tblroom.noofbed,tblroom.image 
												FROM tblbooking 
												JOIN tblroom ON tblbooking.roomid=tblroom.id 
												JOIN tblcategory ON tblcategory.id=tblroom.roomtype 
												JOIN tbluser ON tblbooking.userid=tbluser.id  
												WHERE tblbooking.bookingnumber='$bookingid'";
												$query = $dbh->prepare($sql);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);

												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $row) {               ?>
														<table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
															<tr>
																<th colspan="4" style="color: red;font-weight: bold;text-align: center;font-size: 20px"> Booking Number: <?php echo $bookingid; ?></th>
															</tr>
															<tr>
																<th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Booking Detail:</th>
															</tr>
															<tr>
																<th>Customer Name</th>
																<td><?php echo $row->fullname; ?></td>
																<th>Mobile Number</th>
																<td><?php echo $row->mobilenumber; ?></td>
															</tr>


															<tr>

																<th>Email</th>
																<td><?php echo $row->email; ?></td>
																<th>Payment Method</th>
																<td><?php echo $row->paymentmethod; ?></td>
															</tr>
															<tr>

																<th>Gender</th>
																<td><?php echo $row->gender; ?></td>
																<th>Address</th>
																<td><?php echo $row->address; ?></td>
															</tr>
															<tr>
																<th>Check in Date</th>
																<td><?php echo $row->checkindate; ?></td>
																<th>Check out Date</th>
																<td><?php echo $row->checkoutdate; ?></td>
															</tr>

															<tr>
															<tr>
																<th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Room Detail:</th>
															</tr>
															<th>Room Type</th>
															<td><?php echo $row->categoryname; ?></td>
															<th>Room Price(perday)</th>
															<td>$<?php echo $row->price; ?></td>
															</tr>

															<tr>

																<th>Room Name</th>
																<td><?php echo $row->roomname; ?></td>
																<th>Room Description</th>
																<td><?php echo $row->roomdesc; ?></td>
															</tr>
															<tr>

																<th>Max Adult</th>
																<td><?php echo $row->maxadult; ?></td>
																<th>Max Child</th>
																<td><?php echo $row->maxchild; ?></td>
															</tr>
															<tr>

																<th>No.of Bed</th>
																<td><?php echo $row->noofbed; ?></td>
																<th>Room Image</th>
																<td><img src="images/<?php echo $row->image; ?>" width="100" height="100" value="<?php echo $row->image; ?>"></td>
															</tr>
															<tr>
																<th>Booking Date</th>
																<td><?php echo $row->bookingdate; ?></td>
															</tr>
															<tr>
																<th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Admin Remarks:</th>
															</tr>
															<tr>

																<th>Order Final Status</th>

																<td> <?php $status = $row->status;

																		if ($row->status == "Approved") {
																			echo "Your Booking has been approved";
																		}

																		if ($row->status == "Cancelled") {
																			echo "Your Booking has been cancelled";
																		}


																		if ($row->status == "") {
																			echo "Not Response Yet";
																		}; ?></td>
																<th>Admin Remark</th>
																<?php if ($row->status == "") { ?>

																	<td><?php echo "Not Updated Yet"; ?></td>
																<?php } else { ?> <td><?php echo htmlentities($row->remark); ?>
																	</td>
																<?php } ?>
															</tr>

														
													<?php $cnt = $cnt + 1;
													ini_set('display_errors', 1);
													error_reporting(E_ALL);
													}
												} ?>
														</table>
														<p>
															<a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
														</p>

											</div>
										</div>
									</div>
								</div>


							</div>

							<!-- end content -->

							<?php include_once('includes/footer.php'); ?>
						</div>

					</div>
					<!--content-->
				</div>
			</div>
			<!--//content-inner-->
			<!--/sidebar-menu-->
			<?php include_once('includes/sidebar.php'); ?>
			<div class="clearfix"></div>
		</div>
		<script>
			var toggle = true;

			$(".sidebar-icon").click(function() {
				if (toggle) {
					$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
					$("#menu span").css({
						"position": "absolute"
					});
				} else {
					$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
					setTimeout(function() {
						$("#menu span").css({
							"position": "relative"
						});
					}, 400);
				}

				toggle = !toggle;
			});
		</script>
		<!--js -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- /Bootstrap Core JavaScript -->
		<!-- real-time -->
		<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
		<script type="text/javascript">
			$(function() {

				// We use an inline data source in the example, usually data would
				// be fetched from a server

				var data = [],
					totalPoints = 300;

				function getRandomData() {

					if (data.length > 0)
						data = data.slice(1);

					// Do a random walk

					while (data.length < totalPoints) {

						var prev = data.length > 0 ? data[data.length - 1] : 50,
							y = prev + Math.random() * 10 - 5;

						if (y < 0) {
							y = 0;
						} else if (y > 100) {
							y = 100;
						}

						data.push(y);
					}

					// Zip the generated y values with the x values

					var res = [];
					for (var i = 0; i < data.length; ++i) {
						res.push([i, data[i]])
					}

					return res;
				}

				// Set up the control widget

				var updateInterval = 30;
				$("#updateInterval").val(updateInterval).change(function() {
					var v = $(this).val();
					if (v && !isNaN(+v)) {
						updateInterval = +v;
						if (updateInterval < 1) {
							updateInterval = 1;
						} else if (updateInterval > 2000) {
							updateInterval = 2000;
						}
						$(this).val("" + updateInterval);
					}
				});

				var plot = $.plot("#placeholder", [getRandomData()], {
					series: {
						shadowSize: 0 // Drawing is faster without shadows
					},
					yaxis: {
						min: 0,
						max: 100
					},
					xaxis: {
						show: false
					}
				});

				function update() {

					plot.setData([getRandomData()]);

					// Since the axes don't change, we don't need to call plot.setupGrid()

					plot.draw();
					setTimeout(update, updateInterval);
				}

				update();

				// Add the Flot version string to the footer

				$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
			});
		</script>
		<!-- /real-time -->
		<script src="js/jquery.fn.gantt.js"></script>
		<script>
			$(function() {

				"use strict";

				$(".gantt").gantt({
					source: [{
						name: "Sprint 0",
						desc: "Analysis",
						values: [{
							from: "/Date(1320192000000)/",
							to: "/Date(1322401600000)/",
							label: "Requirement Gathering",
							customClass: "ganttRed"
						}]
					}, {
						name: " ",
						desc: "Scoping",
						values: [{
							from: "/Date(1322611200000)/",
							to: "/Date(1323302400000)/",
							label: "Scoping",
							customClass: "ganttRed"
						}]
					}, {
						name: "Sprint 1",
						desc: "Development",
						values: [{
							from: "/Date(1323802400000)/",
							to: "/Date(1325685200000)/",
							label: "Development",
							customClass: "ganttGreen"
						}]
					}, {
						name: " ",
						desc: "Showcasing",
						values: [{
							from: "/Date(1325685200000)/",
							to: "/Date(1325695200000)/",
							label: "Showcasing",
							customClass: "ganttBlue"
						}]
					}, {
						name: "Sprint 2",
						desc: "Development",
						values: [{
							from: "/Date(1326785200000)/",
							to: "/Date(1325785200000)/",
							label: "Development",
							customClass: "ganttGreen"
						}]
					}, {
						name: " ",
						desc: "Showcasing",
						values: [{
							from: "/Date(1328785200000)/",
							to: "/Date(1328905200000)/",
							label: "Showcasing",
							customClass: "ganttBlue"
						}]
					}, {
						name: "Release Stage",
						desc: "Training",
						values: [{
							from: "/Date(1330011200000)/",
							to: "/Date(1336611200000)/",
							label: "Training",
							customClass: "ganttOrange"
						}]
					}, {
						name: " ",
						desc: "Deployment",
						values: [{
							from: "/Date(1336611200000)/",
							to: "/Date(1338711200000)/",
							label: "Deployment",
							customClass: "ganttOrange"
						}]
					}, {
						name: " ",
						desc: "Warranty Period",
						values: [{
							from: "/Date(1336611200000)/",
							to: "/Date(1349711200000)/",
							label: "Warranty Period",
							customClass: "ganttOrange"
						}]
					}],
					navigate: "scroll",
					scale: "weeks",
					maxScale: "months",
					minScale: "days",
					itemsPerPage: 10,
					onItemClick: function(data) {
						alert("Item clicked - show some details");
					},
					onAddClick: function(dt, rowId) {
						alert("Empty space clicked - add an item!");
					},
					onRender: function() {
						if (window.console && typeof console.log === "function") {
							console.log("chart rendered");
						}
					}
				});

				$(".gantt").popover({
					selector: ".bar",
					title: "I'm a popover",
					content: "And I'm the content of said popover.",
					trigger: "hover"
				});

				prettyPrint();

			});
		</script>
		<script src="js/menu_jquery.js"></script>

		<script src="js/pages/be_tables_datatables.js"></script>
	</body>

	</html><?php }  ?>