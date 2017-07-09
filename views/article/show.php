<?php 	
use \app\common\services\UrlService;


 ?>
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 文章列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="<?= UrlService::buildWwwUrl('/article/add') ?>"> 添加内容</a> </li>
        <li>搜索：</li>
       
 <form method="get" action="" id="listform">
       
          <li>
            <select name="cid" class="input" style="width:200px; line-height:17px;" >
              <option value="">请选择分类</option>
              <?php foreach( $nav_info as $val) {?>
              <option value="<?= $val['nav_id'] ?>"><?= $val['nav_name'] ?></option>
              <?php } ?>
             
            </select>
          </li>
       
        <li>
          <input type="text" placeholder="请输入标题搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changeSearch()" > 搜索</a></li>
</form>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
   
        <th>标题</th>
        <th>图片</th>
        <th>内容</th>
        <th>分类名称</th>
        <th width="10%">更新时间</th>
        <th width="310">操作</th>
      </tr>
      <volist name="list" id="vo">
      <?php foreach( $article_info as $val) {?>
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id"  ops="<?= $val['content_id'] ?>"/>
           <?= $val['content_id'] ?></td>
          <td><input type="text" name="sort[1]" value="<?= $val['content_title'] ?>" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
         	<?php $imgpath = UrlService::buildImgUrl($val['xzwy_img']['img_path']) ?>
          <td width="10%"><img src="<?= $imgpath; ?>" alt="" width="70" height="50" /></td>
          <td><?= mb_substr( $val['content_info'], 0, 20, 'UTF-8' ); ?></td>
          <td><font color="#00CC99"><?= $val['xzwy_nav']['nav_name'] ?></font></td>
          
          <td><?= $val['update_time'] ?></td>
          <td><div class="button-group"> <a class="button border-main" href="add.html"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="DelSelect()"><span class="icon-trash-o" ops="<?= $val['content_id'] ?>" id="del"></span> 删除</a> </div></td>
        </tr>
		<?php } ?>
<tr>
    <td style="text-align:left; padding:19px 0;padding-left:20px;"><input type="checkbox" id="checkall"/>
      全选 </td>
    <td colspan="7" style="text-align:left;padding-left:20px;"><a href="javascript:void(0)" class="button border-red icon-trash-o" style="padding:5px 15px;" onclick="Delete()"> 删除</a> 
</tr>
      <tr>
            <td colspan="8">
              <div class="pagelist">
              <a href="<?= UrlService::buildWwwUrl('/article/show', [ 'page'=> $pages['page']-1 < 0 ? $pages['page']-1 : 1 ] ) ?>">上一页</a>
          <?php for( $i = 1; $i<= $pages['total_page']; $i++ ) {?> 

         
              
              <?php if( $i == $pages['page'] ) {?>
              <span class="current"><?= $i ?></span>
              <?php }else{?>

              <a href="<?= UrlService::buildWwwUrl('/article/show', [ 'page'=> $i ]) ?>"><?= $i ?></a> 
              <?php } ?>
        
          <?php } ?>
          <a href="<?= UrlService::buildWwwUrl('/article/show', [ 'page'=> $pages['page'] + 1 > $pages['total_page'] ? $pages['total_page'] : $pages['page'] + 1  ] ) ?>">下一页</a><a href="">尾页</a>
                </div>
          </td>
      </tr>
    </table>
  </div>
 <script>
 	function changeSearch()
 	{
 		//  分类
		// var nav_id 		= $("select[name=cid]").val();
		
		// var keywords  	= $("input[name=keywords]").val();

		$('#listform').submit();

 	}

$("#checkall").click(function(){ 
  $("input[name='id']").each(function(){
    if (this.checked) {
      this.checked = false;
    }
    else {
      this.checked = true;
    }
  });
})



function Delete()
{
  var checkNUM = $("input[name='id']:checked").length;

        if(checkNUM == 0) 
        { 
          alert("请选择至少一项！"); 
            return; 
        } 


        var checkedList = new Array(); 
        $("input[name='id']:checked").each(function() { 
        checkedList.push($(this).attr('ops')); 
      })

        $.ajax({ 
            type: "post", 
            url: "<?= UrlService::buildWwwUrl('article/ops') ?>", 
            data: {'id':checkedList.toString(),'ops':'all'}, 
            success: function(res) 
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
        })
}

  function DelSelect()
  {
      var id = $('#del').attr('ops');

        $.ajax({
          type:'post',
          url:"<?= UrlService::buildWwwUrl('article/ops') ?>",
          data:{
            id:id,
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
      })
  }


 </script>