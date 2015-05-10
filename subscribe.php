<?php
require_once "header.php";
$realname = addslashes($_POST['realname']);
$email = addslashes($_POST['email']);
if (empty($realname) || empty($email)) {
	echo '<script>alert("请输入真实姓名和 E-mail！");';
}
elseif (!isemail($email)) {
	echo '<script>alert("请输入真实可用的 E-mail 地址！");';
}
else {
	mysql_query("INSERT INTO subscribe SET `realname` = '$realname', `email` = '$email'");
	echo '<script>alert("您已成功订阅科大电子杂志，下次出刊时我们将邮件发送给您。");';
}
echo 'window.location="index.php";</script>';

// whether the string is a valid email address
function isemail($email) {
        return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
?>
