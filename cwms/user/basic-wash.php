<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>CWMS | Basic Wash Plan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="../admin/css/style.css" rel='stylesheet' type='text/css' />
    <link href="../admin/css/font-awesome.css" rel="stylesheet">
    <script src="../admin/js/jquery-2.1.4.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../admin/css/icon-font.min.css" type='text/css' />
    <style>
        .page-container {
            height: auto !important;
            min-height: 100%;
            background: #f8f9fa;
        }
        html, body {
            overflow-y: auto !important;
            height: auto !important;
        }
        .plan-description {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        .plan-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }
        .plan-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        .plan-price {
            font-size: 48px;
            font-weight: 800;
            color: #667eea;
            margin: 15px 0;
        }
        .plan-price span {
            font-size: 24px;
            color: #666;
        }
        .plan-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 25px;
        }
        .plan-features li {
            list-style: none;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .plan-features li i {
            color: #28a745;
            font-size: 18px;
        }
        .plan-features li.excluded i {
            color: #dc3545;
        }
        .credit-form {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        .credit-form h3 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #667eea;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            padding: 12px 15px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: none;
        }
        .row-eq-height {
            display: flex;
        }
        .row-eq-height > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }
        .btn-pay {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        @media (max-width: 768px) {
            .plan-features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="left-content">
            <div class="mother-grid-inner">
                <?php include('includes/header.php'); ?>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i> Basic Wash Plan</li>
                </ol>

                <div class="container-fluid" style="padding: 20px;">
                    <!-- Package Card and Payment Form Side by Side -->
                    <div class="row">
                        <!-- Left Column: Package Card -->
                        <div class="col-md-6">
                            <div class="plan-description">
                                <div class="plan-header">
                                    <h2>Basic Wash Plan</h2>
                                    <div class="plan-price">
                                        <span>Rs</span> 2000/month
                                    </div>
                                    <p style="color: #666; font-size: 16px;">Perfect for regular maintenance and quick cleaning</p>
                                    <p style="color: #999; font-size: 14px;">(15–20 minutes)</p>
                                </div>
                                <div class="plan-features">
                                    <li><i class="fa fa-check-circle"></i> Exterior water wash</li>
                                    <li><i class="fa fa-check-circle"></i> Shampoo + rinse</li>
                                    <li><i class="fa fa-check-circle"></i> Tire & rim wash</li>
                                    <li><i class="fa fa-check-circle"></i> Basic air drying</li>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: eSewa Payment Form -->
                        <div class="col-md-6">
                            <div class="credit-form">
                                <h3><i class="fa fa-credit-card"></i> Complete Payment</h3>
                                <p style="color: #666; margin-bottom: 20px;">Pay securely using eSewa</p>
                                
                                <!-- eSewa Payment Form -->
                                <?php
                                // Construct proper callback URLs
                                $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
                                $host = $_SERVER['HTTP_HOST'];
                                $basePath = str_replace('\\', '/', dirname(dirname($_SERVER['SCRIPT_NAME'])));
                                $successUrl = $protocol . "://" . $host . $basePath . "/user/process-payment.php";
                                $failureUrl = $protocol . "://" . $host . $basePath . "/user/basic-wash.php";
                                $productId = "PKG1_" . time() . "_" . rand(1000, 9999);
                                ?>
                                <form id="esewa-form" method="POST" action="https://uat.esewa.com.np/epay/main">
                                    <input type="hidden" id="tAmt" name="tAmt" value="2000">
                                    <input type="hidden" id="amt" name="amt" value="2000">
                                    <input type="hidden" id="txAmt" name="txAmt" value="0">
                                    <input type="hidden" id="psc" name="psc" value="0">
                                    <input type="hidden" id="pdc" name="pdc" value="0">
                                    <input type="hidden" id="scd" name="scd" value="EPAYTEST">
                                    <input type="hidden" id="pid" name="pid" value="<?php echo htmlspecialchars($productId); ?>">
                                    <input type="hidden" id="su" name="su" value="<?php echo htmlspecialchars($successUrl); ?>">
                                    <input type="hidden" id="fu" name="fu" value="<?php echo htmlspecialchars($failureUrl); ?>">
                                    <input type="hidden" name="package_type" value="1">
                                    <input type="hidden" name="package_amount" value="2000">
                                    
                                    <div class="form-group">
                                        <label>Package Selected</label>
                                        <input type="text" class="form-control" value="Basic Wash - Rs 2000/month" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Total Amount</label>
                                        <input type="text" class="form-control" value="Rs 2000" readonly style="font-size: 24px; font-weight: bold; color: #667eea;">
                                    </div>
                                    
                                    <div class="form-group text-center mt-4">
                                        <button type="submit" class="btn-pay" onclick="return confirm('Note: eSewa UAT may not be accessible. If it fails, use the Test Mode button below.');">
                                            <i class="fa fa-lock"></i> Pay with eSewa
                                        </button>
                                        <p style="margin-top: 15px; font-size: 12px; color: #999;">
                                            <i class="fa fa-shield"></i> Secure payment powered by eSewa
                                        </p>
                                        <p style="margin-top: 10px; font-size: 11px; color: #ff9800;">
                                            <i class="fa fa-exclamation-triangle"></i> If eSewa is not accessible, use Test Mode below
                                        </p>
                                    </div>
                                </form>
                                
                                <!-- Alternative: Direct payment processing (for testing) -->
                                <div>
                                    <!-- <h4 style="color: #28a745; margin-bottom: 15px; text-align: center;">
                                        <i class="fa fa-flask"></i> Development/Testing Mode
                                    </h4> -->
                                    <form method="post" action="process-payment.php">
                                        <input type="hidden" name="package_type" value="1">
                                        <input type="hidden" name="amount" value="2000">
                                        <input type="hidden" name="esewa_submit" value="1">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn-pay" style="background: #28a745; font-size: 16px;">
                                                <i class="fa fa-check-circle"></i> Complete Payment (Test Mode - Recommended)
                                            </button>
                                            <!-- <p style="margin-top: 10px; font-size: 12px; color: #666;">
                                                <i class="fa fa-info-circle"></i> This bypasses eSewa and directly processes payment. Perfect for development and testing.
                                            </p> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/sidebarmenu.php'); ?>
        <div class="clearfix"></div>
    </div>
    <script src="../admin/js/bootstrap.min.js"></script>
</body>
</html>

