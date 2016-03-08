<?php

class HomeController extends BaseController {

	protected $layout='website/template';

	public function getIndex()
	{
		return Redirect::to('website/home/index');
	}

	public function getDownload(){
    //PDF file is stored under project/public/download/info.pdf
    $file= base_path(). "/uploads/".$_GET['filename'];
    $headers = array(
      'Content-Type: application/pdf',
    );
  	return Response::download($file, $_GET['filename'], $headers);
	}

}
