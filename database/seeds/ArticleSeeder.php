<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
        	[
        		'image' => '{"mini": "no-image-mini.jpg", "max" : "no-image-max.jpg", "path":"no-image-path.jpg"}', 
        		'views' => 0,
        	],
        	[
        		'image' => '{"mini": "no-image-mini.jpg", "max" : "no-image-max.jpg", "path":"no-image-path.jpg"}', 
        		'views' => 0,
        	],
        	[
        		'image' => '{"mini": "no-image-mini.jpg", "max" : "no-image-max.jpg", "path":"no-image-path.jpg"}', 
        		'views' => 0,
        	],
        	[
        		'image' => '{"mini": "no-image-mini.jpg", "max" : "no-image-max.jpg", "path":"no-image-path.jpg"}', 
        		'views' => 0,
        	],
        	[
        		'image' => '{"mini": "no-image-mini.jpg", "max" : "no-image-max.jpg", "path":"no-image-path.jpg"}', 
        		'views' => 0,
        	],
        ]);
    }
}
