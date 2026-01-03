<div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-contact">
                        <h2><a href="about.php">About Us</a></h2>
                            <h2>Get In Touch</h2>
<?php 
$sql = "SELECT * from tblpages where type='contact'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{       
?>

                            <p><i class="fa fa-map-marker-alt"></i><?php   echo $result->detail; ?></p>
                            <p><i class="fa fa-phone-alt"></i>+<?php   echo $result->phoneNumber; ?></p>
                            <p><i class="fa fa-envelope"></i><?php   echo $result->emailId; ?></p>

                        <?php } ?>
                            
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="footer-link">
                            <!-- <h2><a href="contact.php">Contact Us</a>
                            </h2> -->
                              <!-- <a href="index.php">Home</a>
                            <a href="about.php">About Us</a>
                            <a href="washing-plans.php">Washing Plans</a>
                            <a href="location.php">Washing Points</a> -->
                            <!-- <a href="contact.php">Contact Us</a> -->
                          
                            <!-- <h2><a href="about.php">About Us</a>
                            </h2> -->
                            <div class="footerright">
                            <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Get In Touch</p>
                    <!-- <h2>Feedback Form</h2> -->
                </div>
                <div class="row">
<?php 
$sql = "SELECT * from tblpages where type='contact'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{       
?>

                
                    <!-- <div class="col-md-4">
                        <div class="contact-info">
                            <h2>Quick Contact Info</h2>

                             <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Address</h3>
                                    <p>+<?php   echo $result->detail; ?></p>
                                </div>
                            </div>


                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Opening Hour</h3>
                                    <p><?php   echo $result->openignHrs; ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-phone-alt"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Call Us</h3>
                                    <p>+<?php   echo $result->phoneNumber; ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Email Us</h3>
                                    <p><?php   echo $result->emailId; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?> -->

                            <div class="col-md-7">
                        <div class="contact-form">
                            <div id="success"></div>
                            <form name="sentMessage" id="contactForm" method="post">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" required="required" name="name" /><br />
                           
                                </div>
                                <div class="control-group">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" required="required"  /> <br />
                                
                                </div>
                                <div class="control-group">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" name="subject" /> <br />
                       
                                </div>
                                <div class="control-group">
                                    <textarea class="form-control" id="message" placeholder="Message" required="required" name="message" ></textarea><br />
                 
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit" id="sendMessageButton" name="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
           
                </div>
            </div>
                                                                                             </div>
              
                        </div>
                    </div>
             
                </div>
            </div>
</div>
            <div class="container copyright">
                <p>Car Wash Scheduling System</p>
            </div>
        </div>
        <!-- Footer End -->        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>