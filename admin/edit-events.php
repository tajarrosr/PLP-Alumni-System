<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid'] == 0)) {
   header('location:logout.php');
} else {
   if (isset($_POST['submit'])) {

      $title = $_POST['title'];
      $schedule = $_POST['schedule'];
      $description = $_POST['description'];
      $eid = $_GET['editid'];
      $sql = "update tblevents set EventTitle=:title,Schedule=:schedule,Description=:description where ID=:eid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':title', $title, PDO::PARAM_STR);
      $query->bindParam(':schedule', $schedule, PDO::PARAM_STR);
      $query->bindParam(':description', $description, PDO::PARAM_STR);
      $query->bindParam(':eid', $eid, PDO::PARAM_STR);
      $query->execute();
      echo '<script>alert("Events details has been updated")</script>';
   }

?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <title>Update Events</title>

      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />

   </head>

   <body class="inner_page general_elements">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- end sidebar -->
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
                              <h2>Update Events</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">

                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Update Events</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post">
                                                   <?php
                                                   $eid = $_GET['editid'];
                                                   $sql = "SELECT * from  tblevents where ID=$eid";
                                                   $query = $dbh->prepare($sql);
                                                   $query->execute();
                                                   $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                   $cnt = ($pageno - 1) * $no_of_records_per_page + 1;

                                                   if ($query->rowCount() > 0) {
                                                      foreach ($results as $row) {               ?>
                                                         <fieldset>

                                                            <div class="field">
                                                               <label class="label_field">Event Titles</label>
                                                               <input type="text" name="title" value="<?php echo $row->EventTitle; ?>" class="form-control">
                                                            </div>


                                                            <br>
                                                            <div class="field">
                                                               <label class="label_field">Schedule</label>
                                                               <input type="datetime-local" name="schedule" value="<?php echo $row->Schedule; ?>" class="form-control">
                                                            </div>


                                                            <br>
                                                            <div class="field">
                                                               <label class="label_field">Description</label>
                                                               <textarea name="description" class="form-control"><?php echo $row->Description; ?></textarea>
                                                            </div>


                                                            <br>
                                                            <div class="field">
                                                               <label class="label_field">Banner Image</label>
                                                               <img src="images/<?php echo $row->BannerImage; ?>" width="100" height="100" value="<?php echo $row->BannerImage; ?>"><a href="changeimage.php?editid=<?php echo $row->ID; ?>"> &nbsp; Edit Image</a>
                                                            </div>


                                                            <br>
                                                      <?php $cnt = $cnt + 1;
                                                      }
                                                   } ?>

                                                      <br>
                                                      <div class="field margin_0">
                                                         <label class="label_field hidden">hidden label</label>
                                                         <button class="main_bt" type="submit" name="submit" id="submit">Update</button>
                                                      </div>
                                                         </fieldset>
                                                </form>
                                             </div>

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- funcation section -->

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