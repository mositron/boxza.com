<!-------------------------- CHAT ---------------------------->
<style type="text/css">
.bz_chat{background:#000 url(http://s0.boxza.com/static/images/forum/chat/bg.png) 0px 0px repeat-x; border-collapse:inherit; margin:5px 0px 2px; border-radius:5px; position:relative}
.bz_chat h3{background:url(http://s0.boxza.com/static/images/forum/chat/icon.chat.png) 0px 0px no-repeat; height:60px; margin:0px}
.bz_chat span.img img{ height:16px; vertical-align:text-bottom}
.bz_chat span.img2 img{ height:38px; width:38px; vertical-align:text-bottom; float:left; margin:2px 5px 2px 0px}
.bz_chat a b{font-weight:normal}
.bz_chat_ch,.bz_chat_nl{padding:0px;background-color: #fff;font:10px;height: 420px;overflow:auto;}
.bz_chat_ch{float:left; width:535px; margin:0px 0px 0px 5px; border-radius:5px;}
.bz_chat_ch_l > div{padding:0px 0px}
.bz_chat_ch_l > div > a{display:block; line-height:0px; width:32px; height:32px; float:left; margin:2px 6px 2px 2px;}
.bz_chat_ch_l > div > a img{width:32px; height:32px;}
.bz_chat_ch_l > div > p{height:15px; line-height:15px; margin:2px 0px 0px 40px}
.bz_chat_ch_l > div > p span{font-size:11px; cursor:pointer}
.bz_chat_ch_l > div > p i{display:inline-block; width:12px; height:15px;background:url(http://s0.boxza.com/static/images/forum/chat/icon.chat.png) -2px -80px no-repeat; vertical-align:text-bottom; margin-right:3px;}
.bz_chat_ch_l > div > p a{color:#222; font-weight:bold; font-size:12px;}
.bz_chat_ch_l > div > div{margin-left:40px;}
.bz_chat_ch_l > div > span{display:block; clear:both;}
.bz_chat_ch .l0{background:#fafafa;}
.bz_chat_ch .c1{color:#000000;}
.bz_chat_ch .c2{color:#000055;}
.bz_chat_ch .c3{color:#008000;}
.bz_chat_ch .c4{color:#FF0000;}
.bz_chat_ch .c5{color:#800000;}
.bz_chat_ch .c6{color:#800080;}
.bz_chat_ch .c7{color:#FF5500;}
.bz_chat_ch .c8{color:#FFFF00;}
.bz_chat_ch .c9{color:#008080;}
.bz_chat_ch .c10{color:#00FFFF;}
.bz_chat_ch .c11{color:#0000FF;}
.bz_chat_ch .c12{color:#7F7F7F;}
.bz_chat_ch .c13{color:#D2D2D2;}
.bz_chat_ch .c21{color:#cc6600;}

.bz_chat_ch p.p{color:#C00;}

.bz_chat_room{ position:absolute; right:5px; top:20px;}

.bz_chat_room li{float:right;}
.bz_chat_room li a{display:inline-block; height:26px; line-height:26px; padding:0px 15px; border-radius:5px; background:#333; border:1px solid #111; margin:0px 2px; color:#ccc}
.bz_chat_room li.on a{background:#000; border:1px solid #F60; color:#f60;}

.bz_chat_nl{background-color: #fff; float:right; width:170px; overflow:auto; margin:0px 5px 0px 0px; border-radius:5px;}
.bz_chat_nl_h{padding:3px; background-color:#f1f2f2; border-bottom:1px solid #dfdfdf}
.bz_chat_nl_h i{ display:inline-block; width:20px; height:17px;background:url(http://s0.boxza.com/static/images/forum/chat/icon.chat.png) -34px -80px no-repeat; margin-right:5px; vertical-align:text-bottom;}
.bz_chat_nl_l > div{padding:1px 0px; border-bottom:1px dashed #ddd;}
.bz_chat_nl_l > div.l0{background:#f9f9f9}
.bz_chat_nl_l > div > a{display:block; line-height:0px; width:16px; height:16px; float:left; margin:2px 5px 2px 2px;}
.bz_chat_nl_l > div > a img{width:16px; height:16px;}
.bz_chat_nl_l > div > p a{color:#222;}
.bz_chat_nl_l > div > span{display:block; clear:both;}

.bz_chat_emo{float:left; width:400px; height:23px; line-height:23px; overflow:hidden; vertical-align:middle; margin-bottom:5px;}
.bz_chat_emo a{display:inline-block}
.bz_chat_emo img{vertical-align:middle}

.bz_chat_col{height:16px; overflow:hidden; line-height:16px; vertical-align:text-top; width:250px; float:right; text-align:right; margin-top:5px;}


.bz_chat_popup{text-align:center;position:absolute;top:0px;left:0px; right:0px; bottom:0px; overflow:hidden;background:rgba(255, 255, 255, 0.7) url(../images/global/gbox.png) left top repeat; z-index:199999; display:none}
.bz_chat_popup_ct{display: table;height: 100%;table-layout: fixed;width: 100%;}
.bz_chat_popup_in{display: table-cell;text-align: center;vertical-align: middle;width: 100%;}
.bz_chat_popup_wr{display: inline-block;outline: none;text-align: left;position:relative}
.bz_chat_popup_wl{ margin:20px 0px; zoom:1; background-color:#fff; padding:1px 1px 5px; border:1px solid #eee;}

.bz_chat_pv{width:150px; float:left;font-size:14px; height:20px; line-height:20px;	border:1px inset #ccc;background-color: #f9f9f9; margin:0px 0px 2px; padding:0px 0px; overflow:hidden}


.bz_chat_box{margin:4px 5px 0px; padding:0px 0px 0px}
.bz_chat_swf{width:1px; height:1px; overflow:hidden}
textarea.bz_chat_mb{ width: 555px; float:right;font-size:14px; height:20px; line-height:20px;	border:1px inset #ccc;background-color: #f9f9f9; margin:0px 0px 2px; padding:0px 0px; resize:none; overflow:hidden}
.bz_chat_login{padding:10px; text-align:center; color:#fff;}
.bz_chat_color{margin:3px; width:10px; height:10px; overflow:hidden;display:block; float:right;}
.bz_chat_color.sel{margin:0px; border:3px solid #000;width:10px; height:10px; overflow:hidden;display:block; float:right;}
* html .bz_chat_color.sel{width:16px; height:16px; }
.bz_chat_scroll{cursor:pointer}
#clearcheck,#scollcheck,#fullwinddow{cursor:pointer;}
#clearcheck{ margin-right:15px;}
</style>
<div>
<div class="bz_chat">
<h3 title="BoxZa Chat"></h3>
<div class="bz_chat_room"><ul><li class="bz_chat_room_boyz"><a href="javascript:;" onClick="_.chatbox.sroom('boyz');">ห้อง Boyz</a></li><li class="bz_chat_room_forum"><a href="javascript:;" onClick="_.chatbox.sroom('forum');">ห้อง Forum</a></li></ul></div>
<div class="bz_chat_popup"></div>
<div>
<div class="bz_chat_ch"><div class="bz_chat_ch_l"></div></div>
<div class="bz_chat_nl">
<div class="bz_chat_nl_h"><i></i>สมาชิกที่กำลังออนไลน์</div>
<div class="bz_chat_nl_l"></div>
</div>
<p class="clear"></p>
</div>
<div class="bz_chat_box">
<div class="bz_chat_swf"><embed src="http://s0.boxza.com/static/flash/chat/sound.swf" quality="high"  wmode="transparent" loop="false"  id="bz_chat_swf" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1" height="1"></embed></div>
<div>
<select name="mp" class="bz_chat_pv"><option value="0">ส่งถึงทุกคน</option></select>
<textarea name="ms" class="bz_chat_mb" maxlength="100"></textarea>
<p class="clear"></p>
</div>
<div>
<div class="bz_chat_col">
  <a href="javascript:;" onClick="_.chatbox.color('1')" class="bz_chat_color sel1" style="background:#000000"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('2')" class="bz_chat_color sel2" style="background:#000055"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('3')" class="bz_chat_color sel3" style="background:#008000"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('4')" class="bz_chat_color sel4" style="background:#FF0000"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('5')" class="bz_chat_color sel5" style="background:#800000"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('6')" class="bz_chat_color sel6" style="background:#800080"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('7')" class="bz_chat_color sel7" style="background:#FF5500"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <!--a href="javascript:;" onClick="_.chatbox.color('8')" class="bz_chat_color sel8" style="background:#FFFF00"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a-->
  <a href="javascript:;" onClick="_.chatbox.color('9')" class="bz_chat_color sel9" style="background:#008080"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <!--a href="javascript:;" onClick="_.chatbox.color('10')" class="bz_chat_color sel10" style="background:#00FFFF"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a-->
  <a href="javascript:;" onClick="_.chatbox.color('11')" class="bz_chat_color sel11" style="background:#0000FF"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <a href="javascript:;" onClick="_.chatbox.color('12')" class="bz_chat_color sel12" style="background:#7F7F7F"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a>
  <!--a href="javascript:;" onClick="_.chatbox.color('13')" class="bz_chat_color sel13" style="background:#D2D2D2"><img src="http://s0.boxza.com/static/images/global/trans.gif"></a--> 
  <span style="clear:both"></span><span id="whisper"></span>
  <img src="http://s0.boxza.com/static/images/chat/scroll_on.gif" class="bz_chat_scroll show-tooltip-s" title="ข้อความเลื่อนลงอัตโนมัติ" onClick="_.chatbox.scroll()" />
  <img src="http://s0.boxza.com/static/images/chat/frame_on.gif" id="clearcheck" class="show-tooltip-s" title="เคลียร์ข้อความ" onClick="_.chatbox.clear();" />
</div> 
<div class="bz_chat_emo">
<a href="javascript:;" onClick="_.chatbox.emo('01')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_01.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('02')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_02.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('03')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_03.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('04')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_04.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('05')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_05.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('06')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_06.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('07')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_07.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('08')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_08.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('09')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_09.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('10')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_10.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('11')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_11.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('12')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_12.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('13')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_13.gif" /></a>
            <a href="javascript:;" onClick="_.chatbox.emo('14')"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_14.gif" /></a>
  <span>[<a href="javascript:void(0);" onClick="window.open('/emoticon', '_onion', 'resizable=yes,width=620,height=450');return false;" style="color:#fff;">เพิ่มเติม</a>]</span>
</div>
<div style="clear:both"></div>
</div> 
</div>
</div>
<p class="clear"></p>
</div>

<script type="text/javascript">
_.chatbox={
	_scroll:true,lastid:0,tmr:'',index:0,_cbg:0,_ubg:0,tmp:'',dl:null,ide:100,room:'<?php echo isset($room)?$room:'forum'?>',info:new Object,cin:0,u:new Object,loaded:false,
	emo:function(text)
	{
		var txtarea = $('.bz_chat_mb').get(0);
		text = '[emo=' + text + ']';
		if (txtarea.createTextRange && txtarea.caretPos)
		{
			var caretPos = txtarea.caretPos;
			caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
			txtarea.focus();
		} else {
			txtarea.value  += text;
			txtarea.focus();
		}
	},
	popup:function(a)
	{
		$('.bz_chat_popup').css('display','block').html('<div class="bz_chat_popup_ct"><div class="bz_chat_popup_in"><div class="bz_chat_popup_wr"><div class="bz_chat_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
		$('.bz_chat_popup_wl').html('<div style="width:300px; text-align:center"><h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.chatbox.u[a].name+'</h4><div style="padding:10px;"><a href="http://boxza.com/'+_.chatbox.u[a].link+'" class="btn" target="_blank">ไปยังโปรไฟล์</a> <input type="button" class="btn" onclick="_.chatbox.whisper(\''+a+'\')" value="กระซิบ"></div><input type="button" value="ปิดหน้าต่างนี้" class="btn" onclick="_.chatbox.cpop()">');
	},
	whisper:function(a)
	{
		var s=false;
		$('.bz_chat_pv option').each(function(index, element) {
         if($(this).attr('value')==a)
			{
				s=true;
			}
      });
		if(!s)
		{
			$('.bz_chat_pv').append('<option value="'+a+'">ส่งถึง.. '+_.chatbox.u[a].name+'</option>')
		}
		$('.bz_chat_pv').val(a);
		_.chatbox.cpop();
		$('.bz_chat_mb').focus();
	},
	cpop:function()
	{
		$('.bz_chat_popup').css('display','none');
	},
	sroom:function(t)
	{
		$('.bz_chat_room li').removeClass('on');
		$('.bz_chat_room_'+t).addClass('on');
		$('.bz_chat_ch_l,.bz_chat_nl_l').html('');
		_.chatbox.room=t;
		_.chatbox.lastid=0;
		_.chatbox.ide=0;
		_.chatbox.loaded=false;
		_.chatbox.api('list',{'last':_.chatbox.lastid});
	},
	onion:function(text)
	{
		var txtarea = $('.bz_chat_mb').get(0);
		text = '[onion=' + text + ']';
		if (txtarea.createTextRange && txtarea.caretPos) {
			var caretPos = txtarea.caretPos;
			caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
			txtarea.focus();
		} else {
			txtarea.value  += text;
			txtarea.focus();
		}
	},
	convert:function(t)
	{
		_.chatbox.cin=0;
		return t.replace(/\[emo=([0-9]{2})\]/ig,function(t2){
			_.chatbox.cin++;
			if(_.chatbox.cin>3)
			{
				return '';
			}
			else
			{
				return t2.replace(/\[emo=([0-9]{2})\]/ig,'<img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_$1.gif">');
			}
		}).replace(/\[onion=([0-9]+)\]/ig,function(t2){
			_.chatbox.cin++;
			if(_.chatbox.cin>3)
			{
				return '';
			}
			else
			{
				return t2.replace(/\[onion=([0-9]+)\]/ig,'<img src="http://s0.boxza.com/static/images/forum/onion/$1.gif">');
			}
		});
		
	},
	api:function(a)
	{
		clearTimeout(_.chatbox.tmr);
		_.api('/global/chatbox/'+_.chatbox.room+'/'+a,(arguments.length>1?arguments[1]:[]));
		_.chatbox.tmr=setTimeout(function(){_.chatbox.delay()},Math.max(2,Math.min(30,1+parseInt(_.chatbox.ide/10)))*1000);
	},
	color:function(a)
	{
		if(arguments.length==1)$('.bz_chat_mb').attr('color',a).focus();
		$('.bz_chat_color.sel').removeClass('sel');
		$('.bz_chat_color.sel'+a).addClass('sel');
	},
	clear:function()
	{
		$('.bz_chat_ch_l').html('');
	},
	delay:function()
	{	
		_.chatbox.index++;
		if(_.chatbox.index>3)
		{
			_.chatbox.index=0;
			_.chatbox.api('list',{'last':_.chatbox.lastid});
		}
		else
		{
			_.chatbox.api('idle',{'last':_.chatbox.lastid});
		}
	},
	scroll:function()
	{
		_.chatbox._scroll=!_.chatbox._scroll;
		$('.bz_chat_scroll').attr('src','http://s0.boxza.com/static/images/chat/scroll_'+(_.chatbox._scroll?'on':'off')+'.gif');
	},
	upscroll:function()
	{
		if(_.chatbox._scroll)
		{
			$('.bz_chat_ch').animate({ scrollTop: Math.max($('.bz_chat_ch_l').height(),$('.bz_chat_ch').height())+100})
		}
	},
	parse:function(a,b)
	{
		//alert(b);
		var c;
		switch(b)
		{
			case 'login':			
				_.chatbox._ubg++;
				_.chatbox._ubg = _.chatbox._ubg % 2;
				$('.bz_chat_ch_l').append('<div id="bz_chat_text_login"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a></p><div class="c0">กรุณาล็อคอินเข้าระบบเพื่อใช้งานการสนทนานี้ (<a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)))?>">ล็อคอิน</a> หรือ <a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/signup/?redirect_uri='.urlencode(URI)))?>">สมัครสมาชิก</a>)</div><span></span></div>');
				_.chatbox.upscroll();
				break;
			case 'fail':
				$('.bz_chat_pv option[value="'+b+'"]').remove();
				_.chatbox._ubg++;
				_.chatbox._ubg = _.chatbox._ubg % 2;
				$('.bz_chat_ch_l').append('<div id="bz_chat_text_login"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a></p><div class="c0">ไม่สามารถกระซิบถึงบุคคลดังกล่าวได้</div><span></span></div>');
				_.chatbox.upscroll();
				break;
			case 'list':
				if(a)
				{
					var t=''+Math.floor(Math.random()*100000);
					for(j in a)
					{
						c=a[j];
						if(!$('#bz_chat_user'+c._id).length)
						{
							_.chatbox.u[c._id]={'_id':c._id,'link':c.l,'img':c.i,'name':c.n};
							_.chatbox._ubg++;
							_.chatbox._ubg = _.chatbox._ubg % 2;
							$('.bz_chat_nl_l').append('<div id="bz_chat_user'+c._id+'" class="l'+_.chatbox._ubg+'" lasttime="'+t+'"><a href="javascript:;" onclick="_.chatbox.popup(\''+c._id+'\');"><img src="'+c.i+'"></a><p><a href="javascript:;" onclick="_.chatbox.popup(\''+c._id+'\',\''+c.l+'\',\''+c.n+'\');" class="forum_level_'+(c.lv?c.lv:'')+'">'+c.n+'</a></p><span></span></div>');
						}
						else
						{
							$('#bz_chat_user'+c._id).attr('lasttime',t);
						}
					}
					$('.bz_chat_nl_l > div').each(function() {
                  if($(this).attr('lasttime')!=t)
						{
							$(this).remove();
						}
               });
				}
				break;
			case 'chat':		
				if(a)
				{
					var snd=false;
					for(var j=0;j<a.length;j++)
					{
						c=a[j];
						if(!$('#bz_chat_text'+c._sn).length)
						{
							_.chatbox.lastid=c._id;
							snd=true;
							_.chatbox._cbg++;
							_.chatbox._cbg = _.chatbox._cbg % 2;						
							if(!c.p)
							{
								$('.bz_chat_ch_l').append('<div id="bz_chat_text'+c._sn+'" class="l'+_.chatbox._cbg+'"><a href="http://boxza.com/'+c.l+'" target="_blank"><img src="'+c.i+'"></a><p><span>['+c.t+']</span> <i></i><a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a></p><div class="c'+c.c+'">'+_.chatbox.convert(c.m)+'</div><span></span></div>');
							}
							else
							{
								$('.bz_chat_ch_l').append('<div id="bz_chat_text'+c._sn+'" class="l'+_.chatbox._cbg+'"><a href="http://boxza.com/'+c.l+'" target="_blank"><img src="'+c.i+'"></a><p class="p"><span>['+c.t+']</span> <i></i><a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a> ส่งข้อความถึง <a href="http://boxza.com/'+c.pl+'" target="_blank">'+c.pn+'</a></p><div class="c'+c.c+'">'+_.chatbox.convert(c.m)+'</div><span></span></div>');
							}
						}
					}
					if(snd)
					{
						_.chatbox.sound(2);
					}
					if(!_.chatbox.loaded)
					{					
						_.chatbox._ubg++;
						_.chatbox._ubg = _.chatbox._ubg % 2;
						_.chatbox.loaded=true;
						$('.bz_chat_ch_l').append('<div id="bz_chat_text_login"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ยินดีต้อนรับสู่ BoxZa Chat</a></p><div class="c0">'+
						'หากต้องการคุยกับเพื่อนแบบส่วนตัว ให้คลิกที่ชื่อของเพื่อนทางด้านขวามือ(สมาชิกที่กำลังออนไลน์) แล้วเลือก "กระซิบ"</div><span></span></div>');
					}
					_.chatbox.upscroll();
				}
				break;
		}
	},
	sound:function(s){
		//alert(typeof($('#bz_chat_swf').get(0).sdcplay));
	 if(typeof($('#bz_chat_swf').get(0).sdcplay)=='function')$('#bz_chat_swf').get(0).sdcplay(s);},
	load:function()
	{
		_.chatbox.color(1,1);
		$('.bz_chat_mb').keypress(function(e){
			var c=(e.keyCode?e.keyCode:e.which);
			var ms=$.trim($(this).val());
			if(c==13&&ms!='')
			{
				$(this).val('');
				_.chatbox.ide=0;
				_.chatbox.api('send',{'last':_.chatbox.lastid,'uid':$('.bz_chat_pv').val(),'color':$(this).attr('color'),'ms':ms});
			}
		});
		
		_.chatbox.sroom(_.chatbox.room);
	}
}

_.chatbox.load();
</script>
<!-------------------------- CHAT ---------------------------->