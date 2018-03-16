<?php

namespace YVolkan\ApiProvider\Facades;

use Illuminate\Support\Facades\Facade;

class ApiProvider extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
        return 'apiProvider';
    }
}