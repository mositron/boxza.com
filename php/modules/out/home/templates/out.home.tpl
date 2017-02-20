<script>
var Base64 = {
	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
	
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
	
		while (i < input.length) {
	
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
	
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
	
			output = output + String.fromCharCode(chr1);
	
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
	
		}
	
		output = Base64._utf8_decode(output);
	
		return output;
	
	},
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
	
		while ( i < utftext.length ) {
	
			c = utftext.charCodeAt(i);
	
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
	
		}
	
		return string;
	}
}

var intd,cd=0;
$(function(){intd=setInterval(function(){reducintd()},100);});
function reducintd()
{
	if(cd<100)
	{
		cd++;
		$('#countd').html(cd);
		$('#appendd').append('.');
	}
	else
	{
		clearInterval(intd);
		var hash = window.location.hash;
		if(hash.length>1)
		{
			var h=$.trim(Base64.decode(hash.substr(1)));
			if(h)
			{
				window.location.href=h;
				return;	
			}
		}
		$('#counte').html('เกิดข้อผิดพลาด ลิ้งค์ปลายทางไม่ถูกต้อง...');
	}
}
</script>
<div class="row-fluid olg">
<div class="olg-l span7 col-side">

<h3>BoxZa.com เครือข่ายสังคมออนไลน์สัญชาติไทย ที่มาพร้อมกับบริการต่างๆมากมาย</h3>


<?php
$key='oauth_signup_service';
$cache=_::cache();
if(!$content=$cache->get('ca1',$key))
{
	//_::time();
	$db=_::db();
	$template=_::template();
	
	$tm = strtotime(date('Y-m-d'))+(3600*24*14);
	$movie=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'v'=>1,'t2'=>1,'tm'=>1,'d'=>1),array('sort'=>array('cs'=>-1,'tm'=>-1),'limit'=>12));
	shuffle($movie);
	$movie=array_slice(array_values($movie),0,1);
	$template->assign('movie',$movie[0]);

	$game=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>48));
	shuffle($game);
	$game=array_slice(array_values($game),0,4);
	$template->assign('game',$game);

	$sexy=$db->find('forum',array('c'=>array('$in'=>array(38,412,413,414,415,416,417,418,419,420)),'dd'=>array('$exists'=>false),'s'=>array('$ne'=>''),'fd'=>array('$ne'=>''),'rc'=>1),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>30));
	shuffle($sexy);
	$sexy=array_slice(array_values($sexy),0,6);
	$template->assign('sexy',$sexy);

	$template->assign('is_line',$arg['line']);
	$content=$template->fetch('home.service');
	
	
	$cache->set('ca1',$key,$content,false,300);
}

echo $content;
?>

</div>
<div class="olg-r span5 col-content">

<div class="olg-log">
<h2>ลิ้งค์ไปยังเว็บภายนอก</h2>
<div style="padding:10px; font-size:18px; line-height:2em">กรุณารอซักครู่...<br>ระบบจะทำการนำท่านยังไปเว็บปลายทาง.<br>
<div><span id="countd" style="color:#f00; font-size:28px">0</span> %</div>
<div><span id="appendd" style="font-size:11px; color:#F60;"></span></div>
</div>
<div id="counte" style="color:#fff; padding:10px;"></div>
</div>
<script type="text/javascript" src="http://www.yengo.com/show.cgi?adp=53999"></script>

</div>
</div>









