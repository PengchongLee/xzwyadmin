<?php 	
use \app\common\services\UrlService;
use yii\widgets\LinkPager;

 ?>


  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 导航管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red" id="but"><span class="icon-trash-o"></span> 批量删除</button>
          <a href="<?= UrlService::buildWwwUrl('nav/add') ?>" class="button border-green">添加</a>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
      <th>选择</th>
        <th width="120">ID</th>
        <th>导航名称</th>       
        <th>状态</th>
        <th>导航类型</th>
        <th>创建时间</th>
        <th width="25%">修改时间</th>
         <th width="120">导航链接</th>
        <th>操作</th>       
      </tr> 
	<!-- 循环展示数据 begin -->
      <?php foreach ($model as $k => $v) {?>     
        <tr name="test">
          <td><input type="checkbox" name="id[]" value="<?= $v['nav_id'];?>" class="ids" /></td>
            <td><?= $v['nav_id'];?></td>
          <td>
          		<span onclick='show(this)'><?= $v['nav_name'];?></span>
          </td>
          <td><span onclick='sta(this)' opt="<?= $v['nav_id'];?>" ><?php if( $v['is_delete']==0 ){
          	echo "删除";
          	}else{echo "展示";}?>状态</span></td>
          <td><?php if( $v['nav_type'] == 0 ){echo "头部导航";}else{echo "其他导航";}?></td>  
          <td><?= $v['create_time'];?></td>         
          <td><?=  empty($v['update_time']) ? $v['update_time'] : '未修改过';?></td>
          <td>
          		<span onclick='show1(this)' ><?=  $v['nav_link'];?></span>
          </td>
          <td>
          		<div class="button-group" > 
          		<a class="button border-red" href="javascript:void(0)" onclick="return del(<?= $v['nav_id'];?>)">
          		<span class="icon-trash-o"></span> 删除</a> 
          		</div>         		
          </td>
        </tr>
       <?php };?>
		<!-- 循环展示数据 end -->
	
      <tr> 
        <td colspan="8"> <?= LinkPager::widget(['pagination' => $pages]); ?></td>
      </tr>
    </table>
  </div>

<script type="text/javascript">

//单删
	function del(id){
		if(confirm("您确定要删除吗?")){
			$.ajax({
			   type: "POST",
			   url: "<?= UrlService::buildWwwUrl('nav/delete') ?>",
			   data: "id="+id,
			   success: function(msg){
				   	if( msg == 1 ){
				   		alert('删除成功');
				     	window.location.href = "<?= UrlService::buildWwwUrl('/nav/show')?>"; 
				   	}else{
				   		alert('删除失败');
				   	}
			   	
			   }
			});
		}
	}

// 全选
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

// 批删
	$('#but').click(function(){
		 var arr = '';
		$("input[name='id[]']").each(function(){
		  if (this.checked) {
			   arr += ','+$(this).val();
		  }
	 	});
	 	arr = arr.substr(1)	;
	 	var url="<?= UrlService::buildWwwUrl('nav/delall') ?>";
		var data={'arr':arr};
		$.get(url,data,function(msg){
			if (msg==1) {
				alert('删除成功');
				window.location.href = "<?= UrlService::buildWwwUrl('/nav/show')?>"; 
			}else{
				alert('删除失败');
			}
		});
	})

// (导航名称)即点即改
	function show(ts){
		var s=$(ts).html();
		var ss=$(ts).parent();
		ss.html("<input type='text' class='sp1' old='"+s+"' onblur='update(this)'value='"+s+"' />");
	}

	function update(ts){
		var old = $(ts).attr('old');
		var val = $(ts).val();
		var id  = $(ts).parent().prev().html();
		url="<?= UrlService::buildWwwUrl('nav/update') ?>";
		data={'val':val,'id':id}
		$.get(url,data,function(msg){
			if (msg==1) {
				$(ts).parent().html(val);
			}else{
				alert('修改失败');
				$(ts).parent().html(old);
			}		
		});
	}

// 修改展示状态
	function sta(ts){
		var now = $(ts).html();
		var id  = $(ts).attr('opt');
		if(now == '展示状态'){
			url="<?= UrlService::buildWwwUrl('nav/setstate') ?>";
			data={'st':0,'id':id}
			$.get(url,data,function(msg){
				if( msg==1){
					$(ts).html('删除状态');
				}else{
					alert('错误');
				};		
			});						
		}
		if(now == '删除状态'){
			url="<?= UrlService::buildWwwUrl('nav/setstate') ?>";
			data={'st':1,'id':id}
			$.get(url,data,function(msg){
				if( msg==1){
					$(ts).html('展示状态');
				}else{
					alert('错误');
				};		
			});
		}
	}

// (导航链接)即点即改
	function show1(ts){
		var s=$(ts).html();
		var ss=$(ts).parent();
		ss.html("<input type='text' class='sp1' old='"+s+"' opt='"+<?= @$v['nav_id'];?>+"' onblur='update1(this)'value='"+s+"' />");
	}

	function update1(ts){
		var old = $(ts).attr('old');
		var val = $(ts).val();
		var id  = $(ts).attr('opt');
		url="<?= UrlService::buildWwwUrl('nav/setlink') ?>";
		data={'val':val,'id':id}
		$.get(url,data,function(msg){
			if (msg==1) {
				$(ts).parent().html(val);
			}else{
				alert('修改失败');
				$(ts).parent().html(old);
			}		
		});
	}
</script>
