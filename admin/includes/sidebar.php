 <nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             <a href="#"><img class="logo_icon img-responsive" src="images/user_img.jpg" alt="#" /></a>
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <div class="user_img"><img class="img-responsive" src="images/user_img.jpg" alt="#" /></div>
             <div class="user_info">
                <?php
                  $aid = $_SESSION['casaid'];
                  $sql = "SELECT AdminName,Email from  tbladmin where ID=:aid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                     foreach ($results as $row) {               ?>
                      <h6><?php echo $row->AdminName; ?></h6>
                      <p><span class="online_animation"></span> <?php echo $row->Email; ?></p><?php $cnt = $cnt + 1;
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
             <a href="#dashboard2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clock-o orange_color"></i> <span>Course</span></a>
             <ul class="collapse list-unstyled" id="dashboard2">
                <li>
                   <a href="add-course.php">> <span>Add</span></a>
                </li>
                <li>
                   <a href="manage-course.php">> <span>Manage</span></a>
                </li>
             </ul>
          </li>

          <li>
             <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o purple_color"></i> <span>Events</span></a>
             <ul class="collapse list-unstyled" id="element">
                <li><a href="add-events.php">> <span>Add Events</span></a></li>
                <li><a href="manage-events.php">> <span>Manage Events</span></a></li>

             </ul>
          </li>
          <li><a href="alumni-list.php"><i class="fa fa-users yellow_color"></i> <span>Alumni List</span></a></li>
          <li>
             <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o blue2_color"></i> <span>Job Posts</span></a>
             <ul class="collapse list-unstyled" id="apps">
                <li><a href="new-job-post.php">> <span>New Job Post</span></a></li>
                <li><a href="approved-job-post.php">> <span>Approved Job</span></a></li>
                <li><a href="cancel-job-post.php">> <span>Unapproved Job</span></a></li>
                <li><a href="all-job-post.php">> <span>All Job Post</span></a></li>
             </ul>
          </li>

          <li class="active">
             <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span> Pages</span></a>
             <ul class="collapse list-unstyled" id="additional_page">
                <li>
                   <a href="aboutus.php">> <span>About Us</span></a>
                </li>
                <li>
                   <a href="contactus.php">> <span>Contact Us</span></a>
                </li>

             </ul>
          </li>
          <li class="active">
             <a href="#additional_page1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o yellow_color"></i> <span> Report</span></a>
             <ul class="collapse list-unstyled" id="additional_page1">
                <li>
                   <a href="betweendates-jobpost.php">> <span>Job Post</span></a>
                </li>
                <li>
                   <a href="betweendates-alumni.php">> <span>Alumni Registration</span></a>
                </li>

             </ul>
          </li>

       </ul>
    </div>
 </nav>