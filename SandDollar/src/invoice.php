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
  <script language="javascript" type="text/javascript">
    function f2() {
      window.close();
    }

    function f3() {
      window.print();
    }
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
        <h2 class="type">Invoice</h2>
      </div>
      <p>My Hotel Booking Detail.</p>
      <div class="bs-docs-example">
        <?php
        $host = 'localhost';
        $dbname = 'hotel_management';
        $user = 'postgres';
        $password = 'admin';
        $dsn = "pgsql:host=$host;dbname=$dbname";
        $dbh = new PDO($dsn, $user, $password);
        $invid = $_GET['invid'];
        $sql = "SELECT tblbooking.bookingnumber,tbluser.fullname,date_part('day',age(tblbooking.checkoutdate,tblbooking.checkindate)) as ddf,tbluser.mobilenumber,tbluser.email,tblbooking.idtype,tblbookinggender,tblbooking.address,tblbooking.checkindate,tblbooking.checkoutdate,tblbooking.bookingdate,tblbooking.remark,tblbooking.status,tblbooking.updationdate,tblcategory.categoryname,tblcategory.description,tblcategory.price,tblroom.roomname,tblroom.maxadult,tblroom.maxchild,tblroom.roomdesc,tblroom.noofbed,tblroom.image,tblroom.roomfacility 
        from tblbooking 
        join tblroom on tblbooking.roomid=tblroom.id 
        join tblcategory on tblcategory.id=tblroom.roomtype 
        join tbluser on tblbooking.userid=tbluser.id  
        where tblbooking.id=:invid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':invid', $invid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) {               ?>
            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
              <tr>
                <th colspan="5" style="text-align: center;color: red;font-size: 20px">Booking Number: <?php echo $row->bookingnumber; ?></th>
              </tr>


              <tr>
                <th>Customer Name</th>
                <td><?php echo $row->fullname; ?></td>
                <th>Mobile Number</th>
                <td colspan="2"><?php echo $row->mobilenumber; ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><?php echo $row->email; ?></td>
                <th>Booking Date</th>
                <td colspan="2"><?php echo $row->bookingdate; ?></td>
              </tr>
              <tr>
                <th>Room Type</th>
                <td><?php echo $row->categoryname; ?></td>
                <th>Room Image</th>
                <td><img src="admin/images/<?php echo $row->image; ?>" width="100" height="100" value="<?php echo $row->image; ?>"></td>
              </tr>
              <tr>
                <th>Room Price(perday)</th>
                <td>$<?php echo $row->price; ?></td>
                <th>Total No. of Days</th>
                <td colspan="2"><?php echo $row->ddf; ?></td>
              </tr>
              <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <tr>
                  <th colspan="5" style="text-align: center;color: red;font-size: 20px">Invoice Detail</th>
                </tr>
                <tr>
                  <th style="text-align: center;">Total Days</th>

                  <th style="text-align: center;">Room Price</th>
                  <th style="text-align: center;">Total Price</th>
                </tr>
                <tr>
                  <td style="text-align: center;"><?php echo $ddf = $row->ddf; ?></td>

                  <td style="text-align: center;"><?php echo $tp = $row->price; ?></td>
                  <td style="text-align: center;"><?php echo $total = $ddf * $tp; ?></td>

                </tr>

              <?php
              $grandtotal += $total;
              $cnt = $cnt + 1;
            } ?>
              <tr>
                <th colspan="2" style="text-align:center;color: blue">Grand Total </th>
                <td colspan="2" style="text-align: center;"><?php echo $grandtotal; ?></td>
              </tr>

            <?php $cnt = $cnt + 1;
          } ?>
              </table>
            </table>
            <p style="text-align: center;font-size: 20px">
              <input name="Submit2" type="submit" class="btn btn-success" style="font-size: 20px" value="Print" onClick="return f3();" style="cursor: pointer;" />
            </p>
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