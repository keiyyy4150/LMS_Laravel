<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'question_number' => '00000000000001',
            'questioners_id' => 2,
            'subject' => '1',
            'category' => '1',
            'title' => 'これはテストデータです',
            'question' => 'これはテストデータです。ここに質問事項が入ります。',
            'status' => 0,
            'answer_deadline' => '2023-5-5',
        ]);
    }
}
