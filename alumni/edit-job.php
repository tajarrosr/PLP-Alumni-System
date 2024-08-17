<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['alumniid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $editid=$_GET['editid'];
 $jobtitle=$_POST['jobtitle'];
 $companyname=$_POST['companyname'];
 $location=$_POST['location'];
 $vacancy=$_POST['vacancy'];
 $designation=$_POST['designation'];
 $description=$_POST['description'];
 $contactperson=$_POST['contactperson'];
 $contactnumber=$_POST['contactnumber'];
 $lastdate=$_POST['lastdate'];

  $sql="update tbljobpost set JobTitle=:jobtitle,CompanyName=:companyname,Location=:location,Vacancy=:vacancy,Designation=:designation,JobDescription=:description,ContactPerson=:contactperson,ContactNumber=:contactnumber,LastDate=:lastdate where ID=:editid";
     $query = $dbh->prepare($sql);
$query->bindParam(':jobtitle',$jobtitle,PDO::PARAM_STR);
$query->bindParam(':companyname',$companyname,PDO::PARAM_STR);
$query->bindParam(':location',$location,PDO::PARAM_STR);
$query->bindParam(':vacancy',$vacancy,PDO::PARAM_STR);
$query->bindParam(':designation',$designation,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':contactperson',$contactperson,PDO::PARAM_STR);
$query->bindParam(':contactnumber',$contactnumber,PDO::PARAM_STR);
$query->bindParam(':lastdate',$lastdate,PDO::PARAM_STR);
$query->bindParam(':editid',$editid,PDO::PARAM_STR);
$query->execute();
if($query -> rowCount() > 0)
   {
    echo '<script>alert("Job details has been updated")</script>';
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
      <title>College Alumni System || Profile</title>
    
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
                              <h2>View Profile Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>View Profile Details</h2>
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
                            <?php
                            $editid=$_GET['editid'];

$sql="SELECT * from  tbljobpost  where ID=:editid";
$query = $dbh -> prepare($sql);
$query->bindParam(':editid',$editid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <div class="field">
                              <label class="label_field">Job Title</label>
                              <input type="text" name="jobtitle" value="<?php  echo $row->JobTitle;?>" class="form-control" required='true'>
                           </div>
                           <br>
                          <div class="field">
                              <label class="label_field">Name of Company</label>
                              <input type="text" name="companyname" value="<?php  echo $row->CompanyName;?>" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Location</label>
                              <input type="text" name="location" value="<?php  echo $row->Location;?>" class="form-control" required='true'>
                           </div>
                          

                           <br>
                         <div class="field">
                              <label class="label_field">Vacancy</label>
                              <input type="text" name="vacancy" value="<?php  echo $row->Vacancy;?>" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Designation</label>
                              <input type="text" name="designation" value="<?php  echo $row->Designation;?>" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           
                           <div class="field">
                              <label class="label_field">Description</label>
                              <textarea name="description" value="" class="form-control" required='true'><?php  echo $row->JobDescription;?></textarea>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Contact Person</label>
                              <input type="text" name="contactperson" value="<?php  echo $row->ContactPerson;?>" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Contact Number</label>
                              <input type="text" name="contactnumber" value="<?php  echo $row->ContactNumber;?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Last Date</label>
                              <input type="date" name="lastdate" value="<?php  echo $row->LastDate;?>" class="form-control" required='true'>
                           </div>
                          

                           <br>
                           <div class="field">
                              <label class="label_field">Post Date</label>
                              <input type="text" name="" value="<?php  echo $row->PostingDate;?>" readonly="" class="form-control">
                           </div>
                           <?php $cnt=$cnt+1;}} ?>

                           <br>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt" type="submit" name="submit" id="submit">Update</button>
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