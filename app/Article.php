<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Article extends Model
{
	use Translatable;

    public $translationModel = 'App\ArticleTranslation';

    protected $translatedAttributes = ['title', 'description', 'text'];

    protected $table = 'articles';

    protected $fillable = ['image', 'user_id'];

    public function categories(){
    	return $this->belongsToMany('App\Category', 'article_category', 'article_id', 'category_id');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function articleDetach($array_items){
        if($array_items){
            $this->categories()->detach();
            $this->categories()->attach($array_items);
        }
        else{
            $this->categories()->detach();
        }
    }

}
