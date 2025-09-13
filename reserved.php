<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['reservedDate'])){
        $reservedDateDatas = $_POST['reservedDate'];
        echo '予約された日時：<br>';
        foreach($reservedDateDatas as $reservedDateData){
            $reservedDateData = xss_remove($reservedDateData);
            echo $reservedDateData . '<br>';
        }
    }
}

function xss_remove($data){
    $data = strip_tags($data);
    $data = htmlspecialchars($data,ENT_QUOTES);
    return $data;
}