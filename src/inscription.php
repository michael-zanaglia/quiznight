<?php
    require "classes/database.php";

    function checkEmail($mail){
        $re = '/^[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/';
        if (preg_match($re, $mail)){
            return true;
        } else {
            return false;
        }
    }

    function main(){
        if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["btn"])){

            $pseudo = $_POST['usr'];
            $mail = $_POST['mail'];
            $pwd = $_POST['pwd'];

            if (checkEmail($mail)){
                $dataB = new DataBase();
                $dataB->insertUsers($pseudo, $mail, $pwd);  
            } else {
                echo "Mail invalide";
            }
            
        }
    }

    main();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>S'inscrire</title>
</head>
<body>
    <div class='coBox'>
        <h1>C'est votre première visite ?</h1>
        <form class='coBox-form' action="" method="post">
            <label for="usr">*Pseudo : </label>
            <input type="text" name="usr" required>
            <label for="pwd">*Mot de passe : </label>
            <input type="password" name="pwd" required>
            <label for="mail">*Email : </label>
            <input type="mail" name="mail" required>
            <button class='coBox-btnConn' type="submit" name="btn">S'inscrire !</button>
        </form>
        <p class='redirection'><a href="connexion.php">Vous etes deja inscrit ?</a></p>
    </div>
    
</body>
</html>