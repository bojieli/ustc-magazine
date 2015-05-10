<?php
session_start();
require_once "header.php";

$isadmin = !empty($_SESSION['admin']);

if (empty($_GET['volume'])) {
	if ($isadmin)
		$vid = mysql_result(mysql_query("SELECT MAX(vid) FROM volume"), 0);
	else
		$vid = mysql_result(mysql_query("SELECT MAX(vid) FROM volume WHERE `visible` = 1"), 0);
}
else
	$vid = addslashes($_GET['volume']);

$volume = mysql_fetch_array(mysql_query("SELECT * FROM volume WHERE `vid` = '$vid'"));
?>
<div style="position:relative;">
<div style="position:absolute; right:30px; top: -50px; font-size: 24px; font-weight: bold; color: white; font-family: SimHei"><?=$volume['title'] ?></div>
</div>
<?php
if ($isadmin) { 
	echo '<h2>';
	echo '<a href="admin.php?logout">退出管理</a>';
	echo '&nbsp;&nbsp;<a href="channel.php?volume='.$vid.'">添加新栏目</a>';
	echo '&nbsp;&nbsp;<a href="addpic.php" target="_blank">添加栏目题图</a>';
	echo '</h2><h2>';
	echo $volume['title'];
	if ($volume['visible'])
		echo '杂志已经发布。<a href="volume.php?hide='.$vid.'">隐藏本期</a>';
	else
		echo '杂志尚未发布。<a href="volume.php?show='.$vid.'">点此发布</a>';
	echo '&nbsp;&nbsp;<a href="modvolume.php?volume='.$vid.'">修改杂志标题</a>';
	echo '&nbsp;&nbsp;<a href="addvolume.php">新建一期杂志</a>';
	echo '</h2>';
} else if (!$volume['visible']) {
	echo '<h1>此期杂志尚未发布！</h1>';
	exit();
}
// $volume['title'] not used yet
?>
<ul class="news">
<?php
$rs = mysql_query("SELECT * FROM channel WHERE `vid` = '$vid' ORDER BY `order` DESC");
while ($row = mysql_fetch_array($rs)) {
	$cid = $row['cid'];
	echo '<li><p class="title"><span>'.$row['name'].'</span>';
	if ($isadmin) {
		echo '&nbsp;&nbsp;&nbsp;<a href="channel.php?cid='.$row['cid'].'" target="_blank">编辑此栏目</a>';
		echo '&nbsp;<a href="post.php?cid='.$row['cid'].'">发表文章</a>';
		echo '&nbsp;<a href="headpic.php?cid='.$row['cid'].'" target="_blank">修改题图</a>';
	}
	echo '</p>';
	
	echo '<div class="photo"><img width="300" src="';
	if (!empty($row['headpic'])) {
		echo 'static/ueditor/server/upload/uploadfiles/'.$row['headpic'];
	} else {
		echo 'static/images/'.$row['cid'].'.jpg';
	}
	echo '"/><p>'.$row['headpic_desc'].'</p></div>';

	echo '<ul>';
	$posts_rs = mysql_query("SELECT * FROM post WHERE `cid` = '$cid' ORDER BY `order` DESC");
	while ($post = mysql_fetch_array($posts_rs)) {
		echo '<li>';
		if (!empty($post['link']))
			echo '<a href="'.$post['link'].'" target="_blank">'.$post['title'].'</a>';
		else
			echo '<a href="view.php?pid='.$post['pid'].'" target="_blank">'.$post['title'].'</a>';
		if ($isadmin) {
			echo '<a href="post.php?pid='.$post['pid'].'" target="_blank">　编辑</a>　';
			echo '<a href="delete.php?pid='.$post['pid'].'">　删除</a>';
		}
		if (!empty($post['author']))
			echo '<span class="time">'.$post['author'].'</span>';
		else
			echo '<span class="time">'.date("m-d", $post['publish_time']).'</span>';
		echo "</li>\n";
	}
	echo "</ul></li>\n";
}
?>
</ul>
<p class="footnote">往期杂志</p>
<div class="subscribe">
<?php
if ($isadmin)
	$rs = mysql_query("SELECT * FROM volume");
else
	$rs = mysql_query("SELECT * FROM volume WHERE visible = 1");

while ($volume = mysql_fetch_array($rs)) {
	echo '<a href="index.php?volume='.$volume['vid'].'">'.$volume['title'].'</a>&nbsp;&nbsp;';
}
?>
</div>
<p class="footnote">欢迎您浏览中国科大新闻网电子杂志。</p>
<div class="subscribe">
<form action="subscribe.php" method="post">
<strong>免费订阅：</strong> 姓名: <input type="text" name="realname" />&nbsp;&nbsp;
E-mail: <input type="text" name="email" />&nbsp;&nbsp;
<button type="submit">现在订阅</button>
</form>
</div>
<p id="footer">版权所有 &copy;2011 <a href="http://ustc.edu.cn">中国科学技术大学</a> 主办：中国科学技术大学新闻网<br />地址：安徽省合肥市金寨路96号 邮编：230026</p>
</body>
</html>
