<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use Config;

class SiteController extends MainController
{

    public function __construct(){
        parent::__construct();
        session()->put('lang' , Config::get('setting.language'));
    }

    public function index(){
        
        app()->setLocale(session()->get('lang'));
    	$articles = $this->getArticles('*', false ,Config::get('setting.article_pagination'));
    	$articles->load('categories', 'user');

    	$articles_sidebar = $this->getArticles("*", Config::get('setting.articles_sidebar'), false, false, 'id');
    	$categories_sidebar = $this->getCategories("*", Config::get('setting.categories_sidebar'));

    	$this->content = view('site.content', [
            'articles' => $articles,
            'folder_name' => $this->project_folder
        ])->render();

    	$this->sidebar = view('site.sidebar',[
            'categories' => $categories_sidebar,
            'articles' => $articles_sidebar,
            'folder_name' => $this->project_folder])->render();

    	return $this->renderOutput();
    }

    public function single($id){

        app()->setLocale(session()->get('lang'));
    	$article =Article::where('id',$id)->first();
    	if($article){
            $article->image = json_decode($article->image);
        }

    	$articles_sidebar = $this->getArticles("*", Config::get('setting.articles_sidebar'), false, false, 'id');
    	$categories_sidebar = $this->getCategories("*", Config::get('setting.categories_sidebar'));

    	$this->content = view('site.content_single', [
    		'article' => $article,
    		'folder_name' => $this->project_folder,
    	])->render();

    	$this->sidebar = view('site.sidebar',[
    		'categories' => $categories_sidebar,
    		'articles' => $articles_sidebar,
    		'folder_name' => $this->project_folder,
    	])->render();

    	return $this->renderOutput();
    }

    public function category(){

        app()->setLocale(session()->get('lang'));
    	$categories = $this->getCategories();

    	$articles_sidebar = $this->getArticles("*", Config::get('setting.articles_sidebar'), false, false, 'id');
    	$categories_sidebar = $this->getCategories("*", Config::get('setting.categories_sidebar'));

    	$this->content = view('site.categories', [
    		'categories' => $categories
    	]);
    	$this->sidebar = view('site.sidebar',[
    		'categories' => $categories_sidebar,
    		'articles' => $articles_sidebar,
    		'folder_name' => $this->project_folder,
    	])->render();

    	return $this->renderOutput();
    }

    public function category_single($id){

        app()->setLocale(session()->get('lang'));
    	$articles = $this->getArticles();
    	$articles->load('categories', 'user');

    	$articles_sidebar = $this->getArticles("*", Config::get('setting.articles_sidebar', false, false, 'id'));
    	$categories_sidebar = $this->getCategories("*", Config::get('setting.categories_sidebar'));

    	$this->content = view('site.category_single', [
    		'articles' => $articles,
    		'folder_name' => $this->project_folder,
    		'id' => $id,
    	])->render();

    	$this->sidebar = view('site.sidebar',[
    		'categories' => $categories_sidebar,
    		'articles' => $articles_sidebar,
    		'folder_name' => $this->project_folder,
    	])->render();

    	return $this->renderOutput();
    }

    public function changeLang($lang){
        if($lang == 'ru' | $lang == 'en'){
            session()->put('lang', $lang);
        }

        return redirect(url()->previous());
    }


    

}
