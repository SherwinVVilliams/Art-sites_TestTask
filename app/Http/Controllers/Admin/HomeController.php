<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Config;

class HomeController extends AdminController
{
    private $table_content = false;

    public function __construct()
    {   
        parent::__construct();
        //$this->sidebar_position = 'no';
    }


    public function index($table = 'article')
    {  
        app()->setLocale(session()->get('lang') ? session()->get('lang') : config()->get('setting.language'));
        $result = view($this->getTableContent($table), ['items' => $this->table_content])->render();

        $this->content = view('admin.home', ['table' => $result])->render();
        $this->sidebar = view('admin.sidebar')->render();

        return $this->renderOutput();
    }

    private function getTableContent($table){
        if($table == 'article'){
            $this->table_content = $this->getArticles();
            $this->table_content->load('user');

            return 'admin.tables.article_table';
        }

        $this->table_content = $this->getCategories();
        $this->table_content->load('articles');

        return 'admin.tables.category_table';
    }

    public function changeLang($lang){
         if($lang == 'ru' | $lang == 'en'){
            session()->put('lang', $lang);
        }

        return redirect(url()->previous());
    }

}

?>