<?php

namespace Bcash\Service;

interface IHttpService
{

	public function post($url, $params, $auth);

}
