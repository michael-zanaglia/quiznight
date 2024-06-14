<?php
    session_start();
    require "functions/logout.php";
    require "classes/database.php";
    require "classes/theme.php";
    require "classes/questions.php";
    if(!isset($_SESSION)){
        header('Location: error.php');
    }

    if(isset($_POST['theme-chs'])){
        $questions = new Questions();
        $res = $questions -> getAllQuestions($_POST['theme-chs']);
        $res = json_encode($res);
        setcookie("questions", $res, time()+3600);
        header("Location: quizz.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Lobby</title>
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
    <div class='settings'>
       <button class='start'>Commencer</button> 
       <div class='lobby-box close'>
            <form action="" method='post' class='flex-form-box'>
                <label for="theme-chs">Choisissez la catégorie : </label>
                <select name="theme-chs" required>
                    <?php
                         $classTheme = new Theme();
                         $res = $classTheme -> getAllTheme();
                         foreach($res as $r){
                            echo "<option value='".$r['theme_name']."'>".$r['theme_name']."</option>";
                         }        
                    ?>
                </select>
                <button type='submit'>Valider</button>
            </form>
       </div>
    </div>
    <script>
        const btn = document.querySelector('.start');
        const lobbyBox = document.querySelector('.lobby-box');
        btn.addEventListener('click', () => {
            lobbyBox.classList.toggle('close'); // Supprime la classe close
            lobbyBox.classList.toggle('open'); // Ajoute la classe open
        })
    </script>
    
</body>
</html>