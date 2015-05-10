<?php
require "header.php";
$volume = mysql_result(mysql_query("SELECT MAX(vid) FROM volume WHERE visible = 1"),0);
echo $volume;
?>
