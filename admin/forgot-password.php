<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $newpassword = md5($_POST['newpassword']);
   $sql = "SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
   $query = $dbh->prepare($sql);
   $query->bindParam(':email', $email, PDO::PARAM_STR);
   $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
   $query->execute();
   $results = $query->fetchAll(PDO::FETCH_OBJ);
   if ($query->rowCount() > 0) {
      $con = "update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('Your Password succesfully changed');</script>";
   } else {
      echo "<script>alert('Email id or Mobile no is invalid');</script>";
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

   <title>Forgot Password</title>

   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <link rel="stylesheet" href="style.css" />
   <script type="text/javascript">
      function valid() {
         if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("New Password and Confirm Password Field do not match  !!");
            document.chngpwd.confirmpassword.focus();
            return false;
         }
         return true;
      }
   </script>
</head>

<body class="inner_page login">
   <div class="full_container">
      <div class="container">
         <div class="center verticle_center full_height">
            <div class="login_section">
               <div class="logo_login">
                  <div class="center">
                     <h3 style="color: white;">PLP Alumni</h3>
                  </div>
               </div>
               <h3 style="color:red;font-weight: bold;padding-top: 20px;text-align: center;">Admin Reset Password</h3>
               <div class="login_form">
                  <form method="post" name="chngpwd" onSubmit="return valid();">
                     <fieldset>
                        <div class="field">
                           <label class="label_field">Email</label>
                           <input type="email" class="form-control" placeholder="Email" required="true" name="email">
                        </div>
                        <div class="field">
                           <label class="label_field">Mobile Number</label>
                           <input type="text" class="form-control" placeholder="Mobile Number" required="true" name="mobile" maxlength="10" pattern="[0-9]+">
                        </div>
                        <div class="field">
                           <label class="label_field">New Password</label>
                           <input type="password" class="form-control" name="newpassword" placeholder="New Password" required="true">
                        </div>
                        <div class="field">
                           <label class="label_field">Confirm</label>
                           <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="true">
                        </div>
                        <div class="field margin_0">
                           <label class="label_field hidden">hidden label</label>
                           <button class="main_bt" name="submit" type="submit">RESET</button>
                        </div>
                     </fieldset>
                     <a class="forgot" href="login.php">Login</a>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>