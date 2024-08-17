<?php
session_start();
error_reporting(0);
include('../admin/includes/dbconnection.php');

if (isset($_POST['login'])) {
   $emailid = $_POST['emailid'];
   $password = md5($_POST['password']);
   $sql = "SELECT ID FROM tblalumni WHERE Emailid=:emailid and Password=:password";
   $query = $dbh->prepare($sql);
   $query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
   $query->bindParam(':password', $password, PDO::PARAM_STR);
   $query->execute();
   $results = $query->fetchAll(PDO::FETCH_OBJ);
   if ($query->rowCount() > 0) {
      foreach ($results as $result) {
         $_SESSION['alumniid'] = $result->ID;
      }

      if (!empty($_POST["remember"])) {
         //COOKIES for emailid
         setcookie("user_login", $_POST["emailid"], time() + (10 * 365 * 24 * 60 * 60));
         //COOKIES for password
         setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
      } else {
         if (isset($_COOKIE["user_login"])) {
            setcookie("user_login", "");
            if (isset($_COOKIE["userpassword"])) {
               setcookie("userpassword", "");
            }
         }
      }
      $_SESSION['login'] = $_POST['emailid'];
      echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
   } else {
      echo "<script>alert('Invalid Details');</script>";
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

   <title>PLP Alumni Login</title>

   <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
   <link rel="stylesheet" href="../admin/style.css" />

</head>

<body class="inner_page login">
   <div class="full_container">
      <div class="container">
         <div class="center verticle_center full_height">
            <div class="login_section">
               <div class="logo_login">
                  <div class="center">
                     <img src="../public/images/plp_logo.png" alt="PLP Alumni Logo" style="width: 70px; height: 70px; margin-right: 10px;">
                     <h3 style="color: white; margin-top: 20px;">PLP Alumni</h3>
                  </div>
               </div>
               <h3 style="color:black;font-weight: bold;padding-top: 20px;text-align: center;">Welcome Alumni 😀</h3>
               <div class="login_form">
                  <form method="post" name="login">
                     <fieldset>
                        <div class="field">
                           <label class="label_field">PLP Email</label>
                           <input type="text" class="form-control" placeholder="Enter Your PLP Email Address" required="true" name="emailid" value="<?php if (isset($_COOKIE["user_login"])) {
                                                                                                                                                         echo $_COOKIE["user_login"];
                                                                                                                                                      } ?>">
                        </div>
                        <div class="field">
                           <label class="label_field">Password</label>
                           <input type="password" class="form-control" placeholder="Enter Your Password" name="password" required="true" value="<?php if (isset($_COOKIE["userpassword"])) {
                                                                                                                                                   echo $_COOKIE["userpassword"];
                                                                                                                                                } ?>">
                        </div>
                        <div class="field">
                           <label class="label_field hidden">hidden label</label>
                           <label class="form-check-label"><input class="form-check-input" id="remember" name="remember" <?php if (isset($_COOKIE["user_login"])) { ?> checked <?php } ?> type="checkbox" /> Remember Me</label>
                           <a class="forgot" href="forgot-password.php">Forgot Password?</a>
                        </div>
                        <div class="field margin_0">
                           <label class="label_field hidden">hidden label</label>
                           <button class="main_bt" name="login" type="submit">Login</button>
                        </div>
                     </fieldset>
                     <a class="forgot" href="../public/home.php">Home Page</a>

                  </form>
                  <a class="forgot" href="registration.php">Registration Page</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>