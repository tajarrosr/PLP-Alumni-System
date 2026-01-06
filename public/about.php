	<?php
	session_start();
	error_reporting(0);
	include __DIR__ . '/includes/dbconnection.php';

	// Fetch the Page Description from the database
	$sql = "SELECT PageDescription FROM tblpage WHERE PageType='aboutus'";
	$query = $dbh->prepare($sql);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);

	// Store the Page Description in a variable
	$pageDescription = $row['PageDescription'];
	$paragraphs = explode("\n", $pageDescription);
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>About PLP Alumni</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
		<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/main_styles.css">
	</head>

	<body>

		<div class="super_container">
			<!-- HEADER -->
			<?php include_once('includes/header.php'); ?>


			<!-- ABOUT US -->
			<div class="about-us-container">
				<div class="about-content">
					<div class="about-text-container">
						<h1>About the Pamantasan ng Lungsod ng Pasig Alumni</h1>
						<?php foreach ($paragraphs as $paragraph) { ?>
							<p class="typewriter"><?php echo $paragraph; ?></p>
						<?php } ?>

						<div class="officers-section">
							<h2>PLP Alumni Association Officers</h2>
							<div class="officers-container">
								<!-- President -->
								<div class="officer president">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Prof. Enrique Antonio S. Perez</h3>
										<p class="officer-position">President</p>
									</div>
								</div>
								<!-- Vice Presidents -->
								<div class="officer">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Ms. Mary Grace B. Raymundo</h3>
										<p class="officer-position">Vice President for Internal Affairs</p>
									</div>
								</div>
								<div class="officer">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Ms. April M. Manuzon</h3>
										<p class="officer-position">Vice President for External Affairs</p>
									</div>
								</div>
								<!-- Secretary -->
								<div class="officer">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Ms. Aileen T. Bias</h3>
										<p class="officer-position">Secretary</p>
									</div>
								</div>
								<!-- Treasurer -->
								<div class="officer">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Ms. Sharon DR. Caylan</h3>
										<p class="officer-position">Treasurer</p>
									</div>
								</div>
								<!-- Auditor -->
								<div class="officer">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Ms. Jenky B. Renomaro</h3>
										<p class="officer-position">Auditor</p>
									</div>
								</div>
								<!-- Public Relations Officer -->
								<div class="officer">
									<img src="images/plp_logo.png" alt="">
									<div class="officer-details">
										<h3 class="officer-name">Mr. Regin Russel F. Gonzales</h3>
										<p class="officer-position">Public Relations Officer</p>
									</div>
								</div>
							</div>
						</div>


						<div class="videos-section">
							<h2>Journey Through Alma Mater: A Heartwarming Alumni Story</h2>
							<div class="video-container">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/y-WqfTvoAcI" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
						<div class="achievements-section">
							<h2>Achievements</h2>
							<p>Our alumni have achieved milestones in various fields SOON TO BE UPLOAD...</p>
							<!-- Add more achievement details -->
						</div>
						<!-- Add more sections like events, community engagement, etc. -->
					</div>
				</div>


				<?php include_once('includes/footer.php'); ?>
			</div>

			<script src="js/jquery-3.2.1.min.js"></script>
			<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
			<script src="js/custom.js"></script>
	</body>

	</html>