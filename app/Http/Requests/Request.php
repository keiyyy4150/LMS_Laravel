<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class Request extends FormRequest
{
    /**
     * @var array 数字フィルド
     */
    protected $numbers = [];

    /**
     * @var array 日付フィルド
     */
    protected $dates = [];

    protected function getDeptCode()
    {
        return Str::after($this->route()->originalParameter('d'), 'd');
    }
}
