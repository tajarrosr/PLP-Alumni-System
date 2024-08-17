<header class="header">
    <!-- TOP BAR -->
    <div class="top_bar">
        <div class="top_bar_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            <ul class="top_bar_contact_list">
                                <!-- Need Help? -->
                                <li>
                                    <div class="question">Need Help?</div>
                                </li>
                                <!-- Contact Information -->
                                <?php
                                $sql = "SELECT * from tblpage where PageType='contactus'";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $row) { ?>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <div><?php echo htmlentities($row->MobileNumber); ?></div>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <div><?php echo htmlentities($row->Email); ?></div>
                                        </li>
                                <?php $cnt = $cnt + 1;
                                    }
                                } ?>
                            </ul>
                            <div class="top_bar_register ml-auto">
                                <!-- Alumni Registration Link -->
                                <div class="register_button"><a href="../alumni/registration.php">Alumni Registration</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER NAVIGATION -->
    <div class="header_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo_container">
                            <!-- Logo -->
                            <a href="home.php">
                                <img src="images\plp_logo.png" alt="Logo" width="60px" height="60px" style="margin-left: -60px;">
                                <div class="logo_text">PLP <span>Alumni</span></div>
                            </a>
                        </div>
                        <nav class="main_nav_contaner ml-auto">
                            <ul class="main_nav">
                                <!-- Navigation Links -->
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'home.php') ? 'class="active"' : ''; ?>><a href="home.php">Home</a></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'about.php') ? 'class="active"' : ''; ?>><a href="about.php">About</a></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'contact.php') ? 'class="active"' : ''; ?>><a href="contact.php">Contact</a></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'events.php') ? 'class="active"' : ''; ?>><a href="events.php">Events</a></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'job-lists.php') ? 'class="active"' : ''; ?>><a href="job-lists.php">Posted Jobs</a></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == '.../alumni/login.php') ? 'class="active"' : ''; ?>><a href="../alumni/login.php">Alumni</a></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == '../admin/login.php') ? 'class="active"' : ''; ?>><a href="../admin/login.php">Admin</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>