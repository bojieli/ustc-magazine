<?php
session_start();
if (empty($_SESSION['admin'])) {
	exit();
}
require "header.php";

// filter input
foreach ($_POST as $key => $value) {
	$_POST[$key] = addslashes($value);
}

$cid = is_numeric($_POST['cid']) ? $_POST['cid'] : 0;
$name = $_POST['name'];
$order = isset($_POST['order']) ? $_POST['order'] : 0;
$headpic_desc = $_POST['headpic_desc'];
$vid = $_POST['volume'];

if (!empty($cid)) {
	mysql_query("UPDATE channel SET `name` = '$name', `order` = '$order', `headpic_desc` = '$headpic_desc' WHERE `cid` = '$cid'");
}
else {
	mysql_query("INSERT INTO channel SET `name` = '$name', `order` = '$order', `vid` = '$vid'");
}
?>
<script>window.location.href="index.php";</script>
