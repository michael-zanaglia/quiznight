<?php
    require "classes/database.php";
    

    function main(){
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnCo'])){
            $userCo = $_POST['userCo'];
            $pwdCo = $_POST['pwdCo'];
            $dataBase = new DataBase();
            $res = $dataBase -> connexion($userCo, $pwdCo);      
            foreach($res as $r){
                if ($r["pseudo"] == $userCo && (password_verify($pwdCo, $r["password"]) || $pwdCo == $r["password"]) ){
                    echo "Bienvenue ".$r['pseudo'];
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
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="post">
        <input type="text" name="userCo" required>
        <input type="password" name="pwdCo" required>
        <button type="submit" name="btnCo">Se Connecter</button>
    </form>
</body>
</html>