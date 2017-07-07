
<?php   
use \app\common\services\UrlService;

$domain_config = \Yii::$app->params['www'];
$upload_config = \Yii::$app->params['upload']."/";
 ?>
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">轮播图管理</strong></div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">排序</th>
        <th>图片</th>
        <th>属性</th>
        <th width="10%">更新时间</th>
        <th width="310">操作</th>
      </tr>
      <volist name="list" id="vo">
      <?php foreach ($data as $key => $val) { ?>
        <tr id="tr">
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="<?= $val['pic_id'] ?>" />
           <?php echo $val['pic_id'] ?></td>
          <td><input type="text" name="sort[1]" value="1" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
          <td width="10%"><img src="<?php echo $domain_config.$upload_config.$val['pic_link'] ?>"  width="100" height="80" /></td>
          <td><font color="#00CC99">
          <?php 
              if($val['status']==1){
                echo "主轮播图";
              }else{
                echo "局部轮播图";
              }
           ?>
           </font></td>
          <td><?php echo $val['create_time'] ?></td>
          <td><div class="button-group"> <a class="button border-red del" href="javascript:void(0)" picid="<?= $val['pic_id'] ?>"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
        <?php } ?>
      <tr>
        <td colspan="8">
        <div class="pagelist"> <a href="">上一页</a> 
        <span class="current">1</span><a href="">2</a><a href="">3</a>
        <a href="">下一页</a>
        <a href="">尾页</a> 
        </div>
        </td>
      </tr>
    </table>
  </div>
  
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加轮播图</strong></div>
  <div class="body-content form-x">  
      <div class="form-group">
        <div class="label">
          <label>上传图片：</label>
        </div>
        <div class="field">
        <form class="upload_pic_wrap" target="upload_file" enctype="multipart/form-data" method="POST"
                      action="<?= UrlService::buildWwwUrl('/upload/pic'); ?>">
                    <div class="upload_wrap pull-left">
                        <i class="fa fa-upload fa-2x"></i>
                        <input type="hidden" name="bucket" id="bucket" value=""/>
                 
                        <input class="button bg-blue margin-left" type="file" value="文件" name="pic" accept="image/png, image/jpeg, image/jpg,image/gif" >
                        <p id="addimg"></p>
                    </div>
          
         </form>
        </div>
      
      </div>  
     <div class="form-group">
        <div class="label">
          <label>所属类型：</label>
        </div>
        <div class="field">
          <div class="button-group radio">
          
          <label class="button active">
                <span class=""></span>         
              <input name="isshow" value="1" type="radio" >主轮播            
          </label>             
        
          <label class="button active">
              <span class=""></span>             
              <input name="isshow" value="0"  type="radio" >局部轮播
          </label>         
           </div>       
        </div>
     </div>
         <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="button"> 提交</button>
        </div>
      </div>
  </div>
</div>
<iframe src="" frameborder="0" class="hide" name="upload_file"></iframe>
<script type="text/javascript">

$(document).ready( function(){
  article_add.init();
} );

upload = {
  error:function( msg )
  {
    alert( msg );
  },
  success:function( imagekey )
  {
    var path = "<?=  UrlService::buildImgUrl('"+imagekey+"') ?>";
    var html = '<img src="'+path+'" height="150" width="200" ><span class="fa fa-times-circle del del_image" data="'+imagekey+'"><i></i></span>';
      $("#addimg").html(html);
  }
}
;

var article_add = {

  init:function()
  { 
    this.ue=null;
    this.eventBind();
  },

eventBind:function(){
    var that = this;

    $(".upload_pic_wrap input[name=pic]").change(function( )
    {
         $(".upload_pic_wrap").submit();
    })

    $(".active input[name=isshow]").click(function(){
         $(this).prop('checked',true);
         $(".active input[name=isshow]").prev().removeClass('icon-check');
         $(".active input[name=isshow]:checked").prev().addClass('icon-check'); 
    })

    $(".icon-check-square-o").on('click',function(){
        var state = $(".active input[name=isshow]:checked").val();
        var path = $("#addimg").find('span').attr('data');
        var root = "<?= $domain_config.$upload_config; ?>";
        var time = "<?= date('Y-m-d H:s:i') ?>";
        if(!path){
          alert('请上传图片');
          return false;
        }
        if(!state){
          alert('请选择上传图片类型');
          return false;
        }
        var status = state==1?"主轮播图":"局部轮播图";
         $.ajax({
               type:'get',
               url:"<?= UrlService::buildWwwUrl('/carouselimg/addimg'); ?>",
               data:{img:path,state:state},
               success:function(res){
               if(res==0){
                alert('上传失败');
               }else{
                 $(".active input[name=isshow]:checked").prev().removeClass('icon-check');
                 $("#addimg").html("");
                 var str = "";
                 str+="<tr>";
                 str+='<td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id" value="'+res+'" />'+res+'</td>';
                 str+='<td><input type="text" name="sort[1]" value="1" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>';
                 str+='<td width="10%"><img src="'+root+path+'"  width="100" height="80" /></td>';
                 str+='<td><font color="#00CC99">'+status+' </font></td>';
                 str+='<td>'+time+'</td>';
                 str+='<td><div class="button-group"> <a class="button border-red del" href="javascript:void(0)"  picid="'+res+'"><span class="icon-trash-o"></span> 删除</a> </div></td>';
                 str+="</tr>";
                 $("#tr").before(str);
               }
             }
        })
    })
       
   $('.del').click(function(){
      if(confirm("您确定要删除吗?")){
       var _this  = $(this);
        var id = $(this).attr('picid');
       $.ajax({
        type:'get',
        url:"<?= UrlService::buildWwwUrl('/carouselimg/delimg'); ?>",
        data:{id:id},
        success:function(res){ 
          if (res==1) {
            _this.parents('tr').remove();
          }else{
            alert('删除失败');
          }
        }
    })
  }
})

  }
}



/*//批量移动
function changecate(o){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){    
    
    $("#listform").submit();    
  }
  else{
    alert("请选择要操作的内容!");
    
    return false;
  }
}
*/
//全选
/*$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})*/

//批量删除
/*function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	  }
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}*/


/*//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}*/

</script>
</body>
</html>