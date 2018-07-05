<?php 

namespace Rvmehta745\Filemanager;

Class Filemanager
{
	public function upload($file,$model,$variation=false)
	{
		$this->move($file,$model,$variation);
	}

	public function tmp_path($file)
	{
		return public_path()."/tmp/$file";
	}

	public function tmp_url($file)
	{
		return asset("tmp/$file");
	}

	public function upload_path($file, $model, $variation=false) 
	{
		$folder = "/uploads/". ( empty($variation) || $variation =='original' ? $model : "{$model}-{$variation}" ); 
		if (!is_array($variation) && !file_exists(public_path().$folder)) 
			@mkdir(public_path().$folder, 0777, true);
		$target_path = public_path()."$folder/$file";
		return $target_path;
	}
	public function upload_url($file, $model, $variation=false)
	{
		$folder = "/uploads/". ( empty($variation)  || $variation =='original' ? $model : "{$model}-{$variation}" );
		if(!empty($file)) 
			return asset("$folder/$file");
		return false;
	}

	public function get_filename($file)
	{
		if(is_file($file))
		{
			$target_file = $this->tmp_path($file->getClientOriginalName());
			move_uploaded_file($file->getRealPath(), $target_file);
			$file = $file->getClientOriginalName();
		}
		return $file;
	}


    /**
     * Upload image to destination
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  string $status
     */
	public function move($file,$model,$variation=false) {
		$file = $this->get_filename($file);
		$source = $this->tmp_path($file);
		$target = $this->upload_path($file,$model,$variation);
		copy($source, $target);
		unlink($source);
	}

}