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
                    <input type="text" class="input" name="stitle" value="" id="com_name"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站LOGO：</label>
                </div>
                <div class="field">
                    <input type="text" id="url1" name="slogo" class="input tips" style="width:25%; float:left;" value="" data-toggle="hover" data-place="right" data-image=""  />
                    <input type="file" id="file" name="com_logo"/>
                    <input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传" >
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="surl" value="" id="web_address" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司简介：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="sdescription" id="com_intro"></textarea>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>联系电话：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_tel" value="" id="com_tel"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>传真：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_fax" value="" id="com_fax"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司账户：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_qq" value="" id="com_account"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司Email：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_email" value="" id="com_email"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>公司地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_address" value="" id="com_address"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit" id="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body></html>
<script>
    $(function(){
        var check = {
            check_name:false,
            check_tel:false,
            check_address:false,
            check_intro:false,
            check_fax:false,
            check_account:false,
            check_email:false,
            check_web:false
        }
        //表单验证
        $("#com_name").blur(function(){
            var com_name = $(this).val();
            $(this).next().remove();
            var reg = /([\u4e00-\u9fa5])|([a-zA-Z])/;
            if(com_name == ''){
                $(this).after("<span style='color:red;'>公司名称不能为空</span>");
                check.check_name = false;
            }else if( !reg.test(com_name) ){
                $(this).after("<span style='color:red;'>请输入汉字或英文</span>");
                check.check_name = false;
            }else{
                check.check_name = true;
            }
        })

        $("#com_address").blur(function(){
            var com_address = $(this).val();
            $(this).next().remove();
            var reg = /^([\u4e00-\u9fa5])|([0-9])|([a-zA-Z])$/;
            if(com_address == ''){
                $(this).after("<span style='color:red;'>公司地址不能为空</span>");
                check.check_address = false;
            }else if( !reg.test(com_address) ){
                $(this).after("<span style='color:red;'>请输入汉字或数字</span>");
                check.check_address = false;
            }else{
                check.check_address = true;
            }
        })

        $("#com_tel").blur(function(){
            var com_tel = $(this).val();
            $(this).next().remove();
            var reg = /^0\d{2,3}-?\d{7,8}$/;
            if(com_tel == ''){
                $(this).after("<span style='color:red;'>公司电话不能为空</span>");
                check.check_tel = false;
            }else if( !reg.test(com_tel) ){
                $(this).after("<span style='color:red;'>电话格式不正确,正确格式0**-*******</span>");
                check.check_tel = false;
            }else{
                check.check_tel = true;
            }
        })

        $("#web_address").blur(function(){
            var web_address = $(this).val();
            $(this).next().remove();
            var reg = /^(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])$/;
            if(web_address == ''){
                $(this).after("<span style='color:red;'>公司网址不能为空</span>");
                check.check_web = false;
            }else if( !reg.test(web_address) ){
                $(this).after("<span style='color:red;'>网址格式不正确,应该以http,ftp,https开头</span>");
                check.check_web = false;
            }else{
                check.check_web = true;
            }
        })

        $("#com_intro").blur(function(){
            var com_intro = $(this).val();
            $(this).next().remove();
            var reg = /^[\u4e00-\u9fa5]{3,500}$/;
            if(com_intro == ''){
                $(this).after("<span style='color:red;'>公司简介不能为空</span>");
                check.check_intro = false;
            }else if( !reg.test(com_intro) ){
                $(this).after("<span style='color:red;'>公司简介不得少于50个汉字</span>");
                check.check_intro = false;
            }else{
                check.check_intro = true;
            }
        })

        $("#com_fax").blur(function(){
            var com_fax = $(this).val();
            $(this).next().remove();
            var reg = /^0\d{2,3}-?\d{7,8}$/;
            if(com_fax == ''){
                $(this).after("<span style='color:red;'>公司传真不能为空</span>");
                check.check_fax = false;
            }else if( !reg.test(com_fax) ){
                $(this).after("<span style='color:red;'>公司传真格式错误，正确格式0**-*******</span>");
                check.check_fax = false;
            }else{
                check.check_fax = true;
            }
        })

        $("#com_account").blur(function(){
            var com_account = $(this).val();
            $(this).next().remove();
            var reg = /^(\d{16}|\d{19})$/;
            if(com_account == ''){
                $(this).after("<span style='color:red;'>公司账户不能为空</span>");
                check.check_account = false;
            }else if( !reg.test(com_account) ){
                $(this).after("<span style='color:red;'>公司账户格式错误，应该为16或19位纯数字</span>");
                check.check_account = false;
            }else{
                check.check_account = true;
            }
        })

        $("#com_email").blur(function(){
            var com_email = $(this).val();
            $(this).next().remove();
            var reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
            if(com_email == ''){
                $(this).after("<span style='color:red;'>公司邮箱不能为空</span>");
                check.check_email = false;
            }else if( !reg.test(com_email) ){
                $(this).after("<span style='color:red;'>公司邮箱格式错误</span>");
                check.check_email = false;
            }else{
                check.check_email = true;
            }
        })

        //图片上传
        $("#image1").click(function(){
            var form=new FormData(document.getElementById('form'));
            $.ajax({
                type:"post",
                url:"<?= UrlService::buildWwwUrl('/company/upload')?>",
                processData:false,
                contentType:false,
                data:form,
                dataType:"json",
                success:function(data){
                    if(data.error == 1){
                        $("#image1").after("<input type='hidden' name='logo' id='logo' value='"+data.com_logo+"'/>");
                    }else{
                        alert(data.msg)
                    }
                }
            })
        })

        //表单提交
        $("#submit").click(function(){

            $("#com_name").trigger("blur");
            $("#com_tel").trigger("blur");
            $("#com_email").trigger("blur");
            $("#com_address").trigger("blur");
            $("#com_account").trigger("blur");
            $("#com_fax").trigger("blur");
            $("#web_address").trigger("blur");
            $("#com_intro").trigger("blur");
            if(check.check_name && check.check_address && check.check_account && check.check_email && check.check_fax && check.check_intro && check.check_tel && check.check_web){

                var com_name = $("#com_name").val();
                var com_tel = $("#com_tel").val();
                var com_email = $("#com_email").val();
                var com_address = $("#com_address").val();
                var com_account = $("#com_account").val();
                var com_fax = $("#com_fax").val();
                var com_intro = $("#com_intro").val();
                var web_address = $("#web_address").val();
                var com_logo = $("#logo").val();

                $.ajax({
                    type:"post",
                    url:"<?= UrlService::buildWwwUrl('/company/add')?>",
                    data:{
                        'com_name':com_name,
                        'com_tel':com_tel,
                        'com_email':com_email,
                        'com_address':com_address,
                        'com_account':com_account,
                        'com_fax':com_fax,
                        'com_intro':com_intro,
                        'web_address':web_address,
                        'com_logo':com_logo
                    },
                    dataType:"json",
                    success:function(data){
                        if(data.error==1){
                            window.location.href = "<?= UrlService::buildWwwUrl('/company/show')?>";
                        }else{
                            alert(data.msg)
                        }
                    }
                })
            }else{
                return false;
            }
        })

    })
</script>

