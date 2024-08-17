<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['casaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {


$vid=$_GET['vid'];
    
    $status=$_POST['status'];
   $remark=$_POST['remark'];
$sql= "update tbljobpost set Status=:status,Remark=:remark where ID=:vid";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Remark has been updated")</script>';
 echo "<script>window.location.href ='all-job-post.php'</script>";
}

  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>College Alumni System || View Job Details</title>
   
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
                              <h2>View Job Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>View Job Details</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    
                                    <?php
                  $vid=$_GET['vid'];

$sql="SELECT tbljobpost.ID,tbljobpost.AlumniID,tbljobpost.JobTitle,tbljobpost.CompanyName,tbljobpost.Location,tbljobpost.Vacancy,tbljobpost.Designation,tbljobpost.JobDescription,tbljobpost.ContactPerson,tbljobpost.ContactNumber,tbljobpost.LastDate,tbljobpost.PostingDate,tbljobpost.Remark,tbljobpost.Status,tblalumni.ID,tblalumni.FullName,tblalumni.CollegeID,tblalumni.Gender,tblalumni.Batch,tblalumni.CourseGraduated,tblalumni.CurrentlyConnected,tblalumni.Image,tblalumni.Emailid,tblalumni.RegDate,tblcourse.ID,tblcourse.CourseName from tbljobpost join tblalumni on tbljobpost.AlumniID=tblalumni.ID join tblcourse on tblalumni.CourseGraduated=tblcourse.ID  where tbljobpost.ID=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  

             ?> 
                                   <table class="table table-bordered">
                                    <tr>
    <th colspan="6" style="color: orange;font-weight: bold;font-size: 20px;text-align: center;">Job Details Posted by (<?php  echo $row->FullName;?>) </th>
  </tr>
  <tr>
    <th>Job Title</th>
    <td><?php  echo $row->JobTitle;?></td>
     <th>Company Name</th>
    <td><?php  echo $row->CompanyName;?></td>
  </tr>
  <tr>
    <th>Location</th>
    <td><?php  echo $row->Location;?></td>
     <th>Vacancy</th>
    <td><?php  echo $row->Vacancy;?></td>
  </tr>
  <tr>
    <th>Designation</th>
    <td><?php  echo $row->Designation;?></td>
     <th>Job Description</th>
    <td><?php  echo $row->JobDescription;?></td>
  </tr>
  <tr>
    <th>Contact Person</th>
    <td><?php  echo $row->ContactPerson;?></td>
     <th>Contact Number</th>
    <td><?php  echo $row->ContactNumber;?></td>
  </tr>
<tr>
    <th>Last Date</th>
    <td><?php  echo $row->LastDate;?></td>
     <th>Posting Date</th>
    <td><?php  echo $row->PostingDate;?></td>
  </tr>
 
  <tr>
   
    <th>Status</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approved")
{
  echo "Your job post has been approved";
}

if($row->Status=="Cancelled")
{
 echo "Your job post has been cancelled";
}


if($row->Status=="")
{
  echo "Not Response Yet";
}


     ;?></td>
     <th >Admin Remark</th>
    <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>

<?php } else { ?>                 
 <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>

  </tr> 

  
</table>



    <table class="table table-bordered">

    <tr>
        <th colspan="4" style="color:blue; font-size:20px;">Alumni Details</th>
    </tr>
<tr>
    <th>Full Name</th>
    <td><?php echo $row->FullName;?></td>
    <th>College ID</th>
    <td><?php echo $row->CollegeID;?></td>
</tr>

<tr>
    <th>Gender</th>
    <td><?php echo $row->Gender;?></td>
    <th>Batch</th>
    <td><?php echo $row->Batch;?></td>
</tr>

<tr>
    <th>Course Graduated</th>
    <td><?php echo $row->CourseName;?></td>
    <th>Working Organization</th>
    <td><?php echo $row->CurrentlyConnected;?></td>
</tr>


<tr>
    <th>Email</th>
    <td><?php echo $row->Emailid;?></td>
    <th>Photo</th>
    <td><img src="../alumni/images/<?php echo $row->Image;?>" width="100" height="100"></td>
</tr>
    </table>

 
<?php $cnt=$cnt+1;}} ?>



<?php 

if ($status==""){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button></p>  

<?php } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                <form method="post" name="submit">

                                
                               
     <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="8" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr> 

 
  <tr>
    <th>Status :</th>
    <td>

   <select name="status" id="status" class="form-control wd-450" required="true" >
    <option value="">Select</option>
     <option value="Approved">Approved</option>
     <option value="Cancelled">Cancelled</option>
   </select></td>
  </tr>




</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>
  
  </form>


</div> 
                                 </div>
                              </div>
                           </div>
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