<?php
    function logout(){
        if(isset($_POST['logout'])) {
            session_destroy();
            header("Location: connexion.php");
        }
    }
?>