<?php
    session_start();
    require "functions/logout.php";

    if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin"){
        header("Location: error.php");
    }

    logout();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Admin</title>
</head>
<body>
    <header>
            <nav>
                <h2>QuizzNight</h2>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Lobby</a></li>
                    <?php  
                        if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin"){echo "<li><a href='#'>Admin</a></li>";}
                    ?>
                    <li>
                        <form action="" method="post"><button type='submit' name='logout'>Deconnexion</button></form>
                    </li>
                    
                </ul>
            </nav>
    </header>
    <h1>Bienvenue dans la page d'admin</h1>
</body>
</html>