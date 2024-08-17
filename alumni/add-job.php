<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['alumniid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
$alumniid=$_SESSION['alumniid'];
 $jobtitle=$_POST['jobtitle'];
 $companyname=$_POST['companyname'];
 $location=$_POST['location'];
 $vacancy=$_POST['vacancy'];
 $designation=$_POST['designation'];
 $description=$_POST['description'];
 $contactperson=$_POST['contactperson'];
 $contactnumber=$_POST['contactnumber'];
 $lastdate=$_POST['lastdate'];
 
$sql="insert into tbljobpost(AlumniID,JobTitle,CompanyName,Location,Vacancy,Designation,JobDescription,ContactPerson,ContactNumber,LastDate)values(:alumniid,:jobtitle,:companyname,:location,:vacancy,:designation,:description,:contactperson,:contactnumber,:lastdate)";
$query=$dbh->prepare($sql);
$query->bindParam(':alumniid',$alumniid,PDO::PARAM_STR);
$query->bindParam(':jobtitle',$jobtitle,PDO::PARAM_STR);
$query->bindParam(':companyname',$companyname,PDO::PARAM_STR);
$query->bindParam(':location',$location,PDO::PARAM_STR);
$query->bindParam(':vacancy',$vacancy,PDO::PARAM_STR);
$query->bindParam(':designation',$designation,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':contactperson',$contactperson,PDO::PARAM_STR);
$query->bindParam(':contactnumber',$contactnumber,PDO::PARAM_STR);
$query->bindParam(':lastdate',$lastdate,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Jobs has been added.")</script>';
echo "<script>window.location.href ='manage-job.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>College Alumni System || Add Jobs</title>
    
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
     
   </head>
   <body class="inner_page general_elements">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
           <?php include_once('includes/sidebar.php');?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <?php include_once('includes/header.php');?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Add Jobs</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Add Jobs</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post" enctype="multipart/form-data">
                        <fieldset>
                            
                           
                           <div class="field">
                              <label class="label_field">Job Title</label>
                              <input type="text" name="jobtitle" value="" class="form-control" required='true'>
                           </div>
                           <br>
                          <div class="field">
                              <label class="label_field">Name of Company</label>
                              <input type="text" name="companyname" value="" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Location</label>
                              <input type="text" name="location" value="" class="form-control" required='true'>
                           </div>
                          

                           <br>
                         <div class="field">
                              <label class="label_field">Vacancy</label>
                              <input type="text" name="vacancy" value="" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Designation</label>
                              <input type="text" name="designation" value="" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           
                           <div class="field">
                              <label class="label_field">Description</label>
                              <textarea name="description" value="" class="form-control" required='true' rows="6"></textarea>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Contact Person</label>
                              <input type="text" name="contactperson" value="" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Contact Number</label>
                              <input type="text" name="contactnumber" value="" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Last Date</label>
                              <input type="date" name="lastdate" value="" class="form-control" required='true'>
                           </div>
                          

                           <br>

                         
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt" type="submit" name="submit" id="submit">Add</button>
                           </div>
                        </fieldset>
                     </form></div>
                                            
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
                 <?php include_once('includes/footer.php');?>
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
      <!-- custom js -->
      <script src="../admin/js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="../admin/js/semantic.min.js"></script>
   </body>
</html><?php } ?>