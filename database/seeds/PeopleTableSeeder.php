<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades_DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name'=>'tanaka',
            'mail'=>'tanaka@gmail.com',
            'age'=>12,
        ];
        DB::table('people')->insert($param);

        $param = [
            'name'=>'saitou',
            'mail'=>'saitou@gmail.com',
            'age'=>26,
        ];
        DB::table('people')->insert($param);

        $param = [
            'name'=>'taniguchi',
            'mail'=>'taniguchi@gmail.com',
            'age'=>40,
        ];
        DB::table('people')->insert($param);
    }
}
