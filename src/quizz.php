<?php
    session_start();
    require "functions/logout.php";
    require "classes/database.php";
    require "classes/theme.php";
    require "classes/reponses.php";
    require "classes/user.php";

    if (isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        
        //$getPseudo = $user -> getPseudo();
    }
    
    if(!isset($_SESSION)){
        header('Location: error.php');
        exit;
    }
    $questions = json_decode($_COOKIE["questions"], true);
    
    if(!isset($_SESSION['turn'])){
        $_SESSION['turn'] = 0;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user -> addPoint($_POST['rep']);
        $_SESSION['turn']++;
        if ($_SESSION['turn']  >= count($questions)){
            $_SESSION['turn'] = 0;
            $_SESSION['points'] = 0;
            header('Location: finish.php');
            exit;
        }
    }

    $currentQuestion = $questions[$_SESSION['turn']]['question'];
    $reponsesDB = new Reponse();
    $reponses = $reponsesDB -> getReponse($currentQuestion);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Quizz Room</title>
</head>
<body>
    <header>
            <nav>
                <h2>QuizzNight</h2>
                <ul>
                    <li><a href="home.php">Home</a></li>
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
    <div>
        <h1><?php echo $currentQuestion; ?></h1>
        <form action="" method="post">
            <div>
                <?php
                    foreach($reponses as $rep){
                        $ind = "rep";
                        echo "<label for=".$rep['reponse'].">".$rep['reponse']."</label>
                            <input class='check' type='checkbox' name=$ind value='".$rep['reponse']."'>";
                    }
                ?>
            </div>
            <button>Valider</button>
        </form>
    </div>
    <script>
        const inp = document.querySelectorAll('.check');
        inp.forEach(checkbox => {
            checkbox.addEventListener('click', () => {
                inp.forEach(othercheckbox =>{
                    if(checkbox !== othercheckbox) {
                        othercheckbox.checked = false;
                    }
                })
            })
        } )
    </script>
</body>
</html>