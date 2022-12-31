<?php
/**
 * 生徒用ホーム画面リクエスト
 * @copyright 鍋田 All Rights Reserved
 * @author K.Nabeta <keike312yms@outlook.jp>
 */

namespace App\Http\Requests\S00;

use App\Http\Requests\Request;

class R00002PostRequest extends Request
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
            //
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
            //
        ];
    }
}
