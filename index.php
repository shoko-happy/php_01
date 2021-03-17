<?php

//4月の出席簿を自動生成するプログラム
//遅刻・欠席作成
 function hantei(){
    
    $num = mt_rand(0,4);

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

<table border = "1">
<caption>4月の出席簿</caption>
<tr>
<td></td>

<?php foreach($keys as $key):?>
    <td><?php echo $key; ?></td>
    <?php endforeach; ?>
</tr>
<?php for($i = 0; $i <= 2; $i ++){?>

<tr>
<?php foreach(person($shussekibo,$i) as $val):?>
  <?php if($val == "欠席"){?>

    <td bgcolor = "red"><?php echo $val; ?></td>

    <?php } else if($val == "遅刻"){?>
    <td bgcolor = "yellow"><?php echo $val; ?></td>

    <?php } else {?>
    <td><?php echo $val; ?></td>
    <?php }; ?>

    <?php endforeach; ?>
</tr>
<?php }; ?>

</table>




<?php
//  出席率を求めるプログラム
   function cal($obj,$no){
   $j = 0;

   foreach(person($obj,$no) as $val){
     if($val == "欠席"){
      $j += 1.0;
     }else if($val == "遅刻"){
      $j += 1/3;
     }else{
      $j = $j;
     }
   };
   return $j;
  };
 
//  出席率をもとにコメントを出すプログラム
  
  function shukei($obj,$no){
    if(cal($obj,$no) > count($obj)*0.3){
      echo "出席数足りないよ";
    } else {
      echo "";
    };
  };

  $days=count($shussekibo);

  // 表示
  echo "<br>";
  echo "遅刻3回＝欠席1回。出席率が70 %を下回るとコメントが表示されます。";
  echo "<br>";
  echo "<br>";

  echo "お名前　:　出席率　コメント";
  echo "<br>";
  echo person($shussekibo,0)[0]."さん　:　";
  echo round (100 * (1 - cal($shussekibo,0) / $days))."%　";
  shukei($shussekibo,0);
  echo "<br>";
  
  echo person($shussekibo,1)[0]."さん　:　";
  echo round (100 * (1 - cal($shussekibo,1) / $days))."%　";

  shukei($shussekibo,1);
  echo "<br>";
  
  echo person($shussekibo,2)[0]."さん　:　";
  echo round (100 * (1 - cal($shussekibo,2) / $days))."%　";

  shukei($shussekibo,2);
  ?>

<div><br></div>
<div><br></div>

<div>トリセツ</div>
<div>先週の課題は、音声入力で生徒の登校のログが記録・表示されるプログラムでした。</div>
<div><br></div>
<div>今回はphpの乱数を使って生徒の1か月の登校データを作り、それを表に埋め込んだり出席率を計算したりしました。</div>
<div>大きな配列を作ったのですが、それを細分化して処理してしまったので、コードがかっこわるい感じになってしまいました。</div>
<div>でも、小さい配列にした方が多少計算が軽くなるんでしょうか。その辺の検証はできませんでした。</div>
<div>後は、ボタンを押したら出席率を計算してくれるようにしたかったのですが、ページ内でのphpの参照方法が分からず断念しました。</div>


