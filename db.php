<?php
$db['host'] = 'localhost';
$db['user'] = 'ustc-magazine';
$db['password'] = 'hzbjlsjr';
$db['dbname'] = 'magazine';

$status = mysql_connect($db['host'], $db['user'], $db['password']);
if (!$status)
	die('Database Connection Failure');
$status = mysql_select_db($db['dbname']);
if (!$status)
	die('Database Selection Failure');

unset($db);
?>
