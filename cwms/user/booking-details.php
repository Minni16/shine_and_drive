<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');
?> 
<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | Booking Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="../admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="../admin/css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="../admin/css/morris.css" type="text/css"/>
<link href="../admin/css/font-awesome.css" rel="stylesheet"> 
<script src="../admin/js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="../admin/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="../admin/css/basictable.css" />
<script type="text/javascript" src="../admin/js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../admin/css/icon-font.min.css" type='text/css' />
  <style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.page-container {
    height: auto !important;
    min-height: 100%;
}
html, body {
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
				<?php include('includes/header.php');?>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Booking Details</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->

				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Booking Details #<?php echo $_GET['bookingid'];?></h2>
					    <table id="table">
				
						</thead>
						<tbody>
<?php 
$bid=$_GET['bid'];
$username = $_SESSION['alogin'];
$sql = "SELECT * from tblcarwashbooking
join tblwashingpoints on tblwashingpoints.id=tblcarwashbooking.carWashPoint
 where tblcarwashbooking.id='$bid' AND tblcarwashbooking.fullName=:username";
$query = $dbh -> prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>		
						  <tr>
						  	<th width="200">Booking Id#</th>
							<td><?php echo htmlentities($result->bookingId);?></td>
							<th>Posting Date</th>
								<td><?php echo htmlentities($result->postingDate);?></td>
						</tr>
						<tr>
							<th>Name</th>
							<td width="300"><?php echo htmlentities($result->fullName);?></td>
							<th>Mobile No</th>
							<td><?php echo htmlentities($result->mobileNumber);?></td>
						</tr>
						<tr>
							<th>Package Type</th>
								<td>
								<?php $ptype=$result->packageType;
if($ptype==1): echo "BASIC CLEANING (Rs 500)";endif;
if($ptype==2): echo "PREMIUM CLEANING (Rs 1500)";endif;
if($ptype==3): echo "COMPLEX CLEANING (Rs 2500)";endif;
							?></td>
							
						<th>Washing Point</th>
							<td><?php echo htmlentities($result->washingPointName	);?><br />
								<?php echo htmlentities($result->washingPointAddress);?></td>
							</tr>
							<tr>
								<th>Washing Date</th>
							<td><?php echo htmlentities($result->washDate);?></td>
							<th>Washing Time</th>
							<td><?php echo htmlentities($result->washTime);?></td>
							</tr>
							<tr>
								<th>Message (if Any)</th>
<td colspan="3"><?php echo htmlentities($result->message);?></td>
							</tr>
							
					<tr>
								<th>Status</th>
<td colspan="3">
                                    <?php 
                                    $status = $result->status;
                                    if($status == 'New'): 
                                        echo '<span style="color: orange; font-weight: bold; font-size: 18px;">New</span>';
                                    elseif($status == 'Completed'):
                                        echo '<span style="color: green; font-weight: bold; font-size: 18px;">Completed</span>';
                                    else:
                                        echo htmlentities($status);
                                    endif;
                                    ?>
                                </td>
							</tr>
<?php if($result->adminRemark!=''): ?>
<tr>
	<td colspan="4" style="color:blue; font-size:22px; text-align:center; font-weight:bold;">Admin Details</td>
</tr>

<tr>
	<th>Transaction Type</th>
	<td><?php echo htmlentities($result->paymentMode);?></td>
		<th>Transaction No.(if any)</th>
	<td><?php echo htmlentities($result->txnNumber);?></td>
</tr>
<tr>
	<th>Admin Remark</th>
	<td colspan="3"><?php echo htmlentities($result->adminRemark);?></td>
</tr>
<?php endif;?>

						 <?php } } else { ?>
						 	<tr>
						 		<td colspan="4" style="color:red;">No Record found or Access Denied</td>
						 	</tr>
						 <?php } ?>
						</tbody>
					  </table>
					</div>
			</div>
		</div>
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
						<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
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

</body>
</html>

