<?php
    session_start();
    //error_reporting(0);
    include('includes/dbconnection.php');
    if (strlen($_SESSION['hbmsaid']==0)) {
        header('location:logout.php');
    } else {
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Hotel Booking Management System | All Booking</title>

        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <!-- Graph CSS -->
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <!-- jQuery -->
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!-- lined-icons -->
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
        <script src="js/simpleCart.min.js"> </script>
        <script src="js/amcharts.js"></script>	
        <script src="js/serial.js"></script>	
        <script src="js/light.js"></script>	
        <!-- //lined-icons -->
        <script src="js/jquery-1.10.2.min.js"></script>
    </head> 

    <body>
        <div class="page-container">
            <!--/content-inner-->
            <div class="left-content">
                <div class="inner-content">
                    <!-- header-starts -->
                    <?php include_once('includes/header.php');?>

                    <!--content-->
                    <div class="content">
                        <div class="women_main">
                            <!-- start content -->
                            <div class="grids">
                                <div class="panel panel-widget forms-panel">
                                    <div class="forms">
                                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                                            <div class="form-title">
                                                <h4>Search Booking</h4>
                                            </div>
                                            <form id="basic-form" method="post">
                                                <div class="form-group" style="padding-top: 20px">
                                                    <label style="font-size: 20px;padding-bottom: 10px">Search Booking</label>
                                                    <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Enter Your Booking Number">
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="search" id="submit">Search</button>
                                            </form>
                                            <div class="form-body">
                                                <?php
                                                if(isset($_POST['search'])) { 
                                                    $sdata=$_POST['searchdata'];
                                                ?>
                                                <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>
                                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">S.No</th>
                                                            <th>Booking Number</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile Number</th>
                                                            <th>Booking Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if (isset($_GET['pageno'])) {
                                                                $pageno = $_GET['pageno'];
                                                            } else {
                                                                $pageno = 1;
                                                            }
                                                            
                                                            // Formula for pagination
                                                            $no_of_records_per_page = 3;
                                                            $offset = ($pageno-1) * $no_of_records_per_page;
                                                            $ret = "SELECT tblbooking.ID FROM tblbooking join tbluser on tblbooking.UserID=tbluser.ID where tblbooking.BookingNumber like '$sdata%' || tbluser.FullName like '$sdata%'";
                                                            $query1 = $dbh -> prepare($ret);
                                                            $query1->execute();
                                                            $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                                                            $total_rows=$query1->rowCount();
                                                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                                                            $sql="SELECT tbluser.*,tblbooking.BookingNumber,tblbooking.ID,tblbooking.Status,tblbooking.BookingDate from tblbooking join tbluser on tblbooking.UserID=tbluser.ID where tblbooking.BookingNumber like '$sdata%' || tbluser.FullName like '$sdata%' LIMIT $offset, $no_of_records_per_page";
                                                            $query = $dbh -> prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);

                                                            $cnt=1;
                                                            if($query->rowCount() > 0) {
                                                                foreach($results as $row) {              
                                                        ?>

                                                        <tr>
                                                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                                            <td><?php  echo htmlentities($row->BookingNumber);?></td>
                                                            <td><?php  echo htmlentities($row->FullName);?></td>
                                                            <td><?php  echo htmlentities($row->Email);?></td>
                                                            <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                                            <td><span class="badge badge-primary"><?php  echo htmlentities($row->BookingDate);?></span></td>
                                                            <td>
                                                                <?php $status=$row->Status;
                                                                    if($status==''):
                                                                ?>
                                                                <span class="badge badge-warning"><?php  echo htmlentities('Not Updated Yet');?></span>
                                                                <?php elseif($status=='Cancelled'):?>
                                                                <span class="badge badge-danger"><?php  echo htmlentities($row->Status);?></span>
                                                                <?php elseif($status=='Approved'): ?>
                                                                <span class="badge badge-success"><?php  echo htmlentities($row->Status);?></span>
                                                                <?php endif;?>
                                                            </td>
                                                            <td class="d-none d-sm-table-cell"><a href="view-booking-detail.php?bookingid=<?php echo htmlentities ($row->BookingNumber);?>" class="btn btn-info btn-sm">View Details</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div align="left">
                                                    <ul class="pagination" >
                                                        <li><a href="?pageno=1"><strong>First></strong></a></li>
                                                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev></strong></a>
                                                        </li>
                                                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next></strong></a>
                                                        </li>
                                                        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
                                                    </ul>
                                                </div>

                                                <?php 
                                                    $cnt=$cnt+1;
                                                    } } else { 
                                                ?>

                                                <tr>
                                                    <td colspan="8"> No record found against this search</td>
                                                </tr>

                                                <?php } }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end content -->
                            <?php include_once('includes/footer.php');?>
                        </div>
                    </div>
                    <!--content-->
                </div>
            </div>
            <!--//content-inner-->

            <!--/sidebar-menu-->
            <?php include_once('includes/sidebar.php');?>
            <!--/sidebar-menu-->

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="js/pages/be_tables_datatables.js"></script>
    </body>
</html>
<?php }  ?>