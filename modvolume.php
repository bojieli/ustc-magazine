<?php
session_start();
require_once "header.php";

$isadmin = !empty($_SESSION['admin']);
if (!$isadmin)
	exit();

$vid = addslashes(!empty($_GET['volume']) ? $_GET['volume'] : $_POST['volume']);
if (!empty($_POST['title'])) {
	mysql_query("UPDATE `volume` SET `title` = '".addslashes(htmlspecialchars($_POST['title']))."' WHERE `vid` = '$vid'");
	echo "<script>window.location.href='index.php?volume=".$volume."';</script>";
	exit();
}

$volume = mysql_fetch_array(mysql_query("SELECT * FROM volume WHERE `vid` = '$vid'"));
?>
<h1>修改杂志标题</h1>
<form class="large" action="modvolume.php" method="post">
<input type="hidden" name="volume" value="<?=$vid ?>" />
<p>杂志标题：<input type="text" name="title" value="<?=$volume['title'] ?>" />
<button type="submit">提交</button>
</form>
