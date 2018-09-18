<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ArticleSeeder::class);
         $this->call(СategorySeeder::class);
         $this->call(ArticleCategorySeeder::class);
         $this->call(ArticleTranslatableSeeder::class);
    }
}
