<?php
use \app\common\services\UrlService;

// 引入前端资源的文件
use app\assets\WebAsset;
use yii\helpers\Html;
use yii\widgets\LinkPager;

WebAsset::register( $this );

?>
<form method="post" action="">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 留言管理</strong></div>
        <div class="padding border-bottom">
            <ul class="search">
                <li>
                </li>
            </ul>
            <a href="<?= UrlService::buildWwwUrl('/online/show')?>"><button type="button"  class="button border-green" id="">显示已处理的信息</button></a>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="120">ID</th>
                <th>姓名</th>
                <th>性别</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>QQ</th>
                <th width="25%">内容</th>
                <th width="120">留言时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php foreach($countries as $k=>$v) { ?>
            <tr>
                <td><input type="checkbox" name="id[]" value="1" />
                    <?= $v['user_id']?></td>
                <td><?= $v['user_name']?></td>
                <td><?php
                    if($v['user_sex'] == "0"){
                        echo "女";
                    }else{
                        echo "男";
                    }
                    ?></td>
                <td><?= $v['user_tel']?></td>
                <td><?= $v['user_email']?></td>
                <td><?= $v['user_qq']?></td>
                <td><?= $v['msg_content']?></td>
                <td><?= date('Y-m-d H:i:s',$v['add_time'])?></td>
<!--                <td id="--><?//= $v['user_id']?><!--"><div class="button-group" style="color: red"><span class="li">未处理</span>  </div></td>-->
                <td><div class="button-group" > <a href="javascript:void(0)" onclick="upe(<?= $v['user_id']?>,this)" style="color: red"><span></span> 未处理</a> </div></td>
                <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="del(<?= $v['user_id']?>,this)"><span class="icon-trash-o"></span> 删除</a> </div></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="8"><div class="pagelist"> <span class="current"><?= LinkPager::widget(['pagination'=>$pagination]) ?></span></div></td>

            </tr>
        </table>
    </div>
</form>
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/admin/js/jquery-1.7.2.min.js')?>"></script>
<script type="text/javascript">

    function del(id,obj){
        if(confirm("您确定要删除吗?")){
            $.ajax({
                type:"get",
                url:"<?= UrlService::buildWwwUrl('/online/del')?>",
                data:{"id":id},
                dataType:"json",
                success:function(data){
                    if(data == 1){
                        obj.parentNode.parentNode.parentNode.remove();
                    }else{
                        alert(data.msg);
                    }
                }
            })
        }
    }

    function upe(id,obj){
            $.ajax({
                type:"get",
                url:"<?= UrlService::buildWwwUrl('/online/state')?>",
                data:{"id":id},
                success:function(data){
                    if(data == 1){
                        obj.parentNode.parentNode.parentNode.remove();
                    }else{
                        alert(data.msg);
                    }
                }
            })
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