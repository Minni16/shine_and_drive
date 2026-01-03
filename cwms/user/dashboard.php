<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>CWMS | User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script
        type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="../admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="../admin/css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../admin/css/morris.css" type="text/css" />
    <!-- Graph CSS -->
    <link href="../admin/css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="../admin/js/jquery-2.1.4.min.js"></script>
    <!-- //jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
        type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="../admin/css/icon-font.min.css" type='text/css' />
    <!-- //lined-icons -->
    <style>
        .page-container {
            height: auto !important;
            min-height: 100%;
        }

        html,
        body {
            overflow-y: auto !important;
            height: auto !important;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="mother-grid-inner">
                <!--header start here-->
                <?php include('includes/header.php'); ?>
                <!--header end here-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i></li>
                </ol>
                <!--four-grids here-->
                <div class="four-grids">

                    <a href="all-bookings.php">
                        <div class="col-md-4 four-grid">
                            <div class="four-agileits">
                                <div class="icon">
                                    <i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
                                </div>
                                <div class="four-text">
                                    <h3>Booking History</h3>
                                    <?php
                                    $username = $_SESSION['alogin'];
                                    $sql = "SELECT id from tblcarwashbooking where fullName=:username";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':username', $username, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = $query->rowCount();
                                    ?>
                                    <h4><?php echo htmlentities($cnt); ?></h4>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a data-toggle="modal" data-target="#myModal">
                        <div class="col-md-4 four-grid">
                            <div class="four-agileinfo">
                                <div class="icon">
                                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                </div>
                                <div class="four-text">
                                    <h3>New Booking</h3>
                                    <h4>Create</h4>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="change-password.php">
                        <div class="col-md-4 four-grid">
                            <div class="four-wthree">
                                <div class="icon">
                                    <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
                                </div>
                                <div class="four-text">
                                    <h3>Change Password</h3>
                                    <h4>Update</h4>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="clearfix"></div>
                </div>
                <!--//four-grids here-->

                <!--inner block start here-->
                <div class="inner-block">
                </div>
                <!--inner block end here-->
            </div>
        </div>
        <!--//content-inner-->
        <!--/sidebar-menu-->
        <?php include('includes/sidebarmenu.php'); ?>
        <div class="clearfix"></div>
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function () {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({ "position": "absolute" });
            }
            else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function () {
                    $("#menu span").css({ "position": "relative" });
                }, 400);
            }

            toggle = !toggle;
        });

    </script>
    <!--js -->
    <script src="../admin/js/jquery.nicescroll.js"></script>
    <script src="../admin/js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../admin/js/bootstrap.min.js"></script>
    <!-- /Bootstrap Core JavaScript -->

    <!-- Booking Modal Start -->
    <div class="modal fade" id="myModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content booking-modal">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-calendar-check"></i> Car Wash Booking</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="bookingForm">
                        <div class="form-group">
                            <label for="packagetype"><i class="fas fa-box"></i> Package Type <span
                                    class="text-danger">*</span></label>
                            <select name="packagetype" id="packagetype" required class="form-control">
                                <option value="">Select Package Type</option>
                                <option value="1">Basic Wash (Rs500)</option>
                                <option value="2">Standard Care (Rs1500)</option>
                                <option value="3">Premium Treatment (Rs2500)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="washingpoint"><i class="fas fa-map-marker-alt"></i> Washing Point <span
                                    class="text-danger">*</span></label>
                            <select name="washingpoint" id="washingpoint" required class="form-control">
                                <option value="">Select Washing Point</option>
                                <?php
                                $sql = "SELECT * from tblwashingpoints";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $result) { ?>
                                    <option value="<?php echo htmlentities($result->id); ?>">
                                        <?php echo htmlentities($result->washingPointName); ?>
                                        (<?php echo htmlentities($result->washingPointAddress); ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fname"><i class="fas fa-user"></i> Full Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="fname" id="fname" class="form-control" required
                                placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="contactno"><i class="fas fa-phone"></i> Mobile Number <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="contactno" id="contactno" class="form-control" pattern="[0-9]{10}"
                                title="10 numeric characters only" required placeholder="Enter 10-digit mobile number">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="washdate"><i class="fas fa-calendar"></i> Wash Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="washdate" id="washdate" required class="form-control"
                                        min="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="washtime"><i class="fas fa-clock"></i> Wash Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="washtime" id="washtime" required class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message"><i class="fas fa-comment"></i> Additional Message</label>
                            <textarea name="message" id="message" class="form-control" rows="3"
                                placeholder="Any special instructions or requests..."></textarea>
                        </div>

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-custom btn-lg" name="book">
                                <i class="fas fa-calendar-check" style="margin-right: 10px;"></i>Get Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Modal End -->
</body>

</html>