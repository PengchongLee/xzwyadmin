<?php 
namespace app\controllers;

use Yii;
use app\controllers\DefaultController;

class CarouselimgController extends DefaultController
{
	
	public function actionList()
	{
		$command = (new \yii\db\Query())
             ->select("*")
             ->from('xzwy_lunbo')
             ->where(['is_delete' => 1])
             ->orderBy('create_time DESC')
             ->createCommand();
        $data = $command->queryAll();
		return $this->render( "index" ,['data'=>$data]);
	}

	public function actionAddimg()
	{
		$state = Yii::$app->request->get('state');
		$pic_link = Yii::$app->request->get('img');
		$time = date('Y-m-d H-i-s');
		$data = [
           'pic_link'  => $pic_link,
           'status' => $state,
           'create_time' => $time,
		];
		$res = Yii::$app->db->createCommand()->insert('xzwy_lunbo',$data)->execute();
		if($res){
			$id = Yii::$app->db->getLastInsertID();
			echo $id;
		}else{
			echo 0;
		}
	}

     public function actionDelimg()
     {
     	$id = Yii::$app->request->get('id');
     	$res = Yii::$app->db->createCommand()->update('xzwy_lunbo', ['is_delete' => 0], "pic_id = $id")->execute();
		if($res){
			echo 1;
		}else{
			echo 0;
		}
     }



}


 ?>