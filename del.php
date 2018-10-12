<?php
$filename="msg.txt";
$msgs=[];
$msgs=unserialize(file_get_contents($filename));
$id=$_GET['del'];
unset($msgs[$id]);
$msgs=serialize($msgs);
if(file_put_contents($filename,$msgs)){
  echo "<script>alert('删除成功！');location.href='message.php'</script>";
}else {
  echo "<script>alert('删除失败！');location.href='message.php'</script>";
}
 ?>
