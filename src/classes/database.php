<?php
    class DataBase {
        private $_HOST = "localhost:3307";
        private $_userDb = "root";
        private $_pwdDb = "";
        private $_NAME = "quizz_night";
        protected $_db;

        public function __construct(){
            try {
                $this->_db = new PDO("mysql:host=$this->_HOST;dbname=$this->_NAME;charset=utf8", $this->_userDb, $this->_pwdDb);
                $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erreur :". $e->getMessage();
            }
        }

        private function checkingDataBeforeInsert($pseudo, $mail){
            $req = $this->_db -> prepare("SELECT pseudo, mail FROM users WHERE pseudo = ? OR mail = ?");
            $req -> execute([$pseudo, $mail]);
            return $req -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertUsers(string $pseudo, string $mail, string $pwd){
            $res = $this -> checkingDataBeforeInsert($pseudo, $mail);
            if (count($res) < 1) {
                $req = $this->_db -> prepare("INSERT INTO users (pseudo, mail, password) VALUES (?,?,?)");
                $req -> execute([$pseudo,  $mail, password_hash($pwd, PASSWORD_DEFAULT)]);
            } else {
                echo "L'utilisatreur existe deja !";
            }  
        }

        public function connexion(string $pseudo, string $pwd){
            $req = $this ->_db -> prepare("SELECT pseudo, password from users WHERE pseudo = ? ");
            $req -> execute([$pseudo]);
            return $req -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertTheme(string $theme){
            $req = $this->_db -> prepare("INSERT INTO theme (theme_name) VALUES (?)");
            $req -> execute([$theme]);
        }
    }
    $exportedDataBase = var_export(new DataBase(), true);
?>