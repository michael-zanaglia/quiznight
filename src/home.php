<?php
    session_start();
    require "functions/logout.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <header>
        <nav>
            <h2>QuizzNight</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Lobby</a></li>
                <?php  
                    if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin"){echo "<li><a href='admin.php'>Admin</a></li>";}
                ?>
                <li>
                    <form action="" method="post"><button type='submit' name='logout'>Deconnexion</button></form>
                </li>
                
            </ul>
        </nav>
    </header>
    
</body>
</html>

<?php
    if(isset($_SESSION['pseudo'])){
        echo "<h1> WELCOME ".$_SESSION['pseudo']."</h1>";
    } else {
        header("Location: error.php");
    }
    logout();
?>
