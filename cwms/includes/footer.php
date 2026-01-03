<?php 
// Process footer contact form submission (same logic as contact.php)
// Only process if submit button from footer form is clicked and dbh is available
if(isset($_POST['submit']) && isset($dbh) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];   
    $subject=$_POST['subject'];
    $message=$_POST['message'];

    $sql="INSERT INTO tblenquiry(FullName,EmailId,Subject,Description) VALUES(:name,:email,:subject,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':subject',$subject,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo "<script>alert('Query sent successfully');</script>";
        // Redirect to the same page to avoid form resubmission
        $currentPage = $_SERVER['REQUEST_URI'];
        // Remove query string if present
        $currentPage = strtok($currentPage, '?');
        echo "<script>window.location.href ='" . htmlspecialchars($currentPage, ENT_QUOTES) . "'</script>";
    }
    else 
    {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
?>
<style>
/* Enhanced Footer Styles */
.footer {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    padding: 60px 0 30px;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #28a745 0%, #20c997 50%, #28a745 100%);
}

.footer-contact {
    padding-right: 30px;
}

.footer-contact h2 {
    font-size: 24px;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 15px;
    letter-spacing: 0.5px;
}

.footer-contact h2:not(:first-child) {
    margin-top: 30px;
}

.footer-contact h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: #28a745;
    border-radius: 2px;
}

.footer-contact h2 a {
    color: #28a745;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-contact h2 a:hover {
    color: #20c997;
    text-decoration: none;
}

.footer-contact p {
    color: #e0e0e0;
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 18px;
    display: flex;
    align-items: flex-start;
    transition: all 0.3s ease;
}

.footer-contact p:hover {
    color: #ffffff;
    transform: translateX(5px);
}

.footer-contact p i {
    color: #28a745;
    font-size: 18px;
    margin-right: 15px;
    margin-top: 3px;
    min-width: 20px;
    text-align: center;
}

.footer-form-section {
    padding-left: 30px;
}

.footer-form-section .section-header {
    text-align: left;
    margin-bottom: 30px;
}

.footer-form-section .section-header p {
    font-size: 14px;
    color: #28a745;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 10px;
}

.footer-form-section .section-header h2 {
    font-size: 28px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    position: relative;
    padding-bottom: 15px;
}

.footer-form-section .section-header h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: #28a745;
    border-radius: 2px;
}

.footer .contact-form {
    background: rgba(255, 255, 255, 0.05);
    padding: 30px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.footer .contact-form .control-group {
    margin-bottom: 20px;
    position: relative;
}

.footer .contact-form .form-control {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    padding: 14px 18px;
    font-size: 15px;
    color: #333;
    transition: all 0.3s ease;
    width: 100%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.footer .contact-form .form-control:focus {
    outline: none;
    border-color: #28a745;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
    transform: translateY(-2px);
}

.footer .contact-form .form-control::placeholder {
    color: #999;
    font-weight: 400;
}

.footer .contact-form textarea.form-control {
    min-height: 120px;
    resize: vertical;
    font-family: inherit;
}

.footer .contact-form .btn-custom {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #ffffff;
    border: none;
    padding: 14px 35px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 100%;
    margin-top: 10px;
}

.footer .contact-form .btn-custom:hover {
    background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.footer .contact-form .btn-custom:active {
    transform: translateY(0);
}

.footer .copyright {
    text-align: center;
    padding: 25px 0;
    margin-top: 40px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer .copyright p {
    margin: 0;
    color: #b0b0b0;
    font-size: 14px;
    letter-spacing: 0.5px;
}

.footer .copyright p a {
    color: #28a745;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.footer .copyright p a:hover {
    color: #20c997;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 991px) {
    .footer-contact {
        padding-right: 0;
        margin-bottom: 40px;
    }
    
    .footer-form-section {
        padding-left: 0;
    }
    
    .footer .contact-form {
        padding: 25px;
    }
}

@media (max-width: 767px) {
    .footer {
        padding: 40px 0 20px;
    }
    
    .footer-contact h2 {
        font-size: 20px;
        margin-bottom: 20px;
    }
    
    .footer-form-section .section-header h2 {
        font-size: 22px;
    }
    
    .footer .contact-form {
        padding: 20px;
    }
    
    .footer .contact-form .form-control {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .footer .contact-form .btn-custom {
        padding: 12px 30px;
        font-size: 14px;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.footer-contact p,
.footer .contact-form {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<div class="footer">
    <div class="container">
        <div class="row">
            <!-- Left Column: Contact Information -->
            <div class="col-lg-6 col-md-6">
                <div class="footer-contact">
                    <h2>Get In Touch</h2>
                    <?php 
                    $sql = "SELECT * from tblpages where type='contact'";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    foreach($results as $result)
                    {       
                    ?>
                    <p>
                        <i class="fa fa-map-marker-alt"></i>
                        <span><?php echo htmlspecialchars($result->detail); ?></span>
                    </p>
                    <p>
                        <i class="fa fa-phone-alt"></i>
                        <span>+<?php echo htmlspecialchars($result->phoneNumber); ?></span>
                    </p>
                    <p>
                        <i class="fa fa-envelope"></i>
                        <span><?php echo htmlspecialchars($result->emailId); ?></span>
                    </p>
                    <?php } ?>
                </div>
            </div>
            
            <!-- Right Column: Contact Form -->
            <div class="col-lg-6 col-md-6">
                <div class="footer-form-section">
                    <div class="section-header">
                        <p>Get In Touch</p>
                        <h2>Send Us a Message</h2>
                    </div>
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" method="post">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" placeholder="Your Name" required="required" name="name" />
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" required="required" />
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" name="subject" />
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" placeholder="Your Message" required="required" name="message" rows="5"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-custom" type="submit" id="sendMessageButton" name="submit">
                                    <i class="fa fa-paper-plane" style="margin-right: 8px;"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container copyright">
        <p>&copy; <?php echo date('Y'); ?> Car Wash Scheduling System. All rights reserved.</p>
    </div>
</div>

<!-- Back to top button -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- Pre Loader -->
<div id="loader" class="show">
    <div class="loader"></div>
</div>
