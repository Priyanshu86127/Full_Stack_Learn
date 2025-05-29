
<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khate Jao</title>
    <link 
            href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap"
 rel="stylesheet" href="style.css">

</head>
<body style="background-image:#fff;">
    <header style="background-image: url('./foodbg_blur.jpg'); background-size: cover; background-repeat: no-repeat;">

    <nav style="display: flex; padding: 10px; align-items: center;">
            <!-- Left side links -->
            <div style="display: flex;">
                <a href="home.html"
                    style="text-decoration:none; color: white; background-color: #007BFF; padding: 12px 20px; margin: 5px; border-radius: 5px; font-weight: bold;"
                   >Home</a>
        
                <a href="about.html"
                    style="text-decoration: none; color: white; background-color: #28a745; padding: 12px 20px; margin: 5px; border-radius: 5px; font-weight: bold;"
                   >About</a>
        
                <a href="services.html"
                    style="text-decoration: none; color: white; background-color: #5a117d; padding: 12px 20px; margin: 5px; border-radius: 5px; font-weight: bold;"
                  >Menu</a>
        
                <a href="contact.html"
                    style="text-decoration: none; color: white; background-color: #dc3545; padding: 12px 20px; margin: 5px; border-radius: 5px; font-weight: bold;"
                    >Contact Me</a>
            </div>
              <div style="margin-left: auto; display: flex;">
                <a href="login.html"
                    style="text-decoration: none; color: white; background-color: #4c1ae0; padding: 12px 20px; margin: 5px; border-radius: 5px; font-weight: bold;"
                    >Login</a>
        
                <a href="signup.html"
                    style="text-decoration: none; color: white; background-color: #4c1ae0; padding: 12px 20px; margin: 5px; border-radius: 5px; font-weight: bold;"
                   >Signup</a>
            </div>
        </nav>
          <h1 style=;font-size:34px;font-family:Harrington;color:red;text-align:center;font-size:85px;>Khaate Jaao</h1>
        <h3 style=text-align:center;color:#4c1ae0;font-size:30px;>Because full pet = full smile.<img src="./images/spoon.jpg" alt="Scrolling Image" width="200">
        </h3>
        <marquee scrollamount="40" direction="left" behavior="alternate">
            <img src="./images/burger.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/crispy.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/cake1.jpeg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/fries.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/cake-recipe.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/man.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/fries.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/burger.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/crispy.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/cake1.jpeg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/fries.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/cake-recipe.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/man.jpg" alt="Scrolling Image" width="200"scrollamount="20">
            <img src="./images/fries.jpg" alt="Scrolling Image" width="200"scrollamount="20">
          </marquee>
          
    </header>
    <hr>
    <br>
   
    <div id="container1">
 

        <div style=text-decoration:underline;font-size:34px;font-family:Harrington;>

            <b>Welcome to Khaate Jaao</b>
        </div>
        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 50px;">
            <div style="width: 200px; height: 120px; background-color: #007BFF; color: black; display: flex; align-items: center; justify-content: center;font-weight: bold;">
             OrderNow
            </div>
            <div style="width: 200px; height: 120px; background-color: #28a745; color: black; display: flex; align-items: center; justify-content: center; font-weight: bold;">
          Prices
            </div>
            <div style="width: 200px; height: 120px; background-color: #ffc107; color: black; display: flex; align-items: center; justify-content: center; font-weight: bold;">
           Specials
            </div>
            <div style="width: 200px; height: 120px; background-color: #dc3545; color: black; display: flex; align-items: center; justify-content: center; font-weight: bold;">
              Contact
            </div>
          </div><br>
        
        
    <hr>
    <h2 style=text-decoration:underline;>Featured Products</h2>
    <div id="container4">
        <div id="row4">
            <button  style="background-color: rgb(148, 9, 27); color: white;font-size:20px;border-radius: 8px;">ORDER NOW</button>
        </div><br>
        <div id="row5">
            <button  style="background-color: rgb(198, 30, 75); color: white;font-size:20px;border-radius: 8px;">ORDER NOW</button>
        </div><br>
        <div id="row6">
            <button  style="background-color: rgb(244, 64, 112); color: white;font-size:20px;border-radius: 8px;">ORDER NOW</button>
        </div><br>
    </div>
    <h2 style=text-decoration:underline;>Menu</h2>
    <h3>Home</h3>
        <h3>Shop</h3>
            <h3>About</h3>
                <h3>Blog</h3>
                    <h3>Our Website</h3>
     <h2 style=text-decoration:underline;>Follow Us</h2>
        <h3><img src="./images/instagram.png" > Instagram</h3>
       <h3><img src="./images/whatsappicon.png" >Facebook</h3>
       <h3><img src="./images/twitter.png" >Twitter</h3>
       <h3><img src="./images/youtube.png" >YouTube</h3>
      <h3><img src="./images/linkedin.png" >Linkedin</h3>

      <h2 style=text-decoration:underline;>Contact Us</h2>
       <h3><img src="./images/whatsapp.png" >+91 1234567890</h3>
       <h3><img src="./images/email.png" >Email:priyanshu.kumari86127@gmail.com</h3>
       <h3><img src="./images/location.png" >Government Engineering College, Vaishali</h3>


    <footer style="font-weight: bold;">
        Copyright © 2025 .Khaate Jaao
        All Rights are reserved</footer>
</body>
</html>

