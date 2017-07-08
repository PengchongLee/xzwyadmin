<?php 
namespace app\controllers;
use app\common\components\BaseController;
use app\models\XzwyContent;

use \app\common\services\UrlService;
use app\common\services\UploadService;

class UploadController extends BaseController
{
	private $allow_type = ['jpg','gif','jpeg',];

	public function actionPic()
	{

		$callback = "window.parent.upload"; //errors/success

		if( !$_FILES || !isset( $_FILES['pic'] ))
		{
			return "<script>{$callback}.error('请选择文件')</script>";
		}	

		// 文件名
		$filename = $_FILES['pic']['name'];

		$tmp_extend = explode('.',$filename);
	
	
		if( !in_array( strtolower( end( $tmp_extend ) ) , $this->allow_type ))
		{
			return "<script>{$callback}.error('图片格式不正确')</script>";
		}

		// 上传图片逻辑
		$res = UploadService::uploadByFile( $filename, $_FILES['pic']['tmp_name'] );

			// return "<script>{$callback}.success('上传图片成功')</script>";

		if( !$res )
		{
			return "<script>{$callback}.error('".UploadService::getlastErrorMsg()."')</script>";
		}
		else
		{
			return "<script>{$callback}.success('".$res['path']."')</script>";
		}


	}

}



 ?>