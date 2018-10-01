<?php 

namespace App\Http\Repositories;

use App\Article;

use App\Http\Repositories\ImageRepository;


class ArticleRepository
{
	private $image_rep;

	public $image_names = ['mini', 'max', 'path'];
	public $images_resolution = [[70, 70], [245, 245], [950, 500]]; 
	public $image_folder = 'site/img/articles/';


	public function setImageRepository(ImageRepository $image_rep)
	{
		$this->image_rep = $image_rep;

		$this->image_rep->setImageFolder($this->image_folder);
		$this->image_rep->setNameAndResolution($this->image_names, $this->images_resolution);
	}

	public function getImageRepository()
	{
		return $this->image_rep;
	}


    public function check($result)
    {
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

?>