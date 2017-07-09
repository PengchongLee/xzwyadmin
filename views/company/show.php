<!DOCTYPE html>
<html lang="zh-cn">
<?php
use yii\helpers\Url;
use \app\common\services\UrlService;

// 引入前端资源的文件
use app\assets\WebAsset;

WebAsset::register( $this );

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="<?= UrlService::buildWwwUrl('/admin/css/admin.css')?>">
    <link rel="stylesheet" href="<?= UrlService::buildWwwUrl('/admin/css/pintuer.css')?>">
    <script src="<?= UrlService::buildWwwUrl('/admin/js/jquery.js')?>"></script>
    <script src="<?= UrlService::buildWwwUrl('/admin/js/pintuer.js')?>"></script>
</head>
<body>
<form method="post" action="">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 网站管理</strong></div>
        <div class="padding border-bottom">
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="120">ID</th>
                <th>公司名称</th>
                <th>公司电话</th>
                <th>公司邮箱</th>
                <th>公司地址</th>
                <th>网站地址</th>
                <th width="25%">公司描述</th>
                <th width="120">创建时间</th>
                <th>操作</th>
            </tr>
            <?php foreach($data as $key=>$val){?>
            <tr>
                <td><?= $val['com_id']?></td>
                <td><?= $val['com_name']?></td>
                <td><?= $val['com_tel']?></td>
                <td><?= $val['com_email']?></td>
                <td><?= $val['com_address']?></td>
                <td><?= $val['web_address']?></td>
                <td>
                    <?php
                        if(strlen($val['com_intro'])>15){
                            $address = substr($val['com_intro'],0,15);
                        }else{
                            $address = $val['com_intro'];
                        }
                    echo $address;
                    ?>
                </td>
                <td><?= $val['create_time']?></td>
                <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="del(<?= $val['com_id']?>,this)"><span class="icon-trash-o"></span> 删除</a> </div></td>
            </tr>
           <?php }?>
        </table>
    </div>
</form>
<script type="text/javascript">
    function del(id,obj){
        if(confirm("您确定要删除吗?")){
            $.ajax({
                type:"get",
                url:"<?= UrlService::buildWwwUrl('/company/del')?>",
                data:{"id":id},
                dataType:"json",
                success:function(data){
                    if(data.error == 1){
                        obj.parentNode.parentNode.parentNode.remove();
                    }else{
                        alert(data.msg);
                    }
                }
            })
        }
    }

    $("#checkall").click(function(){
        $("input[name='id[]']").each(function(){
            if (this.checked) {
                this.checked = false;
            }
            else {
                this.checked = true;
            }
        });
    })

    function DelSelect(){
        var Checkbox=false;
        $("input[name='id[]']").each(function(){
            if (this.checked==true) {
                Checkbox=true;
            }
        });
        if (Checkbox){
            var t=confirm("您确认要删除选中的内容吗？");
            if (t==false) return false;
        }
        else{
            alert("请选择您要删除的内容!");
            return false;
        }
    }

</script>
</body></html>