<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>PLP Alumni Contact Information</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/main_styles.css">
</head>

<body>

	<div class="super_container">
		<!-- HEADER -->
		<?php include_once('includes/header.php'); ?>

		<!-- CONTACT INFO -->
		<div class="col-lg-8">
			<div class="contact_info">
				<div class="contact_info_title">CONTACT INFORMATION</div>

				<div class="location-container">
					<div class="contact_info_content">
						<?php
						$sql = "SELECT * from tblpage where PageType='contactus'";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) {
						?>
								<ul class="location_list">
									<li>
										<h3>Address</h3>
										<p><?php echo htmlentities($row->PageDescription); ?></p>
									</li>
									<li>
										<h3>Contact Number</h3>
										<p>+<?php echo htmlentities($row->MobileNumber); ?></p>
									</li>
									<li>
										<h3>Email</h3>
										<p><?php echo htmlentities($row->Email); ?></p>
									</li>
								</ul>
						<?php
								$cnt = $cnt + 1;
							}
						} ?>
					</div>
					<div class="location">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.650788345804!2d121.07188787497327!3d14.561951585919843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c87941df8e2b%3A0xc7cd5073d3d73742!2sPamantasan%20ng%20Lungsod%20ng%20Pasig!5e0!3m2!1sen!2sph!4v1686870800013!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<?php include_once('includes/footer.php'); ?>
	</div>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
	<script src="js/contact.js"></script>
</body>

</html>