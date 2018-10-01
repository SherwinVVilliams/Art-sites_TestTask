<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Config;

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

    public function __construct()
    {   
        $this->project_folder = Config::get('setting.admin_folder_name');
        $this->template = 'admin.template';
    }

    protected function varsVariables()
    {
        $this->add_vars($this->sidebar, 'sidebar');
        $this->add_vars($this->footer, 'footer');
        $this->add_vars($this->header, 'header');
        $this->add_vars($this->content, 'content');
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

        $this->varsVariables();

        return view($this->template, $this->vars);
    }

    protected function sidebar_control(){
        if($this->sidebar_position == 'no'){
            $this->sidebar = '';
        }

        return $this->sidebar;
    }

    protected function add_vars($item, $item_name){

        if(is_array($item)&& is_array($item_name))
        {
            for($i =0; $i < count($item); $i++)
            {
                $this->vars = array_add($this->vars, $item_name[$i], $item[$i]);
            }
        }
        elseif(!is_array($item) && !is_array($item_name))
        {
            $this->vars = array_add($this->vars, $item_name, $item);
        }
        else{
            throw new \Exception('Неудалось добавить данные');
        }
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

