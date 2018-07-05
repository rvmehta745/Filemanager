<?php

namespace Rvmehta745\Filemanager\Facades;

use Illuminate\Support\Facades\Facade;

Class Filemanager extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
	protected static function getFacadeAccessor()
	{
		return 'filemanager';
	}
}