<?php
    require_once "database.php";
    class Reponse extends DataBase {

        public function setReponse($rep1, $rep2, $rep3, $rep4, $id){
            $rep = [$rep1, $rep2, $rep3, $rep4];
            foreach($rep as $r){
                $req = $this->_db->prepare("INSERT INTO reponses (reponse, questions_id) VALUES (?,?)");
                $req -> execute([$r, $id]);
            }
        }

        //public function getThemeId(string $theme) {
        //    $req = $this->_db->prepare("SELECT id FROM theme WHERE theme_name = ?");
        //    $req -> execute([$theme]);
        //    return $req -> fetch(PDO::FETCH_ASSOC);
        //}
    }

    $exportedDataBase = var_export(new Reponse(), true);
?>