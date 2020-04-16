<?php
require_once('Calculate.php');


$val1=$_POST['value1'];
$operand=$_POST['operand'];
$val2=$_POST['value2'];

//画面から受け取った値をコンストラクタに渡す
$calcurate = new calculate($val1, $operand, $val2);

//入力値のエラーチェック
if( $calcurate->validate() ){
    require_once('CalcApp.php');
    exit;    
}

//計算実行
$calcurate->calcurate();


require_once('CalcApp.php');

?>