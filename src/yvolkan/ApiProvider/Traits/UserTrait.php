<?php

namespace YVolkan\ApiProvider\Traits;

Trait UserTrait
{

	public function authenticate($parameters = [])
	{
		return $this->post('users/authenticate', array_merge($parameters, [
			'username' => $this->config['API_USERNAME'],
			'password' => $this->config['API_PASSWORD'],
		]));
	}

}