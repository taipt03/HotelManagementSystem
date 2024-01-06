<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsaid'] == 0)) {
    header('location:logout.php');
} else {

?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Sand Dollar Hotel Admin | All Booking</title>

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
                                    <h2>All Booking</h2>
                                </div>
                                <div class="panel panel-widget forms-panel">
                                    <div class="forms">
                                        <div class="form-grids widget-shadow" data-example-id="basic-forms">
                                            <div class="form-title">
                                                <h4>All Booking</h4>
                                            </div>
                                            <div class="form-body">

                                            <?php
                                                $host = 'localhost';
                                                $dbname = 'hotel_management';
                                                $user = 'postgres';
                                                $password = 'admin';

                                                $dsn = "pgsql:host=$host;dbname=$dbname";
                                                $dbh = new PDO($dsn, $user, $password);

                                                $tableName = 'tblbooking';
                                                $no_of_records_per_page = 4;

                                                if (isset($_GET['pageno'])) {
                                                    $pageno = $_GET['pageno'];
                                                } else {
                                                    $pageno = 1;
                                                }

                                                $offset = ($pageno - 1) * $no_of_records_per_page;

                                                // Fetch total number of rows
                                                $ret = "SELECT COUNT(*) FROM $tableName";
                                                $query1 = $dbh->prepare($ret);
                                                $query1->execute();
                                                $total_rows = $query1->fetchColumn();
                                                $total_pages = ceil($total_rows / $no_of_records_per_page);

                                                // Fetch booking data with pagination
                                                $sql = "SELECT tbluser.*, tblbooking.bookingnumber, tblbooking.id, tblbooking.status, tblbooking.bookingdate, tblbooking.paymentmethod 
                                                        FROM $tableName 
                                                        JOIN tbluser ON tblbooking.userid = tbluser.id 
                                                        OFFSET $offset LIMIT $no_of_records_per_page";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    ?>
                                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Booking Number</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Mobile Number</th>
                                                                <th>Booking Date</th>
                                                                <th>Status</th>
                                                                <th>Payment Method</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($results as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                                                    <td><?php echo htmlentities($row->bookingnumber); ?></td>
                                                                    <td><?php echo htmlentities($row->fullname); ?></td>
                                                                    <td><?php echo htmlentities($row->email); ?></td>
                                                                    <td><?php echo htmlentities($row->mobilenumber); ?></td>
                                                                    <td><span class="badge badge-primary"><?php echo htmlentities($row->bookingdate); ?></span></td>

                                                                    <td>
                                                                        <?php
                                                                        $status = $row->status;
                                                                        if ($status == '') :
                                                                            ?>
                                                                            <span class="badge badge-warning"><?php echo htmlentities('Not Updated Yet'); ?></span>
                                                                        <?php elseif ($status == 'Cancelled') : ?>
                                                                            <span class="badge badge-danger"><?php echo htmlentities($row->status); ?></span>
                                                                        <?php elseif ($status == 'Approved') : ?>
                                                                            <span class="badge badge-success"><?php echo htmlentities($row->status); ?></span>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <td><?php echo htmlentities($row->paymentmethod); ?></td>

                                                                    <td class="d-none d-sm-table-cell"><a href="view-booking-detail.php?bookingid=<?php echo htmlentities($row->bookingnumber); ?>" class="btn btn-info btn-sm">View Details</a></td>
                                                                </tr>
                                                                <?php
                                                                $cnt = $cnt + 1;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="9" style="color:red; font-size:22px; text-align:center">No record found</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                                ?>
                                                <div align="left">
                                                    <ul class="pagination">
                                                        <li><a href="?pageno=1"><strong>First></strong></a></li>
                                                        <li class="<?php if ($pageno <= 1) {
                                                                        echo 'disabled';
                                                                    } ?>">
                                                            <a href="<?php if ($pageno <= 1) {
                                                                            echo '#';
                                                                        } else {
                                                                            echo "?pageno=" . ($pageno - 1);
                                                                        } ?>"><strong style="padding-left: 10px">Prev></strong></a>
                                                        </li>
                                                        <li class="<?php if ($pageno >= $total_pages) {
                                                                        echo 'disabled';
                                                                    } ?>">
                                                            <a href="<?php if ($pageno >= $total_pages) {
                                                                            echo '#';
                                                                        } else {
                                                                            echo "?pageno=" . ($pageno + 1);
                                                                        } ?>"><strong style="padding-left: 10px">Next></strong></a>
                                                        </li>
                                                        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
                                                    </ul>
                                                </div>
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

        <script src="js/menu_jquery.js"></script>

        <script src="js/pages/be_tables_datatables.js"></script>
    </body>

    </html><?php }  ?>