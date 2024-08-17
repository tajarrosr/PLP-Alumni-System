<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid'] == 0)) {
   header('location:logout.php');
} else {


?>
   <!DOCTYPE html>
   <html lang="en">

   <head>

      <title>All Job Post</title>

      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />

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
                              <h2>All Job Post</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">


                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>All Job Post</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>

                                          <tr>
                                             <th class="text-center"></th>
                                             <th class="d-none d-sm-table-cell">Job Title</th>
                                             <th class="d-none d-sm-table-cell">Company Name</th>
                                             <th class="d-none d-sm-table-cell">Location</th>
                                             <th class="d-none d-sm-table-cell">Vacancy</th>
                                             <th class="d-none d-sm-table-cell">Designation</th>
                                             <th class="d-none d-sm-table-cell">Last Date</th>
                                             <th class="d-none d-sm-table-cell">Posting Date</th>
                                             <th class="d-none d-sm-table-cell">Status</th>

                                             <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                          if (isset($_GET['pageno'])) {
                                             $pageno = $_GET['pageno'];
                                          } else {
                                             $pageno = 1;
                                          }
                                          // Formula for pagination
                                          $no_of_records_per_page = 10;
                                          $offset = ($pageno - 1) * $no_of_records_per_page;
                                          $ret = "SELECT ID FROM tbljobpost";
                                          $query1 = $dbh->prepare($ret);
                                          $query1->execute();
                                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                          $total_rows = $query1->rowCount();
                                          $total_pages = ceil($total_rows / $no_of_records_per_page);
                                          $sql = "SELECT * from tbljobpost LIMIT $offset, $no_of_records_per_page";
                                          $query = $dbh->prepare($sql);
                                          $query->execute();
                                          $results = $query->fetchAll(PDO::FETCH_OBJ);

                                          $cnt = 1;
                                          if ($query->rowCount() > 0) {
                                             foreach ($results as $row) {               ?>
                                                <tr>
                                                   <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                                   <td class="font-w600"><?php echo htmlentities($row->JobTitle); ?></td>
                                                   <td class="font-w600"><?php echo htmlentities($row->CompanyName); ?></td>
                                                   <td class="font-w600"><?php echo htmlentities($row->Location); ?></td>
                                                   <td class="font-w600"><?php echo htmlentities($row->Vacancy); ?></td>
                                                   <td class="font-w600"><?php echo htmlentities($row->Designation); ?></td>
                                                   <td class="font-w600"><?php echo htmlentities($row->LastDate); ?></td>
                                                   <td class="font-w600">
                                                      <span class="badge badge-primary"><?php echo htmlentities($row->PostingDate); ?></span>
                                                   </td>
                                                   <?php if ($row->Status == "") { ?>

                                                      <td class="font-w600"><?php echo "Not Updated Yet"; ?></td>
                                                   <?php } else { ?>
                                                      <td class="d-none d-sm-table-cell">
                                                         <span class="badge badge-primary"><?php echo htmlentities($row->Status); ?></span>
                                                      </td>
                                                   <?php } ?>

                                                   <td class="d-none d-sm-table-cell"><a href="view-jobpost-detail.php?vid=<?php echo htmlentities($row->ID); ?>&&bookingid=<?php echo htmlentities($row->BookingID); ?>" class="btn btn-primary btn-sm" target="_blank">View Details</a></td>
                                                </tr><?php $cnt = $cnt + 1;
                                                   }
                                                } ?>
                                       </tbody>
                                    </table>
                                    <div align="left">
                                       <ul class="pagination">
                                          <li><a href="?pageno=1"><strong>First></strong></a></li>
                                          <li class="<?php if ($pageno <= 1) {
                                                         echo 'disabled';
                                                      } ?>">
                                             <a href="<?php if ($pageno <= 1) {
                                                         echo '#';
                                                      } else {
                                                         echo "?pageno=" . ($pageno - 1);
                                                      } ?>"><strong style="padding-left: 10px">Prev></strong></a>
                                          </li>
                                          <li class="<?php if ($pageno >= $total_pages) {
                                                         echo 'disabled';
                                                      } ?>">
                                             <a href="<?php if ($pageno >= $total_pages) {
                                                         echo '#';
                                                      } else {
                                                         echo "?pageno=" . ($pageno + 1);
                                                      } ?>"><strong style="padding-left: 10px">Next></strong></a>
                                          </li>
                                          <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
                                       </ul>
                                    </div>
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
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>

   </html><?php } ?>