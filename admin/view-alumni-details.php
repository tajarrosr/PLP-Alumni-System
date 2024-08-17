<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid']==0)) {
  header('location:logout.php');
  } else{


  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>College Alumni System || View Alumni Details</title>
   
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!-- fancy box js -->
      <link rel="stylesheet" href="css/jquery.fancybox.css" />
      
   </head>
   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
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
                              <h2>View Alumni Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>View Alumni Details</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    
                                    <?php
                  $alumniid=$_GET['alumniid'];

$sql="SELECT tblcourse.CourseName,tblalumni.* from tblalumni join tblcourse on tblcourse.ID=tblalumni.CourseGraduated  where tblalumni.ID=:alumniid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':alumniid', $alumniid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  
$assignto=$row->AssignTo;
             ?> 
                                   <table class="table table-bordered">
                                    <tr>
    <th colspan="6" style="color: orange;font-weight: bold;font-size: 20px;text-align: center;">Alumni <?php  echo htmlentities($row->FullName);?> Details </th>
  </tr>
  <tr>
    <th>Fullname</th>
    <td><?php  echo $row->FullName;?></td>
     <th>Gender</th>
    <td><?php  echo $row->Gender;?></td>
  </tr>
  <tr>
    <th>Batch</th>
    <td><?php  echo $row->Batch;?></td>
     <th>Course Graduated</th>
    <td><?php  echo $row->CourseName;?></td>
  </tr>
  <tr>
    <th>Working Organization</th>
    <td><?php  echo $row->CurrentlyConnected;?></td>
    <th>Email</th>
    <td><?php  echo $row->Emailid;?></td>
     
  </tr>
  <tr>
    
     <th>Profile Pic</th>
    <td colspan="8"><img src="../alumni/images/<?php echo $row->Image;?>" width="100" height="100"></td>
  </tr>

  

  <?php $cnt=$cnt+1;}} ?>
</table>






                        </div>
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
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- fancy box js -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>

<script type="text/javascript">

  //For report file
  $('#assigntoo').hide();
  $(document).ready(function(){
  $('#status').change(function(){
  if($('#status').val()=='Approved')
  {
  $('#assigntoo').show();
  jQuery("#assignee").prop('required',true);  
  }
  else{
  $('#assigntoo').hide();
    jQuery("#assignee").prop('required',false);  
  }
})}) 
</script>



   </body>
</html><?php } ?>