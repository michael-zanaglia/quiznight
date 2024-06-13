<?php
    require_once "database.php";
    class Image extends DataBase {

        public function setImg($img, $id){
            $req = $this->_db->prepare("INSERT INTO images (image, questions_id) VALUES (?,?)");
            $req ->execute([$img, $id]);
        }

        //public function getThemeId(string $theme) {
        //    $req = $this->_db->prepare("SELECT id FROM theme WHERE theme_name = ?");
        //    $req -> execute([$theme]);
        //    return $req -> fetch(PDO::FETCH_ASSOC);
        //}
    }

    $exportedDataBase = var_export(new Image(), true);
?>