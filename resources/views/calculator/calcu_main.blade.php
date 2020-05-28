@extends('layouts.calcu_app')

@section('title', 'Calculator')


@section('display')
    @parent
    
    <div class="disp-area">
        
    <form id="submit" method="POST" action="/calcu-app">
    {{ csrf_field() }}

       <div class="num-input"> <input  id="num-area1" name="num-area1" type="text" value="<?php if(isset($result["answer"]))echo($result["answer"]) ?>" ></div>
       <input type="hidden" id="request-val" name="request-val" value="">
        <div class="num-input"><input id="num-area2" name="num-area2" value="<?php if(isset($result["formula"]))echo($result["formula"]) ?>" type="" ></div>
                

    </div>

    <div class="button-area">
    <table  class="ButtonArea">
                <tr>
                <td><input class="button orange" type="button"  onclick="" value="設定"></td>
                <td><input class="button orange" type="button" onclick="delValue()" value="DEL"></td>
                <td><input class="button orange" type="button" id="clear" value="C"></td>
                <td><input class="button gray" type="button" onclick="setNum('+')" value="+"></td>
                </tr>

                <!-- <tr>
                <td><input class="button white" type="button" onclick="" value="%"></td>
                <td><input class="button white"  type="button" onclick="setNum('(')" value="("></td>
                <td><input class="button white" type="button" onclick="setNum(')')" value=")" ></td>
                <td><input class="button gray" type="button" onclick="setNum('-')" value="−"></td>
                </tr> -->

            <tr>
                <td><input class="button white" type="button"  onclick="setNum(7)" value="7"></td>
                <td><input class="button white" type="button" onclick="setNum(8)" value="8"></td>
                <td><input class="button white" type="button" onclick="setNum(9)" value="9"></td>
                <td><input class="button gray" type="button" onclick="setNum('-')" value="−"></td>

                </tr>
            <tr>
                <td><input class="button white" type="button" onclick="setNum(4)" value="4"></td>
                <td><input class="button white" type="button" onclick="setNum(5)" value="5"></td>
                <td><input class="button white" type="button" onclick="setNum(6)" value="6"></td>
                <td><input class="button gray" type="button" onclick="setNum('×')" value="×"></td>


                </tr>
            <tr>
                <td><input class="button white" type="button" onclick="setNum(1)" value="1"></td>
                <td><input class="button white" type="button" onclick="setNum(2)" value="2"></td>
                <td><input class="button white" type="button" onclick="setNum(3)" value="3"></td>
                <!-- <td rowspan="2"> --><td><input class="button gray" type="button" onclick="setNum('÷')" value="÷"></td>

            </tr>
            <tr>
                <td colspan="2"><input class="button white" type="button" onclick="setNum(0)" value="0" ></td>
                <td><input class="button white"  type="button" onclick="setNum('.')" value="."></td>
                <td><input class="button gray" type="submit" onclick="prepareaction()" value="="></td>
            </tr>

        </table>
    </div>
</form>

    <script>
        var operand = [,'×', '-', '+', '÷'];

        function setNum(val){
            //最大入力桁数
            const maxlength = 15;

            //最大入力桁数まで入力可能にさせる
            if( $("#num-area1").val().length < maxlength ) {


            var operand = [,'×', '-', '+', '÷'];
            var operandExceptMin = [,'+', '×', '÷'];
            var lastClickVal = $("#num-area1").val().split('').pop();

            //押したボタンが四則演算記号だった時and現在の入力されてる値が０桁じゃない時
            if( operand.indexOf(val) > 0  && $("#num-area1").val().length !== 0){


                //直前に入力した値が四則演算記号ではない時四則演算記号を入力する
                if(operand.indexOf(lastClickVal) < 0){
                    var dispval = $("#num-area1").val() + val;
                    $("#num-area1").val(dispval);
                //入力した値が減算記号だった時
                }else if( val == "-" ){
                    //直前に入力した値が減算記号じゃない時減算記号を入力
                    if(lastClickVal !== "-"){
                        var dispval = $("#num-area1").val() + val;
                        $("#num-area1").val(dispval);
                    }
                //入力された値が減算記号以外の時
                }else if( operandExceptMin.indexOf(val) > 0){
                    //直前に入力した値が減算記号の時
                    if(lastClickVal == "-"){
                        return
                    }
                    var splitval = $("#num-area1").val().split('');//
                    splitval.pop();
                    splitval = splitval.join('');
                    $("#num-area1").val(splitval);
                    var dispval = $("#num-area1").val() + val;
                    $("#num-area1").val(dispval);
                }
            //入力した値が減算記号だった時
            }else if( val == "-" ){
                var dispval = $("#num-area1").val() + val;
                $("#num-area1").val(dispval);
            }
            
                //０～９のボタンが押された時
                if($.isNumeric(val)){
                    //既に入力されている値が０でない時
                    if( $("#num-area1").val() !== "0"   ){
                        var dispval = $("#num-area1").val() + val;
                        $("#num-area1").val(dispval);
                    //clickしたボタンが０でない時
                    }else if( val !== 0 ){
                        $("#num-area1").val("");
                         $("#num-area1").val(val);
                    }
                }

                arrayValue = $("#num-area1").val().split('').reverse();
                if(val == "." &&  $("#num-area1").val().length !== 0 && lastClickVal !== "(" && operand.indexOf(lastClickVal) < 0){
                    ableDot = 1;
                    operandFlg = 0;
                    $.each(arrayValue, function(index, value){
                        if(operand.indexOf(value) > 0){
                            operandFlg = 1;
                        }else if(value == "." ){
                            if(operandFlg == 0){
                                ableDot = 0;
                            }
                        }
                    })

                    if(lastClickVal !== "." && ableDot == 1){
                    var dispval = $("#num-area1").val() + val;
                    $("#num-area1").val(dispval);
                    }
                }

            }
        }

            $('#submit').submit(function(){


                    errorFlg=0;
                    arrayValue = $("#num-area1").val().split('');
                    if( operand.indexOf(arrayValue[arrayValue.length-1]) > 0　&& errorFlg ==0){
                        Swal.fire({ title: 'ERROR', html : 'formula is incomplete'
                                    , position : 'center-start', width : '26rem'
                                    , allowOutsideClick : false
                            });
                            errorFlg++;
                    }

                    $.each(arrayValue, function(index, value){
                        if(value == "÷" && arrayValue[index+1] == "0" && errorFlg ==0){
                            Swal.fire({ title: 'ERROR', html : 'Division by zero'
                                    , position : 'center-start', width : '26rem'
                                    , allowOutsideClick : false
                            });
                            errorFlg++;
                        }
                    })

                    
                    $.each(arrayValue, function(index, value){
                        if(value == "×"){
                            arrayValue[index] = "*";
                        }else if(value == "÷"){
                            arrayValue[index] = "/";
                        }
                    })
                    arrayValue = arrayValue.join('');
                    $("#request-val").val(arrayValue);

                    if(errorFlg !== 0){
                        return false;
                    }
})



        //DELボタンを押すと右から一桁ずつ削除する
        function delValue(){
            
            const maxlength = 15;

            if($("#num-area1").val().length !== 0){
                var $val1 = $("#num-area1").val();
                //value1の値が二桁の時

                if( $val1.length <= maxlength ){
                    var $splitval = String($val1).split('');
                    $splitval.pop();
                    $splitval = $splitval.join('');
                    $("#num-area1").val($splitval);
                //value1の値が一桁の時
                }

            }
        }

        $(function () {
            $("#clear").click( function() {
                $("#num-area1").val("");
            });
        });

        </script>

    
@endsection

