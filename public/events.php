<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>List of Events</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/main_styles.css">
</head>

<body>

	<div class="super_container">

		<!-- Header -->
		<?php include_once('includes/header.php'); ?>

		<!-- Menu -->



		<!-- Home -->
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>Contact</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Events -->
	<div class="events">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">UPCOMING EVENTS</h2>

					</div>
				</div>
			</div>
			<div class="row events_row">

				<!-- Event -->
				<?php
				if (isset($_GET['pageno'])) {
					$pageno = $_GET['pageno'];
				} else {
					$pageno = 1;
				}
				// Formula for pagination
				$no_of_records_per_page = 10;
				$offset = ($pageno - 1) * $no_of_records_per_page;
				$ret = "SELECT ID FROM tblevents";
				$query1 = $dbh->prepare($ret);
				$query1->execute();
				$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
				$total_rows = $query1->rowCount();
				$total_pages = ceil($total_rows / $no_of_records_per_page);
				$sql = "SELECT * from tblevents order by ID desc LIMIT $offset, $no_of_records_per_page";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_OBJ);

				$cnt = 1;
				if ($query->rowCount() > 0) {
					foreach ($results as $row) { ?>
						<div class="col-lg-4 event_col">
							<!-- Wrap the entire event container with an anchor tag -->
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
													<p><?php echo substr($row->Description, 0, 100); ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
				<?php $cnt = $cnt + 1;
					}
				} ?>

				<!-- Event -->


				<!-- Event -->


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