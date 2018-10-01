<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use Auth;
use Image;
use DB;
use Response;

use App\Http\Repositories\ArticleRepository;
use App\Http\Repositories\ImageRepository;

use App\Article;
use App\Category;

use App\Http\Requests\ArticleRequest;


class ArticleController extends AdminController
{
    private $art_rep; 
    private $art_img;

    public function __construct(ArticleRepository $art, ImageRepository $img)
    {
        parent::__construct();
        $this->art_rep = $art;
        $this->art_rep->setImageRepository($img);

        $this->art_img = $this->art_rep->getImageRepository();

        $this->project_folder = config('setting.admin_operation_folder').'.articles';
    }

    public function create()
    {   
        $categories = Category::all();
        $locales = config()->get('translatable.locales');

        $this->content = view($this->project_folder.'/create', ['categories' => $categories, 'locales' => $locales]);
        $this->sidebar = view('admin.sidebar');

        return $this->renderOutput();
    }

    public function store(ArticleRequest $request)
    {
        $values = $request->except('_token', 'image','categories', 'language');
        $data['user_id'] = auth()->user()->id;
        $data['image'] = $this->art_img->getImageName();

        $article = Article::create($data);

        $article->fill([$request->language => $values]);

        $article->categories()->attach($request->categories);

        $article->save();

        return redirect()->route('admin.home');

    }


    public function store_async_images(Request $request){
        if($request->method('ajax'))
        {
            if($request->hasFile('img'))
            {
                $this->art_img->setImage($request->file('img'));

                $this->art_img->checkOldImages();
                return $this->art_img->asyncImagesUpload();
            }
        }
    }

    public function edit($id, $lang)
    {
        $article = Article::findOrFail($id);
        $article->setDefaultLocale($lang);
        $article->image = json_decode($article->image);
        $categories = Category::all();

        $this->content = view($this->project_folder.'/edit', ['article' => $article, 'categories' => $categories, 'lang' => $lang]);
        $this->sidebar = view('admin.sidebar');

        return $this->renderOutput();
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $values = $request->except('_token', 'image','categories');
        $article->setDefaultLocale($values['language']);

        if($request->file('image'))
        {
            $old_images = json_decode($article->image);
            $this->art_img->checkNoImage((array)$old_images);
            $article->image = $this->art_img->getImageName();
        }

        $article->fill([$request->language => $values]);

        $article->save();

        $article->articleDetach($request->categories);

        return redirect()->route('admin.home');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $image = json_decode($article->image);
        $this->art_img->checkNoImage((array)$image);

        $article->categories()->detach();
        $article->delete();

        return redirect()->route('admin.home');
    }


}
