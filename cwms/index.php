<?php //error_reporting(0);
session_start();
include('includes/config.php'); 

if(isset($_POST['book']))
{
$ptype=$_POST['packagetype'];
$wpoint=$_POST['washingpoint'];   
$fname=$_POST['fname'];
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
 echo "<script>window.location.href ='washing-plans.php'</script>";
}
else 
{
 echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Car Wash Scheduling System | Home Page</title>


        <!-- Favicon -->
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
    </head>

    <body>
<?php include_once('includes/header.php');?>

        <!-- Hero Section with Slogan and Carousel Start -->
        <div class="hero-section">
            <div class="container-fluid px-0">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-md-12 slogan-wrapper">
                        <div class="slogan">
                            <h2 class="slogan-title">SHINE & DRIVE</h2>
                            <p class="slogan-text">"Your Journey, Our Shine"</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <!-- Carousel Start -->
                        <div class="carousel">
                            <div class="container-fluid">
                                <div class="owl-carousel">
                                    <div class="carousel-item">
                                        <div class="carousel-img">
                                            <img src="img/carousel-1.jpg" alt="Image">
                                        </div>
                                        <div class="carousel-text">
                                            <h3 style="color: #ffffff;">Washing & Detailing</h3>
                                            <h1>Keep your Car Newer</h1>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="carousel-img">
                                            <img src="img/a.jpg" alt="Image">
                                        </div>
                                        <div class="carousel-text">
                                            <h3 style="color: #ffffff;">Washing & Detailing</h3>
                                            <h1>Quality service for you</h1>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="carousel-img">
                                            <img src="img/carousel-3.jpg" alt="Image">
                                        </div>
                                        <div class="carousel-text">
                                            <h3 style="color: #ffffff;">Washing & Detailing</h3>
                                            <h1>Exterior & Interior Washing</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Section End -->
         <!-- <hr></hr> -->
        

        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="img/a.jpg" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header text-left">
                            <p>About Us</p>
                            <h2>car washing and detailing</h2>
                        </div>
                        <div class="about-content">
                            <p>
                            A car wash is a service that is designed to clean and maintain the exterior and sometimes the interior of a vehicle.
                            </p>
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior wet cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window wiping</li>
                            </ul>
                            <a class="btn btn-custom" href="about.php">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Service Start -->
        <!-- <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p>What We Do?</p>
                    <h2>Premium Washing Services</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-wash-1"></i>
                            <h3>Exterior Washing</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-wash"></i>
                            <h3>Interior Washing</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-vacuum-cleaner"></i>
                            <h3>Vacuum Cleaning</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-seat"></i>
                            <h3>Seats Washing</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-service"></i>
                            <h3>Window Wiping</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-service-2"></i>
                            <h3>Wet Cleaning</h3>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Service End -->

        <!-- Service Section Start -->
        <div class="service-section">
            <div class="container">
                <div class="section-header text-center">
                    <p>What We Do?</p>
                    <h2>Premium Washing Services</h2>
                </div>
                <div class="service-container">
                    <button class="arrow-btn prev-btn" aria-label="Previous services">&#9664;</button>
                    <div class="services-wrapper">
                        <div class="service-item">
                            <i class="flaticon-car-wash-1"></i>
                            <h3>Exterior Washing</h3>
                            <p>Complete exterior cleaning and detailing</p>
                        </div>
                        <div class="service-item">
                            <i class="flaticon-car-wash"></i>
                            <h3>Interior Washing</h3>
                            <p>Deep interior cleaning and sanitization</p>
                        </div>
                        <div class="service-item">
                            <i class="flaticon-vacuum-cleaner"></i>
                            <h3>Vacuum Cleaning</h3>
                            <p>Thorough vacuuming of all interior areas</p>
                        </div>
                        <div class="service-item">
                            <i class="flaticon-seat"></i>
                            <h3>Seats Washing</h3>
                            <p>Professional seat cleaning and conditioning</p>
                        </div>
                        <div class="service-item">
                            <i class="flaticon-car-service"></i>
                            <h3>Window Wiping</h3>
                            <p>Crystal clear window cleaning</p>
                        </div>
                        <div class="service-item">
                            <i class="flaticon-car-service-2"></i>
                            <h3>Wet Cleaning</h3>
                            <p>Comprehensive wet cleaning service</p>
                        </div>
                    </div>
                    <button class="arrow-btn next-btn" aria-label="Next services">&#9654;</button>
                </div>
            </div>
        </div>
        <!-- Service Section End -->

        <script>
            // Service carousel functionality
            document.addEventListener('DOMContentLoaded', function() {
                let scrollAmount = 0;
                const scrollStep = 350;
                const serviceWrapper = document.querySelector(".services-wrapper");
                const nextBtn = document.querySelector(".next-btn");
                const prevBtn = document.querySelector(".prev-btn");
                
                if (nextBtn && prevBtn && serviceWrapper) {
                    nextBtn.addEventListener("click", function() {
                        scrollAmount += scrollStep;
                        const maxScroll = serviceWrapper.scrollWidth - serviceWrapper.clientWidth;
                        if (scrollAmount > maxScroll) {
                            scrollAmount = 0;
                        }
                        serviceWrapper.style.transform = `translateX(-${scrollAmount}px)`;
                    });

                    prevBtn.addEventListener("click", function() {
                        scrollAmount -= scrollStep;
                        if (scrollAmount < 0) {
                            scrollAmount = serviceWrapper.scrollWidth - serviceWrapper.clientWidth;
                        }
                        serviceWrapper.style.transform = `translateX(-${scrollAmount}px)`;
                    });

                    // Auto-scroll with pause on hover
                    let autoScrollInterval = setInterval(() => {
                        if (!serviceWrapper.matches(':hover')) {
                            nextBtn.click();
                        }
                    }, 4000);

                    serviceWrapper.addEventListener('mouseenter', function() {
                        clearInterval(autoScrollInterval);
                    });

                    serviceWrapper.addEventListener('mouseleave', function() {
                        autoScrollInterval = setInterval(() => {
                            nextBtn.click();
                        }, 4000);
                    });
                }
            });
        </script>
        
        
        <!-- Facts Start -->
        
        <!-- Facts End -->
        
        
        <!-- Price Start -->
        <div class="price">
            <div class="container">
                <div class="section-header text-center">
                    <p>Washing Plan</p>
                    <h2>Choose Your Plan</h2>
                </div>
                <div class="row justify-content-center">
                    <!-- Basic Cleaning Plan -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>Basic Wash</h3>
                                <div class="price-amount">
                                    <span class="currency">Rs</span>
                                    <span class="amount">500</span>
                                </div>
                                <p class="price-desc">Perfect for regular maintenance</p>
                                <p class="price-desc">(15–20 minutes)</p>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Exterior water wash</li>
                                    <li><i class="fas fa-check-circle"></i> Shampoo + rinse</li>
                                    <li><i class="fas fa-check-circle"></i> Tire & rim wash</li>
                                    <li><i class="fas fa-check-circle"></i> Basic air drying</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                                <?php if (isset($_SESSION['alogin'])): ?>
                                    <a href="user/basic-wash.php" class="btn btn-custom btn-block">
                                        <i class="fas fa-calendar-check"></i> Get Now
                                    </a>
                                <?php else: ?>
                                    <a href="login.php?redirect=index.php" class="btn btn-custom btn-block">
                                        <i class="fas fa-sign-in-alt"></i> Get Now
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Cleaning Plan (Featured) -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="price-item featured-item">
                            <div class="popular-badge">
                                <i class="fas fa-star"></i> Most Popular
                            </div>
                            <div class="price-header">
                                <h3>Standard Care</h3>
                                <div class="price-amount">
                                    <span class="currency">Rs</span>
                                    <span class="amount">1500</span>
                                </div>
                                <p class="price-desc">Best value for complete care</p>
                                <p class="price-desc">(35–45 minutes)</p>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Everything in Basic</li>
                                    <li>
                                        <span><i class="fas fa-check-circle"></i> Standard Care 1 x Month</span>
                                        <ul class="sub-list">
                                            <li><i class="fas fa-solid fa-plus"></i> Interior vacuum</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Dashboard & console cleaning</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Window & mirror cleaning</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Tire polish</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Light fragrance spray</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="price-footer">
                                <?php if (isset($_SESSION['alogin'])): ?>
                                    <a href="user/standard-care.php" class="btn btn-custom btn-block featured-btn">
                                        <i class="fas fa-calendar-check"></i> Get Now
                                    </a>
                                <?php else: ?>
                                    <a href="login.php?redirect=index.php" class="btn btn-custom btn-block featured-btn">
                                        <i class="fas fa-sign-in-alt"></i> Get Now
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Complex Cleaning Plan -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>Premium Treatment</h3>
                                <div class="price-amount">
                                    <span class="currency">Rs</span>
                                    <span class="amount">2500</span>
                                </div>
                                <p class="price-desc">Ultimate comprehensive service</p>
                                <p class="price-desc">(1.5–2 hours)</p>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Everything in Standard</li>
                                    <li>
                                        <span><i class="fas fa-check-circle"></i> Premium Treatment 1 x Month</span>
                                        <ul class="sub-list">
                                            <li><i class="fas fa-thin fa-plus"></i> Deep interior cleaning</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Seat shampoo / leather conditioning</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Engine bay cleaning</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Wax or polish coating</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Scratch removal</li>
                                            <li><i class="fas fa-solid fa-plus"></i> AC vent cleaning</li>
                                            <li><i class="fas fa-solid fa-plus"></i> Anti-bacterial interior spray</li>
                                        </ul>
                                    </li>
                
                                </ul>
                            </div>
                            <div class="price-footer">
                                <?php if (isset($_SESSION['alogin'])): ?>
                                    <a href="user/premium-treatment.php" class="btn btn-custom btn-block">
                                        <i class="fas fa-calendar-check"></i> Get Now
                                    </a>
                                <?php else: ?>
                                    <a href="login.php?redirect=index.php" class="btn btn-custom btn-block">
                                        <i class="fas fa-sign-in-alt"></i> Get Now
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Price End -->
        
        <script>
            // Auto-fill package type in modal when clicking Get Now
            $(document).ready(function() {
                $('[data-toggle="modal"][data-target="#myModal"]').on('click', function() {
                    var packageType = $(this).data('package');
                    var packageName = $(this).data('package-name');
                    if (packageType) {
                        $('#packagetype').val(packageType);
                    }
                });
            });
        </script>
        
        


        <!-- Footer Start -->
   <?php include_once('includes/footer.php');?>
        
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
                                <label for="packagetype"><i class="fas fa-box"></i> Package Type <span class="text-danger">*</span></label>
                                <select name="packagetype" id="packagetype" required class="form-control">
                                    <option value="">Select Package Type</option>
                                    <option value="1">Basic Wash (Rs500)</option>
                                    <option value="2">Standard Care (Rs1500)</option>
                                    <option value="3">Premium Treatment (Rs2500)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="washingpoint"><i class="fas fa-map-marker-alt"></i> Washing Point <span class="text-danger">*</span></label>
                                <select name="washingpoint" id="washingpoint" required class="form-control">
                                    <option value="">Select Washing Point</option>
                                    <?php 
                                    $sql = "SELECT * from tblwashingpoints";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    foreach($results as $result) { ?>  
                                        <option value="<?php echo htmlentities($result->id);?>">
                                            <?php echo htmlentities($result->washingPointName);?> 
                                            (<?php echo htmlentities($result->washingPointAddress);?>)
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="fname"><i class="fas fa-user"></i> Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" id="fname" class="form-control" required placeholder="Enter your full name">
                            </div>
                            
                            <div class="form-group">
                                <label for="contactno"><i class="fas fa-phone"></i> Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="contactno" id="contactno" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required placeholder="Enter 10-digit mobile number">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="washdate"><i class="fas fa-calendar"></i> Wash Date <span class="text-danger">*</span></label>
                                        <input type="date" name="washdate" id="washdate" required class="form-control" min="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="washtime"><i class="fas fa-clock"></i> Wash Time <span class="text-danger">*</span></label>
                                        <input type="time" name="washtime" id="washtime" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="message"><i class="fas fa-comment"></i> Additional Message</label>
                                <textarea name="message" id="message" class="form-control" rows="3" placeholder="Any special instructions or requests..."></textarea>
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
        
        <script>
            // Set minimum date to today
            document.addEventListener('DOMContentLoaded', function() {
                var today = new Date().toISOString().split('T')[0];
                var washDateInput = document.getElementById('washdate');
                if (washDateInput) {
                    washDateInput.min = today;
                }
            });
        </script>


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

