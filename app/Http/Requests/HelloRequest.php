<?php

namespace App¥Http¥Requests;

use Illuminate¥Foundation¥Http¥FormRequest;

class HelloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'hello')
        {
            return true;
        } else {
            return false;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必ず入力してください。',
            'mail.email' => 'メールアドレスが必要です。',
            'age.numeric' => '年齢は整数で書いてください。',
            'age.hello' => 'Hello! 入力は偶数のみ受け付けます。',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|hello',
        ];
    }
}
