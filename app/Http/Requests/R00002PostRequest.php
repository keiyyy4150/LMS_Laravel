<?php
/**
 * xxxx画面/内部処理リクエスト
 * @copyright 株式会社クイックサーブ All Rights Reserved
 * @author 作成者名 <email@example.com>
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
            'acupuncture_incorporation_division' => ['nullable'],
            'inclusion_contract_name' => ['required', 'string', 'max:128'],
            // 'suppliers_code' => ['nullable', 'integer'], // 現時点で未実装
            // 'customer_code' => ['nullable', 'integer'], // 現時点で未実装
            'voyage_name' => ['sometimes', 'required', 'string', 'max:128'],
            'contract_application_period_from' => ['required', 'date_format:y/m/d', 'before:today'],
            'contract_application_period_to' => ['required', 'date_format:y/m/d', 'before_or_equal:today'],
            // 'contract_applicable_period_from' => ['sometimes', 'required', 'date_format:y/m/d', 'before:today'],
            // 'contract_applicable_period_to' => ['sometimes', 'required', 'date_format:y/m/d', 'before_or_equal:today'],
            'deal_total_quantity' => ['sometimes', 'required'],
            'deal_total_weight' => ['required'],
            'approximation_money' => ['sometimes', 'required'],
            'month_sale_selling_expected_amount' => ['sometimes', 'required'],
            'currency_division' => ['required'],
            'extreme_num' => ['nullable', 'integer'],
            'merchandise_code' => ['nullable', 'integer'],
            'merchandise_name' => ['nullable'],
            'warehouse_code' => ['nullable', 'integer'],
            'logical_warehouse_code' => ['nullable', 'integer'],
            'stock_lower_limit_quantity' => ['nullable', 'numeric', 'lte:stock_upper_limit_quantity'],
            'stock_upper_limit_quantity' => ['nullable', 'numeric', 'gte:stock_lower_limit_quantity']
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
     *  バリデーション項目名定義(一旦こちらに記載)
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'acupuncture_incorporation_division' => '見越組入要否',
            'inclusion_contract_name' => '包括契約名',
            'suppliers_code' => '仕入先',
            'customer_code' => '得意先',
            'voyage_name' => '航海名',
            'contract_application_period_from' => '包括契約期間開始日',
            'contract_application_period_to' => '包括契約期間終了日',
            'deal_total_quantity' => '取引総数量',
            'deal_total_weight' => '取引総重量',
            'approximation_money' => '概算金額',
            'month_sale_selling_expected_amount' => '月間販売見込額',
            'currency_division' => '通貨区分',
            'extreme_num' => '極度No.',
            'merchandise_code' => '商品コード',
            'merchandise_name' => '商品名',
            'warehouse_code' => '倉庫コード',
            'logical_warehouse_code' => '論理倉庫コード',
            'stock_lower_limit_quantity' => '在庫下限',
            'stock_upper_limit_quantity' => '在庫上限'
        ];
    }
}
