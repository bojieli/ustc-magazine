<?php
session_start();
if (empty($_SESSION['admin'])) {
	exit();
}
require "header.php";

$pid = is_numeric($_POST['pid']) ? addslashes($_POST['pid']) : 0;
$cid = addslashes($_POST['channel']);
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$order = isset($_POST['order']) ? addslashes($_POST['order']) : 0;
$link = isset($_POST['link']) ? addslashes($_POST['link']) : '';
$author = isset($_POST['author']) ? addslashes($_POST['author']) : '';

if (empty($cid) || empty($title) || empty($content)) {
	echo '<script>history.go(-1);</script>';
	exit();
}

if (!empty($pid)) {
	mysql_query("UPDATE post SET `cid` = '$cid', `title` = '$title', `content` = '$content', `order` = '$order', `link` = '$link', `author` = '$author' WHERE `pid` = '$pid'");
}
else {
	$time = time();
	mysql_query("INSERT INTO post SET `publish_time` = '$time', `cid` = '$cid', `title` = '$title', `order` = '$order', `content` = '$content', `link` = '$link', `author` = '$author'");
}
?>
<script>window.location.href="index.php";</script>
