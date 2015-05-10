<?php
session_start();
include "header.php";
if (empty($_SESSION['admin'])) {
	exit();
}
if (!is_numeric($_GET['cid'])) {
	echo "<script>history.go(-1);</script>";
	exit();
}
if (is_numeric($_GET['cid']) && !empty($_GET['filename'])) {
	$cid = $_GET['cid'];
	$headpic = base64_decode($_GET['filename']);
	mysql_query("UPDATE channel SET `headpic` = '$headpic' WHERE `cid` = '$cid'");
	echo "<script>window.location='index.php';</script>";
	exit();
}

$cid = $_GET['cid'];
$channel = mysql_result(mysql_query("SELECT name FROM channel WHERE `cid` = '$cid'"), 0);
?>
<h1>设定 <?=$channel ?> 栏目题图</h1>
<h2>点击图片设为题图</h2>
<div class="photolist">
<?php
$dir = "static/ueditor/server/upload/uploadfiles/";
$handle = opendir($dir);
while ($file = readdir($handle)) {
if ($file != '.' && $file != '..') { ?>
<a href="headpic.php?cid=<?=$_GET['cid'] ?>&filename=<?=base64_encode($file) ?>">
<img width="300" src="static/ueditor/server/upload/uploadfiles/<?=$file ?>" />
</a>
<?php }
}
?>
</div>
</body>
</html>
