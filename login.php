<html>
	<?php 
	include "connect.php";
    session_start();
	if(isset($_POST['sub'])){
		$name=$_POST['Name'];      
		$pass=$_POST['password'];
        $qry= "select * from `rec` where `name`='$name' and `password`='$pass'; ";
        echo $qry;
		$res=mysqli_query($conn,$qry);
        if(mysqli_num_rows($res)>0)  {
            $m = "Success";
             header("Location: recipe.php"); 
        } else {
            $m= "Invalid user";
             //header("Location: login.php"); 
        }
	}
?>
    <head >
            <title>Login</title>
            <link rel="stylesheet" href="suggest.css">
    </head>
    <body>
        <header>
                <div id="img1">
                    <img src="logo.png">
                </div> 
                <p id="img2">
                    <a href="home">Home</a>
                    <a href="recipe">Recipes</a>
                    <a href="suggest">suggest</a>
                </p>
        </header>
        <main>
                <h2><b>login</b></h2>
                <h3><?php if(isset($m)) {echo $m;}?></h3>
                <form action="" method="post">
                    Name<br>
                    <input type="text" name="Name">
                    <br>
                    Password
                    <br>
                    <input type="password" name="password">
                    <br><br>
                 <input type="submit" name="sub" value="Click to Submit" class="bold">
                </form>
        </main>
        <div class="c1">
                            <p>&copy; 2014-RECIPE WORLD</p>
        </div>
    </body>
</html>  
  
