<?php 

namespace Rvmehta745\Filemanager;

Class Filemanager
{

	public static function init($file)
	{
		return asset("tmp/$file");
	}

}