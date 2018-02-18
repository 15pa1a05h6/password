<?php 
include "connect1.php";
session_start();

if(isset($_POST['sub'])) {
       // $name=$_POST['name'];
        $email=$_POST['Email'];
        $pass=$_POST['Password'];
        $repass=$POST['Retype Password'];
         $qry="select `email` from `web` where `email`='$email';";
        $res=mysqli_query($conn,$qry);
        if($result=mysqli_fetch_array($res))  {
            $m = "Success";
            $warning= "you have already registered!";
        }
       else{
        $qry = "INSERT INTO `login` (  `Email`, `password`) VALUES ('$email', '$pass');";
       // $res=mysqli_query($conn,$qry);
         mysqli_query($conn,$qry) or die(header('location:signup.php' ));
         
        header('location:websites.php');
       }
    }
    function is_valid_passwords($Pass,$Repass) 
    {
        console.log("pass");//+$pass+"repass"+$repass;
     // Your validation code.
     if (empty($pass)) {
         echo "Password is required.";
         return false;
     } 
     else if ($pass != $repass) {
         // error matching passwords
         echo 'Your passwords do not match. Please type carefully.';
         return false;
     }
     // passwords match
     return true;
}
?>
<!DOCTYPE html>
<html>
    <head>
         <title>Signup</title>
       <link rel="stylesheet" type="text/css" href="project.css">  
       <!---<script src="project.js"></script>-->
    </head>

    <body>
                <div class="hello">
                <h2 align="center"> <a href='signup.php'>Signup</a> / <a href='log.php'>login</a></h2> </div>
                <h2><?php if(isset($warning)) echo $warning;?></h2>
                <form class="form" method="post" action="">
                <b>Name</b><br>
                <input type="text" name="Name"><br>
                <b>Email</b><br>
                <input type="text" name="Email" required><br>
                <b>Password</b></br>
                <input type="password" name="Password" required><br>
                <b>Retype Password</b><br>
                 <input type="password" name="Repass"><br><br>
                   <input class="button"  type="submit"  name="sub" value="Signup">
            </form>
    </body>  
</html>