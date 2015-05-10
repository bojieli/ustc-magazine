<?php
require "header.php";
?>
<script type="text/javascript" src="static/ueditor/editor_config.js"></script>
<script type="text/javascript" src="static/ueditor/editor_all.js"></script>
<link rel="stylesheet" type="text/css" href="static/ueditor/themes/default/ueditor.css"/>
<?php
if (isset($_GET['pid'])) {
	$pid = addslashes($_GET['pid']);
	$post = mysql_fetch_array(mysql_query("SELECT * FROM post WHERE `pid` = '$pid'"));
	if (empty($post)) {
		unset($post);
		unset($_GET['pid']);
	}
}
?>
<h1><?=empty($_GET['pid']) ? '发表文章' : '编辑文章'; ?></h1>
<form class="large" action="post_submit.php" method="post">
<input type="hidden" id="pid" name="pid" value="<?=isset($_GET['pid']) ? $_GET['pid'] : 0 ?>" />
<p><select id="channel" name="channel"><option value="">请选择栏目</option>
<?php
$default = isset($post) ? $post['cid']: (isset($_GET['cid']) ? $_GET['cid'] : 0);
$rs = mysql_query("SELECT * FROM channel");
while ($row = mysql_fetch_array($rs)) { ?>
<option value="<?=$row['cid'] ?>"<?=$default == $row['cid'] ? ' selected="selected"' : '' ?>><?=$row['name'] ?></option>
<?php }
?>
</select>
&nbsp;&nbsp;&nbsp;<input type="text" id="title" name="title" value="<?=isset($post) ? $post['title'] : '' ?>" /></p>
<script type="text/plain" id="editor"><?=isset($post) ? $post['content'] : '' ?></script>
<p>顺序：<input style="width:50px" type="text" id="order" name="order" value="<?=isset($post) ? $post['order'] : 0 ?>" />&nbsp;&nbsp;&nbsp;调整文章的显示顺序：首先按序号排序，序号相同的按发表时间排序。序号越大，代表排列越靠前。默认为0。</p>
<p>作者：<input type="text" id="author" name="author" value="<?=isset($post) ? $post['author'] : '' ?>" /> 若不填写作者，将显示发表时间。</p>
<p>链接：<input type="text" id="link" name="link" value="<?=isset($post) ? $post['link'] : '' ?>" /> 若需要站外链接，填写此栏；否则留空。</p>
<p><button type="submit">发表文章</button></p>
</form>
<script type="text/javascript">
    var editor = new baidu.editor.ui.Editor({textarea: 'content', autoHeightEnabled:true});
    editor.render("editor");
</script>
</div>
</body>
</html>
