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
    $fname=$_POST['fullname'];
$gender=$_POST['gender'];
$batch=$_POST['batch'];
$coursegrad=$_POST['coursegrad'];
$currentlyconnectedto=$_POST['currentlyconnectedto'];

  $sql="update tblalumni set FullName=:fname,Gender=:gender,Batch=:batch,CourseGraduated=:coursegrad,CurrentlyConnected=:currentlyconnectedto where ID=:alumniid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':batch',$batch,PDO::PARAM_STR);
$query->bindParam(':currentlyconnectedto',$currentlyconnectedto,PDO::PARAM_STR);
$query->bindParam(':coursegrad',$coursegrad,PDO::PARAM_STR);
$query->bindParam(':alumniid',$alumniid,PDO::PARAM_STR);
$query->execute();
if($query -> rowCount() > 0)
   {
    echo '<script>alert("Your profile has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";
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
                            $alumniid=$_SESSION['alumniid'];

$sql="SELECT tblcourse.ID,tblcourse.CourseName,tblalumni.* from  tblalumni join tblcourse on tblcourse.ID=tblalumni.CourseGraduated where tblalumni.ID=:alumniid";
$query = $dbh -> prepare($sql);
$query->bindParam(':alumniid',$alumniid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                           <div class="field">
                              <label class="label_field">Fullname</label>
                              <input type="text" class="form-control" value="<?php  echo $row->FullName;?>" required="true" name="fullname">
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Fullname</label>
                              <input type="text" class="form-control" value="<?php  echo $row->CollegeID;?>" readonly="true" name="collegeid">
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Gender</label>
                               <select class="form-control" required="true" name="gender">
                                 <option value="<?php  echo $row->Gender;?>"><?php  echo $row->Gender;?></option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                              </select>
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Batch</label>
                               <input type="text" class="form-control" value="<?php  echo $row->Batch;?>" required="true" name="batch">
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Graduated</label>
                               <select class="form-control" required="true" name="coursegrad">
                                 <option value="<?php  echo $row->ID;?>"><?php  echo $row->CourseName;?></option>
                                  <?php 

$sql2 = "SELECT * from   tblcourse";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
   
<option value="<?php echo htmlentities($row2->ID);?>"><?php echo htmlentities($row2->CourseName
    );?></option>
 <?php } ?>
                              </select>
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Batch</label>
                               <input type="text" class="form-control" value="<?php  echo $row->Batch;?>" required="true" name="batch">
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Pic</label>
                              <img src="images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"><a href="changeimage.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit Image</a>
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Email</label>
                              <input type="text" class="form-control" value="<?php  echo $row->Emailid;?>" readonly="true" name="emailid">
                           </div>
                           <br>
                            <div class="field">
                              <label class="label_field">Currently Conncted To</label>
                              <input type="text" class="form-control" value="<?php  echo $row->CurrentlyConnected;?>" required="true" name="currentlyconnectedto">
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Registration Date</label>
                              <input type="text" name="" value="<?php  echo $row->RegDate;?>" readonly="" class="form-control">
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