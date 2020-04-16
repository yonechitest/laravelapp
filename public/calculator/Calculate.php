<?php

class Calculate {

    //演算記号の定数
    const PLUS = 'plus';
    const MINUS = 'minus';
    const MULTIPLIED = 'multiplied';
    const DIVIDED = 'divided';

    //入力可能な最大桁数
    const MAX_LENGTH = 2;

    //入力値
    private $val1;      //値１
    private $val2;      //値２
    private  $operand;  //演算記号
    private $result;    //計算結果


    //エラー判定フラグ
    private $iserror = false;
    private $errormessage = "";



    //コンストラクタ
    public function __construct($val1, $operand, $val2) {
        $this->val1 = $val1;
        $this->operand = $operand;
        $this->val2 = $val2;

    }


    //入力値を確認する
    public function validate(){

        //入力値が数字かどうかのチェック
        $this->validateIsNum($this->val1, $this->val2 );
        //入力値が最大桁数以下かチェック
        $this->validateLength($this->val1, $this->val2 );
        //ゼロ除算チェック
        $this->validateDivideZero($this->val2 );

        return $this->iserror;
    }


    //入力値が数字かどうかのチェック
    public function validateIsNum($val1, $val2 ){
        if( !is_numeric($val1) || !is_numeric($val2)  ){
            $this->errormessage = "半角数字で入力してください";
            $this->iserror = true;
        }   
    }

    //入力値が最大桁数以下かチェック
    public function validateLength($val1, $val2){
        if( strlen($val1) > self::MAX_LENGTH || strlen($val2) > self::MAX_LENGTH ){
            $this->errormessage = "入力桁数は".self::MAX_LENGTH."桁以下にしてください";
            $this->iserror = true;
        }   
    }

    //ゼロ除算チェック
    public function validateDivideZero($val2){
        if( $this->operand == self::DIVIDED && $val2 == "0" || $val2 == "00" ){
            $this->errormessage = "二つ目の数はゼロ以外の数にしてください。";
            $this->iserror = true;
        }   
    }


    
    //計算処理をする
    public function calcurate(){
        switch ($this->operand) {
            case self::PLUS:
                $this->result = $this->val1 + $this->val2;
                break;
            case self::MINUS:
                $this->result = $this->val1 - $this->val2;
                break;
            case self::MULTIPLIED:
                $this->result = $this->val1 * $this->val2;
                break;
            case self::DIVIDED:
                $this->result = floor($this->val1/$this->val2);
                break;
            }
        return;
    }

//Getter/Setter

        //値１を取得
        public function getVal1() {
            return $this->val1;
        }
    
        //演算記号を取得
        public function getOperand() {
            return $this->operand;
        }
    
        //値２を取得
        public function getVal2() {
            return $this->val2;
        }
    
        //計算結果を取得
        public function getResult() {
            return $this->result;
        }
    
        //エラー判定
        public function iserror() {
            return $this->iserror;
        }
    
        //エラーメッセージを取得
        public function getErrormessage() {
            return $this->errormessage;
        }
        
    

}
?>

