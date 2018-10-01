<?php 

namespace App\Http\Repositories;

use Image;
use Response;

class ImageRepository
{
	private $image;
	private $images_name;
	private $images_resolution;
	private $checked = false;

	public $image_folder;

	private $filename;
	private $ext;

	public function setImageFolder($data){
		$this->image_folder = $data;
	}

	public function setFilename($data){
		$this->filename = $data;
	}

	public function setImage($image)
	{
		$this->image = $image;
		$this->ext = $image->getClientOriginalExtension();
		$this->filename = md5(date('Y-m-d_h-i-s'));
	}

	public function setNameAndResolution($name, $resolution)
	{
		if(!$this->checked){
			$this->check($name, $resolution);
		}
		else{
			$this->images_name = $name;
			$this->images_resolution = $resolution;
		}
	}

	protected function check($data_names, $data_resol)
	{	
		if(is_array($data_names)&&is_array($data_resol))
			$this->checkInputData($data_names, $data_resol);
		else
			throw new \Exception("Incorrect inputs, data should be (array, array(array(integer, integer)))");
	}

	protected function checkInputData($data_names, $data_resol)
	{
		if(count($data_names) != count($data_resol))
			throw new \Exception("Arrays should be the same length");

		for($i = 0; $i<count($data_names);$i++)
		{
			if(!is_string($data_names[$i]))
				throw new \Exception('Names values should be the string type');

			for($j = 0; $j<count($data_resol[$i]); $j++)
			{
				if(!is_array($data_resol[$i]) | count($data_resol[$i]) != 2 | !is_integer($data_resol[$i][$j]))
					throw new \Exception('Resolution values should be the [integer, integer] type');
			}
			
		}
		
		$this->checked = true;
		$this->setNameAndResolution($data_names, $data_resol);	
	}

	protected function validInput()
	{
		if($this->checked&&isset($this->image_folder)&&isset($this->image))
		{
			return true;
		}

		throw new \Exception('Need to set image: name, resolution and folder');
	}

	public function asyncImagesUpload()
	{
		$this->validInput();

		if(is_array($this->images_name)){
			return $this->loadDataImages($this->image);
		}
    }

    protected function loadDataImages($image)
    {
    	$dir_path = $this->image_folder.'/';

    	$return_array = array();

    	for($i = 0; $i<count($this->images_name); $i++)
    	{	
    		$path = $dir_path.$this->filename.'-'.$this->images_name[$i].'.'.$this->ext;

    		$return_array[$this->images_name[$i]] = '/'.$dir_path.$this->filename.'-'.$this->images_name[$i].'.'.$this->ext;

    		$this->makeImage($image, $this->images_resolution[$i], $path);
    	}

    	$this->setSessionValues();

    	return Response::json($return_array);
    }

    private function makeImage($image, $resolution, $path)
    {
    	Image::make($image)->fit($resolution[0], $resolution[1])->save($path);
    }


    public function getImageName()
    {
    	if(session()->has('old_image_name'))
    		return json_encode($this->getArrayImagesName(session()->get('old_image_name'), session()->get('old_image_ext')));

        return json_encode($this->getArrayImagesName('no-image', 'jpg'));
    }

    protected function getArrayImagesName($filename, $ext)
    {
    	$data = array();

    	$this->forgetSessionValues();

    	for($i = 0; $i<count($this->images_name); $i++)
    	{
            $data[$this->images_name[$i]] = $filename.'-'.$this->images_name[$i].'.'.$ext;
        }

        return $data;
    }


    public function checkOldImages()
    {
    	if(session()->has('old_image_name')){
	    	for($i = 0; $i<count($this->images_name);$i++)
	        {
	            $image_path = $this->image_folder.'/'.session()->get('old_image_name').'-'.$this->images_name[$i].".".session()->get('old_image_ext');

	           	$this->deleteImage($image_path);
	        }
    	}
    }

    private function setSessionValues()
    {
    	session()->put('old_image_name', $this->filename);
    	session()->put('old_image_ext', $this->ext);
    }

    private function forgetSessionValues(){
    	session()->forget('old_image_name');
        session()->forget('old_image_ext');
    }

    public function checkNoImage($old)
    {
		if($old['mini'] != 'no-image-mini.jpg')
		{
	        for($i = 0; $i<count($this->images_name); $i++){
	            $this->deleteImage($this->image_folder.'/'.$old[$this->images_name[$i]]);
	        }
	    }
    }

    private function deleteImage($img_path)
    {
        $path = public_path($img_path);
        if(file_exists($path)){
            unlink($path);
        }
    }

}

?>