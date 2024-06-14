<?php
    require_once "goodOne.php";
    class User{
        private $_pseudo;
        private $_quizzPoints = 0;

        public function __construct(string $pseudo = 'Guest'){
            $this->_pseudo = $pseudo; 
        }

        public function getPseudo(){
            return $this->_pseudo;
        }

        public function addPoint($rep){
            $answer = new GoodOne();
            $res = $answer -> getAnswer($rep);
            if($res){
                $_SESSION['points']++;
                $this-> _quizzPoints = $_SESSION['points'];
            } else {
                $this-> _quizzPoints = $_SESSION['points'];
            }
            echo $this-> _quizzPoints;
        }

        public function getPoints() {
            return $this-> _quizzPoints;
        }
    }
    $exportedDataBase = var_export(new User(), true);
?>