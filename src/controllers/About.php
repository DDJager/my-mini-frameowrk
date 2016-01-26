<?php

namespace Src\Controllers;

class About extends BaseController
{
	public function show()
	{
		$data = ["name" => $this->request->getParameter("name", "stranger")];
		$html = $this->renderer->render("About", $data);
        $this->response->setContent($html);
	}
}