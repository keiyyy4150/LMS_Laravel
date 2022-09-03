<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $params = [
            [
                'course_name' => '高3文系コース'
            ],
            [
                'course_name' => '高3理系コース'
            ],
            [
                'course_name' => '高3AO入試対策コース'
            ],
        ];

        foreach($params as $param) {
            DB::table('courses')->insert($param);
        }
    }
}
