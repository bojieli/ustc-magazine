<?php
session_start();
require_once "header.php";

$pid = addslashes(isset($_GET['pid']) ? $_GET['pid'] : 0);
$rs = mysql_query("SELECT * FROM post WHERE `pid` = '$pid'");
if (empty($rs))
	die('文章不存在！');
$post = mysql_fetch_array($rs);
?>
<style>
#share,#share a{line-height:16px;margin-bottom:7px}
#share a{display:inline-block;width:16px;height:16px;text-indent:-999em;cursor:pointer;margin-left:5px;background:url(http://photo.tuhigh.com/pics/1044/1024/187252t1287897845550_o.png) no-repeat}
#share a#renren-share{background-position:0 -64px}
#share a#douban-share{background-position:0 -80px}
#share a#sina-share{background-position:0 -96px}
#share a#netease-share{background-position:0 -112px}
#share a#tencent-share{background-position:0 -128px}
</style>
<script>
function addListener(node, type, listener, obj) {
	var param = obj || {};
 
	if(node.addEventListener) {
		node.addEventListener(type, function(ev){listener(ev, param);}, false);
		return true;
	} else if(node.attachEvent) {
		node['e' + type + listener] = listener;
		node[type + listener] = function() {
			node['e' + type + listener](window.event, param);
		};
		node.attachEvent('on' + type, node[type + listener]);
		return true;
	}
	return false;
}
 
function getParamsOfShareWindow(width, height) {
	return ['toolbar=0,status=0,resizable=1,width=' + width + ',height=' + height + ',left=',(screen.width-width)/2,',top=',(screen.height-height)/2].join('');
}
 
function bindShareList() {
	var link = encodeURIComponent(document.location); // 文章链接
	var title = encodeURIComponent(document.title.substring(0,76)); // 文章标题
	var source = encodeURIComponent('网站名称'); // 网站名称
	var windowName = 'share'; // 子窗口别称
	var site = 'http://www.example.com/'; // 网站链接
 
	addListener(document.getElementById('facebook-share'), 'click', function() {
		var url = 'http://facebook.com/share.php?u=' + link + '&t=' + title;
		var params = getParamsOfShareWindow(626, 436);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('twitter-share'), 'click', function() {
		var url = 'http://twitter.com/share?url=' + link + '&text=' + title;
		var params = getParamsOfShareWindow(500, 375);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('delicious-share'), 'click', function() {
		var url = 'http://delicious.com/post?url=' + link + '&title=' + title;
		var params = getParamsOfShareWindow(550, 550);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('kaixin001-share'), 'click', function() {
		var url = 'http://www.kaixin001.com/repaste/share.php?rurl=' + link + '&rcontent=' + link + '&rtitle=' + title;
		var params = getParamsOfShareWindow(540, 342);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('renren-share'), 'click', function() {
		var url = 'http://share.renren.com/share/buttonshare?link=' + link + '&title=' + title;
		var params = getParamsOfShareWindow(626, 436);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('douban-share'), 'click', function() {
		var url = 'http://www.douban.com/recommend/?url=' + link + '&title=' + title;
		var params = getParamsOfShareWindow(450, 350);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('sina-share'), 'click', function() {
		var url = 'http://v.t.sina.com.cn/share/share.php?url=' + link + '&title=' + title;
		var params = getParamsOfShareWindow(607, 523);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('netease-share'), 'click', function() {
		var url = 'http://t.163.com/article/user/checkLogin.do?link=' + link + 'source=' + source + '&info='+ title + ' ' + link;
		var params = getParamsOfShareWindow(642, 468);
		window.open(url, windowName, params);
	});
 
	addListener(document.getElementById('tencent-share'), 'click', function() {
		var url = 'http://v.t.qq.com/share/share.php?title=' + title + '&url=' + link + '&site=' + site;
		var params = getParamsOfShareWindow(634, 668);
		window.open(url, windowName, params);
	});
}
 
bindShareList();
</script>
<div class="post">
<h1><?=$post['title'] ?></h1>
<p class="midtext small">发表于 <?=date("Y-m-d h:i:s", $post['publish_time']) ?></p>
<div id="share">
	<span class="midtext">分享到：</span>
	<a rel="nofollow" id="renren-share" title="人人网">人人网</a>
	<a rel="nofollow" id="douban-share" title="豆瓣">豆瓣</a>
	<a rel="nofollow" id="sina-share" title="新浪微博">新浪微博</a>
	<a rel="nofollow" id="netease-share" title="网易微博">网易微博</a>
	<a rel="nofollow" id="tencent-share" title="腾讯微博">腾讯微博</a>
</div>
<?php if (!empty($_SESSION['admin'])) {
	echo '<h2><a href="post.php?pid='.$post['pid'].'">修改本文</a></h2>';
} ?>
<?=$post['content'] ?>
<script type="text/javascript" src="static/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#vote").click(function(){
    $.get("rate.php?pid=<?=$post['pid'] ?>", function(result){
      $("#votecount").html(result);
    });
  });
});
</script>
<div id="vote"><span class="count" id="votecount"><?=$post['rate'] ?></span><span class="text">顶一下<span></div>
</div>
<p id="footer">&copy;2011 <a href="http://ustc.edu.cn">中国科学技术大学</a>&nbsp;&nbsp;&nbsp;<a href="admin.php">管理员登录</a></p>
</body>
</html>
