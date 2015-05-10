<?php
session_start();
require "header.php";

if (isset($_GET['logout'])) {
	session_destroy();
	echo '<script>window.location.href="index.php";</script>';
}

if (!empty($_POST)) {
	$username = addslashes($_POST['username']);
	$password = md5($_POST['password']);
	$rs = mysql_query("SELECT COUNT(*) FROM admin WHERE `username` = '$username' AND `password` = '$password'");
	$data = mysql_result($rs, 0);
	if (!empty($data)) {
		$_SESSION['admin'] = true;
		echo '<h1>登录成功，将跳转到首页...</h1>';
	} else {
		unset($_SESSION['admin']);
		echo '<h1>登录失败，请重新登录</h1>';
	}
}

if (empty($_SESSION['admin'])) { ?>
<h1>管理员登录</h1>
<form class="large" action="admin.php" method="post">
<table class="form">
<tr><td>用户名<td><input name="username" type="text" /></tr>
<tr><td>密码<td><input name="password" type="password" /></tr>
<tr><td><td><button type="submit">登录</button></tr>
</table>
</form>
<?php
} else {
	echo '<script>window.location.href="index.php";</script>';
}
?>
