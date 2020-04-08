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
    private $iserror = false;
    private $errormessage = "";



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

    //エラー判定
    public function iserror() {
        return $this->iserror;
    }

    //エラーメッセージ設定
    public function getErrormessage() {
        return $this->errormessage;
    }
    
    

    //入力値バリデーション
    public function valuevalidate(){
        //入力値が数字かどうかのチェック
        if( !is_numeric($this->val1) || !is_numeric($this->val2)  ){
            $this->errormessage = "数値を入力してください";
            $this->iserror = true;
            return true;
        }   

        //入力値が最大桁数以下かチェック
        if( strlen($this->val1) > self::MAXLENGTH || strlen($this->val2) > self::MAXLENGTH ){
            $this->errormessage = "入力桁数は".self::MAXLENGTH."桁以下にしてください";
            $this->iserror = true;
            return true;
        }   

        return $this->iserror;
    }



    
    //実際に計算処理をする
    public function calcuexe(){
        switch ($this->operand) {
            case self::ADD:
                $this->result = $this->val1 + $this->val2;
                break;
            case self::SUBTRACT:
                $this->result = $this->val1 - $this->val2;
                break;
        }
        return;
    }

}
?>

