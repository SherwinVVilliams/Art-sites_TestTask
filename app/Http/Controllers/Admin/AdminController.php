<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Config;

use App\Article;
use App\Category;

class AdminController extends Controller
{
    protected $content;
    protected $sidebar_position = 'yes';
    protected $sidebar;
    protected $header;
    protected $footer;
    protected $template;
    protected $navigation;

    protected $vars = array();
    protected $project_folder ;

    public function __construct(){
        app()->setLocale(session()->get('lang') ? session()->get('lang') : 'ru');
        $this->project_folder = Config::get('setting.admin_folder_name');
        $this->template = 'admin.template';
    }

    protected function RenderOutput(){
        if(!$this->header){
            $this->header = view('admin.header', [
                'folder_name' => $this->project_folder,
                'title' => Config::get('setting.site_title'),
            ])->render();
        }

        if(!$this->footer){
            $this->footer = view('admin.footer')->render();
        }

        $this->sidebar = $this->sidebar_control();

        $this->add_vars($this->sidebar, 'sidebar');
        $this->add_vars($this->footer, 'footer');
        $this->add_vars($this->header, 'header');
        $this->add_vars($this->content, 'content');


        return view($this->template, $this->vars);
    }

    protected function sidebar_control(){
        if($this->sidebar_position == 'no'){
            $this->sidebar = '';
        }

        return $this->sidebar;
    }

    protected function add_vars($item, $item_name){

        if(is_array($item)&& is_array($item_name)){
            
            for($i =0; $i < count($item); $i++){

                $this->vars = array_add($this->vars, $item_name[$i], $item[$i]);

            }
        }
        elseif(!is_array($item) && !is_array($item_name)){

            $this->vars = array_add($this->vars, $item_name, $item);

        }
        else{
            throw new \Exception('Неудалось добавить данные');
        }
    }

    protected function getArticles($select = '*',  $take = false, $paginate = false, $where = false ){

        $result = Article::select($select);

        if($take){
            $result->take($take);
        }

        if(is_array($where) && count($where) == 2){
            $result->where($where[0], $where[1]);
        }

        if($paginate){
            return $this->check($result->paginate($paginate));
        }

        return $this->check($result->get());
    }

    protected function getCategories($select = '*', $take = false){

        $result = Category::select($select);

        if($take){
            $result->take($take);
        }

        return $result->get();
    }

    protected function check($result){
        if($result->isEmpty()){
            return false;
        }

        $result->transform(function($item, $key) {
            if(is_string($item->image) && is_object(json_decode($item->image)) && json_last_error() == JSON_ERROR_NONE){
                $item->image = json_decode($item->image);
            }

            return $item;
        });// декодіруємо json формат в полі картинки, якщо це не потрібно то нічого не зробимо
        return $result;
    }

}

