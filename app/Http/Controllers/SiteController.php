<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Category;


use App\Http\Repositories\ArticleRepository;
use Config;

class SiteController extends MainController
{
    private $art_rep;

    public function __construct(ArticleRepository $art){
        parent::__construct();
        $this->art_rep = $art;
    }

    public function index()
    {   
    	$articles = $this->art_rep->check(Article::translatedIn(app()->getLocale())->paginate(Config::get('setting.article_pagination')));

    	$articles->load('categories', 'user');

    	$articles_sidebar = $this->art_rep->check(Article::translatedIn(app()->getLocale())->take(Config::get('setting.articles_sidebar'))->orderBy('id', 'desc')->get());
    	$categories_sidebar = Category::select()->take(Config::get('setting.categories_sidebar'))->get();

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

    	$article = Article::find($id);

    	if($article){
            $article->image = json_decode($article->image);
        }

    	$articles_sidebar = $this->art_rep->check(Article::translatedIn(app()->getLocale())->take(Config::get('setting.articles_sidebar'))->orderBy('id', 'desc')->get());
    	$categories_sidebar = Category::select()->take(Config::get('setting.categories_sidebar'))->get();

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

    public function category()
    {
    	$categories = Category::all();

    	$articles_sidebar = $this->art_rep->check(Article::translatedIn(app()->getLocale())->take(Config::get('setting.articles_sidebar'))->orderBy('id', 'desc')->get());
    	$categories_sidebar = Category::select()->take(Config::get('setting.categories_sidebar'))->get();

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

    public function category_single($id)
    {
    	$articles = $this->art_rep->check(Article::all());
    	$articles->load('categories', 'user');

        $articles_sidebar = $this->art_rep->check(Article::translatedIn(app()->getLocale())->take(Config::get('setting.articles_sidebar'))->orderBy('id', 'desc')->get());
        $categories_sidebar = Category::select()->take(Config::get('setting.categories_sidebar'))->get();

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

    public function changeLang($lang)
    {    
        foreach(config()->get('translatable.locales') as $locale){
            if($lang == $locale){
                session()->put('lang', $lang); 
                break;
            }
        }

        return redirect(url()->previous());
    }

}
