<?php
    $mysql='mysql:host=localhost;dbname=note_application';
    $user='root';
    $pass='';

    try{
        $db = new PDO($mysql , $user , $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOExeption $e){
        echo 'failed '.$e->getMessage();
    }

    $username = "";
    $email    = "";
    $name     = "";
    $password1 = "";
    $password2 = "";
    session_start();

    if(isset($_POST['register']))
    {
        $username =  $_POST['username'];
        $email    =  $_POST['email'];
        $name     =  $_POST['name'];
        $password1 =  $_POST['password1'];
        $password2 =  $_POST['password2'];

        
        $errors = [];

    /* sanitize inputs */
        $username = strip_tags($username);
        $name = strip_tags($name);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors , "The email address '$email' is considered invalid.");
        } 

        if(empty( $username))
        {
            array_push($errors , "username is required");
        }
        if(empty( $name))
        {
            array_push($errors , "name is required");
        }
        if(empty( $email))
        {
            array_push($errors , "email is required");
        }
        if(empty( $password1))
        {
            array_push($errors , "password is required");
        }
        if( $password1 != $password2)
        {
            array_push($errors , "two passwords don't match");
        }

        $get_user=$db->prepare("SELECT username FROM users WHERE username = ?");
        $get_user->execute([$username]);
        
        $exists = $get_user->fetch() > 0;

        if($exists)
        {
            array_push($errors , "username is already exist");
        }

        if(count($errors) == 0)
        {
            $password = md5($password1);
            $store = $db->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
            $store->execute([$name, $username, $email, $password]);

            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name ;
            $_SESSION['email'] = $email;

            header('location: index.php');
            exit;
        }
    }

    if(isset($_POST['login']))
    {
        $username = ( $_POST['username']);
        $password = md5($_POST['password']);

        $username = strip_tags($username);

        $get_user = $db->prepare("SELECT * from users where username = ? and password = ? ");
        $get_user->execute([$username , $password]);

        $user = $get_user->fetch();
        if($user > 0)
        {
            $get_user_info = $db->prepare("SELECT * FROM users where username = ? and password = ?");
            $get_user_info->execute([$_POST['username'] , md5($_POST['password']) ]);
            
            $user_info = $get_user_info->fetch();

            $_SESSION['username'] = $user_info['username'];
            $_SESSION['name'] = $user_info['name'];
            $_SESSION['email'] = $user_info['email'];

            header('location: index.php');
            exit;
        }
        else
        {
            $errors = [];
            array_push($errors ,"Wrong Username Or Password");
        }
    }

    if(isset($_GET['logout']))
    {
        // Unset all of the session variables.
        $_SESSION = array();
        // Finally, destroy the session.
        session_destroy();
        
        header('location: login.php');
        exit;
    }

    // store data in database
    if (isset($_POST['new-note'])) {
        $note = $_POST['new-note'];
        
        $get_user_id=$db->prepare('SELECT id FROM users WHERE username = ?');
        $get_user_id->execute([$_SESSION['username']]);
        $id = $get_user_id->fetch();

        $id=$id['id'];
        $stmt = $db->prepare('INSERT INTO notes (content , user_id) VALUES ( ? , ? )');
        $stmt->execute([$note , $id ]);
    }


        // Add endpoint to retrieve user notes
        if(isset($_GET['user_notes'])) {
            // Check if user is logged in
            if(!isset($_SESSION['username'])) {
                http_response_code(401); // Unauthorized
                echo json_encode(array("error" => "User not logged in"));
                exit;
            }
    
            // Get user ID
            $get_user_id = $db->prepare('SELECT id FROM users WHERE username = ?');
            $get_user_id->execute([$_SESSION['username']]);
            $user_id = $get_user_id->fetchColumn();
    
            // Fetch user notes
            $get_user_notes = $db->prepare('SELECT * FROM notes WHERE user_id = ?');
            $get_user_notes->execute([$user_id]);
            $user_notes = $get_user_notes->fetchAll(PDO::FETCH_ASSOC);
    
            // Return notes as JSON
            echo json_encode($user_notes);
            exit;
        }

        
        if(isset($_GET['dataUserID']) && isset($_GET['dataNoteId']))
        {
            $stmt=$db->prepare("DELETE FROM notes WHERE note_id = ?  AND user_id = ? ");
            $stmt->execute([$_GET['dataNoteId'] , $_GET['dataUserID']]);
        }
        
?>
