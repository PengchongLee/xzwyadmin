<?php 
use \app\common\services\UrlService;

// 引入前端资源的文件
use app\assets\WebAsset;

WebAsset::register( $this );
?>


<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <?php $this->head(); ?>  
    <!-- <link rel="stylesheet" href="css/pintuer.css"> -->
    <!-- <link rel="stylesheet" href="css/admin.css"> -->
    <script src="<?= UrlService::buildWwwUrl('/admin/js/jquery.js')?>"></script>   
    <script src="<?= UrlService::buildWwwUrl('/admin/js/pintuer.js') ?>"></script>
</head>
<body style="background-color:#f2f9fd;">
<?php $this->beginBody(); ?>

<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><img src="images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;<a href="##" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;<a class="button button-little bg-red" href="login.html"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  <h2 ><span class="icon-user"></span>基本设置</h2>
  <ul style="display:block">
    <li><a href="<?= UrlService::buildWwwUrl('/company/add') ?>" ><span class=""></span>网站设置</a></li>
    <li><a href="pass.html" ><span class=""></span>修改密码</a></li>
    <li><a href="page.html" ><span class=""></span>导航管理</a></li>  
    <li><a href="<?= UrlService::buildWwwUrl('/carouselimg/list') ?>" ><span class=""></span>首页轮播</a></li>   
    <li><a href="book.html" ><span class=""></span>在线报名</a></li>     
  </ul>   
  <h2><span class="icon-pencil-square-o"></span>文章管理</h2>
  <ul>
    <li><a href="<?= UrlService::buildWwwUrl('/article/show') ?>" ><span class=""></span>文章管理</a></li>
    <li><a href="<?= UrlService::buildWwwUrl('/article/add') ?>" ><span class=""></span>添加内容</a></li>
    <li><a href="cate.html" ><span class=""></span>分类管理</a></li>        
  </ul>  
</div>
  
<ul class="bread">
  <li><a href="{:U('Index/info')}" target="right" class="icon-home"> 首页</a></li>
  <li><a href="##" id="a_leader_txt">网站信息</a></li>
</ul>
<div class="admin">
<?= $content ?>
  <!-- <iframe scrolling="auto" rameborder="0" src="info.html" name="right" width="100%" height="100%"></iframe> -->
</div>
<div style="text-align:center;">
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
    $(this).next().slideToggle(200);  
    $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
      
      $(this).children.find('span').addClass('icon-caret-right');
      $("#a_leader_txt").text($(this).text());
      $(".leftnav ul li a").removeClass("on");
    $(this).addClass("on");
  })
});
</script>

