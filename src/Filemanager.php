<?php 

namespace Rvmehta745\Filemanager;

Class Filemanager
{

	public function init($file)
	{
		return asset("tmp/$file");
	}

}