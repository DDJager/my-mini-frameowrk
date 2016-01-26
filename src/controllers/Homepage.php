<?php

namespace Src\Controllers;

class Homepage extends BaseController
{
	public function show()
	{
		$data = ["name" => $this->request->getParameter("name", "stranger")];
		$html = $this->renderer->render("Homepage", $data);
        $this->response->setContent($html);
	}
}