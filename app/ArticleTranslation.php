<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class ArticleTranslation extends Model
{
    protected $table = 'articles_translations';

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'text'];

}
