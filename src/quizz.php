<?php
    session_start();
    require "classes/database.php";
    require "classes/theme.php";
    require "classes/reponses.php";
    require "classes/user.php";

    if (isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
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
        $user -> addPoint($_POST['rep'], $questions[$_SESSION['turn']]['question']);
        $_SESSION['turn']++;
        if ($_SESSION['turn']  >= count($questions)){
            $user -> setTurn($_SESSION['turn']);
            $_SESSION['user'] = serialize($user);
            $_SESSION['turn'] = 0;
            $_SESSION['points'] = 0;
            header('Location: finish.php');
            exit;
        }

    }

    $currentQuestion = $questions[$_SESSION['turn']]['question'];
    $imgDB = new Image();
    $imgBase64 = $imgDB -> getImg($currentQuestion);
    //$imgBase64 = false;
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
                    <li><a href="lobby.php">Lobby</a></li>
                    <?php  
                        if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin"){echo "<li><a href='admin.php'>Admin</a></li>";}
                    ?>
                </ul>
            </nav>
    </header>
    <div class='flex-quizz'>
        <h1 class='titre' ><?php echo $currentQuestion; ?></h1>
        <?php
            echo $imgBase64 ? "<img class=img-quizz src='data:image;base64,".$imgBase64."' alt='IMG-Question'>" : null;
        ?>
        <form action="" method="post">
            <div class=grid-rep>
                <?php
                    foreach($reponses as $rep){
                        $ind = "rep";
                        echo "<div><label for=".$rep['reponse'].">".$rep['reponse']."</label>
                            <input class='check' type='checkbox' name=$ind value='".$rep['reponse']."'></div>";
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