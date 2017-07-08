<?php
use yii\helpers\Url;
use \app\common\services\UrlService;

// 引入前端资源的文件
use app\assets\WebAsset;

WebAsset::register( $this );

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>
    <link rel="stylesheet" href="<?= UrlService::buildWwwUrl('/admin/css/admin.css')?>">
    <link rel="stylesheet" href="<?= UrlService::buildWwwUrl('/admin/css/pintuer.css')?>">
    <script src="<?= UrlService::buildWwwUrl('/admin/js/jquery.js')?>"></script>
    <script src="<?= UrlService::buildWwwUrl('/admin/js/pintuer.js')?>"></script>
    <script src="<?= UrlService::buildWwwUrl('/admin/js/ajaxfileupload.js')?>" type="text/javascript"></script>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="<?= UrlService::buildNullUrl()?>" id="form" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>公司名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="stitle" value="<?= $data['com_name']?>" id="com_name"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站LOGO：</label>
                </div>
                <div class="field">
                    <input type="text" id="url1" name="slogo" class="input tips" style="width:25%; float:left;" value="" data-toggle="hover" data-place="right" data-image=""  />
                    <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传" >
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="surl" id="web_address" value="<?= $data['web_address']?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司简介：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="sdescription" id="com_intro"><?= $data['com_intro']?></textarea>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>联系电话：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_tel" value="<?= $data['com_tel']?>" id="com_tel"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>传真：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_fax" id="com_fax" value="<?= $data['com_fax']?>"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司账户：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_qq" value="<?= $data['com_account']?>" id="com_account"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司Email：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_email" value="<?= $data['com_email']?>" id="com_email"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_address" value="<?= $data['com_address']?>" id="com_address"/>
                    <div class="tips"></div>
                </div>
            </div>
        </form>
    </div>
</div>
</body></html>