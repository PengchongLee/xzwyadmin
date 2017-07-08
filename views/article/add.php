<?php 	
use \app\common\services\UrlService;

 ?>
 <div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
  	<div class="form-x">
   <!--  <form method="post" class="form-x" action="<?= UrlService::buildNullUrl() ?>">   -->
      <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">

        <!--  <input type="text" id="url1" name="img" class="input tips" style="width:25%; float:left;"  value=""  data-toggle="hover" data-place="right" data-image="" />
          <input type="file" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;">
          <div class="tipss">图片尺寸：500*500</div> -->
    	<form class="upload_pic_wrap" target="upload_file" enctype="multipart/form-data" method="POST"
                      action="<?= UrlService::buildWwwUrl('/upload/pic'); ?>">
                    <div class="upload_wrap pull-left">
                        <i class="fa fa-upload fa-2x"></i>
                        <input type="hidden" name="bucket" value="book"/>
                 
                        <input class="button bg-blue margin-left" type="file" value="文件" name="pic" accept="image/png, image/jpeg, image/jpg,image/gif" >
                    </div>
          
         </form>
        	
		
        </div>
      </div>     

        <div class="form-group">
          <div class="label">
            <label>分类标题：</label>
          </div>
          <div class="field">
            <select name="cid" class="input w50">
              <option value="">请选择分类</option>
              <?php  foreach( $nav_info as $val ) {?>
              <option value="<?= $val['nav_id'] ?>"><?= $val['nav_name'] ?></option>
              <?php } ?>
            </select>
            <div class="tips"></div>
          </div>
        </div>

      <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <textarea name="content" id="editor"  style="height:450px; border:1px solid #ddd;"></textarea>
          <div class="tips"></div>
        </div>
      </div>

     
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o save" type="submit"> 提交</button>
        </div>
      </div>
    <!-- </form> -->
    </div>
  </div>
</div>
<iframe src="" frameborder="0" class="hide" name="upload_file"></iframe>
<script src="<?= UrlService::buildWwwUrl('/admin/ueditor/ueditor.config.js') ?>"></script>
<script src="<?= UrlService::buildWwwUrl('/admin/ueditor/ueditor.all.min.js') ?>"></script>
<script>
	
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
		var path = "<?= UrlService::buildImgUrl('"+imagekey+"') ?>";
		var html = '<img src="'+path+'" height="50" width="50" ><span class="fa fa-times-circle del del_image" data="'+imagekey+'"><i></i></span>';

		// if( $( ".upload_pic_wrap .pic-each" ).size() > 0 )
		// {
		// 	$(".upload_pic_wrap .pic-each").html( html );
		// }
		// else
		// {
			$(".upload_pic_wrap").append( '<span class="pic-each">'+html+'</span>' );
		// }

	}
}
;
var article_add = {

	init:function()
	{	
		this.ue=null;
		this.eventBind();
		this.initEditor();
		// this.deleteimage();
	},
	eventBind:function(){
		var that = this;

		$(".upload_pic_wrap input[name=pic]").change(function( )
		{
	
			$(".upload_pic_wrap").submit();

		})

		// 保存
		$('.save').on('click',function(){ 

			//内容
			var summary =  $.trim( that.ue.getContent() );

			// 标题
			var title 		= $("input[name=title]");

			// 分类
			var nav_id 		= $("select[name=cid]");

			var imagenum 	= $(".del_image").size();

			var imagekey = new Array(); 
				$(".del_image").each(function() { 
				imagekey.push($(this).attr('data')); 
			})

				if( nav_id.val().length < 1 )
				{
					alert( '请您填写正确的文章导航' )
					return false;
				}

				if( summary.length < 1 )
				{
					alert( '请您填写正确的文章内容' )
					return false;
				}

				if( title.val().length < 1 )
				{
					alert( '请您填写正确的文章标题' )
					return false;
				}

			var path = "<?= UrlService::buildWwwUrl('/article/add')?>";
				$.ajax({
					url:path,
					type:'POST',
					data:{
						title:title.val(),
						nav_id:nav_id.val(),
						summary:summary,
						imagekey:imagekey.toString(),
					},
					dataType:'json',
					success:function( res )
					{
						if( res.code ==200)
						{							
							alert( res.msg )
							window.location.href = "<?= UrlService::buildWwwUrl('/article/show')?>"; 
						}
						else
						{
							alert( res.msg )
							window.location.href = "<?=  UrlService::buildWwwUrl('/article/show')?>"; 
						}
					}

				});
		})
	},
	initEditor:function(){
        var that = this;
        that.ue = UE.getEditor('editor',{
            toolbars: [
                [ 'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall',  '|','rowspacingtop', 'rowspacingbottom', 'lineheight'],
                [ 'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                    'directionalityltr', 'directionalityrtl', 'indent', '|',
                    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                    'link', 'unlink'],
                [ 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                    'horizontal', 'spechars','|','inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols' ]

            ],
            enableAutoSave:true,
            saveInterval:60000,
            elementPathEnabled:false,
            zIndex:4
        });
        that.ue.addListener('beforeInsertImage', function (t,arg){
            console.log( t,arg );
            //alert('这是图片地址：'+arg[0].src);
            // that.ue.execCommand('insertimage', {
            //     src: arg[0].src,
            //     _src: arg[0].src,
            //     width: '250'
            // });
            return false;
        });
    },

}



</script>