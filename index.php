<?php

//4月の出席簿を自動生成するプログラム
//遅刻・欠席作成
 function hantei(){
    
    $num = mt_rand(0,3);

    if($num == 0){
        $hantei = "欠席";
    } else if($num == 1){
        $hantei = "遅刻";
    } else {
        $hantei = "出席";
    }
    return $hantei;
 };

 //生徒の出席データ
 function data(){

    $data = array(array("茜",hantei()),array("楓",hantei()),array("桜",hantei()));
    return $data;

 };

 //4月の出席簿
 $count = 0;
 $shussekibo = array("4月".$count."日"=>data());
 while ($count <= 29){

    $count = $count+1;
     if($count%7 == 3){
   //土曜日は除く
    } else if($count%7 == 4){ 
    //日曜日は除く
    } else{

        $shussekibo+= array("4月".$count."日"=>data());
    }
  }
 var_dump($shussekibo);


?>
