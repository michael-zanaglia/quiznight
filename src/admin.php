<?php
    ///ALTER TABLE matable AUTO_INCREMENT = 0;
    session_start();
    require "functions/logout.php";
    require "classes/database.php";
    require "classes/theme.php";
    require "classes/questions.php";
    require "functions/encodebase64.php";

    if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin"){
        header("Location: error.php");
        exit;
    }
    if (isset($_POST['question']) ){
        $themeDB = new Theme();
        $questionDB = new Questions();

        $theme = $_POST['theme-slct'];
        $img = $_FILES['img'];
        if ($img['name'] != ''){
            $img = encode64($_FILES['img']['tmp_name']);
        }
        $quest = $_POST['question'];
        $rep1 = $_POST['rep1'];
        $rep2 = $_POST['rep2'];
        $rep3 = $_POST['rep3'];
        $rep4 = $_POST['rep4'];
        $answer = $_POST['goodAnswer'];
        $id = $themeDB -> getThemeId($theme);
        $id = $id['id'];
        $questionDB -> setQuestion($rep1, $rep2, $rep3, $rep4, $quest, $id, $answer, $img);

        
    }
    logout();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Admin</title>
</head>
<body>
    <header>
            <nav>
                <h2>QuizzNight</h2>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="lobby.php">Lobby</a></li>
                    <?php  
                        if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin"){echo "<li><a href='#'>Admin</a></li>";}
                    ?>
                    <li>
                        <form action="" method="post"><button type='submit' name='logout'>Deconnexion</button></form>
                    </li>
                    
                </ul>
            </nav>
    </header>
    <h1>Bienvenue dans la page d'admin</h1>
    <?php
        if(isset($_GET['theme'])){
            $theme =  ucfirst(htmlspecialchars($_GET['theme']));
            $database = new DataBase();
            $database -> insertTheme($theme);
            header("Location: validate.php");
            exit;
        }
    ?>
    <div class="grid">
        <div>
            <div class='divs'>
               <p>Ajouter un theme</p>
                <svg class='plus1' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path class='path1' stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg> 
            </div>
            <div class='addingTheme'>
                <form action="" method="get" class='grid-form'>
                    <label for="theme">Quelle theme souhaitez vous pour votre quiz ?</label>
                    <input type="text" name='theme' required>
                    <button type='submit'>Valider</button>
                </form>
            </div>
        </div>
        <hr>
        <div>
            <div class='divs'>
                <p>Modifier un quiz</p>
                <svg class='plus2' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path class='path2' stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class='updateQuiz'>
                <form action="" method="post" class='grid-form' enctype="multipart/form-data">
                    <label for="theme-slct">*Selectionner la catégorie : </label>
                    <select name="theme-slct" required>
                        <?php
                             $classTheme = new Theme();
                             $res = $classTheme -> getAllTheme();
                             foreach($res as $r){
                                echo "<option value='".$r['theme_name']."'>".$r['theme_name']."</option>";
                             }        
                        ?>
                    </select>
                    <label for="img">Selectionner une image : </label>
                    <input type="file" name='img' accept=".jpg, .jpeg, .png, .gif">
                    <label for="question">*Choisir une question : </label>
                    <input type="text" name='question' required>
                    <label for="">*Entrer les réponses : </label>
                    <div class='grid-rep'>
                        <input type="text" name='rep1' placeholder='reponse1' required>
                        <input type="text" name='rep2' placeholder='reponse2' required>
                        <input type="text" name='rep3' placeholder='reponse3' required>
                        <input type="text" name='rep4' placeholder='reponse4' required>
                    </div>
                    <label for="goodAnswer">*Entrer la bonne réponse : </label>
                    <input type="text" name='goodAnswer' placeholder='ex: reponseD...' required>
                    <button type='submit'>Valider</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let plus1 = document.querySelector('.plus1');
        let plus2 = document.querySelector('.plus2');
        let path1 = document.querySelector('.path1');
        let path2 = document.querySelector('.path2');
        plus1.addEventListener('click', () => {
            const add = document.querySelector('.addingTheme');
            if(path1.getAttribute('d') === 'M12 4.5v15m7.5-7.5h-15'){
                add.style.display = 'block';
                path1.setAttribute('d', 'M5 12h14');
            } else {
                add.style.display = 'none';
                path1.setAttribute('d', 'M12 4.5v15m7.5-7.5h-15');
            }
        });
        plus2.addEventListener('click', () => {
            const update = document.querySelector('.updateQuiz');
            if(path2.getAttribute('d') === 'M12 4.5v15m7.5-7.5h-15'){
                update.style.display = 'block';
                path2.setAttribute('d', 'M5 12h14');
            } else {
                update.style.display = 'none';
                path2.setAttribute('d', 'M12 4.5v15m7.5-7.5h-15');
            }
            
        });
    </script>
</body>
</html>
