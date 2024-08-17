<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Pamantasan ng Lungsod ng Pasig Alumni</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/main_styles.css">
</head>

<body>

	<div class="super_container">
		<!-- HEADER LINK -->
		<?php include_once('includes/header.php'); ?>

		<!-- HOME -->
		<div class="home">
			<div class="home_slider_container">
				<!-- Home Slider -->
				<div class="owl-carousel owl-theme home_slider">
					<!-- Home Slider Item 1 -->
					<div class="owl-item">
						<div class="home_slider_background" style="background-image:url(images/plp_header1.jpg)"></div>
						<div class="home_slider_content">
							<div class="container">
								<div class="row">
									<div class="col text-center">
										<div class="home_slider_title">WELCOME TO PLP ALUMBACK : </div>
										<div class="home_slider_subtitle">Empowering PLP Alumni To Comeback, Reconnect, And Shine Brighter – Where Memories Reignite And Futures Take Flight</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Home Slider Item 2 -->
					<div class="owl-item">
						<div class="home_slider_background" style="background-image:url(images/plp_header2.jpg)"></div>
						<div class="home_slider_content">
							<div class="container">
								<div class="row">
									<div class="col text-center">
										<div class="home_slider_title">Revive the bond between the Alumni and the institution</div>
										<div class="home_slider_subtitle">Exchange professional knowledge</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Home Slider Item 3 -->
					<div class="owl-item">
						<div class="home_slider_background" style="background-image:url(images/plp_header3.jpg)"></div>
						<div class="home_slider_content">
							<div class="container">
								<div class="row">
									<div class="col text-center">
										<div class="home_slider_title">Welcome to the Alumni Lineage!</div>
										<div class="home_slider_subtitle">On this website, you will find information about upcoming events and job opportunities</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- Home Slider Nav -->
			<div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
			<div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
		</div>

		<!-- EVENTS -->
		<div class="events">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title_container text-center">
							<h2 class="section_title_home">UPCOMING EVENTS :</h2>
							<div class="section_subtitle">
								<p>Get ready for an exciting lineup of activities! Join us for a series of engaging events designed to bring people together. From workshops to gaming tournaments, there's something for everyone. Whether you're seeking knowledge, fun, or a chance to connect, our upcoming events promise a great time. Stay tuned for more details and mark your calendars!</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row events_row">
					<?php
					$sql = "SELECT * FROM tblevents ORDER BY ID DESC LIMIT 6";
					$query = $dbh->prepare($sql);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);

					if ($query->rowCount() > 0) {
						foreach ($results as $row) {
					?>
							<div class="col-lg-4 event_col">
								<a href="view-events.php?vid=<?php echo htmlentities($row->ID); ?>" class="event_link">
									<div class="event event_left">
										<div class="event_container">
											<!-- Event Image -->
											<div class="event_image">
												<img src="../admin/images/<?php echo $row->BannerImage; ?>" width="400" height="200" alt="">
											</div>
											<!-- Event Details Container -->
											<div class="event_details">
												<!-- Event Title -->
												<div class="event_title">
													<a href="view-events.php?vid=<?php echo htmlentities($row->ID); ?>" style="color: #000;">
														<?php echo htmlentities($row->EventTitle); ?>
													</a>
												</div>
												<!-- Event Info Container -->
												<div class="event_info_container">
													<!-- Event Info (Date) -->
													<div class="event_info">
														<i class="fa fa-clock-o" aria-hidden="true" style="color: black;"></i>
														<span style="color: black;"><?php echo (new DateTime($row->Schedule))->format('Y-m-d, h:i A'); ?></span>
													</div>
													<!-- Event Text -->
													<div class="event_text">
														<p><?php echo substr($row->Description, 0, 50); ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
					<?php
						}
					} ?>
				</div>

			</div>
		</div>

		<!-- FOOTER -->
		<?php include_once('includes/footer.php'); ?>
	</div>
	<script>
		function changeColor(element) {
			element.style.color = "#0a7d42"; // Change to the desired hover color
		}

		function restoreColor(element) {
			element.style.color = "black"; // Restore to the default color on mouseout
		}
	</script>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>