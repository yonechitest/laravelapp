<?php

class Calculate {

    private $val1;//値１
    private $val2;//値２
    private $operand;//演算記号
    private $result;//計算結果

    //演算記号の定数
    const ADD = 'add';
    const SUBTRACT = 'subtract';



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

