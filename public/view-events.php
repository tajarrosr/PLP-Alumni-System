<?php
session_start();
error_reporting(0);
include __DIR__ . '/includes/dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>College Alumni System || View Events Details</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/main_styles.css">
</head>

<body>

	<div class="super_container">

		<!-- Header -->

		<?php include_once('includes/header.php'); ?>


		<!-- Home -->

		<div class="home">
			<div class="breadcrumbs_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="breadcrumbs">
								<ul>
									<li><a href="home.php">Home</a></li>
									<li><a href="events.php">Events</a></li>
									<li>Events Details</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Event -->

		<div class="course">
			<div class="container">
				<div class="row">

					<!-- Event -->
					<div class="col-lg-12">

						<div class="course_container">
							<div class="course_title">Events Details</div>

							<?php
							$vid = $_GET['vid'];

							$sql = "SELECT * from tblevents where ID = :vid ";
							$query = $dbh->prepare($sql);
							$query->bindParam(':vid', $vid, PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);

							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) {               ?>
									<!-- Event -->
									<div class="course_image"><img src="../admin/images/<?php echo $row->BannerImage; ?>" alt=""></div>

									<!-- Event -->
									<div class="course_tabs_container">

										<div class="tab_panels">

											<!-- Description -->
											<div class="tab_panel active">

												<div class="tab_panel_title"><?php echo $row->EventTitle; ?></div>
												<div class="tab_panel_content">
													<div class="tab_panel_text">
														<p><?php echo $row->Description; ?>.</p>
													</div>

													<div class="tab_panel_section">
														<div class="tab_panel_subtitle">Date and Time</div>
														<div class="tab_panel_text">
															<p><?php echo (new DateTime($row->Schedule))->format('Y-m-d, h:i A'); ?></p>
														</div>
													</div>

												</div>
											</div>





										</div>
									</div>
						</div><?php $cnt = $cnt + 1;
								}
							} ?>
					</div>


				</div>
			</div>
		</div>


		<!-- Footer -->
		<?php include_once('includes/footer.php'); ?>

	</div>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>