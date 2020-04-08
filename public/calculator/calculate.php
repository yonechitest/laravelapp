<?php

class Calculate {

    private $val1;//値１
    private $val2;//値２
    private $operand;//演算記号
    private $result;//計算結果

    //演算記号の定数
    const ADD = 'add';
    const SUBTRACT = 'subtract';

    //入力可能な最大桁数
    const MAXLENGTH = '2';
    private $iscorrectmaxlength = true;



    //コンストラクタ
    public function __construct($val1, $operand, $val2) {
        $this->val1 = $val1;
        $this->operand = $operand;
        $this->val2 = $val2;
    }
    
    //値１
    public function getVal1() {
        return $this->val1;
    }

    //演算記号
    public function getOperand() {
        return $this->operand;
    }

      //値２
    public function getVal2() {
        return $this->val2;
    }

      //計算結果
    public function getResult() {
        return $this->result;
    }

    //入力桁チェック異常時false設定
    public function setFalselengthvalidate() {
        $this->iscorrectmaxlength　= false;
    }

    //最大桁数チェック結果
    public function isCorrectmaxlength() {
        return $this->iscorrectmaxlength;
    }


    //入力値の最大桁数チェックし異常ならfalseをセット
    public function valuevalidate(){
        if( strlen($this->val1) > self::MAXLENGTH && strlen($this->val2) > self::MAXLENGTH ){
            $this->setFalselengthvalidate();
        }   
        return $this->iscorrectmaxlength;
    }

    
    //実際に計算処理をする
    public function calcuexe(){
        if(is_numeric($this->val1) && is_numeric($this->val2)){
            switch ($this->operand) {
                case self::ADD:
                    $this->result = $this->val1 + $this->val2;
                    break;
                case self::SUBTRACT:
                    $this->result = $this->val1 - $this->val2;
                    break;
            }
        }
    }

}
?>

