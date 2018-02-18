<?php 
	include "connect1.php";
    session_start();
	if(isset($_POST['sub'])){
		$name=$_POST['Name']; 
        $email=$_POST['Email'];   
        $qry="select `w`.`password` from `web` `w` 
                where `website`='$name' and `w`.`email` IN (select `email` from `login` where `email`='$email');";
        $res=mysqli_query($conn,$qry);
        if($result=mysqli_fetch_array($res))  {
            echo "Your password is:";
            $m = "Success";
            echo $result[0];
             //header("Location: websites.php"); 
        } else {
            $m= "Invalid user";
             //header("Location: login.php"); 
        }
	}
?>
 <body>
        <main>
                <h2><b>Websites</b></h2>
                <form action="" method="post">
                     Email<br>
                    <input type="text" name="Email">
                    <br>
                    Name<br>
                    <input type="text" name="Name">
                 <br><br>
                  <a href="upload.php">upload</a>
                 <input type="submit" name="sub" value="Click to See Your password" class="bold">
                </form>
        </main>
    </body>