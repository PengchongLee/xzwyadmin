<?php 
namespace app\controllers;
use app\common\components\BaseController;

use app\models\XzwyCompany;

class DefaultController extends BaseController
{
    public $layout = "web";

	public function actionIndex()
	{

        $data = XzwyCompany::find()->orderBy("create_time DESC")->asarray()->one();
		return $this->render( "index" ,['data'=>$data]);

	}
}


 ?>