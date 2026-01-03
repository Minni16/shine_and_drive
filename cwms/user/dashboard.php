<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');
include('includes/payment-check.php');

// Code for Booking
if(isset($_POST['book']))
{
$ptype=$_POST['packagetype'];
$wpoint=$_POST['washingpoint'];   
// Use session username for backend to ensure bookings show in history
$fname=$_SESSION['alogin'];
$mobile=$_POST['contactno'];
$date=$_POST['washdate'];
$time=$_POST['washtime'];
$message=$_POST['message'];
$status='New';
$bno=mt_rand(100000000, 999999999);
$sql="INSERT INTO tblcarwashbooking(bookingId,packageType,carWashPoint,fullName,mobileNumber,washDate,washTime,message,status) VALUES(:bno,:ptype,:wpoint,:fname,:mobile,:date,:time,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bno',$bno,PDO::PARAM_STR);
$query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
$query->bindParam(':wpoint',$wpoint,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':time',$time,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
 
  echo '<script>alert("Your booking done successfully. Booking number is "+"'.$bno.'")</script>';
 echo "<script>window.location.href ='dashboard.php'</script>";
}
else 
{
 echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}
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
                
                <!-- Subscription Plan Display -->
                <?php
                $username = $_SESSION['alogin'];
                // Get user's latest completed payment
                $subscriptionSql = "SELECT * FROM tbluserpayments 
                                   WHERE username = :username AND paymentStatus = 'completed' 
                                   ORDER BY paymentDate DESC LIMIT 1";
                $subscriptionQuery = $dbh->prepare($subscriptionSql);
                $subscriptionQuery->bindParam(':username', $username, PDO::PARAM_STR);
                $subscriptionQuery->execute();
                $subscription = $subscriptionQuery->fetch(PDO::FETCH_OBJ);
                
                // Get user info from admin table for auto-filling booking form
                $userInfoSql = "SELECT fullName, phoneNumber FROM admin WHERE UserName = :username";
                $userInfoQuery = $dbh->prepare($userInfoSql);
                $userInfoQuery->bindParam(':username', $username, PDO::PARAM_STR);
                $userInfoQuery->execute();
                $userInfo = $userInfoQuery->fetch(PDO::FETCH_OBJ);
                
                // Set default values for form
                $defaultPackageType = $subscription ? $subscription->packageType : '';
                $defaultFullName = $userInfo ? ($userInfo->fullName ?: $username) : $username;
                $defaultPhoneNumber = $userInfo ? $userInfo->phoneNumber : '';
                
                // Package details
                $packageDetails = [
                    1 => ['name' => 'Basic Wash', 'amount' => 2000, 'color' => '#1a1a1a', 'color2' => '#000000', 'icon' => 'fa-car'],
                    2 => ['name' => 'Standard Care', 'amount' => 3000, 'color' => '#1a1a1a', 'color2' => '#000000', 'icon' => 'fa-star'],
                    3 => ['name' => 'Premium Treatment', 'amount' => 4500, 'color' => '#1a1a1a', 'color2' => '#000000', 'icon' => 'fa-diamond']
                ];
                
                if ($subscription) {
                    $packageType = intval($subscription->packageType);
                    $packageInfo = isset($packageDetails[$packageType]) ? $packageDetails[$packageType] : $packageDetails[1];
                ?>
                <div class="subscription-card" style="background: linear-gradient(135deg, <?php echo $packageInfo['color']; ?> 0%, <?php echo isset($packageInfo['color2']) ? $packageInfo['color2'] : $packageInfo['color']; ?> 100%); border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); color: #fff;">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div style="background: rgba(255,255,255,0.2); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    <?php 
                                    // Use different icons based on package type - using Font Awesome 4 compatible icons
                                    $iconClass = 'fa-star'; // default
                                    if ($packageType == 1) $iconClass = 'fa-car';
                                    elseif ($packageType == 2) $iconClass = 'fa-star';
                                    elseif ($packageType == 3) $iconClass = 'fa-diamond';
                                    ?>
                                    <i class="fa <?php echo $iconClass; ?>" aria-hidden="true" style="font-size: 32px !important; color: #fff !important; line-height: 1 !important; display: inline-block !important; width: 100%; text-align: center;"></i>
                                </div>
                                <div>
                                    <h2 style="margin: 0; font-size: 28px; font-weight: 700; color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        <?php echo htmlspecialchars($packageInfo['name']); ?> Plan
                                    </h2>
                                    <p style="margin: 5px 0 0 0; font-size: 16px; opacity: 0.95;">
                                        <i class="fa fa-check-circle"></i> Active Subscription
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <div style="background: rgba(255,255,255,0.2); padding: 15px 20px; border-radius: 8px; backdrop-filter: blur(10px); display: inline-block;">
                                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Amount Paid</div>
                                <div style="font-size: 32px; font-weight: 700; color: #fff;">
                                    Rs <?php echo number_format($subscription->amount, 0); ?>
                                </div>
                            </div>
                            <?php if ($subscription->paymentDate): ?>
                            <div style="margin-top: 10px; font-size: 13px; opacity: 0.85;">
                                <i class="fa fa-calendar"></i> 
                                Purchased: <?php echo date('M d, Y', strtotime($subscription->paymentDate)); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.2);">
                        <div class="row">
                            <div class="col-md-4">
                                <div style="font-size: 13px; opacity: 0.9;">
                                    <i class="fa fa-credit-card"></i> Payment Method: 
                                    <strong><?php echo htmlspecialchars($subscription->paymentMode ?: 'N/A'); ?></strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="font-size: 13px; opacity: 0.9;">
                                    <i class="fa fa-hashtag"></i> Transaction ID: 
                                    <strong style="font-family: monospace; word-break: break-all;"><?php echo htmlspecialchars($subscription->transactionId ?: 'N/A'); ?></strong>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="../index.php" style="color: #fff; text-decoration: none; background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 6px; font-size: 13px; transition: all 0.3s;">
                                    <i class="fa fa-plus"></i> Upgrade Plan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="subscription-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); color: #fff; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 20px;">
                        <div style="background: rgba(255,255,255,0.2); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 32px !important; color: #fff !important; line-height: 1 !important; display: inline-block !important;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 24px; font-weight: 700; color: #fff;">
                                No Active Subscription
                            </h3>
                            <p style="margin: 5px 0 0 0; font-size: 16px; opacity: 0.95;">
                                Purchase a package to access all features
                            </p>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <a href="../index.php" style="color: #fff; text-decoration: none; background: rgba(255,255,255,0.3); padding: 12px 30px; border-radius: 8px; font-size: 16px; font-weight: 600; display: inline-block; transition: all 0.3s;">
                            <i class="fa fa-shopping-cart"></i> View Packages
                        </a>
                    </div>
                </div>
                <?php } ?>
                
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
    
    <script>
        // Open booking modal if URL parameter is present
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('open_booking') === '1') {
                $('#myModal').modal('show');
                // Clean up URL by removing the parameter
                if (window.history && window.history.replaceState) {
                    var newUrl = window.location.pathname;
                    window.history.replaceState({}, document.title, newUrl);
                }
            }
            
            // Set minimum date to today for wash date
            var today = new Date().toISOString().split('T')[0];
            var washDateInput = document.getElementById('washdate');
            if (washDateInput) {
                washDateInput.min = today;
            }
        });
    </script>

    <!-- Booking Modal Start -->
    <style>
        .booking-modal {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        .booking-modal .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 25px 30px;
            border-radius: 0;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .booking-modal .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .booking-modal .modal-header .modal-title {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            flex: 1;
        }
        
        .booking-modal .modal-header .modal-title i {
            font-size: 28px;
            background: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .booking-modal .modal-header .close {
            color: #fff;
            opacity: 0.9;
            font-size: 28px;
            font-weight: 300;
            text-shadow: none;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            margin: 0;
            padding: 0;
            border: none;
            line-height: 1;
            flex-shrink: 0;
            cursor: pointer;
        }
        
        .booking-modal .modal-header .close span {
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            position: relative;
            top: 0;
            left: 0;
        }
        
        .booking-modal .modal-header .close:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }
        
        .booking-modal .modal-body {
            padding: 35px 40px;
            background: #f8f9fa;
        }
        
        .booking-modal .form-group {
            margin-bottom: 25px;
        }
        
        .booking-modal .form-group label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            letter-spacing: 0.3px;
        }
        
        .booking-modal .form-group label i {
            color: #667eea;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        
        .booking-modal .form-group .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
            color: #2d3748;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        
        .booking-modal .form-group .form-control:disabled {
            background-color: #f7f8fa;
            color: #4a5568;
            cursor: not-allowed;
            opacity: 0.7;
            border-color: #cbd5e0;
        }
        
        .booking-modal .form-group .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1), 0 4px 12px rgba(0, 0, 0, 0.08);
            outline: none;
            transform: translateY(-1px);
        }
        
        .booking-modal .form-group .form-control:disabled:focus {
            transform: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        
        .booking-modal .form-group select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 14 14'%3E%3Cpath fill='%23667eea' d='M7 10L2 5h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 14px;
            padding-right: 45px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        
        .booking-modal .form-group textarea.form-control {
            resize: vertical;
            min-height: 110px;
            font-family: inherit;
        }
        
        .booking-modal .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 14px 40px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            white-space: nowrap;
            min-width: 180px;
        }
        
        .booking-modal .btn-custom i {
            background: rgba(255, 255, 255, 0.3);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .booking-modal .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .booking-modal .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }
        
        .booking-modal .btn-custom:hover::before {
            left: 100%;
        }
        
        .booking-modal .btn-custom:active {
            transform: translateY(-1px);
        }
        
        .booking-modal .text-danger {
            color: #e53e3e !important;
            font-weight: 700;
        }
        
        @media (max-width: 767.98px) {
            .booking-modal .modal-body {
                padding: 25px 20px;
            }
            
            .booking-modal .modal-header {
                padding: 20px;
            }
            
            .booking-modal .modal-header .modal-title {
                font-size: 22px;
            }
            
            .booking-modal .modal-header .modal-title i {
                width: 40px;
                height: 40px;
                font-size: 22px;
            }
        }
    </style>
    
    <div class="modal fade" id="myModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content booking-modal">
                <div class="modal-header">
                    <h4 class="modal-title"> 
                        <span>Car Wash Booking</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="bookingForm" action="dashboard.php">
                        <div class="form-group">
                            <label for="packagetype">
                                <i class="fa fa-cube"></i>   
                                <span>Package Type <span class="text-danger">*</span></span>
                            </label>
                            <select name="packagetype" id="packagetype" required class="form-control" <?php echo (!empty($defaultPackageType)) ? 'disabled' : ''; ?>>
                                <option value="">Select Package Type</option>
                                <option value="1" <?php echo ($defaultPackageType == 1) ? 'selected' : ''; ?>>Basic Wash (Rs2000/month)</option>
                                <option value="2" <?php echo ($defaultPackageType == 2) ? 'selected' : ''; ?>>Standard Care (Rs3000/month)</option>
                                <option value="3" <?php echo ($defaultPackageType == 3) ? 'selected' : ''; ?>>Premium Treatment (Rs4500/month)</option>
                            </select>
                            <?php if (!empty($defaultPackageType)): ?>
                                <input type="hidden" name="packagetype" value="<?php echo htmlspecialchars($defaultPackageType); ?>">
                                <small class="form-text text-muted" style="margin-top: 5px; display: block;">
                                    <i class="fa fa-info-circle"></i> Package type is locked based on your active subscription.
                                </small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="washingpoint">
                                <i class="fa fa-map-marker"></i> 
                                <span>Washing Point <span class="text-danger">*</span></span>
                            </label>
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
                            <label for="fname">
                                <i class="fa fa-user"></i> 
                                <span>Full Name <span class="text-danger">*</span></span>
                            </label>
                            <input type="text" name="fname" id="fname" class="form-control" required
                                value="<?php echo htmlspecialchars($defaultFullName); ?>"
                                placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="contactno">
                                <i class="fa fa-phone"></i> 
                                <span>Mobile Number <span class="text-danger">*</span></span>
                            </label>
                            <input type="text" name="contactno" id="contactno" class="form-control" pattern="[0-9]{10}"
                                title="10 numeric characters only" required 
                                value="<?php echo htmlspecialchars($defaultPhoneNumber); ?>"
                                placeholder="Enter 10-digit mobile number">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="washdate">
                                        <i class="fa fa-calendar"></i> 
                                        <span>Wash Date <span class="text-danger">*</span></span>
                                    </label>
                                    <input type="date" name="washdate" id="washdate" required class="form-control"
                                        min="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="washtime">
                                        <i class="fa fa-clock-o"></i> 
                                        <span>Wash Time <span class="text-danger">*</span></span>
                                    </label>
                                    <input type="time" name="washtime" id="washtime" required class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">
                                <i class="fa fa-comment"></i> 
                                <span>Additional Message</span>
                            </label>
                            <textarea name="message" id="message" class="form-control" rows="3"
                                placeholder="Any special instructions or requests..."></textarea>
                        </div>

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-custom btn-lg" name="book">
                                <i class="fa fa-check-circle"></i> Book Now
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