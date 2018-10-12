<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set("PRC");
$filename="msg.txt";
$msgs=[];
//判断是否传入参数key
if (isset($_GET['key'])) {
  $key=$_GET['key'];
  //反序列化文件获得留言数组
  $msgs=unserialize(file_get_contents($filename));
  //获取对应键名的元素
  $elem=$msgs[$key];
}
//判断用户是否按下了修改按钮
if (isset($_POST['editButton'])) {
  $username=$_POST['username'];
  $title=strip_tags($_POST['title']);
  $content=strip_tags($_POST['content']);
  $time=time();
  //快速生成关联数组
  $data=compact('username','title','content','time');
  //新的关联数组覆盖原来的关联数组
  $msgs[$key]=$data;
  //将数组序列化成字符串
  $msgs=serialize($msgs);
  if(file_put_contents($filename,$msgs)){
    echo "<script>alert('修改成功！');location.href='message.php'</script>";
  }else {
    echo "<script>alert('修改失败！');location.href='message.php'</script>";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <form class="" action="#" method="post">
    <?php if (isset($elem)): ?>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">用户名</span>
      </div>
      <input name="username" type="text" class="form-control" value="<?php echo $elem['username'] ?>" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">标题</span>
      </div>
      <input name="title" type="text" class="form-control" value="<?php echo $elem['title'] ?>" placeholder="title" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">内容</span>
      </div>
      <textarea name="content" class="form-control" aria-label="With textarea"><?php echo $elem['content'] ?></textarea>
    </div>
    <button name="editButton" type="submit" class="btn btn-primary btn-lg">修改留言</button>
    <button name="bntKey" type="button" hidden value="<?php if(isset($_GET['key'])){echo $_GET['key'];} ?>" name="button"></button>
  <?php endif; ?>
    </form>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
