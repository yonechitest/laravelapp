<?php
namespace App\Http\Requests\crud;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class CreateProductRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {   
        //[ *1.指定パス以外からのアクセス禁止 ]
        if( $this->path() == 'my-crud/edit/'.$request->id )
        {
            return true; 
        }else{
            return false; 

        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //[ *2.Validationルール記述箇所 ]
        return [
            'name' => 'max:50',
            'price' => 'digits_between:0,5',
            'note' => 'max:50'        
        ];
    }

    //[ *3.Validationメッセージを設定（省略可） ]
    //function名は必ず「messages」となります。
    public function messages(){
        return [
            'name.max'       => '商品名は50字以内でお願いします。',
            'price.digits_between'     => '５桁以内の数値でお願いします。',
        ];
    }

}
