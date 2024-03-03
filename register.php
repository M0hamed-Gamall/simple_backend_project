 <?php 
    include 'server.php';
  ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="CSS_folder/login&register.css">
</head>
<body>
    <form  method="post" action="register.php" class="sign-tab">

        <?php include 'errors.php';?>

        <div class="name">
            <h2>Name</h2>
            <input type="text" placeholder="Enter your name" class="signName" name="name"  value=<?php echo $name ?>>
        </div>
        <div class="email">
            <h2>Email</h2>
            <input type="email" placeholder="Enter your Email" class="signMail " name="email" value=<?php echo $email ?>>
        </div>

        <div class="username">
            <h2>Username</h2>
            <input type="text" placeholder="Enter your username" class="signUser" name="username" value=<?php echo $username ?>>
        </div>

        <div class="password">
            <h2>Password</h2>
            <input type="password" placeholder="Enter your password" class="signPass1" name="password1" >
        </div>
        <div class="password confirm">
            <h2>Confirm Password</h2>
            <input type="password" placeholder="Enter your password again" class="signPass2" name="password2" >
        </div>
        <input type="submit" class="sign-btn" value="sign up" name="register">
        <div class="signup" >already have an account ? <a href="login.php">login</a></div>
    </form>


</body>
</html>