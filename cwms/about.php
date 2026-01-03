<?php //error_reporting(0);
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Car Wash Scheduling System | About Us Page</title>
        <link rel="icon" type="image/png" href="img/logo.png">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        
        <style>
        /* Enhanced About Page Styles */
        .about {
            padding: 0 0 0 0;
        }
        
        .about .container > .row:first-child {
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .about-hero {
            padding: 80px 0;
            color: #000;
            margin-bottom: 60px;
        }
        
        .about-hero h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .about-hero p {
            font-size: 20px;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .about-img {
            position: relative;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
            margin-bottom: 0;
        }
        
        .about-img:hover {
            transform: translateY(-5px);
        }
        
        .about-img img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            transition: transform 0.5s ease;
            display: block;
            vertical-align: top;
        }
        
        .about-img:hover img {
            transform: scale(1.05);
        }
        
        .about-img::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
            border-radius: 15px;
            z-index: 1;
            pointer-events: none;
        }
        
        .section-header.text-left h2 {
            font-size: 42px;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 20px;
        }
        
        .section-header.text-left h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
            border-radius: 2px;
        }
        
        .section-header.text-left p {
            font-size: 16px;
            font-weight: 600;
            color: #28a745;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 15px;
        }
        
        .about-content p {
            font-size: 17px;
            line-height: 1.9;
            color: #555;
            margin-bottom: 30px;
            text-align: justify;
        }
        
        .about-content hr {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #28a745 50%, transparent 100%);
            margin: 35px 0;
        }
        
        .about-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .about-content ul li {
            padding: 15px 20px;
            margin-bottom: 12px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #333;
        }
        
        .about-content ul li:hover {
            background: linear-gradient(135deg, #f0f9f4 0%, #ffffff 100%);
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.15);
        }
        
        .about-content ul li i {
            color: #28a745;
            font-size: 20px;
            margin-right: 15px;
            min-width: 25px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }
        
        .feature-card {
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-top: 4px solid #28a745;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.2);
        }
        
        .feature-card i {
            font-size: 50px;
            color: #28a745;
            margin-bottom: 20px;
            display: block;
        }
        
        .feature-card h3 {
            font-size: 22px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }
        
        .feature-card p {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }
        
        .stats-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 80px 0;
            margin-top: 60px;
            color: #ffffff;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-item i {
            font-size: 48px;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        .stat-item h3 {
            font-size: 42px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 10px;
        }
        
        .stat-item p {
            font-size: 18px;
            color: #b0b0b0;
            margin: 0;
        }
        
        @media (max-width: 991px) {
            .about-content {
                padding-left: 0;
                margin-top: 40px;
            }
            
            .about-hero h1 {
                font-size: 36px;
            }
            
            .about-hero p {
                font-size: 18px;
            }
        }
        
        @media (max-width: 767px) {
            .about {
                padding: 60px 0;
            }
            
            .about-hero {
                padding: 60px 0;
            }
            
            .about-hero h1 {
                font-size: 32px;
            }
            
            .section-header.text-left h2 {
                font-size: 32px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .about-img,
        .about-content,
        .feature-card {
            animation: fadeInUp 0.6s ease-out;
        }
        </style>
    </head>

    <body>
        <?php include_once('includes/header.php');?>
        
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>About Us</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Home</a>
                        <a href="about.php">About Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        <!-- About Hero Section -->
        <div class="about-hero">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Welcome to Car Wash Scheduling System</h1>
                        <p>Your trusted partner for premium car care and detailing services. We bring innovation and excellence to every wash.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="img/carousel-2.jpg" alt="Car Wash Service">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header text-left">
                            <p>About Us</p>
                            <h2>Car Washing and Detailing</h2>
                        </div>
                        <div class="about-content">
                            <?php 
                            $sql = "SELECT type,detail from tblpages where type='aboutus'";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach($results as $result)
                            {       
                                // Clean and format the content - extract clean text from HTML
                                $content = $result->detail;
                                
                                // Decode HTML entities first
                                $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                                
                                // Remove all HTML tags
                                $content = strip_tags($content);
                                
                                // Replace HTML entities and clean up whitespace
                                $content = str_replace(['&nbsp;', '&amp;'], [' ', '&'], $content);
                                $content = preg_replace('/\s+/', ' ', $content);
                                $content = trim($content);
                                
                                // Display as clean paragraph
                            ?>
                            <p>
                                <?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <!-- Features Grid -->
                <div class="features-grid">
                    <div class="feature-card">
                        <i class="fas fa-tools"></i>
                        <h3>Modern Equipment</h3>
                        <p>We use the latest high-pressure cleaning machines and professional-grade tools for superior results.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-users"></i>
                        <h3>Expert Team</h3>
                        <p>Our trained professionals are dedicated to providing exceptional service and attention to detail.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Quality Guaranteed</h3>
                        <p>We stand behind our work with a satisfaction guarantee on all our car wash services.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-clock"></i>
                        <h3>Convenient Scheduling</h3>
                        <p>Book your appointment online at your convenience. We're here when you need us.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <?php include_once('includes/footer.php');?>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
