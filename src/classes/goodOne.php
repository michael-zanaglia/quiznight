<?php
    require_once "database.php";
    class GoodOne extends DataBase {

        public function setAnswer($answer, $id){
            $req = $this->_db->prepare("INSERT INTO goodone (good, questions_id) VALUES (?,?)");
            $req ->execute([$answer, $id]);
        }

        //public function getThemeId(string $theme) {
        //    $req = $this->_db->prepare("SELECT id FROM theme WHERE theme_name = ?");
        //    $req -> execute([$theme]);
        //    return $req -> fetch(PDO::FETCH_ASSOC);
        //}
    }

    $exportedDataBase = var_export(new GoodOne(), true);
?>