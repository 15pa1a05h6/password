
<?php 
include "connect1.php";
session_start();

if(isset($_POST['sub'])) {
   $website=$_POST['Website'];
        $email=$_POST['Email'];
        $password=$_POST['Password'];
        $qry="select `email`,`website` from `web` where `email`='$email' and `website`='$website';";
        $res=mysqli_query($conn,$qry);
        if($result=mysqli_fetch_array($res))  {
            $m = "Success";
            echo "already exists";
        }
        else {
          $qry = "INSERT INTO `web` ( `website`, `password`, `email`) VALUES ('$website', '$password','$email' );";
          mysqli_query($conn,$qry) or die("its already exists: " ) ;
}
}
?>
<!DOCTYPE html>
<html>
    <head>
            <title>Upload</title>
               <link rel="stylesheet" type="text/css" href="project.css">  
    </head>   
    <body>
        <div class="content">
            <div class="disp">
                <h2 align="center"><b>upload</br></h2>
                <h4> <?php if(isset($warning)) echo $warning; ?></h4>
                <!--NOTE: enctype is necessary for upload and you cant use GET, only POST-->
                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <b>Email</b><br>
                    <input type="text" name="Email">
                    <br><br>
                    <b>Name</b><br>
                    <input type="text" name="Website">
                 <br><br>
                  <b> Password</b><br>
                   <input type="password" name="Password"><br>
                <input type="submit" name="sub" value="Click to Submit">
            </form>
            </div>
        </div>
    </body>  
</html>