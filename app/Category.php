<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Category extends Model
{
	protected $table = 'categories';

	protected $fillable = ['name'];
    
    public function articles(){
    	return $this->belongsToMany('App\Article', 'article_category','category_id', 'article_id');
    }
}
