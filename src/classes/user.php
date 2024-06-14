<?php
    require_once "goodOne.php";
    class User{
        private $_pseudo;
        private $_quizzPoints = 0;
        private $_turnTotal;

        public function __construct(string $pseudo = 'Guest'){
            $this->_pseudo = $pseudo; 
        }

        public function getPseudo(){
            return $this->_pseudo;
        }

        public function addPoint($rep, string $quest){
            $answer = new GoodOne();
            $res = $answer -> getAnswer($rep, $quest);
            if($res){
                $_SESSION['points']++;
                $this-> _quizzPoints = $_SESSION['points'];
            } else {
                $this-> _quizzPoints = $_SESSION['points'];
            }
        }

        public function getPoints() {
            return $this-> _quizzPoints;
        }

        public function setTurn(int $count){
            $this->_turnTotal = $count;
        }
        public function getTurn(){
            return $this->_turnTotal;
        }
    }
    $exportedDataBase = var_export(new User(), true);
?>