<!DOCTYPE html>
<html>
<head>
<title><?php echo $pageData['title'];?></title>
<meta charset="utf-8">

<style type="text/css">
html, body {width:100%;height:100%;overflow:hidden;margin:0px;padding:0px;font-family:'Open Sans',sans-serif;font-size:16px}
body {background:url('/var/www/course-project-database/public/404.png') center no-repeat #333039}
.content {width:100%;text-align:center;position:absolute;bottom:10%;left:0px;}
.content a {display:inline-block;text-decoration:none}
.content a, .content a:hover {color:rgba(255,255,255,0.3);}
.content a:hover {color:rgba(255,255,255,0.5);}
@media only screen and (max-width: 460px), screen and (max-height: 700px) {
.content {position:static;}
.content a {display:block;width:100%;height:100%;position:absolute;top:0px;left:0px;font-size:0px;opacity:0;}
body {background-size:cover}
}
</style>
</head>

<body>
<div class="content">
	<a href="/"><p>Ошибка 404</p> Перейти к главной странице</a>
</div>
</body>
</html>