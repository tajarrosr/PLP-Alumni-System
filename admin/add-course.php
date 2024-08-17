<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid'] == 0)) {
   header('location:logout.php');
} else {
   if (isset($_POST['submit'])) {

      $coursename = $_POST['coursename'];
      $sql = "insert into tblcourse(CourseName)values(:coursename)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':coursename', $coursename, PDO::PARAM_STR);

      $query->execute();

      $LastInsertId = $dbh->lastInsertId();
      if ($LastInsertId > 0) {
         echo '<script>alert("Course has been added.")</script>';
         echo "<script>window.location.href ='add-course.php'</script>";
      } else {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
      }
   }

?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <title>Add Course</title>

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
                              <h2>Add Course</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">

                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Add Course</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post">
                                                   <fieldset>

                                                      <div class="field">
                                                         <label class="label_field">Course Name</label>
                                                         <input type="text" name="coursename" value="" class="form-control" required='true'>
                                                      </div>


                                                      <br>
                                                      <div class="field margin_0">
                                                         <label class="label_field hidden">hidden label</label>
                                                         <button class="main_bt" type="submit" name="submit" id="submit">Add</button>
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