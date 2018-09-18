<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use Auth;
use Image;
use DB;
use Response;

use App\Article;
use App\Category;

use App\Http\Requests\ArticleRequest;


class ArticleController extends AdminController
{
    private $folder_image = '\site\img\articles';

    private $img_names = array();
    private $img_resolution = array();

    public function __construct()
    {
        parent::__construct();
        $this->project_folder = config('setting.admin_operation_folder').'.articles';

        $this->img_names = ['mini', 'max', 'path', /*'test'*/];

        $this->img_resolution = [ 
            $this->img_names[0] => [70, 70],
            $this->img_names[1] => [245,245],
            $this->img_names[2] => [900, 525],
            /*$this->img_names[3] => [450, 450], //для теста */
        ];
    }

    public function index(){}

    public function create()
    {   
        app()->setLocale(session()->get('lang') ? session()->get('lang') : config()->get('setting.language'));
        $categories = $this->getCategories();
        $locales = config()->get('translatable.locales');

        $this->content = view($this->project_folder.'/create', ['categories' => $categories, 'locales' => $locales]);
        $this->sidebar = view('admin.sidebar');

        return $this->renderOutput();
    }

    public function store(ArticleRequest $request)
    {
        if($request->method('post')){
            $lang_values = $request->except('_token', 'image','categories', 'language');
            $data['user_id'] = auth()->user()->id;
            $data['image'] = $this->getImageName();
            $article = Article::create($data);

            $article->categories()->attach($request->categories);

            foreach ([$request->language] as $locale) {
                $article->translateOrNew($locale)->title = $lang_values['title'];
                $article->translateOrNew($locale)->text = $lang_values['text'];
                $article->translateOrNew($locale)->description = $lang_values['description'];
            }
            $article->save();

            return redirect()->route('admin.home');
        }

    }

    private function getImageName(){

        $data = array();

        if(session()->has('old_image_name')){
            for($i = 0; $i<count($this->img_names); $i++){
                $data[$this->img_names[$i]] = session()->get('old_image_name').'-'.$this->img_names[$i].'.'.session()->get('old_image_ext');
                $this->moveImages($data[$this->img_names[$i]]);
            }
            session()->forget('old_image_name');
            session()->forget('old_image_ext');
            session()->forget('old_image_user');
        }
        else{
            for($i = 0; $i<count($this->img_names); $i++){
                $data[$this->img_names[$i]] = 'no-image'.'-'.$this->img_names[$i].'.jpg';
            }
        }

        return json_encode($data);
    }

    private function moveImages($image_name){
        $old_path = public_path($this->folder_image.'/'.Auth::user()->id.'/'.$image_name);
        $new_path = public_path($this->folder_image.'/'.$image_name);
        if(file_exists($old_path)){
            rename($old_path, $new_path);
        }
    }

    public function store_async_images(Request $request){
        if($request->method('ajax')){
            if($request->hasFile('img')){
                $this->checkOldImages($request);
                echo $this->asyncThreeImagesUpload($request);
            }
        }
    }

    private function asyncThreeImagesUpload($request){

        $image = $request->file('img');

        $user = Auth::user()->id.'/';
        $filename = date('Y-m-d_h-i-s');
        $dir_path = public_path($this->folder_image.'/'.$user);
        $ext = $image->getClientOriginalExtension();

        $full_path_images = array();
        $return_array = array();
        $resol = $this->img_resolution;
        $names = $this->img_names;

        if(!is_dir($dir_path)){
            mkdir($dir_path);
        }

        for($i = 0; $i < count($names); $i++)
        {
            $path = $this->folder_image.'/'.$user.$filename.'-'.$names[$i].'.'.$ext;

            $full_path_images[$names[$i]] = public_path($path);
            $return_array[$this->img_names[$i]] = $path;

            Image::make($image)->fit($resol[$names[$i]][0],$resol[$names[$i]][1])->save($full_path_images[$names[$i]]);
        }

        session()->put('old_image_name', $filename);
        session()->put('old_image_ext', $ext);
        session()->put('old_image_user', $user);

        return Response::json($return_array);
    }

    private function checkOldImages($request){
        if(session()->has('old_image_name'))
        {
            for($i = 0; $i<count($this->img_names);$i++){

                $image_path = $this->folder_image.'/'.session()->get('old_image_user').session()->get('old_image_name').'-'.$this->img_names[$i].".".session()->get('old_image_ext');

                if(file_exists(public_path($image_path))){
                    unlink(public_path($image_path));
                }
            }

        }
    }

    public function show($id){}

    public function edit($id)
    {
        app()->setLocale(session()->get('lang') ? session()->get('lang') : config()->get('setting.language'));
        $article = Article::findOrFail($id);
        $article->image = json_decode($article->image);
        $categories = $this->getCategories();

        $this->content = view($this->project_folder.'/edit', ['article' => $article, 'categories' => $categories]);
        $this->sidebar = view('admin.sidebar');

        return $this->renderOutput();
    }

    public function update(ArticleRequest $request, $id)
    {
            $article = Article::findOrFail($id);
            $lang_values = $request->except('_token', 'image','categories');

            if($request->file('image')){
                $old_images = json_decode($article->image);
                $this->checkNoImage((array)$old_images);
                $article->image = $this->getImageName();
            }
            $article->save();
            $article->articleDetach($request->categories);
            $locales = [session()->get('language') ? session()->get('language') : 'en'];

            foreach ($locales as $locale) {
                $article->translate($locale)->title =  $lang_values['title'];
                $article->translate($locale)->text = $lang_values['text'];
                $article->translate($locale)->description = $lang_values['description'];
            }
            $article->save();

            return redirect()->route('admin.home');
    }

    /*private function articleDetach($array_items,Article $article){
        if($array_items){
            $article->categories()->detach();
            $article->categories()->attach($array_items);
        }
        else{
            $article->categories()->detach();
        }
    }*/

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $image = json_decode($article->image);
        $this->checkNoImage((array)$image);

        $article->categories()->detach();
        $article->delete();

        return redirect()->route('admin.home');
    }

    private function checkNoImage($old){
        if($old['mini'] != 'no-image-mini.jpg'){
            for($i = 0; $i<count($this->img_names); $i++){
               $this->deleteImage($old[$this->img_names[$i]]);
            }
        }
    }

    private function deleteImage($img_name){
        $path = public_path($this->folder_image.'/'.$img_name);
        if(file_exists($path)){
            unlink($path);
        }
    }

}
