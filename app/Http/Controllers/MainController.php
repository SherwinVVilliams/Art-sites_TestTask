<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Config;

use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\ImageRepository;

class MainController extends Controller
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
		$this->project_folder = Config::get('setting.project_folder_name');
		$this->template = 'site.template';
	}

	protected function varsVariables()
	{
		$this->add_vars($this->sidebar, 'sidebar');
    	$this->add_vars($this->footer, 'footer');
    	$this->add_vars($this->navigation, 'navigation');
		$this->add_vars($this->header, 'header');
		$this->add_vars($this->content, 'content');
	}

	protected function RenderOutput(){

		if(!$this->header){
    		$this->header = view('site.header', [
    			'folder_name' => $this->project_folder,
    			'title' => Config::get('setting.site_title'),
    		])->render();
        }

        if(!$this->navigation){
        	$this->navigation = view('site.navigation', ['folder_name' => $this->project_folder])->render();
        }

        if(!$this->footer){
    		$this->footer = view('site.footer')->render();
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

}
