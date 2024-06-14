<?php
    session_start();
    require "functions/logout.php";
    require "classes/user.php";

    if (isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
    }
    
    if(!isset($_SESSION)){
        header('Location: error.php');
        exit;
    }

    logout();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>End Point</title>
</head>
<body>
    <header>
            <nav>
                <h2>QuizzNight</h2>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="lobby.php">Lobby</a></li>
                    <?php  
                        if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin"){echo "<li><a href='admin.php'>Admin</a></li>";}
                    ?>
                    <li>
                        <form action="" method="post"><button type='submit' name='logout'>Deconnexion</button></form>
                    </li>
                    
                </ul>
            </nav>
    </header>
    <h1>FINI</h1>
    <?php
        $turns = $user -> getTurn();
        $points = $user -> getPoints();
        $percent = ($points/$turns)*100;
        if($percent < 10) {
            echo "AIE! Revois tes classiques amigo ! Sur $turns questions, tu as bien répondu $points fois !";
        } else if($percent >= 10 && $percent < 40 ) {
            echo "Hmm insuffisant... Sur $turns questions, tu as répondu juste seulement $points fois !";
        }
        else if($percent >= 40 && $percent < 60) {
            echo "Bien tenté ! Sur $turns questions, tu as bien répondu $points fois !";
        } else if($percent >= 60 && $percent < 80) {
            echo "Bien joué ! Sur $turns questions, tu as bien répondu $points fois !";
        } else if($percent >= 80 && $percent <= 99) {
            echo "Pas loin ! Sur $turns questions, tu as bien répondu $points fois !";
        } else {
            echo "WOW c'est un score parfait ! Sur $turns questions, tu as bien répondu à toutes les questions!";
        }
        
    ?>
</body>
</html>