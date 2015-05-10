<?php
session_start();
require_once "header.php";

$isadmin = !empty($_SESSION['admin']);
if (!$isadmin)
	exit();

if (!empty($_GET['hide'])) {
	$vid = addslashes($_GET['hide']);
	mysql_query("UPDATE volume SET `visible` = '0' WHERE `vid` = '$vid'");
} else if (!empty($_GET['show'])) {
	$vid = addslashes($_GET['show']);
	mysql_query("UPDATE volume SET `visible` = '1' WHERE `vid` = '$vid'");
}
?>
<script>window.location.href="index.php?volume=<?=$vid ?>";</script>
