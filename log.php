<html>
	<?php 
	include "connect1.php";
    session_start();
	if(isset($_POST['sub'])){
		$name=$_POST['Email'];      
		$pass=$_POST['password'];
        $qry= "select * from `login` where `email`='$name' and `password`='$pass'; ";
		$res=mysqli_query($conn,$qry);
        if(mysqli_num_rows($res)>0)  {
            $m = "Success";
             header("Location: websites.php"); 
        } else {

           // $m= "Invalid user";
            $warning= "usename name and password incorrect";
            echo "<script type='text/javascript'>alert('$warning');</script>";
             header("Location: log.php"); 
        }
	}
?>
    <head >
            <title>Login</title>
            <link rel="stylesheet" type="text/css" href="project.css">  

    </head>
    <body background="project5.jpg">
        <main>
                <h2 align="center"> <a href='signup.php'>Signup</a> / <a href='log.php'>login</a>   </h2>
                <form action="" method="post">
                    <div class="container">
                    <b>Email</b><br>
                    <input type="text" name="Email">
                    <br><br>
                    <b>Password</b>
                    <br>
                    <input type="password" name="password">
                    <br><br>
                 <input type="submit"  class="button" name="sub" value="Login" class="bold">
                </form>
        </main>
    </body>
</html>  
  
