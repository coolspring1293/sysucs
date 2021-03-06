<?php
require_once('auth_admin.php');
require_once('../functions.php');
require_once('../header.html');

if($_SESSION['admin'] !=1)
{
  header("Location:index.php");
  exit;
}

?>
<div class="container">
<br />
<br />
<br />

<div class="alert alert-info">

  <?php
$type = safeGet('type');
$dbc = newDbc();
if($type == "add")
{
  $subject = safePost('subject');
  $name = safePost('name');
  $major = safePost('major');
  $remark = $_POST['remark'];

  DB::insert( 'setting',array(
          'subject'=>$subject,
          'name'=>$name,
          'major'=>$major,
          'remark'=>$remark
      ));

  $stucture = "../upload/".$subject."/";
  if(!mkdir($stucture,0777))
  {
    die("创建文件夹失败，请手动创建<code>".$stucture."</code>,并更改权限为可写入！");
  }
}

else if($type=="change")
{
  $subject = safePost('subject');
  $name = safePost('name');
  $show = safePost('show');
  $major = safePost('major');
  $remark = $_POST['remark'];

    DB::update( 'setting',array(
          'name'=>$name,
          'show'=>$show,
          'major'=>$major,
          'remark'=>$remark
      ),"subject=%s",$subject);


  echo "更改成功！";
}
else if($type=="banner")
{
  $ID = safePost('ID');
  $imgUrl = safePost('imgUrl');
  $title = safePost('title');
  $content = safePost('content');
  $query = "update banner set title='".$title."',content='".$content."',imgUrl='".$imgUrl."' where ID ='".$ID."'";
  mysqli_query($dbc,$query) or die ("update failed ". $query);
  echo "更改成功！";
}

else
{
  echo "无任何操作！";
  exit;
}
?>

</div>

<a class='btn' href="/">回到首页</a>
<a class='btn' href="setting.php">设置页面</a>



