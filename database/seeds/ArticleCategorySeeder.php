<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_category')->insert([
        	[
        		'article_id' => 1,
        		'category_id' => 1,
        	],
        	[
        		'article_id' => 1,
        		'category_id' => 2,
        	],
        	[
        		'article_id' => 2,
        		'category_id' => 1,
        	],
        	[
        		'article_id' => 3,
        		'category_id' => 1,
        	],
        	[
        		'article_id' => 4,
        		'category_id' => 1,
        	],
        	[
        		'article_id' => 5,
        		'category_id' => 2,
        	],

        ]);
    }
}
