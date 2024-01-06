<?php
												$host = 'localhost';
												$dbname = 'hotel_management';
												$user = 'postgres';
												$password = 'admin';

												$dsn = "pgsql:host=$host;dbname=$dbname";
												$dbh = new PDO($dsn, $user, $password);
												$bookingid = '390343987';

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