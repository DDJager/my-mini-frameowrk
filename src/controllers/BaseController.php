<?php

namespace Src\Controllers;

abstract class BaseController
{
	/**
	 * \Http\Response object 
	 * @var $response
	 */
	protected $response;

	/**
	 * Constructs a dependecy injection of the Response interface
	 * @param \Http\Response $response 	
	 */
	public function __construct(\Http\Response $response)
	{
		$this->response = $response;
	}
}