<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answer_comments')->insert([
            'answer_number' => '00000000000001',
            'responders_id' => 2,
            'renponds' => 'これはテストデータ（回答）に対する返信欄のテストデータです。'
        ]);
    }
}
