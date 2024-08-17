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
      $sql = "delete from tblalumni where ID=:rid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':rid', $rid, PDO::PARAM_STR);
      $query->execute();
      $sql1 = "delete from tbljobpost where AlumniID=:rid";
      $query1 = $dbh->prepare($sql1);
      $query1->bindParam(':rid', $rid, PDO::PARAM_STR);
      $query1->execute();
      echo "<script>alert('Data deleted');</script>";
      echo "<script>window.location.href = 'alumni-list.php'</script>";
   }

?>
   <!DOCTYPE html>
   <html lang="en">

   <head>

      <title>Alumni Report</title>

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
                              <h2>Manage Alumni List</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">

                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">

                                       <div class="full graph_head">
                                          <div class="alert alert-primary" role="alert">
                                             <form method="post">
                                                <fieldset>

                                                   <div class="field">
                                                      <label class="label_field">From Date</label>
                                                      <input type="date" name="fdate" value="" id="fdate" class="form-control" required='true'>
                                                   </div>


                                                   <br>
                                                   <div class="field">
                                                      <label class="label_field">To Date</label>
                                                      <input type="date" name="todate" id="todate" value="" class="form-control" required='true'>
                                                   </div>


                                                   <br>
                                                   <div class="field margin_0">
                                                      <label class="label_field hidden">hidden label</label>
                                                      <button class="main_bt" type="submit" name="submit" id="submit">Submit</button>
                                                   </div>
                                                </fieldset>
                                             </form>
                                          </div>
                                          <?php
                                          if (isset($_POST['submit'])) { ?>
                                             <?php
                                             $fdate = $_POST['fdate'];
                                             $tdate = $_POST['todate'];
                                             ?>
                                             <div class="heading1 margin_0">
                                                <h2> Alumni List from <?php echo date("d-m-Y", strtotime($fdate)); ?> To <?php echo date("d-m-Y", strtotime($tdate)); ?></h2>
                                             </div>
                                       </div>
                                       <div class="table_section padding_infor_info">
                                          <div class="table-responsive-sm">
                                             <table class="table table-bordered">
                                                <thead>
                                                   <tr>
                                                      <th>S.No</th>
                                                      <th>Full Name</th>
                                                      <th>College ID</th>
                                                      <th>Batch</th>
                                                      <th>Email</th>
                                                      <th>Registration Date</th>
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
                                                   $ret = "SELECT ID FROM tblalumni where date(RegDate) between '$fdate' and '$tdate'";
                                                   $query1 = $dbh->prepare($ret);
                                                   $query1->execute();
                                                   $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                   $total_rows = $query1->rowCount();
                                                   $total_pages = ceil($total_rows / $no_of_records_per_page);
                                                   $sql = "SELECT * from tblalumni where date(RegDate) between '$fdate' and '$tdate' LIMIT $offset, $no_of_records_per_page";
                                                   $query = $dbh->prepare($sql);
                                                   $query->execute();
                                                   $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                   $cnt = 1;
                                                   if ($query->rowCount() > 0) {
                                                      foreach ($results as $row) {               ?>
                                                         <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($row->FullName); ?></td>
                                                            <td><?php echo htmlentities($row->CollegeID); ?></td>
                                                            <td><?php echo htmlentities($row->Batch); ?></td>
                                                            <td><?php echo htmlentities($row->Emailid); ?></td>
                                                            <td><?php echo htmlentities($row->RegDate); ?></td>
                                                            <td><a href="view-alumni-details.php?alumniid=<?php echo htmlentities($row->ID); ?>"><i class="btn btn-success" aria-hidden="true" target="blank">View</i></a>&nbsp; <a href="alumni-list.php?delid=<?php echo ($row->ID); ?>" onclick="return confirm('Do you really want to Delete ?');"><i class="btn btn-danger"> Delete</i></a></td>
                                                         </tr>
                                                      <?php }
                                                   } else { ?>

                                                      <tr>
                                                         <th colspan="6" style="color:red">No record found</th>
                                                      </tr> <?php } ?>
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
                                             </div><?php } ?>
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