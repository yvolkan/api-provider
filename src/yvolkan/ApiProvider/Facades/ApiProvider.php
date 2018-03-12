<?php

namespace yvolkan\ApiProvider\Facades;

use Illuminate\Support\Facades\Facade;

class ApiProviderFacade extends Facade
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