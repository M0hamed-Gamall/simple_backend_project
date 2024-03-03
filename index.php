<?php 
    include 'server.php';
    if(!isset($_SESSION['name']))
    {
        header('location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="CSS_folder/style.css">
        <title>User Profile Card</title>
        <style>
            .user-card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                transition: 0.3s;
                width: 40%;
                border-radius: 5px;
                padding: 20px;
                text-align: center;
                margin: 0 auto; /* Center the card */
                margin-top: 50px;
                background-color: #f2f2f2;
            }

            .user-card:hover {
                box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            }

            .user-info {
                margin: 10px 0;
                font-size: 18px;
            }

            .user-info span {
                font-weight: bold;
            }
        </style>
    </head>
    <body>

        <div class="user-card">
            <div class="user-info"><span>Username:</span> <?php echo $_SESSION['username'] ;?></div>
            <div class="user-info"><span>Name:</span> <?php echo $_SESSION['name']; ?></div>
            <div class="user-info"><span>Email:</span> <?php echo $_SESSION['email'] ;?></div>
            <a href="index.php?logout='out'">log out</a>
        </div>

        <form method="post">
            <div class="add-notes">
                <h2>Add Your Note</h2>
                <input type="text" placeholder="Enter your Note" class="newNote" name="new-note">
                <button class="add"> Add </button>
            </div>
        </form>

        <div id="notes-container">
            <h2>Your Notes</h2>
        </div>
        
            <script src="manage_notes.js"></script>
            
    </body>
</html>