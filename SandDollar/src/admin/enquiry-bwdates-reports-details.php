<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsaid'] == 0)) {
    header('location:logout.php');
} else {
if (isset($_POST['submit'])) {
        $fdate = $_POST['fromdate'];
        $tdate = $_POST['todate'];
        
        if ($fdate > $tdate) {
            echo '<script>alert("To Date must be greater than or equal to From Date.")</script>';
			echo '<script>window.location.href = "enquiry-betdates-reports.php";</script>';
        } 
    }
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Sand Dollar Hotel Admin | Between Dates Enquiry Report</title>

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

                                <div class="panel panel-widget forms-panel">
                                    <div class="forms">
                                        <div class="form-grids widget-shadow" data-example-id="basic-forms">
                                            <div class="form-title">
                                                <h4>Between Dates Enquiry Report</h4>
                                            </div>

                                            <div class="form-body">
                                                <?php
                                                $fdate = $_POST['fromdate'];
                                                $tdate = $_POST['todate'];

                                                ?>
                                                <h4 align="center" style="color:blue">Report from <?php echo $fdate ?> to <?php echo $tdate ?></h4>
                                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile Number</th>
                                                            <th>Enquiry Date</th>
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

                                                        $tableName = 'tblcontact';
                                                        if (isset($_GET['pageno'])) {
                                                            $pageno = $_GET['pageno'];
                                                        } else {
                                                            $pageno = 1;
                                                        }
                                                        // Formula for pagination
                                                        $no_of_records_per_page = 3;
                                                        $offset = ($pageno - 1) * $no_of_records_per_page;


                                                        // $ret = "SELECT ID FROM tblcontact";
                                                        // $query1 = $dbh->prepare($ret);
                                                        // $query1->execute();
                                                        // $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                        // $total_rows = $query1->rowCount();
                                                        // $total_pages = ceil($total_rows / $no_of_records_per_page);
                                                        $start_date = $_POST['fromdate'];
                                                        $end_date = $_POST['todate'];

                                                        $ret = "SELECT COUNT(*) FROM $tableName WHERE enquirydate BETWEEN :start_date AND :end_date";
                                                        $query1 = $dbh->prepare($ret);
                                                        $query1->bindParam(':start_date', $start_date);
                                                        $query1->bindParam(':end_date', $end_date);
                                                        $query1->execute();
                                                        $total_rows = $query1->fetchColumn();
                                                        $total_pages = ceil($total_rows / $no_of_records_per_page);

                                                        // $sql = "SELECT * from tblcontact where date(EnquiryDate) between '$fdate' and '$tdate' LIMIT $offset, $no_of_records_per_page";
                                                        // $query = $dbh->prepare($sql);
                                                        // $query->execute();
                                                        // $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                        $sql = "SELECT tbluser.*, tblcontact.message, tblcontact.id, tblcontact.isread, tblcontact.enquirydate
                                                        FROM $tableName 
                                                        JOIN tbluser ON tblcontact.userid = tbluser.id 
                                                        WHERE tblcontact.enquirydate BETWEEN :start_date AND :end_date
                                                        OFFSET $offset LIMIT $no_of_records_per_page";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':start_date', $start_date);
                                                        $query->bindParam(':end_date', $end_date);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $row) {               ?>
                                                                <tr>
                                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                                    <td><?php echo htmlentities($row->name); ?></td>
                                                                    <td><?php echo htmlentities($row->email); ?></td>
                                                                    <td><?php echo htmlentities($row->mobilenumber); ?></td>

                                                                    <td>
                                                                        <span class="badge badge-primary"><?php echo htmlentities($row->enquirydate); ?></span>
                                                                    </td>
                                                                    <td><a href="view-enquiry.php?viewid=<?php echo htmlentities($row->id); ?>" class="btn btn-info btn-sm">View Details</a></td>
                                                                </tr>


                                                        <?php $cnt = $cnt + 1;
                                                            }
                                                        } else {
                                                            ?>
                                                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="5" style="color:red; font-size:22px; text-align:center">No reportss found between the specified dates</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                        } ?>

                                                    </tbody>

                                                </table>
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
        <!--js -->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- /Bootstrap Core JavaScript -->
        <!-- real-time -->
        <script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
        <script src="js/menu_jquery.js"></script>

        <script src="js/pages/be_tables_datatables.js"></script>
    </body>

    </html><?php }  ?>
