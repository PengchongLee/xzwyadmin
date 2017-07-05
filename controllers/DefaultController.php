<?php 
namespace app\controllers;
use app\common\components\BaseController;

class DefaultController extends BaseController
{
    public $layout = "web";

	public function actionIndex()
	{
		return $this->render( "index" );
	}
}


 ?>