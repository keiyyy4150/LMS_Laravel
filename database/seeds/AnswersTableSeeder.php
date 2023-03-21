<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            'question_number' => '00000000000001',
            'answer_number' => '00000000000001',
            'answerers_id' => 3,
            'answer' => 'これは質問（テストデータ）に対する回答（テストデータ）です。'
        ]);
    }
}
