<?php 
require_once('Calculate.php');
 ?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>電卓</title>
    <link rel="stylesheet" type="text/css" href="../css/calculator.css">
    </head>
    <body>
        <div> <?php if(isset($calcurate) && $calcurate->iserror())echo($calcurate->getErrormessage()) ?> </div>
        <form name="clcuform"  onSubmit="submitscript()">
        <input type="text" name="value1" id="value1" class="CalcArea" value="<?php if(isset($calcurate))echo($calcurate->getVal1()) ?>" size="10" maxlengh="2" >
        <select name="operand" id="operand" class="SymbolArea" onchange="value2reset()">
            <option value="-"></option>
            <option <?php if(isset($calcurate) && $calcurate->getOperand() == Calculate::PLUS )echo("selected") ?> value="<?php echo( Calculate::PLUS )?>">+</option>
            <option <?php if(isset($calcurate) && $calcurate->getOperand() == Calculate::MINUS )echo("selected") ?> value="<?php echo( Calculate::MINUS )?>">-</option>
            <option <?php if(isset($calcurate) && $calcurate->getOperand() == Calculate::MULTIPLIED )echo("selected") ?> value="<?php echo( Calculate::MULTIPLIED )?>">×</option>
            <option <?php if(isset($calcurate) && $calcurate->getOperand() == Calculate::DIVIDED )echo("selected") ?> value="<?php echo( Calculate::DIVIDED )?>">÷</option>

        </select>
        <input type="text" name="value2" id="value2" class="CalcArea" value="<?php if(isset($calcurate))echo($calcurate->getVal2()) ?>" size="10" maxlengh="2" >
        =
        <input type="text" name="result" id="result" class="CalcArea" value="<?php if(isset($calcurate))echo($calcurate->getResult()) ?>" size="10" maxlengh="10" readonly>

        
        <table border="0" class="ButtonArea">
            <tr>
                <td><button class="Button" type="button" onclick="setNum(7)" value="7">7</button></td>
                <td><button class="Button" type="button" onclick="setNum(8)" value="8">8</button></td>
                <td><button class="Button" type="button" onclick="setNum(9)" value="9">9</button></td>
                <td><button class="Button" type="button" onclick="setOperand('<?php echo( Calculate::PLUS )?>')" value="<?php echo( Calculate::PLUS )?>">+</button></td>

                </tr>
            <tr>
                <td><button class="Button" type="button" onclick="setNum(4)" value="4">4</button></td>
                <td><button class="Button" type="button" onclick="setNum(5)" value="5">5</button></td>
                <td><button class="Button" type="button" onclick="setNum(6)" value="6">6</button></td>
                <td><button class="Button" type="button" onclick="setOperand('<?php echo( Calculate::MINUS )?>')" value="<?php echo( Calculate::MINUS )?>">-</button></td>

                </tr>
            <tr>
                <td><button class="Button" type="button" onclick="setNum(1)" value="1">1</button></td>
                <td><button class="Button" type="button" onclick="setNum(2)" value="2">2</button></td>
                <td><button class="Button" type="button" onclick="setNum(3)" value="3">3</button></td>
                <td><button class="Button" type="button" onclick="setOperand('<?php echo( Calculate::MULTIPLIED )?>')" value="<?php echo( Calculate::MULTIPLIED )?>">×</button></td>
            </tr>
            <tr>
                <td><button class="Button" type="button" onclick="delValue()" value="">DEL</button></td>
                <td><button class="Button" type="button" onclick="setNum(0)" value="0">0</button></td>
                <td><input class="Button"  type="submit" onclick="prepareaction()" value="="></td>
                <td><button class="Button" type="button" onclick="setOperand('<?php echo( Calculate::DIVIDED )?>')" value="<?php echo( Calculate::MULTIPLIED )?>">÷</button></td>

            </tr>
        </table>
    </form>

    </body>
    <script>
        function setNum(val){
            //最大入力桁数
            const maxlength = 2;

            //最大入力桁数まで入力可能にさせる
            if( $("#value1").val().length < maxlength && $('[name=operand] option:selected').val() == "-" ) {

                if( val !== 0 || $("#value1").val().length !== 0  ){
                    var dispval = $("#value1").val() + val;
                    $("#value1").val(dispval);
                }

            }else if( $("#value2").val().length < maxlength ){
                if( val !== 0 || $("#value2").val().length !== 0  ){
                    var dispval = $("#value2").val() + val;
                    $("#value2").val(dispval);
                }
            }
        }

        //演算子を未選択に戻したら値２を初期化する
        function value2reset(){
            if( $('[name=operand]').val() == "-" ) {
                $("#value2").val("");
            }
        }

        //演算子ボタンを押したらプルダウンにセット
        function setOperand(val){
            $("#operand").val(val);
        }

        </script>
        <script>

        //DELボタンを押すと右から一桁ずつ削除する
        function delValue(){
            //value2に値がある時
            if( $("#value2").val().length !== 0 ) {
                var $val2 = $("#value2").val();
                //value2の値が二桁の時
                if( $val2.length == 2 ){
                    var $splitval = String($val2).split('');
                    $("#value2").val($splitval[0]);
                //value2の値が一桁の時
                }else {
                    $("#value2").val("");
                }
            //value1に値がある時
            }else if($("#value1").val().length !== 0){
                var $val1 = $("#value1").val();
                //value1の値が二桁の時
                if( $val1.length == 2 ){
                    var $splitval = String($val1).split('');
                    $("#value1").val($splitval[0]);
                //value1の値が一桁の時
                }else {
                    $("#value1").val("");
                }

            }

        }

        </script>
        <script>


        function submitscript(){

            if( $('[name=operand] option:selected').text() == "÷" && ($("#value2").val() == "0" || $("#value2").val() == "00") ) {
                alert("二つ目の数はゼロ以外の数にしてください。");
            }else{
                document.clcuform.method="POST";
                document.clcuform.action="Calcuexe.php";
            }
        }

    </script>
</html>