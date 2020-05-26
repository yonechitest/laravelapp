<?php

namespace App\Http\Controllers\Calculator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClculatorController extends Controller
{
    //

    public function index(Request $request){
// var_dump(config('const.PLUS'));


      $formula = $request->input('num-area1');

      $requestVal = $request->input('request-val');
      $requestVal = str_split($requestVal);
      $stack = array();
      $stackOperand = array();
      $popStackOperand = "null" ;

      $PLUS = config('const.PLUS');
      $MULTIPLIED = config('const.MULTIPLIED');
      $MINUS = config('const.MINUS');
      $DIVIDED = config('const.DIVIDED');





      foreach ($requestVal as $value) {



        if(is_numeric($value)){
          array_push($stack,$value);
          //四則演算が来た時
        }else if($PLUS === $value or $MINUS === $value or 
        $MULTIPLIED === $value or $DIVIDED === $value){
          //＋、－が来た時
          if($PLUS === $value or $MINUS === $value ){

            if(  $popStackOperand == $MULTIPLIED || $popStackOperand == $DIVIDED  ){

              array_push($stack, $popStackOperand);
              array_pop($stackOperand);

              array_push($stackOperand, $value);
              array_push($stackOperand, $value);

              $popStackOperand = array_pop($stackOperand);



            }else {
              
              array_push($stackOperand, $value);


              $popStackOperand = $value;


            }
          

          }else{

            array_push($stackOperand, $value);

            $popStackOperand = $value;



          }

        }

      }


      
        //全部終わったとき
      if(count($stackOperand) > 0){
        foreach ($stackOperand as $operand) {
        $popStackOperand = array_pop($stackOperand);
        array_push($stack, $popStackOperand);

        }
      }

      while (count($stack) > 1) {
        if(in_array($PLUS, $stack)or in_array($MINUS, $stack)or 
        in_array($MULTIPLIED, $stack)or in_array($DIVIDED, $stack)){
          



      $operandIndex = 0;
      foreach ($stack as $value) {
        if($PLUS === $value or $MINUS === $value or 
        $MULTIPLIED === $value or $DIVIDED === $value){

        break;
        }
        $operandIndex++;

      }

      $stackStr = join( ",", $stack );
      $stackOperandStr = join( ",", $stackOperand );
    // var_dump($stackStr);
    // var_dump($stackOperandStr);

    //   var_dump($operandIndex);
      
if(isset($stack[ $operandIndex ])){
        switch ($stack[ $operandIndex ]) {
          case "+":
            $answer = $stack[$operandIndex - 2] + $stack[$operandIndex - 1];

            $stack[$operandIndex - 2] = $answer;

            unset($stack[$operandIndex - 1]);
            unset($stack[$operandIndex]);

            $stack = array_values($stack);
              break;
          case "-":
            $answer = $stack[$operandIndex - 2] - $stack[$operandIndex - 1];

            $stack[$operandIndex - 2] = $answer;

            unset($stack[$operandIndex - 1]);
            unset($stack[$operandIndex]);

            $stack = array_values($stack);

              break;
          case "*":
            $answer = $stack[$operandIndex - 2] * $stack[$operandIndex - 1];

            $stack[$operandIndex - 2] = $answer;

            unset($stack[$operandIndex - 1]);
            unset($stack[$operandIndex]);

            $stack = array_values($stack);

              break;
          case "/":
            $answer = floor($stack[$operandIndex - 2] / $stack[$operandIndex - 1]);

            $stack[$operandIndex - 2] = $answer;

            unset($stack[$operandIndex - 1]);
            unset($stack[$operandIndex]);

            $stack = array_values($stack);

              break;
          }
        }


      }
  }

      //   $stackStr = join( ",", $stack );
      //   $stackOperandStr = join( ",", $stackOperand );
      // var_dump($stackStr);
      // var_dump($stackOperandStr);

          //計算処理をする
          
          $stackStr = join( ",", $stack );
          
          $result = array("answer" => $stackStr, "formula" => $formula);
	
          return view('calculator.calcu_main',compact('result'));
    }

    // public function calculate(Request $request){


	

    //   return view('calculator.calcu_main',compact('result'));
    //   }







}
