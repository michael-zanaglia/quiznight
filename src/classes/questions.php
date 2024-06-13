<?php
    require_once "database.php";
    require_once "reponses.php";
    require_once "goodOne.php";
    require_once "img.php";
    require_once "theme.php";

    class Questions extends DataBase {

        public function setQuestion($rep1, $rep2, $rep3, $rep4, $quest, $id, $answer, $img){
            $reponse = new Reponse();
            $goodOne = new GoodOne();
            $image = new Image();

            $req = $this->_db->prepare("INSERT INTO questions (question, theme_id) VALUES (?,?)");
            $req -> execute([$quest, $id]);
            $question_id = $this -> getQuestionId($quest)['id'];
            $reponse -> setReponse($rep1, $rep2, $rep3, $rep4, $question_id);
            $goodOne -> setAnswer($answer, $question_id);
            $image -> setImg($img, $question_id);
            header("Location: validate.php");
            exit;
        }

        public function getQuestionId(string $quest) {
            $req = $this->_db->prepare("SELECT id FROM questions WHERE question = ?");
            $req -> execute([$quest]);
            return $req -> fetch(PDO::FETCH_ASSOC);
        }

        public function getAllQuestions(string $theme){
            $themeDB = new Theme();
            $res = $themeDB -> getThemeId($theme)['id'];
            $req = $this->_db->prepare("SELECT question FROM questions INNER JOIN theme ON questions.theme_id = theme.id WHERE theme.id = ?");
            $req -> execute([$res]);
            return $req -> fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $exportedDataBase = var_export(new Questions(), true);
?>