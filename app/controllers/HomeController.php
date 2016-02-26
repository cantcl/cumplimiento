<?php

class HomeController extends BaseController {

	protected $layout='website/template';

	public function getIndex()
	{
		return Redirect::to('website/home/index');
	}

}
