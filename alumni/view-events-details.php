<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['alumniid'] == 0)) {
   header('location:logout.php');
} else {



?>
   <!DOCTYPE html>
   <html lang="en">

   <head>

      <title>College Alumni System || View College Events</title>

      <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="../admin/style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="../admin/css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="../admin/css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="../admin/css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="../admin/css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="../admin/css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="../admin/js/semantic.min.css" />
      <!-- fancy box js -->
      <link rel="stylesheet" href="../admin/css/jquery.fancybox.css" />

   </head>

   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <?php include_once('includes/header.php'); ?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>View College Events</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">


                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>View College Events</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
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
                                          <table class="table table-bordered">
                                             <tr>
                                                <th colspan="6" style="color: orange;font-weight: bold;font-size: 20px;text-align: center;"><?php echo $row->EventTitle; ?> </th>
                                             </tr>
                                             <tr>

                                                <td><img src="../admin/images/<?php echo $row->BannerImage; ?>" width="1050" height="450"></td>

                                             </tr>
                                             <tr>

                                                <td><?php echo $row->Description; ?>
                                                   <p><strong style="color: red;">Date and Time:</strong> <?php echo $row->Schedule; ?></p>
                                                </td>

                                             </tr>
                                          </table><?php $cnt = $cnt + 1;
                                                }
                                             } ?>

                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- footer -->
                  <?php include_once('includes/footer.php'); ?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->

      </div>
      <!-- jQuery -->
      <script src="../admin/js/jquery.min.js"></script>
      <script src="../admin/js/popper.min.js"></script>
      <script src="../admin/js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="../admin/js/animate.js"></script>
      <!-- select country -->
      <script src="../admin/js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="../admin/js/owl.carousel.js"></script>
      <!-- chart js -->
      <script src="../admin/js/Chart.min.js"></script>
      <script src="../admin/js/Chart.bundle.min.js"></script>
      <script src="../admin/js/utils.js"></script>
      <script src="../admin/js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="../admin/js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- fancy box js -->
      <script src="../admin/js/jquery-3.3.1.min.js"></script>
      <script src="../admin/js/jquery.fancybox.min.js"></script>
      <!-- custom js -->
      <script src="../admin/js/custom.js"></script>
      <!-- calendar file css -->
      <script src="../admin/js/semantic.min.js"></script>
   </body>

   </html><?php } ?>