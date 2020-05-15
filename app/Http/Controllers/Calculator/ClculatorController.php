<?php

namespace App\Http\Controllers\Calculator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClculatorController extends Controller
{
    //
    public function index(Request $request){

      $val1 = $request->input('num-area2');
      $val2 = $request->input('num-area');
      $operand = $request->input('operandValue');
      $result = "";

          //計算処理をする


      switch ($operand) {
          case '+':
              $result = $val1 + $val2;
              break;
          case '−':
              $result = $val1 - $val2;
              break;
          case '×':
              $result = $val1 * $val2;
              break;
          case '÷':
              $result = $val1/$val2;
              var_dump("s");
              break;
          }

          if(strlen($result) >= 16){
            $result = "E";
          }






	
          return view('calculator.calcu_main',compact('result'));
    }

    // public function calculate(Request $request){


	

    //   return view('calculator.calcu_main',compact('result'));
    //   }







}
