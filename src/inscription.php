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
    <title>S'inscrire</title>
</head>
<body>
    <h1>C'est votre première visite ?</h1>
    <form action="" method="post">
        <input type="text" name="usr" required>
        <input type="password" name="pwd" required>
        <input type="mail" name="mail" required>
        <button type="submit" name="btn">S'inscrire !</button>
    </form>
    <p><a href="connexion.php">Vous etes deja inscrit</a></p>
    
</body>
</html>