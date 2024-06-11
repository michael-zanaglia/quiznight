<?php
    require "classes/database.php";
    session_start();
    

    function main(){
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnCo'])){
            $userCo = $_POST['userCo'];
            $pwdCo = $_POST['pwdCo'];
            $dataBase = new DataBase();
            $res = $dataBase -> connexion($userCo, $pwdCo);      
            foreach($res as $r){
                if ($r["pseudo"] == $userCo && (password_verify($pwdCo, $r["password"]) || $pwdCo == $r["password"]) ){
                    $_SESSION["pseudo"] = $r['pseudo'];
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Erreur connexion impossible";
                }
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
    <title>Connexion</title>
</head>
<body>
    <div class='coBox'>
        <h1>Connexion</h1>
        <form class='coBox-form' action="" method="post">
            <label for="userCo">Pseudo : </label>
            <input type="text" name="userCo" required>
            <label for="pwdCo">Mot de passe : </label>
            <input type="password" name="pwdCo" required>
            <button class='coBox-btnConn' type="submit" name="btnCo">Se Connecter</button>
        </form>
        <p class='redirection'><a href="inscription.php">Vous n'etes pas inscrit ?</a></p> 
    </div>
</body>
</html>