


<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>電卓</title>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    </head>
    <body>
        <form action="calculate.php" method="POST">
        <input type="text" name="value1" id="value1" class="CalcArea" value="<?php if(isset($_GET['value1'])) { echo $_GET['value1']; } ?>" size="10" maxlengh="10" >
        <select name="symbol" class="SymbolArea">
            <option value=""></option>
            <option <?php if(isset($_GET['symbol']) && $_GET['symbol'] == '1') { print("selected"); } ?> value="1">+</option>
            <option <?php if(isset($_GET['symbol']) && $_GET['symbol'] == '2') { print("selected"); } ?> value="2">-</option>

        </select>
        <input type="text" name="value2" id="value2" class="CalcArea" value="<?php if(isset($_GET['value2'])) { echo $_GET['value2']; } ?>" size="10" maxlengh="10" >
        =
        <input type="text" name="result" id="result" class="CalcArea" value="<?php if(isset($_GET['result'])) { echo $_GET['result']; } ?>" size="10" maxlengh="10" >

        
        <table border="0" class="buttonArea">
            <tr>
                <td><button class="button" type="button" value="7">7</button></td>
                <td><button class="button" type="button" value="8">8</button></td>
                <td><button class="button" type="button" value="9">9</button></td>
                </tr>
            <tr>
                <td><button class="button" type="button" value="4">4</button></td>
                <td><button class="button" type="button" value="5">5</button></td>
                <td><button class="button" type="button" value="6">6</button></td>
                </tr>
            <tr>
                <td><button class="button" type="button" value="1">1</button></td>
                <td><button class="button" type="button" value="2">2</button></td>
                <td><button class="button" type="button" value="3">3</button></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="button" value="0">0</button></td>
                <td><input class="button" type="submit" value="="></td>
            </tr>
        </table>
    </form>

    </body>
    <script>
        $('button').click(function() {
            val = $(this).val();
            if( !$("#value1").val() ) {
                $("#value1").val(val);
            }else{
                $("#value2").val(val);
            }                
        })
        </script>
</html>