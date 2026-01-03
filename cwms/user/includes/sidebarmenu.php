<style>
	/* Beautified Sidebar Menu Styles */
	.sidebar-menu {
		background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
		box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
	}

	.logo1 {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		padding: 20px;
		text-align: center;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
	}

	.sidebar-icon {
		color: #fff;
		font-size: 20px;
		transition: all 0.3s ease;
		display: inline-block;
		padding: 8px;
		border-radius: 4px;
	}

	.sidebar-icon:hover {
		background: rgba(255, 255, 255, 0.2);
		transform: rotate(90deg);
	}

	.logo1 > div[style*="border-top"] {
		border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
		margin: 0;
	}

	.menu {
		padding: 10px 0;
	}

	#menu {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	#menu li {
		margin: 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.05);
		transition: all 0.3s ease;
	}

	#menu li:last-child {
		border-bottom: none;
	}

	#menu li a {
		display: flex;
		align-items: center;
		padding: 15px 20px;
		color: #ecf0f1;
		text-decoration: none;
		font-size: 14px;
		font-weight: 500;
		transition: all 0.3s ease;
		position: relative;
		overflow: hidden;
	}

	#menu li a::before {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		height: 100%;
		width: 4px;
		background: #667eea;
		transform: scaleY(0);
		transition: transform 0.3s ease;
	}

	#menu li a:hover::before,
	#menu li.active a::before {
		transform: scaleY(1);
	}

	#menu li a:hover {
		background: rgba(102, 126, 234, 0.15);
		color: #fff;
		padding-left: 25px;
		transform: translateX(5px);
	}

	#menu li.active a {
		background: rgba(102, 126, 234, 0.2);
		color: #fff;
		border-left: 4px solid #667eea;
	}

	#menu li a i {
		font-size: 18px;
		margin-right: 15px;
		width: 24px;
		text-align: center;
		color: #bdc3c7;
		transition: all 0.3s ease;
	}

	#menu li a:hover i,
	#menu li.active a i {
		color: #667eea;
		transform: scale(1.2);
	}

	#menu li a span {
		flex: 1;
		font-weight: 500;
		letter-spacing: 0.3px;
	}

	#menu li a .clearfix {
		display: none;
	}

	/* New Booking Button Special Styling */
	#menu li a.btn-custom {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: #fff;
		margin: 10px;
		border-radius: 6px;
		box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
	}

	#menu li a.btn-custom::before {
		display: none;
	}

	#menu li a.btn-custom:hover {
		background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
		padding-left: 20px;
	}

	#menu li a.btn-custom i {
		color: #fff;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		#menu li a {
			padding: 12px 15px;
			font-size: 13px;
		}

		#menu li a i {
			font-size: 16px;
			margin-right: 12px;
		}
	}
</style>

<div class="sidebar-menu">
	<!-- <header class="logo1">
		<a href="#" class="sidebar-icon">
			<span class="fa fa-bars"></span>
		</a>
		<div style="margin-top: 10px; color: #fff; font-size: 14px; font-weight: 600; letter-spacing: 1px;">
			MENU
		</div>
	</header> -->
	<div class="menu">
		<ul id="menu">
			<li>
				<a href="dashboard.php">
					<i class="fa fa-tachometer"></i>
					<span>Dashboard</span>
					<div class="clearfix"></div>
				</a>
			</li>
			
			<li>
				<a href="all-bookings.php">
					<i class="fa fa-history"></i>
					<span>Booking History</span>
					<div class="clearfix"></div>
				</a>
			</li>

			<li>
				<a href="dashboard.php?open_booking=1" id="new-booking-link">
					<i class="fa fa-plus-circle"></i>
					<span>New Booking</span>
					<div class="clearfix"></div>
				</a>
			</li>
			
			<li>
				<a href="change-password.php">
					<i class="fa fa-lock"></i>
					<span>Change Password</span>
					<div class="clearfix"></div>
				</a>
			</li>
		</ul>
	</div>
</div>

