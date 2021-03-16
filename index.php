<?php

//4月の出席簿を自動生成するプログラム
//遅刻・欠席作成
 function hantei(){
    
    $num = mt_rand(0,5);

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
 $count = 1;
 $shussekibo = array("4月".$count."日" => data());
 while ($count <= 30){

    $count = $count + 1;
     if($count%7 == 3){
   //土曜日は除く
    } else if($count%7 == 4){ 
    //日曜日は除く
    } else{
        $shussekibo += array("4月".$count."日" => data());
    }
 
  }
//生成したデータを表に表示するプログラム

  $keys = array_keys($shussekibo);

  function person($obj,$no){  
    $person = [$obj["4月1日"][$no][0]];
   for($i = 1; $i <= 30; $i++){
   if($obj["4月{$i}日"][$no][1]== NULL){
    } else {
   $person[] = $obj["4月{$i}日"][$no][1];
   }
   }
    return $person;
  };

 ?>

<table border="1">
<caption>4月の出席簿</caption>
<tr>
<td></td>
<?php foreach($keys as $key):?>
    <td><?php echo $key; ?></td>
    <?php endforeach; ?>
</tr>
<?php for($i = 0; $i <= 2; $i++){?>
<tr>
<?php foreach(person($shussekibo,$i) as $val):?>
    <td color=red><?php echo $val; ?></td>
    <?php endforeach; ?>
</tr>
<?php }; ?>

</table>



