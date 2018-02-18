<?php 
	include "connect1.php";
    session_start();
	if(isset($_POST['sub'])){
		$website=$_POST['Website']; 
        $email=$_POST['Email'];   
        $qry="select `w`.`password` from `web` `w` 
                where `website`='$website' and `w`.`email` IN (select `email` from `login` where `email`='$email');";
        $res=mysqli_query($conn,$qry);
        if($result=mysqli_fetch_array($res))  {
            echo "Your password is:";
            $m = "Success";
            echo $result[0];
        } else {
            $m= "Invalid user";
            header("Location: upload.php");
             //header("Location: login.php"); 
        }
	}
?>
<html>
     <head>
          <title>Website</title>
       <link rel="stylesheet" type="text/css" href="project.css">  
    </head>
 <body>
     <h1>You're logged  in :-)</h1>
        <main>
                <h2 align="center"><b>Websites</b></h2>
                <form action="" method="post">
                     <b>Email</b><br>
                    <input type="text" name="Email">
                    <br>
                    <b>Website</b><br>
                    <input type="text" name="Website">
                 <br><br>
                 <input type="submit"  class="button" name="sub" value="Click to See Your password" class="bold"><br><br>         
                 <h2><a href="upload.php">upload</a></h2>      
                </form>
        </main>
    </body>
</html>