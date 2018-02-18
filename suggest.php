<html>
	<?php echo "hii" ?>
    <head >
            <title>Suggest</title>
            <link rel="stylesheet" href="suggest.css">
    </head>
    <body>
        <header>
                <div id="img1">
                    <img src="logo.png">
                </div> 
                <p id="img2">
                    <a href="home.html">Home</a>
                    <a href="recipe.html">Recipes</a>
                    <a href="suggest.html">suggest</a>
                    <a class="e" href='login.php'>logout</a>
                </p>
        </header>
        <main>
                <h2><b>Suggest</b></h2>
                <form action="/action_page.php" method="get">
                    Recipe Name<br>
                    <input type="text" name="Recipe Name" class="box">
                    <br><br>
                    Ingredients<br>
                    <textarea rows="10" cols="30" class="box" ></textarea>
                    <br><br>
                    Your Name
                    <br>
                    <input type="text" name="Your Name" class="box">
                    <br><br>
                    Your Email
                    <br>
                    <input type="text" name="Your Email"class="box">
                    <br><br>
                    <p>Get Newsletter? <input type="checkbox"></p>
                    <br>
                    <input type="submit" value="Click to Submit" class="bold">
                </form>
        </main>
        <div class="c1">
                            <p>&copy; 2014-RECIPE WORLD</p>
        </div>
    </body>
</html>  
  
