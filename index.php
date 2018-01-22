<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>加星星</title>
<link type="text/css" rel="stylesheet" href="css/datouwang.css" />
</head>
<?php
///数据库配置
$con_db_host = "localhost";
$con_db_id   = "root";
$con_db_pass	= "123456";
$con_db_name = "met_stars";
$db_charset  =  "utf8";
$conn=mysql_connect($con_db_host,$con_db_id,$con_db_pass) or die("error connecting") ; //连接数据库
mysql_query("set names 'utf8'"); //数据库输出编码
mysql_select_db($con_db_name) or die("error select"); //打开数据库

//test
//test
//test

#print_r($_POST);
//获得表单，累加存入数据库
if($_POST){
	$total_stars=$_POST["total_stars"]+$_POST["task_star"];
	#print_r($total_stars);
	$sql = "insert into met_stars_star
	 				(task_id,task_name,task_star,total_stars)
					values('1','".$_POST["task_name"]."','".$_POST["task_star"]."','".$total_stars."')";
	#echo $sql;
	mysql_query($sql,$conn);
}

//查询所有记录
$sql="select * from met_stars_star";
$result = mysql_query($sql,$conn) or die("valid result");
while($row = mysql_fetch_array($result)) {
	$total_stars = $row["total_stars"];
	$logg = "<tr><td>".$row[star_time]
				."</td><td>".$row[task_name]
				."</td><td>".$row[task_star]
				."</td><td>".$row[total_stars]
				."</td></tr>".$logg;
}
$logg = "<br><br><table>".$logg."</table>";

mysql_close(); //关闭MySQL连接

?>
<body>

<div id="calculator">
	<!-- Screen and clear key -->
	<div class="top">
		<span class="clear">萱萱</span>
		<div class="screen"><?php echo $total_stars;?></div>
	</div>
	<div class="keys">
		<!-- operators and other keys -->
		<span>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input class="operator" type="submit" name="num1" value="自己穿衣+1">
			<input type="hidden" name="task_name" value="one">
			<input  type="hidden" name="task_star" value="1">
			<input  type="hidden" name="total_stars" value="<?php echo $total_stars;?>">
			</form>
		</span>

		<span>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input class="operator" type="submit" name="num2" value="自己刷牙+2">
			<input type="hidden" name="task_name" value="two">
			<input  type="hidden" name="task_star" value="2">
			<input  type="hidden" name="total_stars" value="<?php echo $total_stars;?>">
			</form>
		</span>

		<span class="eval">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input class="operator" type="submit" name="num3" value="自己吃饭+3">
			<input type="hidden" name="task_name" value="three">
			<input  type="hidden" name="task_star" value="3">
			<input  type="hidden" name="total_stars" value="<?php echo $total_stars;?>">
			</form>
		</span>


	<?php echo $logg;?>
	</div>
</div>





</body>
</html>
