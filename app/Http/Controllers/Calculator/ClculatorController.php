<?php

namespace App\Http\Controllers\Calculator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClculatorController extends Controller
{
    //

    public function index(Request $request){

        //計算式エリアに入力されたそのままの文字列（×,÷表記）
        $formula = $request->input('num-area1');
        //計算式エリアに入力された文字列の×,÷を*,/に変換した文字列
        $requestVal = $request->input('request-val');
        //requestValを1文字づつ配列に格納
        $requestVal = str_split($requestVal);
        //逆ポーランド記法に変換した式を格納する配列
        $polandStr = array();
        //逆ポーランド記法に変換時に使用する四則演算記号の一時退避領域
        $stackOperand = array();
        //$stackOperandの最後に格納された記号を入れておく変数
        $popStackOperand = "null" ;

        //四則演算記号
        $PLUS = config('const.PLUS');
        $MULTIPLIED = config('const.MULTIPLIED');
        $MINUS = config('const.MINUS');
        $DIVIDED = config('const.DIVIDED');

        //$requestValを項分割したあとに式を再格納する配列
        $formulaStr = array();
        //項分割するときに数値を一時的に退避させておく領域
        $stackNum = array();

        //"2,5,*,1,0"を"25,*,10"のように項分割させる
        foreach ( $requestVal as $key=>$val ) {
            //数値の場合その値を退避させておく
            if(is_numeric($val)){

                array_push($stackNum, $val);
                
                //最終ループで退避領域に余っている数値を連結させて$formulaStrに追加する
                if( $key + 1 == count( $requestVal ) ) {
                    $stackStr = join( "", $stackNum );
                    array_push($formulaStr, $stackStr);
                    $stackNum = array();
                }

            //数値以外の時
            }else{
                //負数の項を組み立てるため、減算記号or１つ前の値が演算記号の時"-"を退避領域入れる
                if($val == $MINUS and !is_numeric($requestVal[$key-1])){
                    array_push($stackNum, $val);
                //少数が来たとき退避領域に追加
                }else if($val == "."){
                    array_push($stackNum, $val);
                //+,*,/退避領域にある数値を連結させて$formulaStrに追加する
                }else{
                    $stackStr = join( "", $stackNum );
                    array_push($formulaStr, $stackStr);
                    $stackNum = array();
                    //$stackNum = array_values($stackNum);
                    array_push($formulaStr, $val);
                }
            }
        }
            //項分割された式を逆ポーランド記法で変換
            foreach ($formulaStr as $value) {
                //数値の時ポーランド領域に追加
                if(is_numeric($value)){
                    array_push($polandStr,$value);

                //四則演算記号が来た時
                }else if($PLUS === $value or $MINUS === $value or 
                        $MULTIPLIED === $value or $DIVIDED === $value){

                    //＋、－が来た時
                    if($PLUS === $value or $MINUS === $value ){
                        //四則演算記号の一時退避領域の末尾が*or/の時、*or/をポーランド領域に追加し+,-を一時退避領域に格納
                        if(  $popStackOperand == $MULTIPLIED || $popStackOperand == $DIVIDED  ){
                            array_push($polandStr, $popStackOperand);
                            array_pop($stackOperand);
                            array_push($stackOperand, $value);
                            array_push($stackOperand, $value);
                            $popStackOperand = array_pop($stackOperand);
                        //四則演算記号の一時退避領域の末尾が*or/でない時そのまま格納
                        }else {
                            array_push($stackOperand, $value);
                            $popStackOperand = $value;
                        }
                    //*or/が来た時そのまま一時退避領域に格納
                    }else{
                        array_push($stackOperand, $value);
                        $popStackOperand = $value;
                    }
                }
            }
            
            //残りの四則演算の一時退避領域の値をポーランド領域に追加
            if(count($stackOperand) > 0){
                foreach ($stackOperand as $operand) {
                    $popStackOperand = array_pop($stackOperand);
                    array_push($polandStr, $popStackOperand);
                }
            }

            //逆ポーランド記法に乗っ取って計算
            while (count($polandStr) > 1) {
                //ポーランド領域に演算記号があれば以下を処理する
                if(in_array($PLUS, $polandStr)or in_array($MINUS, $polandStr)or 
                    in_array($MULTIPLIED, $polandStr)or in_array($DIVIDED, $polandStr)){
                    $operandIndex = 0;
                    //ポーランド領域のどの位置に演算記号があるか走査する
                    foreach ($polandStr as $value) {
                        if($PLUS === $value or $MINUS === $value or 
                            $MULTIPLIED === $value or $DIVIDED === $value){
                            break;
                        }
                        $operandIndex++;
                    }

                    // $stackStr = join( ",", $polandStr );
                    // $stackOperandStr = join( ",", $stackOperand );

                    //演算記号の位置ある場所の１，２つ前の項を使い計算
                    if(isset($polandStr[ $operandIndex ])){
                        switch ($polandStr[ $operandIndex ]) {
                            case "+":
                                $answer = $polandStr[$operandIndex - 2] + $polandStr[$operandIndex - 1];
                                $polandStr[$operandIndex - 2] = $answer;
                                unset($polandStr[$operandIndex - 1]);
                                unset($polandStr[$operandIndex]);
                                $polandStr = array_values($polandStr);
                                break;
                            case "-":
                                $answer = $polandStr[$operandIndex - 2] - $polandStr[$operandIndex - 1];
                                $polandStr[$operandIndex - 2] = $answer;
                                unset($polandStr[$operandIndex - 1]);
                                unset($polandStr[$operandIndex]);
                                $polandStr = array_values($polandStr);
                                break;
                            case "*":
                                $answer = $polandStr[$operandIndex - 2] * $polandStr[$operandIndex - 1];
                                $polandStr[$operandIndex - 2] = $answer;
                                unset($polandStr[$operandIndex - 1]);
                                unset($polandStr[$operandIndex]);
                                $polandStr = array_values($polandStr);
                                break;
                            case "/":
                                if($polandStr[$operandIndex - 1] !== "0"){
                                $answer = floor($polandStr[$operandIndex - 2] / $polandStr[$operandIndex - 1]);
                                }else{
                                    $answer ="ERROR:Division by zero";
                                }
                                $polandStr[$operandIndex - 2] = $answer;
                                unset($polandStr[$operandIndex - 1]);
                                unset($polandStr[$operandIndex]);
                                $polandStr = array_values($polandStr);
                                break;
                        }
                    }
                }
            }
          //25×2+2×25+2 =102    
        $stackStr = join( ",", $polandStr );
        $result = array("answer" => $stackStr, "formula" => $formula);

        return view('calculator.calcu_main',compact('result'));
    }
}