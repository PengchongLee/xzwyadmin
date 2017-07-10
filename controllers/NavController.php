<?php 
namespace app\controllers;
use Yii;
use app\common\components\BaseController;
use app\models\XzwyContent;
use app\models\XzwyImg;
use app\models\XzwyNav;
use yii\data\Pagination;

class NavController extends BaseController
{
	//导航展示
  	public function actionShow()
  	{	
  		$pages = new Pagination(['totalCount' =>XzwyNav::find()->count(),'pageSize' => '5']);
       	$model = XzwyNav::find()->offset($pages->offset)->limit($pages->limit)->all();

  		return $this->render( 'show' , ['pages' => $pages,'model' => $model] );
  	}

  	//导航添加
  	public function actionAdd()
  	{	
  		//判断是否有传值
  		if ( $post = yii::$app->request->post() ) 
  		{
  			//接值
	  		$post = yii::$app->request->post();

	  		//处理接受数据
	  		$nav_name 	= trim( $post['name'] );
	  		$nav_type 	= trim( $post['type'] );
	  		$nav_link 	= $post['name'] ;

	  		//添加
	  		$res  = Yii::$app->db->createCommand()->insert('xzwy_nav',array(  

	           'nav_name'    => $nav_name ,  

	           'nav_type'    => $nav_type ,

	           'is_delete'   => 0,

	           'create_time' => date('Y-m-d h:i:s'),

	           'update_time' => '',

	           'nav_link'    => $nav_link ,

	         ))->execute();

	  		//判断是否添加成功
	  		if ( $res ) {
	  			return $this->redirect(['nav/show']);
	  		}else{
	  			header("refresh:3;url=add");
	            die('<center><h1>添加失败</h1></center>');
	  		}
  		}else{

			return $this->render('add');
  		}
  	}

  	//导航单删除
  	public function actionDelete()
  	{
  		//接值
  		$id  = intval( yii::$app->request->post('id') );

  		$res = XzwyNav::deleteAll( ["nav_id"=> $id ]);
  		
  		//判断是否删除
		if ( $res ) {
			echo 1;
		}else{
			echo 0;
		}		

  	}

  	// 导航批删
  	public function actionDelall()
  	{
  		//接值
  		$ids  = trim( yii::$app->request->get('arr') ) ;

		$res = XzwyNav::deleteAll("nav_id in($ids)");

		//判断是否删除成功
		if ( $res ) 
		{
			return 1;
		}else{
			return 0;
		}

  	}

  	// 导航修改
  	public function actionUpdate()
  	{
  		// 接值
  		$nav_name = trim( yii::$app->request->get('val') );
  		$nav_id   = intval( yii::$app->request->get('id') );

  		// 修改
  		$result   = XzwyNav::find()->where(['nav_id'=>$nav_id])->one();          //返回一条
 		$res = $result->nav_name = $nav_name;                             //要修改的字段
 		$result->save();
 		if ( $res ) {
 			return 1;
 		}else{
 			return 0;
 		}
  	}

  	// 状态修改
  	public function actionSetstate()
  	{
  		// 接值
  		$is_delete = trim( yii::$app->request->get('st') );
  		$nav_id    = intval( yii::$app->request->get('id') );

  		// 修改
 		$res = yii::$app->db->createCommand()->update('xzwy_nav',
                ["is_delete"=>$is_delete,'update_time'=>date('Y-m-d h:i:s')],
                "nav_id=$nav_id")->execute();
 		if ( $res ) {
 			echo 1;
 		}else{
 			echo 0;
 		}
  	}
  	



}
