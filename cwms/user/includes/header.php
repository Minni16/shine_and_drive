<?php
// Display UserName from session
$userDisplayName = htmlentities($_SESSION['alogin']);
if (isset($_SESSION['alogin'])) {
	// Format username nicely (capitalize first letter of each word)
	$userDisplayName = ucwords(str_replace(['_', '-'], ' ', htmlentities($_SESSION['alogin'])));
	// Get first letter for avatar
	$userInitial = strtoupper(substr($userDisplayName, 0, 1));
}
?>
<style>
	/* Enhanced Header UI Styles */
	.header-main {
		background: transparent;
		padding: 1em 1.5em;
		display: flex;
		justify-content: space-between;
		align-items: center;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
	}

	.logo-w3-agile {
		background: transparent;
		padding: 0;
		margin: 0;
		float: none;
		width: auto;
	}

	.logo-w3-agile h1 {
		margin: 0;
		font-size: 28px;
		font-weight: 700;
		letter-spacing: 1px;
	}

	.logo-w3-agile h1 a {
		color: #333;
		text-decoration: none;
		transition: all 0.3s ease;
		display: inline-block;
	}

	.logo-w3-agile h1 a:hover {
		color: #667eea;
		transform: scale(1.02);
	}

	.profile_details {
		background: transparent;
		padding: 0;
		margin: 0;
		float: none;
		width: auto;
	}

	.profile_img {
		display: flex;
		align-items: center;
		gap: 12px;
		position: relative;
	}

	.user-avatar {
		width: 45px;
		height: 45px;
		border-radius: 50%;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 20px;
		font-weight: 700;
		color: #fff;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
		transition: all 0.3s ease;
		flex-shrink: 0;
	}

	.profile_details_drop:hover .user-avatar {
		transform: scale(1.05);
		box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
	}

	.user-name {
		flex: 1;
		margin: 0;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.user-name p {
		font-size: 15px;
		color: #333;
		line-height: 1;
		font-weight: 600;
		margin: 0;
		letter-spacing: 0.5px;
		display: inline;
	}

	.user-name .fa {
		color: #666 !important;
		font-size: 14px !important;
		transition: all 0.3s ease;
		margin: 0;
		line-height: 1;
		vertical-align: middle;
	}

	.profile_details_drop .fa {
		color: #666 !important;
		font-size: 16px !important;
		transition: all 0.3s ease;
		margin-left: 8px;
	}

	.profile_details_drop:hover .fa {
		transform: translateY(2px);
	}

	.profile_details_drop .fa.fa-angle-up {
		display: none;
	}

	.profile_details_drop.open .fa.fa-angle-up {
		display: inline-block;
	}

	.profile_details_drop.open .fa.fa-angle-down {
		display: none;
	}

	.profile_details_drop a.dropdown-toggle {
		display: flex;
		align-items: center;
		padding: 0;
		text-decoration: none;
		width: 100%;
	}

	.profile_details_drop a.dropdown-toggle:hover {
		text-decoration: none;
	}

	.dropdown-menu.drp-mnu {
		background: #fff;
		border: none;
		border-radius: 8px;
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
		padding: 0.5em 0;
		margin-top: 10px;
		min-width: 200px;
		overflow: hidden;
	}

	.dropdown-menu.drp-mnu li {
		list-style: none;
		margin: 0;
	}

	.dropdown-menu.drp-mnu li a {
		padding: 12px 20px;
		display: flex;
		align-items: center;
		gap: 12px;
		color: #333;
		text-decoration: none;
		transition: all 0.3s ease;
		font-size: 14px;
		font-weight: 500;
	}

	.dropdown-menu.drp-mnu li a i {
		color: #667eea;
		width: 20px;
		text-align: center;
		font-size: 16px;
	}

	.dropdown-menu.drp-mnu li a:hover {
		background: #667eea;
		color: #fff;
		padding-left: 25px;
	}

	.dropdown-menu.drp-mnu li a:hover i {
		color: #fff;
	}

	.profile_details ul {
		margin: 0;
		padding: 0;
	}

	@media (max-width: 768px) {
		.logo-w3-agile h1 {
			font-size: 22px;
		}

		.user-name p {
			font-size: 13px;
		}

		.user-avatar {
			width: 40px;
			height: 40px;
			font-size: 18px;
		}
	}
</style>

<div class="header-main">
	<div class="logo-w3-agile">
		<h1><a href="dashboard.php">Car Wash Scheduling</a></h1>
	</div>

	<div class="profile_details w3l">
		<ul>
			<li class="dropdown profile_details_drop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<div class="profile_img">
						<div class="user-avatar">
							<?php echo $userInitial; ?>
						</div>
						<div class="user-name">
							<p>Welcome, <?php echo $userDisplayName; ?></p>
						</div>
						<div style="margin-left: 30px;">
							<i class="fa fa-angle-down" style="color: #000 !important;"></i>
							<i class="fa fa-angle-up" style="color: #000 !important;"></i>
						</div>
					</div>
				</a>
				<ul class="dropdown-menu drp-mnu">
					<li>
						<a href="change-password.php">
							<span>Change Password</span>
						</a>
					</li>
					<li>
						<a href="logout.php">
							<span>Logout</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>