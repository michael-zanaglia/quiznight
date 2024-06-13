<?php
    function encode64($img){
        var_dump($img);
        $imgToStr = file_get_contents($img);
        $strTo64 = base64_encode($imgToStr);
        return $strTo64;
    }
//<image src="data:'$imageType';base64,'$strTo64" alt="uploded"/>  --- $imageType = $_FILES['img']['type'];
?>
