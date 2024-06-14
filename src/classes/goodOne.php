<?php
    require_once "database.php";
    require_once "questions.php";
    class GoodOne extends DataBase {

        public function setAnswer($answer, $id){
            $req = $this->_db->prepare("INSERT INTO goodone (good, questions_id) VALUES (?,?)");
            $req ->execute([$answer, $id]);
        }

        public function getAnswer(string $rep, string $quest) {
            $question = new Questions();
            $questionID = $question -> getQuestionId($quest)['id'];
            $req = $this->_db->prepare("SELECT good FROM goodone INNER JOIN questions ON goodone.questions_id = questions.id WHERE good = ? AND questions.id = ?");
            $req -> execute([$rep, $questionID]);
            return $req -> fetch(PDO::FETCH_ASSOC);
        }
    }

    $exportedDataBase = var_export(new GoodOne(), true);
?>