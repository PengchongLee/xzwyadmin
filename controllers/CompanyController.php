<?php
namespace app\controllers;

use Yii;
use app\common\components\BaseController;
use app\models\XzwyCompany;
use \app\common\services\UrlService;

class CompanyController extends BaseController
{
    public $layout = "web";

    public function actionAdd()
    {
        if ($this->isRequestMethod('post')) {

            $data = array(
                'com_name' => $this->post("com_name"),
                'web_address' => $this->post("web_address"),
                'com_tel' => $this->post("com_tel"),
                'com_email' => $this->post("com_email"),
                'com_address' => $this->post("com_address"),
                'com_account' => $this->post("com_account"),
                'com_fax' => $this->post("com_fax"),
                'com_intro' => $this->post("com_intro"),
                'com_logo' => $this->post("com_logo"),
                'create_time' => date("Y-m-d H:i:s", time())
            );
            $model = new XzwyCompany();
            if ($model->load($data, '') && $model->save()) {
                $arr['error'] = '1';
                $arr['content'] = $data;
                $arr['msg'] = '';
            } else {
                $arr['error'] = '0';
                $arr['msg'] = '添加失败';
            }
            return json_encode($arr);
        } else {
            return $this->render("add");
        }
    }
    public function actionUpload()
    {
        if(isset($_FILES['com_logo']) && $_FILES['com_logo']['error'] == 0){
            $file = $_FILES['com_logo'];
            $com_logo = UrlService::buildWwwUrl("admin/images/logo/".$file['name']);
            if( move_uploaded_file($file['tmp_name'],"admin/images/logo/".$file['name']) ){
                $data['error'] = 1;
                $data['com_logo'] = $com_logo;
            }else{
                $data['error'] = 0;
                $data['msg'] = '上传失败';
            }
        }
        return json_encode($data);
    }
    public function actionShow()
    {
        $data = XzwyCompany::find()->asArray()->all();
        return $this->render('show',['data'=>$data]);
    }
    public function actionDel(){
        if ($this->isRequestMethod('get')) {
            $id = $this->get("id");
            $res = XzwyCompany::deleteAll(['com_id'=>$id]);
            if($res){
                $data['error'] = 1;
            }else{
                $data['error'] = 0;
                $data['msg'] = "删除失败";
            }
        }
        return json_encode($data);
    }
}
