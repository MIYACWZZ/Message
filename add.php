<?php
header('content-type:text/html;charset=utf-8');
//设置时区
date_default_timezone_set('PRC');
$filename="msg.txt";
$msgs=[];
//检测文件是否存在
if(file_exists($filename)){
  //读取文件内容
  $string=file_get_contents($filename);
  if(strlen($string)>0){
    $msgs=unserialize($string);
  }
}
//检测用户是否点击了提交按钮
//isset 检测变量是否已经设置并且非null
//strip_tags — 从字符串中去除 HTML 和 PHP 标记
if(isset($_POST['pubMsg'])){
  $username=$_POST['username'];
  $title=strip_tags($_POST['title']);
  $content=strip_tags($_POST['content']);
  $time=time();
  //快速组成关联数组
  $data=compact('username','title','content','time');
  array_push($msgs,$data);
  //将数组序列化成字符串
  $msgs=serialize($msgs);
  if(file_put_contents($filename,$msgs)){
    echo "<script>alert('留言成功！');location.href='message.php'</script>";
  }else {
    echo "<script>alert('留言失败！');location.href='message.php'</script>";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bootstrap 4, from LayoutIt!</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					IMOOC留言板 <small>-v1.0</small>
				</h1>
			</div>
			<div class="jumbotron">
				<h2>
					Hello, world!
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Learn more</a>
				</p>
			</div>
      <br/>
      <br/>
      <div class="col-md-12">
			<form action='#' method="post">
        <h3>
				请留言
        </h3><hr/>
        <div class="form-group">
          <label for="exampleInputUsername">
						用户名
					</label>
          <input type="text" required name="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputTitle">标题</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="exampleInputContent">内容</label>
          <textarea name="content" rows="5" cols="30" class="form-control" required></textarea>
        </div>
          <input type="submit" class="btn btn-primary btn-lg" value="发布留言" name="pubMsg">
			</form>
    </div>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
