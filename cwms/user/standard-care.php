<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>CWMS | Standard Care Plan</title>
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
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i> Standard Care Plan</li>
                </ol>

                <div class="container-fluid" style="padding: 20px;">
                    <!-- First Row: Plan Description -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="plan-description">
                                <div class="plan-header">
                                    <h2>Standard Care Plan</h2>
                                    <div class="plan-price">
                                        <span>Rs</span> 1500
                                    </div>
                                    <p style="color: #666; font-size: 16px;">Comprehensive cleaning with premium features</p>
                                </div>
                                <div class="plan-features">
                                    <li><i class="fa fa-check-circle"></i> Everything in Basic</li>
                                    <li><i class="fa fa-check-circle"></i> Interior Wet Cleaning</li>
                                    <li><i class="fa fa-check-circle"></i> Window Wiping</li>
                                    <li><i class="fa fa-check-circle"></i> Dashboard Polishing</li>
                                    <li><i class="fa fa-check-circle"></i> Tire Cleaning</li>
                                    <li><i class="fa fa-check-circle"></i> Standard Air Drying</li>
                                    <li class="excluded"><i class="fa fa-times-circle"></i> Waxing</li>
                                    <li class="excluded"><i class="fa fa-times-circle"></i> Tire Shine</li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Credit Form -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="credit-form">
                                <h3><i class="fa fa-credit-card"></i> Payment Information</h3>
                                <form method="post" action="add-booking.php">
                                    <input type="hidden" name="packagetype" value="2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cardholder Name <span class="text-danger">*</span></label>
                                                <input type="text" name="cardholder_name" class="form-control" required placeholder="John Doe">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Card Number <span class="text-danger">*</span></label>
                                                <input type="text" name="card_number" class="form-control" required placeholder="1234 5678 9012 3456" maxlength="19" pattern="[0-9\s]{13,19}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Expiry Month <span class="text-danger">*</span></label>
                                                <select name="expiry_month" class="form-control" required>
                                                    <option value="">Month</option>
                                                    <?php for($i=1; $i<=12; $i++): ?>
                                                        <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Expiry Year <span class="text-danger">*</span></label>
                                                <select name="expiry_year" class="form-control" required>
                                                    <option value="">Year</option>
                                                    <?php for($i=date('Y'); $i<=date('Y')+10; $i++): ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CVV <span class="text-danger">*</span></label>
                                                <input type="text" name="cvv" class="form-control" required placeholder="123" maxlength="4" pattern="[0-9]{3,4}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Billing Address <span class="text-danger">*</span></label>
                                                <textarea name="billing_address" class="form-control" rows="3" required placeholder="Enter your billing address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="book" class="btn-pay">
                                                <i class="fa fa-lock"></i> Pay Rs 1500 & Complete Booking
                                            </button>
                                        </div>
                                    </div>
                                </form>
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

