<?php
require_once "db.php";
if (!is_numeric($_GET['pid']))
	exit();
$pid = $_GET['pid'];

session_start();
if (!isset($_SESSION["rate_$pid"])) {
	$_SESSION["rate_$pid"] = true;
	mysql_query("UPDATE post SET rate = rate + 1 WHERE `pid` = '$pid'");
}
echo mysql_result(mysql_query("SELECT rate FROM post WHERE `pid` = '$pid'"), 0);
?>
