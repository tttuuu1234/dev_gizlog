<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return true;
    }
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() //コントローラーに処理が渡る前にvalidateをしてくれる　rulesでリクエスの対してのvalidateを指定
    {
        return [
            'reporting_time' => 'required|before:now',
            'title'          => 'required|max:30',
            'contents'       => 'required|max:250',
        ];
    }
  
    public function messages() //表示させるメッセージ
    {
        return [
            'reporting_time.before'   => '今日以前の日付を入力してください。',
            'reporting_time.required' => '入力必須の項目です。',
            'title.max'               => '30文字以内で入力してください。',
            'title.required'          => '入力必須の項目です。',
            'contents.max'            => '250文字以内で入力してください。',
            'contents.required'       => '入力必須の項目です。',
        ];
    }
}

