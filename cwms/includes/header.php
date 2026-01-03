        <style>
            /* User Dropdown Styles */
            .navbar-nav .dropdown {
                position: relative;
            }
            
            .navbar-nav .dropdown-toggle {
                transition: all 0.3s ease;
                border-radius: 6px;
            }
            
            .navbar-nav .dropdown-toggle:hover {
                background: rgba(255, 255, 255, 0.1) !important;
            }
            
            .navbar-nav .dropdown-toggle .fa-angle-down {
                transition: transform 0.3s ease;
            }
            
            .navbar-nav .dropdown.show .dropdown-toggle .fa-angle-down {
                transform: rotate(180deg);
            }
            
            .navbar-nav .dropdown-menu {
                background: #fff;
                border: none;
                border-radius: 10px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.15);
                padding: 6px 0;
                min-width: 220px;
                margin-top: 8px;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: block;
            }
            
            .navbar-nav .dropdown.show .dropdown-menu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            
            .navbar-nav .dropdown-item {
                padding: 12px 20px;
                display: flex;
                align-items: center;
                gap: 12px;
                color: #333;
                text-decoration: none;
                transition: all 0.2s ease;
                font-size: 14px;
                font-weight: 500;
                border-radius: 0;
                position: relative;
            }
            
            .navbar-nav .dropdown-item:first-child {
                border-radius: 10px 10px 0 0;
            }
            
            .navbar-nav .dropdown-item:last-child {
                border-radius: 0 0 10px 10px;
            }
            
            .navbar-nav .dropdown-item:hover {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #fff;
                padding-left: 24px;
                transform: translateX(2px);
            }
            
            .navbar-nav .dropdown-item:hover i {
                color: #fff !important;
                transform: scale(1.1);
            }
            
            .navbar-nav .dropdown-item:active {
                transform: translateX(2px) scale(0.98);
            }
            
            .navbar-nav .dropdown-item i {
                width: 20px;
                text-align: center;
                font-size: 16px;
                transition: all 0.2s ease;
            }
            
            .navbar-nav .dropdown-divider {
                margin: 6px 12px;
                border-top: 1px solid #e9ecef;
                height: 0;
            }
            
            .navbar-nav .dropdown-toggle::after {
                display: none;
            }
            
            /* Focus states for accessibility */
            .navbar-nav .dropdown-toggle:focus {
                outline: 2px solid rgba(102, 126, 234, 0.5);
                outline-offset: 2px;
            }
            
            .navbar-nav .dropdown-item:focus {
                background: rgba(102, 126, 234, 0.1);
                outline: none;
            }
            
            /* Mobile responsiveness */
            @media (max-width: 991px) {
                .navbar-nav .dropdown-menu {
                    position: static !important;
                    transform: none;
                    box-shadow: none;
                    border-radius: 0;
                    margin-top: 0;
                    opacity: 1;
                    visibility: visible;
                }
                
                .navbar-nav .dropdown.show .dropdown-menu {
                    transform: none;
                }
            }
        </style>
        
        <script>
            // Enhanced dropdown UX with smooth interactions
            $(document).ready(function() {
                var $dropdown = $('.navbar-nav .dropdown');
                var $dropdownToggle = $('#userDropdown');
                var $dropdownMenu = $dropdownToggle.next('.dropdown-menu');
                
                // Handle dropdown toggle
                $dropdownToggle.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    var isOpen = $dropdown.hasClass('show');
                    
                    // Close all other dropdowns
                    $('.navbar-nav .dropdown').removeClass('show');
                    
                    // Toggle this dropdown
                    if (!isOpen) {
                        $dropdown.addClass('show');
                        $dropdownToggle.attr('aria-expanded', 'true');
                    } else {
                        $dropdown.removeClass('show');
                        $dropdownToggle.attr('aria-expanded', 'false');
                    }
                });
                
                // Close dropdown when clicking outside
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.navbar-nav .dropdown').length) {
                        $dropdown.removeClass('show');
                        $dropdownToggle.attr('aria-expanded', 'false');
                    }
                });
                
                // Prevent dropdown from closing when clicking inside menu
                $dropdownMenu.on('click', function(e) {
                    e.stopPropagation();
                });
                
                // Add click feedback to dropdown items
                $dropdownMenu.find('.dropdown-item').on('mousedown', function() {
                    $(this).addClass('active');
                }).on('mouseup mouseleave', function() {
                    $(this).removeClass('active');
                });
            });
        </script>
        
        <!-- Top Bar Start -->
        <!-- <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.php">
                                <h1>CAR <span>Wash Scheduling</span></h1>
                                <img src="img/logo.jpg" alt="Logo">
                            </a>
                        </div>
                    </div> -->

<?php 
$sql = "SELECT * from tblpages where type='contact'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{       
?>
                    <!-- <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Opening Hour</h3>
                                        <p><?php   echo $result->openignHrs; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Call Us</h3>
                                        <p>+<?php   echo $result->phoneNumber; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p><?php   echo $result->emailId; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <?php } ?>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <img src="img/logo.png" width="140" height="70">
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto" style="margin-left: 160px;">
                
                            <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="about.php" class="nav-item nav-link">About</a>
                            <a href="washing-plans.php" class="nav-item nav-link">Washing Plans</a>
                            <a href="location.php" class="nav-item nav-link">Washing Points</a>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                            <?php if (isset($_SESSION['alogin'])): ?>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="admin/dashboard.php" class="nav-item nav-link">Admin Panel</a>
                                <?php endif; ?>
                            <!-- <a href="logout.php" class="nav-item nav-link">Logout</a> -->
                            <?php else: ?>
                            <a href="register.php" class="nav-item nav-link">Register</a>
                            <a href="login.php" class="nav-item nav-link">Login</a>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (isset($_SESSION['alogin'])): ?>
                        <div class="navbar-nav ml-auto">
                            <?php
                            // Check if user has subscription - check if username exists in tbluserpayments
                            $username = $_SESSION['alogin'];
                            $checkPaymentTableSql = "SELECT id FROM tbluserpayments WHERE username = :username LIMIT 1";
                            $checkPaymentTableQuery = $dbh->prepare($checkPaymentTableSql);
                            $checkPaymentTableQuery->bindParam(':username', $username, PDO::PARAM_STR);
                            $checkPaymentTableQuery->execute();
                            $paymentRecord = $checkPaymentTableQuery->fetch(PDO::FETCH_OBJ);
                            
                            $displayName = ucwords(str_replace(['_', '-'], ' ', htmlspecialchars($username)));
                            ?>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flex; align-items: center; gap: 8px; color: #ffffff !important; padding: 8px 15px; text-decoration: none; cursor: pointer;">
                                    <i class="fa fa-user-circle" style="font-size: 18px; color: #28a745;"></i>
                                    <span style="font-weight: 500; color: #000;">
                                        <?php echo $displayName; ?>
                                    </span>
                                    <i class="fa fa-angle-down" style="font-size: 14px; color: #000; margin-left: 4px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="user/dashboard.php">
                                        <i class="fa fa-tachometer" style="color: #667eea;"></i>
                                        <span>User Dashboard</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">
                                        <i class="fa fa-sign-out" style="color: #dc3545;"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->
