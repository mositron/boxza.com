<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Onion Emoticons</title>
<script>
function addemo(a)
{
	var t=opener.document.getElementsByTagName('TEXTAREA');
	for(var i=0;i<t.length;i++)
	{
		t[i].value=t[i].value+'[onion='+a+']';
	}
}
</script>
<style>
*{padding:0px; margin:0px;}
body{font-family:tahoma; font-size:12px; color:#555; background:#fff; padding:0px; margin:0px;}
img{border:0px;}
ul li{float:left; width:50px; height:50px; margin:5px 0px 0px 5px; list-style:none;}
ul li a{display:block; width:50px; height:50px;}

</style>
</head>
<body>
<ul>
<?php for($i=1;$i<=117;$i++):?>
<li><a href="javascript:;" onClick="addemo(<?php echo $i?>);"><img src="http://s0.boxza.com/static/images/forum/onion/<?php echo $i?>.gif"></a></li>
<?php endfor?>
<p style="clear:both;"></p>
</ul>
<div style="padding:5px; background:#f9f9f9; text-align:center;"><a href="javascript:;" onClick="window.close()">ปิดหน้าต่างนี้</a></div>
</body>
</html>
<?php exit;?>