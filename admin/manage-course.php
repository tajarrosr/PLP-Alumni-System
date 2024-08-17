<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid'] == 0)) {
   header('location:logout.php');
} else {

   // Code for deletion
   if (isset($_GET['delid'])) {
      $rid = intval($_GET['delid']);
      $sql = "delete from tblcourse where ID=:rid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':rid', $rid, PDO::PARAM_STR);
      $query->execute();
      echo "<script>alert('Data deleted');</script>";
      echo "<script>window.location.href = 'manage-course.php'</script>";
   }

?>
   <!DOCTYPE html>
   <html lang="en">

   <head>

      <title>College Alumni System || Manage Course</title>

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
                              <h2>Manage Course</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">


                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Manage Course</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>S.No</th>
                                             <th>Course Name</th>
                                             <th>Creation Date</th>
                                             <th>Action</th>
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
                                          $ret = "SELECT ID FROM tblcourse";
                                          $query1 = $dbh->prepare($ret);
                                          $query1->execute();
                                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                          $total_rows = $query1->rowCount();
                                          $total_pages = ceil($total_rows / $no_of_records_per_page);
                                          $sql = "SELECT * from tblcourse LIMIT $offset, $no_of_records_per_page";
                                          $query = $dbh->prepare($sql);
                                          $query->execute();
                                          $results = $query->fetchAll(PDO::FETCH_OBJ);

                                          $cnt = ($pageno - 1) * $no_of_records_per_page + 1;
                                          if ($query->rowCount() > 0) {
                                             foreach ($results as $row) {               ?>
                                                <tr>
                                                   <td><?php echo htmlentities($cnt); ?></td>
                                                   <td><?php echo htmlentities($row->CourseName); ?></td>
                                                   <td><?php echo htmlentities($row->CreationDate); ?></td>
                                                   <td><a href="edit-course.php?editid=<?php echo htmlentities($row->ID); ?>"><i class="btn btn-success" aria-hidden="true">Edit</i></a>&nbsp; <a href="manage-course.php?delid=<?php echo ($row->ID); ?>" onclick="return confirm('Do you really want to Delete ?');"><i class="btn btn-danger"> Delete</i></a></td>
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