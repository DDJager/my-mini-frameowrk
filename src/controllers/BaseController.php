<?php

namespace Src\Controllers;

abstract class BaseController
{
	/**
	 * \Http\Response object 
	 * 
	 * @var Response
	 */
	protected $response;

	/**
	 * \Http\Request object 
	 * 
	 * @var Request
	 */
	protected $request;

	/**
	 * \Src\Template\Renderer interface
	 * 
	 * @var Renderer
	 */
	protected $renderer;

	/**
	 * Constructs a dependecy injection
	 * 
	 * @param 	\Http\Response 	$response 	
	 * @param 	\Http\Request   $request 	
	 */
	public function __construct(\Http\Response $response, \Http\Request $request, \Src\Template\Renderer $renderer)
	{
		$this->response = $response;
		$this->request = $request;
		$this->renderer = $renderer;
	}
}