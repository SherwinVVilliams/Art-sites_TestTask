<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Article;
use App\Category;


use App\Http\Repositories\ArticleRepository;
use Config;

class HomeController extends AdminController
{
    private $table_content = false;
    private $art_rep;

    public function __construct(ArticleRepository $art)
    {   
        parent::__construct();
        $this->art_rep = $art;
    }


    public function index($table = 'article')
    {  
        $result = view($this->getTableContent($table), ['items' => $this->table_content])->render();

        $this->content = view('admin.home', ['table' => $result])->render();
        $this->sidebar = view('admin.sidebar')->render();

        return $this->renderOutput();
    }

    private function getTableContent($table)
    {
        /*$res = 'App\\' . studly_case(str_singular('Article'));
        if(class_exists($res)){
            dd($res);
        }*/
        if($table == 'article'){

            $articles = Article::all();
            $this->table_content = $this->art_rep->check($articles);
            $this->table_content->load('user');

            return 'admin.tables.article_table';
        }

        $this->table_content = Category::all();
        $this->table_content->load('articles');

        return 'admin.tables.category_table';
    }


}

?>