   <footer class="footer">
      <div class="footer_background" style="background-image:url(images/plp_footer.jpg)"></div>
      <div class="container">
         <div class="row footer_row">
            <div class="col">
               <div class="footer_content">
                  <div class="row">

                     <div class="col-lg-4 footer_col">
                        <!-- Footer About -->
                        <div class="footer_section footer_about">
                           <div class="footer_logo_container">
                              <a href="#">
                                 <div class="footer_logo_text">PLP <span>Alumni</span></div>
                              </a>
                           </div>
                           <div class="footer_about_text">
                              <p>Academic Excellence, Cultural Identity, Peace Education, Sustainable Development, Social Equity and Responsibility, and Global Competitiveness.</p>
                           </div>
                           <div class="footer_social">
                              <ul>
                                 <li><a href="https://www.facebook.com/pamantasannglungsodngpasig"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                 <li><a href="https://www.youtube.com/channel/UC84F36p58oR6r4eDfUUj1zQ"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                 <li><a href="https://www.linkedin.com/company/plp-pamantasan-ng-lungsod-ng-pasig"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                 <li><a href="https://twitter.com/psscofficial"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                              </ul>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-4 footer_col">
                        <!-- Footer Contact -->
                        <div class="footer_section footer_contact">
                           <div class="footer_title">CONTACT US :</div>
                           <div class="footer_contact_info">
                              <ul>
                                 <?php
                                 $sql = "SELECT * from tblpage where PageType='contactus'";
                                 $query = $dbh->prepare($sql);
                                 $query->execute();
                                 $results = $query->fetchAll(PDO::FETCH_OBJ);

                                 $cnt = 1;
                                 if ($query->rowCount() > 0) {
                                    foreach ($results as $row) {               ?>
                                       <li><b>Email:&nbsp;</b><?php echo htmlentities($row->Email); ?></li>
                                       <li><b>Phone:&nbsp;</b> 0<?php echo htmlentities($row->MobileNumber); ?></li>
                                       <li><b>Address:&nbsp;</b><?php echo htmlentities($row->PageDescription); ?></li><?php $cnt = $cnt + 1;
                                                                                                                     }
                                                                                                                  } ?>
                              </ul>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-4 footer_col">
                        <!-- Footer links -->
                        <div class="footer_section footer_links">
                           <div class="footer_title">QUICK LINKS :</div>
                           <div class="footer_links_container">
                              <ul>
                                 <li><a href="home.php">Home</a></li>
                                 <li><a href="about.php">About</a></li>

                                 <li><a href="contact.php">Contact</a></li>
                                 <li><a href="../alumni/login.php">Alumni</a></li>
                                 <li><a href="../admin/login.php">Admin</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>

                     <!-- Footer copyright -->
                     <div class="row copyright_row">
                        <div class="col">
                           <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
                              <div class="cr_text">
                                 Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                 </script> Pamantasan ng Lungsod ng Pasig </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>