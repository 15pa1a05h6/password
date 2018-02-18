<?php
    if(isset($_POST['sub'])){
        echo "hello ".$_POST['Name']."<br/>";
        echo $email=$_POST['Email']."<br/>";
		echo $pass=$_POST['password']."<br/>";
        echo $phno=$_POST['phoneno']."<br/>";
    }
?>
<!doctype html>
<html>
    <form name="greeter" action="" method="post">
    Name
    <br>
    <input type="text" name="Name">
    <br><br>
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
    <input type="submit" name="sub" value="Click to Submit">
    </form>
</html>