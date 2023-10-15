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
    <title>Sand Dollar Hotel | Hotel :: View Booking Detail</title>
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
          <?php
          $vid = $_GET['viewid'];

          $sql = "SELECT tblbooking.BookingNumber,tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tblbooking.ID as tid,tblbooking.IDType,tblbooking.Gender,tblbooking.Address,tblbooking.CheckinDate,tblbooking.CheckoutDate,tblbooking.BookingDate,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblcategory.CategoryName,tblcategory.Description,tblcategory.Price,tblroom.RoomName,tblroom.MaxAdult,tblroom.MaxChild,tblroom.RoomDesc,tblroom.NoofBed,tblroom.Image,tblroom.RoomFacility 
from tblbooking 
join tblroom on tblbooking.RoomId=tblroom.ID 
join tblcategory on tblcategory.ID=tblroom.RoomType 
join tbluser on tblbooking.UserID=tbluser.ID  
where tblbooking.ID=:vid";
          $query = $dbh->prepare($sql);
          $query->bindParam(':vid', $vid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);

          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $row) {               ?>
              <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <tr>
                  <th colspan="4" style="color: red;font-weight: bold;text-align: center;font-size: 20px"> Booking Number: <?php echo $row->BookingNumber; ?></th>
                </tr>
                <tr>
                  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Booking Detail:</th>
                </tr>
                <tr>
                  <th>Customer Name</th>
                  <td><?php echo $row->FullName; ?></td>
                  <th>Mobile Number</th>
                  <td><?php echo $row->MobileNumber; ?></td>
                </tr>


                <tr>

                  <th>Email</th>
                  <td><?php echo $row->Email; ?></td>
                  <th>ID Type</th>
                  <td><?php echo $row->IDType; ?></td>
                </tr>
                <tr>

                  <th>Gender</th>
                  <td><?php echo $row->Gender; ?></td>
                  <th>Address</th>
                  <td><?php echo $row->Address; ?></td>
                </tr>
                <tr>
                  <th>Check in Date</th>
                  <td><?php echo $row->CheckinDate; ?></td>
                  <th>Check out Date</th>
                  <td><?php echo $row->CheckoutDate; ?></td>
                </tr>

                <tr>
                <tr>
                  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Room Detail:</th>
                </tr>
                <th>Room Type</th>
                <td><?php echo $row->CategoryName; ?></td>
                <th>Room Price(perday)</th>
                <td>$<?php echo $row->Price; ?></td>
                </tr>

                <tr>

                  <th>Room Name</th>
                  <td><?php echo $row->RoomName; ?></td>
                  <th>Room Description</th>
                  <td><?php echo $row->RoomDesc; ?></td>
                </tr>
                <tr>

                  <th>Max Adult</th>
                  <td><?php echo $row->MaxAdult; ?></td>
                  <th>Max Child</th>
                  <td><?php echo $row->MaxChild; ?></td>
                </tr>
                <tr>

                  <th>No.of Bed</th>
                  <td><?php echo $row->NoofBed; ?></td>
                  <th>Room Image</th>
                  <td><img src="admin/images/<?php echo $row->Image; ?>" width="100" height="100" value="<?php echo $row->Image; ?>"></td>
                </tr>
                <tr>

                  <th>Room Facility</th>
                  <td><?php echo $row->RoomFacility; ?></td>
                  <th>Booking Date</th>
                  <td><?php echo $row->BookingDate; ?></td>
                </tr>
                <tr>
                  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Admin Remarks:</th>
                </tr>
                <tr>

                  <th>Order Final Status</th>

                  <td> <?php $status = $row->Status;

                        if ($row->Status == "Approved") {
                          echo "Your Booking has been approved";
                        }

                        if ($row->Status == "Cancelled") {
                          echo "Your Booking has been cancelled";
                        }


                        if ($row->Status == "") {
                          echo "Not Response Yet";
                        }; ?></td>
                  <th>Admin Remark</th>
                  <?php if ($row->Status == "") { ?>

                    <td><?php echo "Not Updated Yet"; ?></td>
                  <?php } else { ?> <td><?php echo htmlentities($row->Remark); ?>
                    </td>
                  <?php } ?>
                </tr>


            <?php $cnt = $cnt + 1;
            }
          } ?>

              </table>
              <?php if ($row->Status != "Cancelled") { ?>
                <a href="invoice.php?invid=<?php echo htmlentities($row->tid); ?>" class="btn btn-success">Invoice</a>
              <?php } ?>
              <?php if ($row->Status == "") { ?>
                <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Delete</button>
              <?php } ?>
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete booking</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-bordered table-hover data-tables">
                        <form method="post" name="submit">
                          <tr>
                            <th>Remark :</th>
                            <td>
                              <textarea name="remark" placeholder="Tell us your reason to delete this booking" rows="12" cols="14" class="form-control wd-450"></textarea>
                            </td>
                          </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="submit" class="btn btn-primary">Delete</button>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
              <?php
              if (isset($_POST['submit'])) {
                $bookingid = $row->BookingNumber;
                $status = "Cancelled";
                $remark = $_POST['remark'];


                $sql = "update tblbooking set Status=:status,Remark=:remark where BookingNumber=:bookingid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->bindParam(':remark', $remark, PDO::PARAM_STR);
                $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
                $query->execute();

                echo '<script>alert("Your booking is deleted successfully")</script>';
                echo "<script>window.location.href ='my-booking.php'</script>";
              }
              ?>
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