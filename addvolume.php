<?php
session_start();
require_once "header.php";

$isadmin = !empty($_SESSION['admin']);
if (!$isadmin)
	exit();
if (!empty($_POST['title'])) {
	mysql_query("INSERT INTO `volume` (`title`, `visible`) VALUES ('".addslashes(htmlspecialchars($_POST['title']))."', '0')");
	$volume = mysql_result(mysql_query("SELECT MAX(vid) FROM volume"), 0);
	
	// add default columns
	$columns = mysql_query("SELECT `name`,`order`,`headpic` FROM channel WHERE `vid`='1'");
	while ($column = mysql_fetch_array($columns)) {
		mysql_query("INSERT INTO `channel` SET `name` = '".$column['name']."',`order`='".$column['order']."',`headpic`='".$column['headpic']."',`vid`='$volume'");
	}
	echo "<script>window.location.href='index.php?volume=".$volume."';</script>";
}
?>
<h1>新建一期杂志</h1>
<h2>注意，新建的杂志只有管理员能看到。待编辑完毕后，在杂志上部点击“发布”方可使所有人都看到此期杂志。
<form class="large" action="addvolume.php" method="post">
<p>杂志标题：<input type="text" name="title" />
<button type="submit">提交</button>
</form>
