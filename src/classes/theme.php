<?php
    require_once "classes/database.php";
    class Theme extends DataBase {
        public function getAllTheme(){
            $req = $this->_db->query("SELECT theme_name FROM theme");
            return $req -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function getThemeId(string $theme) {
            $req = $this->_db->prepare("SELECT id FROM theme WHERE theme_name = ?");
            $req -> execute([$theme]);
            return $req -> fetch(PDO::FETCH_ASSOC);
        }
    }

    $exportedDataBase = var_export(new Theme(), true);
?>