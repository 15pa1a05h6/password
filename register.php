<html>
	<?php 
	include "connect.php";
	if(isset($_POST['sub'])){
		$name=$_POST['Name'];
		$email=$_POST['Email'];
		$pass=$_POST['password'];
        $phno=$_POST['phoneno'];
		echo $qry= "INSERT INTO `rec` (`name`,`email`,`password`,`phoneno`) VALUES ('$name','$email','$password','$phno');";
		mysqli_query($conn,$qry);
	}
?>
    <head >
            <title>Register</title>
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
                <h2><b>Register</b></h2>
                <form action="" method="post">
                    Name<br>
                    <input type="text" name="Name">
                    <br>
                    Email<br>
                    <input type="text" name="Email">
                    <br><br>
                    Password
                    <br>
                    <input type="password" name="password">
                    <br><br>
                    phoneno
                    <br>
                    <input type="text" name="phoneno" >
                    <br><br>
                 <input type="submit" name="sub" value="Click to Submit" class="bold">
                </form>
        </main>
        <div class="c1">
                            <p>&copy; 2014-RECIPE WORLD</p>
        </div>
    </body>
</html>  
  
