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
    <script type="text/javascript">
      function del(key){
        if(confirm("确定删除吗?")){
          location.href="del.php?del="+key;
        }else {
          location.href="message.php";
        }
      }
    </script>
  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					IMOOC留言板 <small>-v2.0</small>
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
      <?php if (is_array($msgs)&&count($msgs)>0):?>
			<table class="table">
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							用户
						</th>
						<th>
						  标题
						</th>
						<th>
							时间
						</th>
            <th>
							内容
						</th>
            <th>
							编辑
						</th>
            <th>
							删除
						</th>
					</tr>
				</thead>
				<tbody>
          <?php $i=1;foreach($msgs as $key=>$val):?>
					<tr class="table-active">
						<td>
							<?php echo $i++; ?>
						</td>
						<td>
							<?php echo $val['username'] ?>
						</td>
            <td>
              <?php echo $val['title'] ?>
						</td>
						<td>
							<?php echo date('Y/m/d H:i:s',$val['time']) ?>
						</td>
						<td>
							<?php echo $val['content'] ?>
						</td>
            <td>
              <a href="edit.php?key=<?php echo $key ?>">编辑</a>
						</td>
            <td>
              <a href="#" onclick="del(<?php echo $key ?>)">删除</a>
            </td>
					</tr>
        <?php endforeach; ?>
				</tbody>
			</table>
    <?php endif; ?>
      <br/>
      <div class="col-md-12">
			 <form action="add.php" method="post">
         <input type="submit" name="" value="添加留言" class="btn btn-info btn-lg btn-block active">
       </form>
    <br/>
    <br/>
		</div>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
