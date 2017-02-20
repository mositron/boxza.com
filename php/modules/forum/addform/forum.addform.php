<!DOCTYPE html>
<head>
<meta charset="UTF-8">
</head>
<body>
<script>
var s = unescape(document.location.search.substring(1));
/*
var ig = /username_list|search/i;
var t=opener.document.getElementsByTagName('TEXTAREA');
for(var i=0;i<t.length;i++)
{
	if(!t[i].name.match(ig))
	{
		t[i].value = t[i].value+s;
		opener.focus();
		window.close();
		break;
	}
}
*/
opener.window.tinyMCE.execCommand('mceInsertContent', false, '<br>'+s+'<br>');
//opener.window.tinyMCE.execCommand('mceFocus',false,'post-msg');
window.close();			
</script>
</body>
</html>
<?php exit;?>