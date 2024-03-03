<?php 
    include 'server.php';
?> 

<!DOCTYPE html>
<html>
    <head>
        <title> Notes </title>
        <link rel="stylesheet" type="text/css" href="CSS_folder/login&register.css">
    </head>
    <body>
        <header>Notes</header>
        
        <form method="post" action="login.php" class="login-tab">
            <?php include 'errors.php'; ?>
            <div class="username">
                <h2>Username</h2>
                <input type="text" placeholder="Enter your username" class="user" name="username" >
            </div>
            <div class="password">
                <h2>Password</h2>
                <input type="password" placeholder="Enter your password" class="pass" name="password">
            </div>
            <input type="submit" class="submit-btn" value="login" name="login">
            <div class="signup" >don't have an account ? <a href="register.php">sign up</a></div>
        </form>
        
        
    </body>
    </html>
