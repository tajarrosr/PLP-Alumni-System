<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['alumniid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

 
 $eid=$_GET['editid'];
 $pic=$_FILES["pic"]["name"];
$extension = substr($pic,strlen($pic)-4,strlen($pic));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");

if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$pic=md5($pic).time().$extension;
 move_uploaded_file($_FILES["pic"]["tmp_name"],"images/".$pic);
$sql="update tblalumni set Image=:pic where ID=:eid";
$query=$dbh->prepare($sql);

$query->bindParam(':pic',$pic,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Profile pic has been updated")</script>';
}
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>College Alumni System || Profile pic Image</title>
    
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
                              <h2>Update Profile pic</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Update Profile pic</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post" enctype="multipart/form-data">
                                                   <?php
$eid=$_GET['editid'];
$sql="SELECT tblalumni.Image,tblalumni.FullName from tblalumni where tblalumni.ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Fullname</label>
                              <input type="text" name="" value="<?php echo htmlentities($row->FullName);?>" class="form-control" readonly="true">
                           </div>
                         <br>
                           <div class="field">
                              <label class="label_field">Old Profile Pic</label>
                              <img src="images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>">
                           </div>

                           <br>
                           <div class="field">
                              <label class="label_field">New Profile Pic</label>
                              <input type="file" name="pic" value="" class="form-control" required='true'>
                           </div>

                           <br>
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