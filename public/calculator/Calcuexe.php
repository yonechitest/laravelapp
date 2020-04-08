<?php
require_once('Calculate.php');


$val1=$_POST['value1'];
$operand=$_POST['operand'];
$val2=$_POST['value2'];

//画面から受け取った値をインスタンス化
$calcu = new calculate($val1, $operand, $val2);

//入力値の桁数チェック
$iscorrectmaxlength = $calcu->valuevalidate();
if($iscorrectmaxlength){
    require_once('Calculator.php');
    exit;    
}

//計算実行
$calcu->calcuexe();


require_once('Calculator.php');

?>