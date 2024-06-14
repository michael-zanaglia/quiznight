<?php
    require_once "database.php";
    require_once "questions.php";
    
    class Image extends DataBase {

        public function setImg($img, $id){
            $req = $this->_db->prepare("INSERT INTO images (image, questions_id) VALUES (?,?)");
            $req ->execute([$img, $id]);
        }

        public function getImg(string $quest) {
            $question = new Questions();
            $questionID = $question -> getQuestionId($quest)['id'];
            $req = $this->_db->prepare("SELECT image FROM images INNER JOIN questions ON images.questions_id = questions.id WHERE questions.id = ?");
            $req -> execute([$questionID]);
            $getImage = $req -> fetch(PDO::FETCH_ASSOC);
            if ($getImage && isset($getImage['image'])) {
                return $getImage['image'];
            } else {
                return false;
            }
            
        }
    }

    $exportedDataBase = var_export(new Image(), true);
?>