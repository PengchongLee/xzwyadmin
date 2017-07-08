<?php 
namespace app\controllers;
use app\common\components\BaseController;

use app\models\Company;



class DefaultController extends BaseController
{
    public $layout = "web";

	public function actionIndex()
	{

        $data = Company::find()->orderBy("create_time DESC")->asarray()->one();
		return $this->render( "index" ,['data'=>$data]);

	}
}


 ?>