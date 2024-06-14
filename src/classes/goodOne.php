<?php
    require_once "database.php";
    class GoodOne extends DataBase {

        public function setAnswer($answer, $id){
            $req = $this->_db->prepare("INSERT INTO goodone (good, questions_id) VALUES (?,?)");
            $req ->execute([$answer, $id]);
        }

        public function getAnswer(string $rep) {
            $req = $this->_db->prepare("SELECT good FROM goodone WHERE good = ?");
            $req -> execute([$rep]);
            return $req -> fetch(PDO::FETCH_ASSOC);
        }
    }

    $exportedDataBase = var_export(new GoodOne(), true);
?>