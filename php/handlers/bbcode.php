<?php

class bbcode
{
	public $hidelink;
	public $code=array();
	public $badword='';
	public function __construct()
	{
		$this->hidelink='<span style="padding:3px;margin:2px;border:1px solid #F0F0F0; background:#FCFCFC;">[ <b style="color:#FF0000">เฉพาะสมาชิกเท่านั้น ถึงจะสามารถเห็น Link นี้</b> ] (<a href="http://oauth.boxza.com/signup?redirect_uri='.urlencode(URI).'"><b>สมัครสมาชิก</b></a> | <a href="http://oauth.boxza.com/login?redirect_uri='.urlencode(URI).'"><b>เข้าระบบ</b></a>)</span>';
		$this->badword=require(HANDLERS.'boxza/badword.php');
	}
	public function get($text,$login=false)
	{
		$text = str_replace('<','&lt;',$text);
		$text = str_replace('>','&gt;',$text);
		
		$text = str_replace($this->badword,'---banned---',$text);
		
		$text=strip_tags($text);
		$text = preg_replace_callback("/\[code\](.*?)\[\/code\]/ism",array($this,"pre_start"),$text);
		$search[0] = "#\[link\]([a-z]+?://){1}(.*?)\[/link\]#si";
		$search[1] = "#\[link\](.*?)\[/link\]#si";
		$search[2] = "#\[link=([a-z]+?://){1}(.*?)\](.*?)\[/link\]#si";
		$search[3] = "#\[link=(.*?)\](.*?)\[/link\]#si";
		$search[4] = "#\[email\](.*?)\[/email\]#si";
		$search[5] = "#\[email=(.*?){1}(.*?)\](.*?)\[/email\]#si";
		$search[6] = "#\[url\]([a-z]+?://){1}(.*?)\[/url\]#si";
		$search[7] = "#\[url\](.*?)\[/url\]#si";
		$search[8] = "#\[url=([a-z]+?://){1}(.*?)\](.*?)\[/url\]#si";
		$replace[0] = '<a href="\1\2" target="_blank" rel="nofollow">\1\2</a>';
		$replace[1] = '<a href="http://\1" target="_blank" rel="nofollow">\1</a>';
		$replace[2] = '<a href="\1\2" target="_blank" rel="nofollow">\3</a>';
		$replace[3] = '<a href="\1" target="_blank" rel="nofollow">\2</a>';
		$replace[4] = '<a href="mailto:\1" rel="nofollow">\1</a>';
		$replace[5] = '<a href="mailto:\1\2" rel="nofollow">\3</a>';
		$replace[6] = '<a href="\1\2" target="_blank" rel="nofollow">\1\2</a>';
		$replace[7] = '<a href="http://\1" target="_blank" rel="nofollow">\1</a>';
		$replace[8] = '<a href="\1\2" target="_blank" rel="nofollow">\3</a>';
		$search[10] = "#\[b\](.*?)\[/b\]#si";
		$replace[10] = '<strong>\1</strong>';
		$search[11] = "#\[i\](.*?)\[/i\]#si";
		$replace[11] = '<em>\1</em>';
		$search[12] = "#\[u\](.*?)\[/u\]#si";
		$replace[12] = '<u>\1</u>';
		$search[13] = "#\[img\](.*?)\[/img\]#si";
		$replace[13] = '<img src="\1" alt="" style="vertical-align:middle; border:0">';
		$search[14] = "#\[center\](.*?)\[/center\](\s+)?#si";
		$replace[14] = '<div style="text-align:center">\1</div>';
		$search[15] = "#\[left\](.*?)\[/left\](\s+)?#si";
		$replace[15] = '<div style="text-align:left">\1</div>';
		$search[16] = "#\[right\](.*?)\[/right\](\s+)?#si";
		$replace[16] = '<div style="text-align:right">\1</div>';
		$search[17] = "#\[blockquote\](.*?)\[/blockquote\](\s+)?#si";
		$replace[17] = '<div class="indent">\1</div>';
		$search[20] = "/\[size=([1-2]?[0-9])\](.*?)\[\/size\]/si";
		$replace[20] = '<span style="font-size:\1px">\2</span>';
		$search[32] = "/\[size=(.*?)\](.*?)\[\/size\]/si";
		$replace[32] = '<span style="font-size:\1">\2</span>';
		$search[21] = "#\[edited\](.*?)\[/edited\]#si";
		$replace[21] = '<span class="smallblacktext">[ \1 ]</span>';
		$search[22] = "#\[br\]#si";
		$replace[22] = '<br>';
		$search[23] = "#\[emo=(.*?)]#si";
		$replace[23] = ' <img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_\1.gif"> ';
		$search[24] = "#\[quote\](\s+)?#si";
		$replace[24] = '<div dir="ltr" class="quote"><div class="qoute_detail">';
		$search[25] = "#\[quote=(.*?)\]#si";
		$replace[25] = '<div dir="ltr" class="quote"><div class="quote_user">อ้างอิงจาก <span>\1</span></div><div class="quote_detail">';
		$search[26] = "#\[/quote\](\s*)?#si";
		$replace[26] = '</div></div>';
		$search[27] = "#\[hide\](.*?)\[/hide\]#si";
		$replace[27] = '<div><a href="javascript:;" onclick="var _1=this.parentNode.getElementsByTagName(\'DIV\')[0]; _1.style.display=(_1.style.display==\'none\'?\'block\':\'none\');">กดเพื่อดูข้อความที่ถูกซ่อน</a><div style="display:none">\1</div></div>';
		$search[28] = "#\[hide=(.*?)\](.*?)\[/hide\]#si";
		$replace[28] = '<div><a href="javascript:;" onclick="var _1=this.parentNode.getElementsByTagName(\'DIV\')[0]; _1.style.display=(_1.style.display==\'none\'?\'block\':\'none\');">\1</a><div style="display:none">\2</div></div>';
		$search[29] = "/\[color=(.*?)\](.*?)\[\/color\]/si";
		$replace[29] = '<span style="color:\1">\2</span>';
		//$search[30] = "/\[youtube\](http:\/\/)?(www\.)?youtube\.com\/watch\?v=([^&]+)(.*)?\[\/youtube\]/i";
		
		//$replace[30] = '#\[youtube\](.*?)((?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11}))(.*?)\[\/youtube\]#si';
    	//$replace[30] = '<iframe width="700" height="395" src="http://www.youtube.com/embed/\2" frameborder="0" allowfullscreen></iframe>';

		#$replace[30] = '#\[youtube\]((?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?)\[\/youtube\]#is';
    	#$replace[30] = '<iframe width="700" height="395" src="http://www.youtube.com/embed/\1" frameborder="0" allowfullscreen></iframe>';

	

//@\[youtube\].*?(?:v=)?([^?&[]+)(&[^[]*)?\[/youtube\]@is
		$search[30] = '/\[youtube\](.*?)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^\[#\&\?]*)([^\[]*)\[\/youtube\]/i';
		$replace[30] = '<iframe width="700" height="395" src="http://www.youtube.com/embed/\8" frameborder="0" allowfullscreen></iframe>';
		//$replace[30] = '<iframe width="700" height="395" src="http://www.youtube.com/embed/\3" frameborder="0" allowfullscreen></iframe>';
		$search[31] = "#\[onion=(.*?)]#si";
		$replace[31] = ' <img src="http://s0.boxza.com/static/images/forum/onion/\1.gif"> ';
		$text = preg_replace($search, $replace, $text);
		//$text = preg_replace_callback('/([^"|^\'|^>])(http:\/\/|https:\/\/|ftp:\/\/)([^\s,]*)/i',array($this,'linkout'),$text);
		$text = preg_replace('/([^"|^\'|^>])(http:\/\/|https:\/\/|ftp:\/\/)([^\s,]*)/i','$1<a href="$2$3" target="_blank" rel="nofollow">$2$3</a>',$text);
		$text = preg_replace('/([^"|^\'|^>])([A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4})/i','$1<a href="mailto:$2" rel="nofollow">$2</a>',$text);
		$text= nl2br($text);
		$text = preg_replace_callback('/\[code\](.*?)\[\/code\]/ism',array($this,'pre_end'),$text);
		$text=str_replace(array('<br /><pre ','</pre><br />'),array('<pre ','</pre>'),$text);
		return $text;
	}
	function linkout($url)
	{
		return $url[1].'1<a href="http://boxza.com/out/'.strtr(base64_encode($url[2].$url[3]), '+/', '-_').'" target="_blank" rel="nofollow">'.$url[2].$url[3].'</a>';
		//return strtr(base64_encode($url[2].$url[3]), '+/', '-_');
	}
	function pre_start($t)
	{
		$c=count($this->code);
		$this->code[$c]='<pre class="brush: php;">'.preg_replace(array('/\<br \/\>/','/\[code\+\]/i','/\[\/code\+\]/i'),array('','[code]','[/code]'),$t[1]).'</pre>';
		return '[code]'.$c.'[/code]';
	}
	function pre_end($t)
	{
		return $this->code[trim($t[1])];
	}
}
?>