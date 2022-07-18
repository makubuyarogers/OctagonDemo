<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id'=>1,
                'first_name'=>'Makubuya',
                'last_name'=>'Rogers',
                'phone_number'=>'+256703178665',
                'password'=>bcrypt('rogers123'),
                'created_at'=>'2022-05-03 11:39:34',
                'updated_at'=>'2022-05-03 11:39:34'
            ),
        ));
    }
}
