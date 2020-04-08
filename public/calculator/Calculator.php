

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>電卓</title>
    <link rel="stylesheet" type="text/css" href="../css/calculator.css">
    </head>
    <body>
        <div> <?php if(isset($calcu) && $calcu->isCorrectmaxlength())echo("入力桁数は".Calculate::MAXLENGTH."桁未満にしてください") ?> </div>
        <form action="Calcuexe.php" method="POST">
        <input type="text" name="value1" id="value1" class="CalcArea" value="<?php if(isset($calcu))echo($calcu->getVal1()) ?>" size="10" maxlengh="10" >
        <select name="operand" class="SymbolArea">
            <option value=""></option>
            <option <?php if(isset($calcu) && $calcu->getOperand() == 'add')echo("selected") ?> value="add">+</option>
            <option <?php if(isset($calcu) && $calcu->getOperand() == 'subtract')echo("selected") ?> value="subtract">-</option>

        </select>
        <input type="text" name="value2" id="value2" class="CalcArea" value="<?php if(isset($calcu))echo($calcu->getVal2()) ?>" size="10" maxlengh="10" >
        =
        <input type="text" name="result" id="result" class="CalcArea" value="<?php if(isset($calcu))echo($calcu->getResult()) ?>" size="10" maxlengh="10" >

        
        <table border="0" class="ButtonArea">
            <tr>
                <td><button class="Button" type="button" onclick="setNum(7)" value="7">7</button></td>
                <td><button class="Button" type="button" onclick="setNum(8)" value="8">8</button></td>
                <td><button class="Button" type="button" onclick="setNum(9)" value="9">9</button></td>
                </tr>
            <tr>
                <td><button class="Button" type="button" onclick="setNum(4)" value="4">4</button></td>
                <td><button class="Button" type="button" onclick="setNum(5)" value="5">5</button></td>
                <td><button class="Button" type="button" onclick="setNum(6)" value="6">6</button></td>
                </tr>
            <tr>
                <td><button class="Button" type="button" onclick="setNum(1)" value="1">1</button></td>
                <td><button class="Button" type="button" onclick="setNum(2)" value="2">2</button></td>
                <td><button class="Button" type="button" onclick="setNum(3)" value="3">3</button></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="Button" type="button" onclick="setNum(0)" value="0">0</button></td>
                <td><input class="Button"  type="submit" value="="></td>
            </tr>
        </table>
    </form>

    </body>
    <script>
        function setNum(val){

            //最大入力桁数
            const maxlength = 2;

            //最大入力桁数まで入力可能にさせる
            if( $("#value1").val().length < maxlength ) {
                var dispval = $("#value1").val() + val;
                $("#value1").val(dispval);

            }else if( $("#value2").val().length < maxlength ){
                var dispval = $("#value2").val() + val;
                $("#value2").val(dispval);
            }
        }

    </script>
</html>