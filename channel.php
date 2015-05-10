<?php
require "header.php";

if (isset($_GET['cid'])) {
	$cid = addslashes($_GET['cid']);
	$post_rs = mysql_query("SELECT * FROM channel WHERE `cid` = '$cid'");
	if (empty($post_rs)) {
		unset($_GET['cid']);
	} else {
		$post = mysql_fetch_array($post_rs);
	}
}
?>
<h1><?=empty($post) ? '添加新栏目' : '编辑栏目' ?></h1>
<form class="large" action="channel_submit.php" method="post">
<input type="hidden" name="volume" value="<?=$_GET['volume'] ?>" />
<input type="hidden" id="cid" name="cid" value="<?=isset($post) ? $post['cid'] : 0 ?>" />
<p>栏目名称：<input type="text" id="name" name="name" value="<?=isset($post) ? $post['name'] : '' ?>" /></p>
<p>栏目题图：<a class="large" href="headpic.php?cid=<?=$_GET['cid'] ?>">点此修改</a>&nbsp;<img width="250" src="static/ueditor/server/upload/uploadfiles/<?=isset($post) ? $post['headpic'] : '' ?>" /></p>
<p>题图介绍：<input type="text" id="headpic_desc" name="headpic_desc" value="<?=isset($post) ? $post['headpic_desc'] : '' ?>" /></p>
<p>显示顺序：<input type="text" style="width:50px" id="order" name="order" value="<?=isset($post) ? $post['order'] : 0 ?>" />&nbsp;&nbsp;&nbsp;从大到小排序</p>
<p><button type="submit">提交</button></p>
</form>
<h2>栏目列表</h2>
<table>
<tr><th>显示顺序<th>栏目名称<th>文章篇数<th></tr>
<?php
if (!empty($post['vid']))
	$vid = $post['vid'];
else {
if (empty($_GET['volume']))
	$vid = mysql_result(mysql_query("SELECT MAX(vid) FROM volume WHERE `visible` = 1"), 0);
else
	$vid = addslashes($_GET['volume']);
}
$rs = mysql_query("SELECT * FROM channel WHERE `vid` = '$vid' ORDER BY `order` DESC");
while ($channel = mysql_fetch_array($rs)) {
	$cid = $channel['cid'];
	$order = $channel['order'];
	$name = $channel['name'];
	$num = intval(mysql_result(mysql_query("SELECT COUNT(*) FROM post WHERE `cid` = '$cid'"), 0));
	echo "<tr><td>$order<td>$name<td>$num<td><a href=\"channel.php?cid=$cid \">编辑此栏目</a></tr>";
}
?>
</table>
</body>
</html>
