<?php
session_start();
if (empty($_SESSION['admin'])) {
	exit();
}
require "header.php";

if (is_numeric($_GET['pid'])) {
	mysql_query("DELETE FROM post WHERE `pid` = '".$_GET['pid']."'");
}
?>
<script>history.go(-1);</script>
