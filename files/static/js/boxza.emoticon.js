/*  */



$.extend(_,
{
	emoticon:
	{
		input:false,lastemo:'',
		open:function(inp)
		{
			_.emoticon.input=inp;
			_.emoticon.show('o');
		},
		insert:function(t)
		{
			t='[emoticon='+t+']';
			_.emoticon.input.val(_.emoticon.input.val()+' '+t).focus();
			_.emoticon.cpop();
		},
		cpop:function(){$('.bz-emoticon-popup').css('display','none');$('html').removeClass('hdMode');	},
		show:function(ty)
		{
			if(!ty)
			{
				ty=_.emoticon.lastemo;
			}
			else
			{
				_.emoticon.lastemo=ty;
			}
			var w=$(window).width(),h=$(window).height(),c='',cn='';
			var _c={o:117,y:180,r:94,p:95,a:110,m:53,l:21,b:18,c:10};
			if(c=_c[ty])
			{
				if(!$('.bz-emoticon-popup').length)
				{
					$('body').append('<div class="bz-emoticon-popup"></div>');
				}
				$('.bz-emoticon-popup').css({'display':'block','width':w,'height':h,'left':$(window).scrollLeft(),'top':$(window).scrollTop()}).html('<div class="bz-emoticon-popup-ct"><div class="bz-emoticon-popup-in"><div class="bz-emoticon-popup-wr"><div class="bz-emoticon-popup-wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
				var t='<div style="height:24px;line-height:24px; background:#f5f5f5; padding:0px 10px;">';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'o\')"'+(ty=='o'?' style="font-weight:bold;color:#f90"':'')+'">Onion</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'y\')"'+(ty=='y'?' style="font-weight:bold;color:#f90"':'')+'">Yoyo</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'r\')"'+(ty=='r'?' style="font-weight:bold;color:#f90"':'')+'">Rabbit</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'p\')"'+(ty=='p'?' style="font-weight:bold;color:#f90"':'')+'">Panda</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'a\')"'+(ty=='a'?' style="font-weight:bold;color:#f90"':'')+'">Raccoon</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'m\')"'+(ty=='m'?' style="font-weight:bold;color:#f90"':'')+'">Milk Bottle</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'l\')"'+(ty=='l'?' style="font-weight:bold;color:#f90"':'')+'">Leaf</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'b\')"'+(ty=='b'?' style="font-weight:bold;color:#f90"':'')+'">Red Crab</a> | ';
				t+='<a href="javascript:;" onclick="_.emoticon.show(\'c\')"'+(ty=='c'?' style="font-weight:bold;color:#f90"':'')+'">Cloud</a>';
				t+='</div><ul class="bz-emoticon-pemo" style="width:'+(w-100)+'px; height:'+(h-220)+'px; overflow:auto;">';
				for(var i=1;i<=c;i++)
				{
					t+='<li><a href="#['+ty+i+']" onClick="_.emoticon.insert(\''+ty+i+'\');return false;"><img src="http://s0.boxza.com/static/chat/emoticon/'+ty+'/'+i+'.gif" class="bz-emoticon-click-emo '+ty+'"></a></li>'
				}
				t+='<p style="clear:both;"></p></ul><div style="padding:5px; text-align:center;"><input type="button" value="ปิดหน้าต่างนี้" class="button" onclick="_.emoticon.cpop()"></div>';
				$('.bz-emoticon-popup-wl').html(t);
				$('html').addClass('hdMode');	
			}
		}
	}
});