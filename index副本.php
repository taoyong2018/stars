<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>加星星</title>

<link type="text/css" rel="stylesheet" href="css/datouwang.css" />

</head>
<body>

<div id="calculator">
	<!-- Screen and clear key -->
	<div class="top">
		<span class="clear">萱萱</span>
		<div class="screen">0</div>
	</div>
	<div class="keys">
		<!-- operators and other keys -->
		<span>2</span>

		<span>1</span>

		<span class="eval">3</span>

		<span class="operator">4</span>
	</div>
</div>
<?php
//数据库配置
$con_db_host = "localhost";
$con_db_id   = "root";
$con_db_pass	= "123456";
$con_db_name = "met_stars";
$db_charset  =  "utf8";


$conn=mysql_connect($con_db_host,$con_db_id,$con_db_pass) or die("error connecting") ; //连接数据库
mysql_query("set names 'utf8'"); //数据库输出编码
mysql_select_db($con_db_name) or die("error select"); //打开数据库
$sql="select * from  met_stars_star";
$result = mysql_query($sql,$conn) or die("valid result");
echo "<table>";
while($row = mysql_fetch_array($result)) {
	$total_stars = $row["total_stars"];
	echo "<tr><td>";
	echo $row[star_time];
	echo "</td><td>";
	echo $row[task_name];
	echo "</td><td>";
	echo $row[task_star];
	echo "</td></tr>";
}
echo "</table>";
$total_stars=$total_stars+2;





echo <<<EOT
<script type="text/javascript">
var keys = document.querySelectorAll('#calculator span');
var input = document.querySelector('.screen');
input.innerHTML=
EOT;
echo $total_stars;
echo <<<EOT
;
for(var i = 0; i < keys.length; i++) {
	keys[i].onclick = function(e) {
		var inputVal = input.innerHTML;
		var btnVal = this.innerHTML;
		input.innerHTML = parseInt(inputVal)+parseInt(btnVal);
		e.preventDefault();
EOT;
$sql = "insert into met_stars (task_name,task_star,total_stars) vales('close',1,'$total_stars')";
mysql_query($sql);
mysql_close(); //关闭MySQL连接
echo <<<EOT
	}
}
</script>
EOT;

?>




</body>
</html>
