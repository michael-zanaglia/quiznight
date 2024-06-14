<?php
    require_once "database.php";
    require_once "questions.php";
    class Reponse extends DataBase {

        public function setReponse($rep1, $rep2, $rep3, $rep4, $id){
            $rep = [$rep1, $rep2, $rep3, $rep4];
            foreach($rep as $r){
                $req = $this->_db->prepare("INSERT INTO reponses (reponse, questions_id) VALUES (?,?)");
                $req -> execute([$r, $id]);
            }
        }

        public function getReponse(string $quest) {
            $question = new Questions();
            $questionID = $question -> getQuestionId($quest)['id'];
            $req = $this->_db->prepare("SELECT reponse from reponses INNER JOIN questions ON reponses.questions_id = questions.id WHERE questions.id = ?");
            $req->execute([$questionID]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $exportedDataBase = var_export(new Reponse(), true);
?>