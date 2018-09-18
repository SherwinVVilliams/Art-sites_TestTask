<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class СategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	[
        		'name' => 'Education'
        	],
        	[
        		'name' => 'Rest'
        	],
        ]);
    }
}
