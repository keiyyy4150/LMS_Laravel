<?php
/**
* スケジュール編集用リクエスト
* @copyright 鍋田 All Rights Reserved
* @author K.Nabeta <keike312yms@outlook.jp>
*/

namespace App\Http\Request\Students;

use App\Http\Requests\Request;

class SubmitSchedulePostRequest extends Request
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
            'sample' => ['required', 'string', 'max:128'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }

    /**
     *  バリデーション項目名定義
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'sample' => 'サンプル',
        ];
    }
}

