<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class UsersTableSeeder extends Seeder
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
                'role' => 1,
                'images' => 'プロフィール画像',
                'name' => '管理者サンプル',
                'kana' => 'カンリシャサンプル',
                'tel' => '09012345678',
                'email' => 'sample@sample.com',
                'password' => bcrypt('12345678'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach($params as $param) {
            DB::table('users')->insert($param);
        }
    }
}
