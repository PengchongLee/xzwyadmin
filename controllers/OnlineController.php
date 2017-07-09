<?php

namespace app\controllers;
use app\common\components\BaseController;
use yii\data\Pagination;
use app\models\Online;
use yii;
class OnlineController extends BaseController
{
    public $layout = "web";

    public function actionIndex()
    {
        $query = Online::find();
        $pagination = new Pagination([
            "defaultPageSize"=>5,
            "totalCount"=>$query->count(),
        ]);
        //分页
        $countries = $query->orderBy('user_id')
            ->where("state=0")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
            "countries"=>$countries,
            "pagination"=>$pagination,
        ]);
    }
    //删除
    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        $sql = "delete from xzwy_user where `user_id`= $id";
        $arr = Yii::$app->db->createCommand($sql)->execute();
        if($arr){
            echo "1";
        }else{
            echo "0";
        }
    }

    //处理状态
    public function actionState()
    {
        $id = Yii::$app->request->get('id');
        $rt= Online::updateAll(array('state'=>'1'),array('user_id'=>$id));
        if($rt){
            echo "1";
        }else{
            echo "0";
        }
    }

    //处理过的数据
    public function actionShow()
    {
        $query = Online::find();
        $pagination = new Pagination([
            "defaultPageSize"=>5,
            "totalCount"=>$query->count(),
        ]);
        //分页
        $countries = $query->orderBy('user_id')
            ->where("state=1")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('show',[
            "countries"=>$countries,
            "pagination"=>$pagination,
        ]);
    }

}


?>