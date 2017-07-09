<?php   
use \app\common\services\UrlService;

 ?>

<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?= UrlService::buildWwwUrl('/nav/add'); ?>">  
      <div class="form-group">
        <div class="label">
          <label>导航名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="name" data-validate="required:请输入导航名称" />
          <div class="tips"></div>
        </div>
      </div>        
      <if condition="$iscid eq 1">
        <div class="form-group">
          <div class="label">
            <label>导航类型：</label>
          </div>
          <div class="field">
            <select name="type" class="input w50">
              <option value="">请选择分类</option>
              <option value="0">头部导航</option>
              <option value="1">其他部位</option>
            </select>
            <div class="tips"></div>
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>导航链接：</label>
        </div>
        <div class="field"> 
          <script src="js/laydate/laydate.js"></script>
          <input type="text" class="laydate-icon input w50" name="link" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value=""  data-validate="required:导航链接不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>