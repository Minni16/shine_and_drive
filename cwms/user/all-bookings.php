<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/auth-check.php');
include('includes/payment-check.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | My Bookings</title>
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

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../admin/css/icon-font.min.css" type='text/css' />
<style>
	/* Error and Success Messages */
	.errorWrap {
		padding: 15px 20px;
		margin: 0 0 20px 0;
		background: #fff;
		border-left: 4px solid #dc3545;
		border-radius: 4px;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		color: #721c24;
		font-weight: 500;
	}

	.succWrap {
		padding: 15px 20px;
		margin: 0 0 20px 0;
		background: #fff;
		border-left: 4px solid #28a745;
		border-radius: 4px;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		color: #155724;
		font-weight: 500;
	}

	/* Page Container */
	.page-container {
		height: auto !important;
		min-height: 100%;
		background: #f8f9fa;
	}

	html, body {
		overflow-y: auto !important;
		height: auto !important;
		background: #f8f9fa;
	}

	/* Breadcrumb Styling */
	.breadcrumb {
		background: transparent;
		padding: 15px 0;
		margin-bottom: 20px;
		border-radius: 0;
	}

	.breadcrumb-item {
		font-size: 14px;
		color: #6c757d;
	}

	.breadcrumb-item a {
		color: #667eea;
		text-decoration: none;
		transition: color 0.3s ease;
	}

	.breadcrumb-item a:hover {
		color: #764ba2;
		text-decoration: underline;
	}

	.breadcrumb-item .fa {
		margin: 0 8px;
		color: #adb5bd;
	}

	/* Table Container */
	.agile-tables {
		background: #fff;
		border-radius: 8px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		padding: 25px;
		margin-bottom: 30px;
	}

	.w3l-table-info h2 {
		font-size: 28px;
		font-weight: 700;
		color: #333;
		margin-bottom: 25px;
		padding-bottom: 15px;
		border-bottom: 3px solid #667eea;
		letter-spacing: 0.5px;
	}

	/* Table Styling */
	#table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
		background: #fff;
		border-radius: 8px;
		overflow: hidden;
	}

	#table thead {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	}

	#table thead th {
		padding: 15px 20px;
		text-align: left;
		font-weight: 600;
		color: #fff;
		font-size: 14px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		border: none;
	}

	#table tbody tr {
		transition: all 0.3s ease;
		border-bottom: 1px solid #e9ecef;
	}

	#table tbody tr:hover {
		background: #f8f9ff;
		transform: translateX(2px);
		box-shadow: 0 2px 4px rgba(102, 126, 234, 0.1);
	}

	#table tbody td {
		padding: 15px 20px;
		color: #495057;
		font-size: 14px;
		vertical-align: middle;
		border: none;
	}

	#table tbody tr:last-child {
		border-bottom: none;
	}

	/* Action Links */
	#table tbody td a {
		color: #667eea;
		text-decoration: none;
		font-weight: 600;
		padding: 8px 16px;
		border-radius: 4px;
		display: inline-block;
		transition: all 0.3s ease;
		background: rgba(102, 126, 234, 0.1);
	}

	#table tbody td a:hover {
		background: #667eea;
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
	}

	/* No Records Message */
	#table tbody tr td[colspan] {
		text-align: center;
		padding: 40px 20px;
		color: #dc3545;
		font-size: 16px;
		font-weight: 500;
		background: #fff5f5;
	}

	/* Package Type Badges */
	#table tbody td {
		line-height: 1.6;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.agile-tables {
			padding: 15px;
		}

		.w3l-table-info h2 {
			font-size: 22px;
			margin-bottom: 20px;
		}

		#table thead th,
		#table tbody td {
			padding: 10px 12px;
			font-size: 13px;
		}
	}

	/* Content Area */
	.left-content {
		background: transparent;
	}

	.mother-grid-inner {
		padding: 20px;
	}

	/* Inner Block */
	.inner-block {
		padding: 20px 0;
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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>My Bookings</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->

				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>My Bookings</h2>
					    <table id="table">
						<thead>
						  <tr>
						  <th>Booking No.</th>
							<th>Name</th>
							<th width="200">Package Type</th>
							<th>Washing Point</th>
							<th>Washing Date/Time</th>
							<th width="200">Posting Date</th>
							<th>Action</th>
							
						  </tr>
						</thead>
						<tbody>
<?php 
$username = $_SESSION['alogin'];
$sql = "SELECT *,tblcarwashbooking.id as bid from tblcarwashbooking
join tblwashingpoints on tblwashingpoints.id=tblcarwashbooking.carWashPoint
where tblcarwashbooking.fullName=:username
ORDER BY tblcarwashbooking.postingDate DESC";
$query = $dbh -> prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>		
						  <tr>
							<td><?php echo htmlentities($result->bookingId);?></td>
							<td><?php echo htmlentities($result->fullName);?></td>
								<td width="50">
								<?php $ptype=$result->packageType;
if($ptype==1): echo "BASIC CLEANING (Rs 500)";endif;
if($ptype==2): echo "PREMIUM CLEANING (Rs 1500)";endif;
if($ptype==3): echo "COMPLEX CLEANING (Rs 2500)";endif;


							?></td>
							
						
							<td><?php echo htmlentities($result->washingPointName	);?><br />
								<?php echo htmlentities($result->washingPointAddress);?></td>
							<td><?php echo htmlentities($result->washDate."/".$result->washTime);?></td>
							
								<td><?php echo htmlentities($result->postingDate);?></td>
				

<td><a href="booking-details.php?bid=<?php echo htmlentities($result->bid);?>&&bookingid=<?php echo htmlentities($result->bookingId);?>">View</a>
</td>
<?php } ?>
</tr>
						 <?php } else { ?>
						 	<tr>
						 		<td colspan="7">No Record found</td>

						 	</tr>
						 <?php } ?>
						</tbody>
					  </table>
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