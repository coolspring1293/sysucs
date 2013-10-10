<?php
require_once('auth_admin.php');
require('../functions.php');
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>view download</title>
    <style type="text/css">
#logo{
font-size:28px;
line-height:59px;
margin:1px 3px 3px;
}
      .form{
        margin:0px 0px 0px !important;
margin-bottom:0px !important;
        display:inline;
      }
      thead td
      {
        font-size:20px;
      }
      tbody td
      {
        font-size:18px;
      }
    </style>
    <link media="all" rel="stylesheet" href="../..//css/bootstrap.min.css" type="text/css" />
  </head>
  <body>
<?php
   date_default_timezone_set('PRC');
        $today = date("Y/m/d");
        $date_second = strtotime($today);
        $index = 1;
        $dbc =newDbc();
        mysqli_query($dbc,"set names utf-8");
        $query = "SELECT * FROM down WHERE time >= ".$date_second." ORDER BY time DESC";
          $result =mysqli_query($dbc,$query);
          $num_results = $result->num_rows;
?>
<a name="top"></a>
<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
    <div class="container">
<a class="brand" href="../">SYSUCS.ORG</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
<li> <a href="./">Home</a> </li>
<?php
if($_SESSION['admin'] ==1)
{
    echo '
    <li> <a href="wadmin.php" >文件管理</a> </li>
<li> <a href="viewUsers.php">用户管理</a> </li>
<li> <a href="setting.php"> 网站设置</a> </li>
';
}

?>

<li> <a href="viewip.php" >访问统计</a> </li>
<li> <a href="todayCoin.php" >今日金币</a> </li>
<li class="active"> <a href="viewdown.php" >下载统计</a> </li>
            </ul>
          </div><!--/.nav-collapse -->




</div>
</div>
</div>
    <div class="container">
      <br />
      <br />
      <br />
 <big>今日 <?php echo $num_results; ?> </big> 
</form>

      <table width="100%" class="table table-striped table-bordered">
        <thead >
          <tr>
            <td width="40px">序号</td>
            <td >时间</td>
            <td >ip</td>
            <td >user</td>
            <td >UA</td>
          </tr>
        </thead>
        <tbody>
        <?php
               for($i=1;$i<=$num_results;$i++)
          {
              $row = mysqli_fetch_array($result);
              echo "<tr>
                     <td>".$i."</td>
                     <td>".date(" H:i",$row['time'])."</td>
                     <td>".$row['ip']."</td>
                     <td>".$row['user']."</td>
                     <td>".($row['file'])."</td>
                    </tr>

                    ";
          
          }




        ?>
        </tbody>
      </table>
<a name="bottom"></a>
<br />
<br />
<br />


  </body>
</html>
