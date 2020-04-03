<?php
$value1 = $_POST['value1']; 
$symbol = $_POST['symbol']; 
$value2 = $_POST['value2']; 
$result = $_POST['result']; 

if(is_numeric($value1)&&is_numeric($value2)){
    switch ($symbol) {
        case '1':
            $result = $value1 + $value2;
            break;
        case '2':
            $result = $value1 - $value2;
            break;
    }
}

$value1 = "value1=" . $value1;
$symbol = "symbol=" . $symbol;
$value2 = "value2=" . $value2;
$result = "result=" . $result;

$url = "http://localhost/dashboard/calculator.php?".$result."&".$symbol."&".$value1."&".$value2;
header('Location:' . $url );
exit;
?>