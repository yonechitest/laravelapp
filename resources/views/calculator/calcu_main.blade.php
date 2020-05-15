@extends('layouts.calcu_app')

@section('title', 'Calculator')


@section('display')
    @parent
    
    <div class="disp-area">
        
    <div class="num-disp">
    <form action="/calcu-app" method="POST">
    {{ csrf_field() }}

        <input id="num-area" name="num-area" type="text" value="<?php if(isset($result))echo($result) ?>" maxlength="15">
        <input id="num-area2" name="num-area2" value="" type="hidden" >
        <dis class="operand" id="operand" name="operand" value=""></div>
        <input type="hidden" id="operandValue" name="operandValue" value="">


    </div>
    </div>

    <div class="button-area">
    <table  class="ButtonArea">
            <tr>
                <td><button class="Button" type="button" onclick="setNum(7)" value="7">7</button></td>
                <td><button class="Button" type="button" onclick="setNum(8)" value="8">8</button></td>
                <td><button class="Button" type="button" onclick="setNum(9)" value="9">9</button></td>
                <td><button class="Button" type="button" onclick="setOperand('+')" >+</button></td>

                </tr>
            <tr>
                <td><button class="Button" type="button" onclick="setNum(4)" value="4">4</button></td>
                <td><button class="Button" type="button" onclick="setNum(5)" value="5">5</button></td>
                <td><button class="Button" type="button" onclick="setNum(6)" value="6">6</button></td>
                <td><button class="Button" type="button" onclick="setOperand('−')" >-</button></td>

                </tr>
            <tr>
                <td><button class="Button" type="button" onclick="setNum(1)" value="1">1</button></td>
                <td><button class="Button" type="button" onclick="setNum(2)" value="2">2</button></td>
                <td><button class="Button" type="button" onclick="setNum(3)" value="3">3</button></td>
                <td><button class="Button" type="button" onclick="setOperand('×')" >×</button></td>
            </tr>
            <tr>
                <td><button class="Button" type="button" onclick="delValue()" >C</Canvas></button></td>
                <td><button class="Button" type="button" onclick="setNum(0)" value="0">0</button></td>
                <td><button class="Button"  type="submit" onclick="prepareaction()" value="=">=</td>
                <td><button class="Button" type="button" onclick="setOperand('÷')" >÷</button></td>

            </tr>
        </table>
    </div>
</form>

    <script>
        function setNum(val){
            //最大入力桁数
            const maxlength = 15;

            //最大入力桁数まで入力可能にさせる
            if( $("#num-area").val().length < maxlength || $("#operandValue").val() !== '') {



                if( $("#operandValue").val() !== ''){

                    $("#num-area2").val($("#num-area").val()) ;
                    $("#num-area").val('');
                    $("#operandValue").val('')
            }

                if( val !== 0 || $("#num-area").val().length !== 0  ){
                    var dispval = $("#num-area").val() + val;
                    $("#num-area").val(dispval);
                }


            }
        }

        //演算記号設定
        function setOperand(val){
                    $("#operand").text(val);
                    $("#operandValue").val(val);
        }

        function prepareaction(){
                    
                    $("#operandValue").val($("#operand").text());
        }

        //DELボタンを押すと右から一桁ずつ削除する
        function delValue(){
            
            const maxlength = 15;

            if($("#num-area").val().length !== 0){
                var $val1 = $("#num-area").val();
                //value1の値が二桁の時

                if( $val1.length <= maxlength ){
                    var $splitval = String($val1).split('');
                    $splitval.pop();
                    $splitval = $splitval.join('');
                    $("#num-area").val($splitval);
                //value1の値が一桁の時
                }

            }

        }


        </script>

    
@endsection
