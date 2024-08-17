 <nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             <a href="#"><img class="logo_icon img-responsive" src="images/pic.png" alt="#" /></a>
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <?php
               $aid = $_SESSION['alumniid'];
               $sql = "SELECT FullName,Image,Emailid from  tblalumni where ID=:aid";
               $query = $dbh->prepare($sql);
               $query->bindParam(':aid', $aid, PDO::PARAM_STR);
               $query->execute();
               $results = $query->fetchAll(PDO::FETCH_OBJ);
               $cnt = 1;
               if ($query->rowCount() > 0) {
                  foreach ($results as $row) {               ?>
                   <div class="user_img"><img class="img-responsive" src="images/<?php echo $row->Image; ?>" alt="#" /></div>
                   <div class="user_info">

                      <h6><?php echo $row->FullName; ?></h6>
                      <p><span class="online_animation"></span> <?php echo $row->Emailid; ?></p><?php $cnt = $cnt + 1;
                                                                                             }
                                                                                          } ?>
                   </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       <h4>General</h4>
       <ul class="list-unstyled components">

          <li><a href="dashboard.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>

          <li class="active">
             <a href="#dashboard2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clock-o orange_color"></i> <span>Post Job</span></a>
             <ul class="collapse list-unstyled" id="dashboard2">
                <li>
                   <a href="add-job.php">> <span>Add</span></a>
                </li>
                <li>
                   <a href="manage-job.php">> <span>Manage</span></a>
                </li>
             </ul>
          </li>


          <li><a href="view-events.php"><i class="fa fa-users purple_color"></i> <span>View Events</span></a></li>

          <li><a href="status-jobpost.php"><i class="fa fa-users purple_color"></i> <span>Status of Job Post</span></a></li>


       </ul>
    </div>
 </nav>