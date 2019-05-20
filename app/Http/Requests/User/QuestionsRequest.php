<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
    public function rules()
    {
        return [
          'title' => 'required|max:30',
          'content' => 'required|max:250',
          'tag_category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'title.required' => '入力必須の項目です。',
          'title.max' => '30文字以内の入力です。' ,
          'content.required' => '入力必須の項目です。',
          'content.max' => '250文字以内の入力です。',
          'tag_category_id.required' => '入力必須の項目です。',
        ];
    }
}

