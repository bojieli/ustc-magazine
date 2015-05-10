<?php
require "header.php";
?>
<script type="text/javascript" src="static/ueditor/editor_config.js"></script>
<script type="text/javascript" src="static/ueditor/editor_all.js"></script>
<link rel="stylesheet" type="text/css" href="static/ueditor/themes/default/ueditor.css"/>
<h1>添加栏目题图</h1>
<p>&nbsp;</p>
<form>
<textarea id="editor">题图添加方法：点击左上角的“图片”按钮，在弹出的窗口内点击“本地上传”，点击“添加照片”并选择照片，点击“开始上传”，上传完成后“确认”即可。<br><br>随后在栏目中点击“修改题图”就能看到刚上传的题图了。</textarea>
</form>
<script type="text/javascript">
    var editor = new baidu.editor.ui.Editor({ toolbars:[['InsertImage']] });
    editor.render("editor");
</script>
</body>
</html>
