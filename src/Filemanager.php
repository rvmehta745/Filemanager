<?php 

namespace Rvmehta745\Filemanager;

Class Filemanager
{

	public function upload($file,$model,$variation=false,$source=false)
	{
		$this->upload_move($file,$model,$variation,$source);
	}

	public function tmp_path($file)
	{
		return public_path()."/tmp/$file";
	}

	public function tmp_url($file)
	{
		return asset("tmp/$file");
	}

	public function upload_path($file, $model, $variation=false, $relative=null) 
	{
		$use_aws = is_null($relative)? env('AWS_STATUS',false) : $relative;
		$folder = "/uploads/". ( empty($variation) || $variation =='original' ? $model : "{$model}-{$variation}" ); 

		if (!$use_aws && !is_array($variation) && !file_exists(public_path().$folder)) 
		{
			umask(0);
			@mkdir(public_path().$folder, 0777, true);
		}
		$target_path = ($use_aws? "" : public_path()) ."$folder/$file";
		return $target_path;
	}
	public function upload_url($file, $model, $variation=false)  {
		$use_aws = env('AWS_STATUS',false);
		$folder = "/uploads/". ( empty($variation)  || $variation =='original' ? $model : "{$model}-{$variation}" );
		if(!empty($file)) 
		{
			if($use_aws)
				return env('AWS_S3_HOST')."$folder/$file";
			else
				return asset("$folder/$file");
		} 
		return false;
	}
	public function upload_move($file,$model,$variation=false,$source=false) {
		$use_aws = env('AWS_STATUS',false);
		$source = $source ? $source : $this->tmp_path($file);
		$target = $this->upload_path($file,$model,$variation);
		if($use_aws) {
			$s3 = AWS::createClient('s3');
			$s3->putObject(array(
				'Bucket'     => env('AWS_S3_BUCKET'),
				'Key'        => $target,
				'SourceFile' => $source,
				'ACL'    => 'public-read'
			));
		} else {
			copy($source, $target);
		}
	}

}