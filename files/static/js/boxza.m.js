$.extend(_,{
	profile:{
		history:new Object,
		updating:true,
		po:{
			parse:function(a){
				if(a.line&&a.count&&a.data)
				{
					$('.ln-poll-'+a.line+' label').each(function(i,c) {
						$(this).css('background-position',Math.floor((a.data[i] / Math.max(1,a.count))*560)+'px -143px').find('i').html(a.data[i]+' โหวต');
					});
				}
			}
		},
		lk:{
			parse:function(a){
				var b=a.l+(a.i?'-'+a.i:'');
				if(a.s=='like')
				{
					$('.lk-'+b).addClass('like');
					$('.lk-c-'+b).html(a.c?a.c:'0');
				}
				else if(a.s=='unlike')
				{
					$('.lk-'+b).removeClass('like');
					$('.lk-c-'+b).html(a.c?a.c:'0');
				}
				else if(a.s=='list')
				{
					
				}
			}
		},
		cm:{
			post:function(e,t){var c=(e.keyCode?e.keyCode:e.which);if(c==13&&!e.shiftKey){var txt=$.trim(t.value);if(txt)_.api('/me/comment/'+$(t).data('cm')+'/insert',{'message':txt});t.value='';return false;}},
			parse:function(a)
			{
				if(a.type=='list')
				{
					if(a.cm && a.cm.d)
					{
						if(a.t=='clear')$('.cm-d-'+a._id+' .cm-s').remove();
						if(a.cm.c)$('.cm-c-'+a._id).html(a.cm.c);
						for(var i=0;i<a.cm.d.length;i++)_.profile.cm.insert(a._id,a.cm.d[i]);
						$('.cm-l-'+a._id).html('ความคิดเห็นทั้งหมด');
					}
				}
				else if(a.type=='delete')
				{
					$('.cm-d-'+a._id+' .cm-s-'+a.i).remove();
					$('.cm-c-'+a._id).html(a.c);
				}
			},
			insert:function(a,cm)
			{
				var n=(arguments.length>2?true:false),_l='',_t='<div class="cm-s cm-s-'+cm.i+'" uid="'+cm.u._id+'">'+
								'<div class="av" av="'+cm.u._id+'"><a href="/'+cm.u.link+'" class="h" title="'+cm.u.name+'"><img src="'+cm.u.himg+'" class="img-uid-'+cm.u._id+'"></a></div><div class="cm-d">'+
								'<div class="cm-r"><span class="cm-de" onclick="_.profile.cm.act('+a+','+cm.i+');"></span>';
									_l+='<span class="bk">'+
									'<span class="lk lk-'+a+'-'+cm.i+(cm.lm?' like':'')+'">'+
									'<span onclick="_.api(\'/me/like/'+a+'-'+cm.i+'\')" class="like ptr"><i class="ptr" title="โดน"></i></span>'+
									'<span onclick="_.api(\'/me/like/'+a+'-'+cm.i+'/unlike\')" class="unlike ptr"><i class="ptr" original-title="เฉยๆ"></i></span>'+
									'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-'+a+'-'+cm.i+'">'+cm.lc+'</span></span>'+
									'</span>'+
									'</span>';
									_l+='<span class="ago" datetime="'+cm.t+'">'+_.time.cal(cm.t)+'</span>';
								if(!n)
								{
									_t+=_l;
								}
								_t+=' <span class="cm-u"><a href="/'+cm.u.link+'" class="h">'+cm.u.name+'</a></span></div>';
								if(n)
								{
									_t+=_l;
								}
								_t+='<div class="cm-dt ev">'+_.itag(cm.m)+'</div>'+
								'</div><p class="clear"></p></div>';
				if(!$('.cm-d-'+a+' .cm-s-'+cm.i).length && !n)
				{
					$('.cm-d-'+a).append(_t);
				}
				if($('.hd-cm-d-'+a).length && !n)
				{
					if(!$('.hd-cm-d-'+a+' .cm-s-'+cm.i).length)$('.hd-cm-d-'+a).append(_.profile.cm.insert(a,cm,true));
				}
				return _t;
			}
		}
	},
	post:{
		send:function(e)
		{
			
		},
		delto:function(e)
		{
			var i=e.parentNode;
			(i.parentNode).removeChild(i);
		},
		group:function(e,i)
		{
			if(!$('#lto-l-'+i).length)
			{
				var f=i.split('-');
				if(i=='-1')
				{
					$('#lto-l-0').remove();
				}
				else if(i=='0')
				{
					$('#lto-l--1').remove();
				}
				$('#lto').append('<span id="lto-l-'+i+'" class="lto-'+i+(f[0]=='fb'?' lto-fb':'')+'"><p></p><input type="hidden" name="to[]" value="'+i+'"> '+$(e).html()+' <i onClick="_.post.delto(this)"></i></span>');
			}
			return false;
		},
		geo:function(){if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(p){_.ajax.gourl('/line','getvar','geo',p.coords.latitude,p.coords.longitude);});}},
		photo:function(){_.ajax.gourl('/line','getvar','photo');},
		expand:function(a)
		{
			if(!a)
			{
				$('#post-msg').focus();
			}
			else if(a=='photo')
			{
				_.ajax.gourl('/line','getvar','photo');
			}
			else if(a=='geo')
			{
				_.post.geo();
			}
			
		}
	},
	hash: {
		popped: false, initurl:location.href,
		hash:function(){
			var h=window.location.hash
			_url= (h.substr(0,2)=='#!')?h.substr(2):'';
			alert(h+' - '+_url);
			if(!_.hash.popped && _url)
			{
				_.hash.go('#!'+_url);
			}
		},
		go:function(h)
		{
			if(h && h.substr(0,2)=='#!')
			{
				var url=h.substr(2);
				_.line.go(h.substr(2),true,true);
			}
		},
		close:function()
		{
			if(_.hash.popped)
			{
				history.pushState({ path: location.pathname }, '', location.pathname);
			}
		},
		top:function(){$('html,body').animate({scrollTop:0}, 500,'easeOutExpo');}
	},
	line:{
		getnew:function(now)
		{
			clearTimeout(_.line.timer);
			var a=_.url,b=(a=='/'?'/line':a);
			if(now&&b.substring(0,5)=='/line')_.line.reload(false);
			_.line.timer=setTimeout(function(){_.line.getnew(true);},60000);
		},
		
		go:function(url)
		{
			if(url.length<2)url='/line';
			var u = url.split('/');
			if(_.hash.popped || ('state' in window.history))
			{
				_.hash.popped=true;
				if(url!=_.url)
				{
					history.pushState({ path: url }, '', url);
				}
			}
			else
			{
				window.location.href = '#!'+url;
			}
			_.url=_.line.last=url;
			_.line.reload(true);
			_.line.lasted=_.line.last;
		},
		reload:function(loading)
		{
			_.profile.updating=false;
			if(loading)$.mobile.loading('show',{text: 'กำลังโหลด',textVisible: true,theme: 'a',html: ''});
			$.ajax({
								 url: '/ajax'+_.url,
								 type: 'GET',
								 error : function (){ }, 
								 success: function (data) {
									  $('#bz-content-in').html(data).trigger('create');
									  if(loading)$.mobile.loading('hide');
										_.line.update();
										$('#bz-content-in').scrollz('hidePullHeader');
								 },
								 error: function()
								 {
									_.profile.updating=true; 
									$('#bz-content-in').scrollz('hidePullHeader');
								 }
			});
		},
		update:function()
		{
			_.time.ago();
			_.line.getnew(false);
			_.profile.updating=true;
			$('.dt:not(.ev),.cm-dt:not(.ev)').each(function(){
				if(!$(this).hasClass('ev'))
				{
					$(this).addClass('ev').html(_.itag($(this).html(),$(this).data('user'),$(this).parent().parent().data('expand')));
				}
			});
		},
		
		parse:function(a,b)
		{
			_.profile.updating=false;
			if(b=='hide')
			{
				$('.ln-'+a+' .ct').css('display','none').after('<div class="ct-h">ซ่อนโพสนี้เรียบร้อยแล้ว (<span class="ptr2" onclick="_.api(\'/me/line/unhide-'+a+'\');">ยกเลิก</span>)</div>');
			}
			else if(b=='unhide')
			{
				$('.ln-'+a+' .ct').css('display','block');
				$('.ln-'+a+' .ct-h').remove();
			}
			else if(b=='ignore')
			{
				$('#_line .ln[uid='+a+'] .ct').css('display','none').after('<div class="ct-h">ซ่อนโพสทั้งหมดจากบุคคลนี้เรียบร้อยแล้ว (<span class="ptr2" onclick="_.api(\'/me/line/unignore-'+a+'\');">ยกเลิก</span>)</div>');
			}
			else if(b=='unignore')
			{
				$('#_line .ln[uid='+a+'] .ct').css('display','block');
				$('#_line .ln[uid='+a+'] .ct-h').remove();
			}
			else if(b=='list')
			{
				if(!a)return;
				$('.ln-next').remove();
				_.line.content='';
				_.line.start = parseInt($('#_line .ln:first').length?$('#_line .ln:first').data('ds'):0);
				_.line.end = parseInt($('#_line .ln:last').length?$('#_line .ln:last').data('ds'):0);
		
				for(var j=0;j<a.length;j++)
				{
					var b=a[j];
					if($('#_line_ln'+b._id).length)
					{
						if(b.cm && b.cm.d)
						{
							$('.cm-c-'+b._id).html(b.cm.c);
						}
						$('.lk-c-'+b._id).html(b.lk&&b.lk.c?b.lk.c:'0');
						$('.sh-c-'+b._id).html(b.sh&&b.sh.c?b.sh.c:'0');
						$('.cm-c-'+b._id).html(b.cm&&b.cm.c?b.cm.c:'0');
					}
					else
					{
						if(b.ds >= _.line.start)
						{
							_.line.start = b.ds;
							$('#_line').prepend(_.line.convert(b));
						}
						else if(b.ds <= _.line.end)
						{
							_.line.end = b.ds;
							$('#_line').append(_.line.convert(b));
						}
						else
						{
							$('#_line .ln').each(function(){
								var  c = parseInt($(this).data('ds'));
								if(b.ds < c)
								{
									$(this).before(_.line.convert(b));
									return false;
								}
							});
						}
					}
				}
				_.urled = _.url;
				if(a.length==30 && !$('.ln-next').length)
				{
					$('#_line').append('<div class="ln-next"><span onclick="_.line.next()" class="ptr2" style="display:block">โหลดข้อมูลเพิ่มเติม</span></div>');
				}
				_.line.update();
			}
		},
		next:function()
		{
			var n=parseInt($('#_line .ln:last').length?$('#_line .ln:last').data('ds'):0),a=_.url,b=(a=='/'?'/line':a);
			if(n && $('.ln-next span').length && b.substring(0,5)=='/line')
			{
				_.url=_.urled=b;
				$('.ln-next').html('กรุณารอซักครู่...');
				_.api('/me'+b+'/next-'+n);
			}
			else if(n && $('.ln-next span').length && $('#_line').data('profile'))
			{
				_.url=_.urled=b;
				$('.ln-next').html('กรุณารอซักครู่...');
				_.api('/profile-'+$('#_line').data('profile')+'/line/next-'+n);
			}
		},
		convert:function(p)
		{
			var $v = '<div id="_line_ln'+p._id+'" data-ln="'+p._id+'" data-ha="'+(p.ha?1:0)+'" data-ds="'+p.ds+'" data-ty="'+p.ty+'" data-uid="'+p.u._id+'" data-pid="'+(p.p?p.p._id:'')+'" class="ln ln-'+p._id+'" data-expand="'+(p.is_profile?1:'')+'">'+
			'<div class="av"'+(p.u._id?' av="'+p.u._id+'"':'')+'><a href="/'+p.u.link+'" class="h" title="'+p.u.name+'"><img src="'+p.u.himg+'" class="img-uid-'+p.u._id+'"></a></div>'+
			
			'<div class="ct-s"><a href="/'+p.u.link+'" class="sm-a h">'+p.u.name+'</a></div>'+
			'<div class="ct-si"><span class="inter" ';
			if($.inArray(0,p.inm)>-1)
			{
				$v+='data-ref="0">สาธารณะ';
			}
			else if($.inArray(-1,p.inm)>-1)
			{
				$v+='data-ref="-1">เฉพาะเพื่อน';
			}
			else 
			{
				$v+='data-ref="-2">ส่วนตัว';
			}
			$v+='</span>, <span class="ago" datetime="'+p.ds+'"></span></div>'+
			'<div class="ct">';
			if(p.p && !p.is_profile)
			{
				$v+='<div class="ct-pf">โพสต์บนไลน์ของ <span class="av" av="'+p.p._id+'"><a href="/'+p.p.link+'" class="h" title="'+p.p.name+'"><img src="'+p.p.himg+'"></a></span> <span class="n"><a href="/'+p.p.link+'" class="h" title="'+p.p.name+'">'+p.p.name+'</a></span></div>';
			}
			
			if(p.ty=='gift')
			{
				$v+='<div><div style="width:138px; margin:5px 5px 0px; padding:5px 0px; border:1px solid #f5f5f5; float:left"><img src="http://s1.boxza.com/gift/128/'+p.tt+'.png"></div>';
				$v+='<div class="dt ev" style="width:"400px; float:left">'+(p.ms?_.itag(p.ms,p.uk,p.is_profile):'')+'</div>';
				$v+='<p class="clear"></p></div>';
			}
			else if(p.ty=='quiz')
			{
				$v+='<div><div style="width:138px; margin:5px 5px 0px; padding:5px 0px; border:1px solid #f5f5f5; float:left"><img src="http://s0.boxza.com/static/images/profile/quiz.png"></div>';
				$v+='<div class="dt ev" style="width:"350px; float:left">'+(p.ms?_.itag(p.ms,p.uk,1):'')+'</div>';
				$v+='<p class="clear"></p><div>*** เฉพาะสมาชิกที่สมัครด้วย Facebook หรือยืนยันการสมัครสมาชิกผ่านอีเมล์แล้วเท่านั้น ***</div></div>';
			}
			else
			{
				$v+='<div class="dt ev">'+(p.ms?_.itag(p.ms,p.uk,p.is_profile):'')+'</div>';
			}
			if(p.ty=='poll' && p.po && p.po.d)
			{
				$v+='<div class="ln-poll ln-poll-'+p._id+'"><div class="l">สร้างเมื่อ <span class="ago" datetime="'+p.da+'">'+_.time.cal(p.da)+'</span>, จำนวนผู้ร่วมโหวตทั้งหมด '+p.po.c+' คน</div>';
				for(var b=0;b<p.po.d.length;b++)
				{
					$v+='<div><label style="background-position:'+Math.floor((p.po.d[b].c / Math.max(1,p.po.c))*560)+'px -143px"><input type="radio" name="poll-'+p._id+'" value="'+p.po.d[b].i+'" onClick="_.api(\'/me/poll/'+p._id+'-'+p.po.d[b].i+'\')"'+(_.my && $.inArray(_.my._id,p.po.d[b].u)>-1?' checked':'')+'> '+p.po.d[b].m+'<i>'+p.po.d[b].c+' โหวต</i><p></p></label></div>';
				}
				$v+='</div>';
			}
			
			if(p.pt && p.pt.tmp)
			{
				$v+='<div class="pt"><a href="/line/'+p._id+'" data-rel="dialog" data-transition="slidedown"><img src="'+p.pt.tmp+'"></a></div>';
			}
			else if(p.ty=='album' && p.pt && p.pt.f)
			{
				$v+='<div class="pt"><ul class="pt-al">';
				for(var j=0;j<p.pt.f.length;j++)
				{
					$v+='<li><a href="/line/'+p.pt.f[j].i+'" data-rel="dialog" data-transition="slidedown"><img src="'+p.pt.f[j].tmp+'"></a></li>';
				}
				$v+='<p class="clear"></p></ul></div>';
			}
			if(p.at)
			{
				$v+='<div class="vid-tt"><a href="'+p.at.l+'" target="_blank" rel="nofollow">'+p.at.t+'</a></div>';
				if(p.at.i)
				{
					$v+='<div class="vid-im"><a href="'+p.at.l+'" target="_blank" rel="nofollow"'+(p.at.v?' class="v" onclick="_.line.embed(this,\''+p.at.v.l+'\','+p.at.v.w+','+p.at.v.h+');return false;"':'')+'><img src="'+p.at.i+'" style="max-width:500px; max-height:375px;"><i></i></a></div>';
				}
				if(p.at.d)
				{
					$v+='<div class="vid-dc">'+p.at.d+'</div>';
				}
			}
			if(p.lc)
			{
				$v += '<div><div class="mp">'+
				'<img src="//maps.googleapis.com/maps/api/staticmap?center='+p.lc.l[0]+','+p.lc.l[1]+'&markers=color:blue%7Clabel:A%7C'+p.lc.l[0]+','+p.lc.l[1]+'&zoom=15&size=490x150&maptype=roadmap&sensor=false" style="margin:5px 0px 5px 5px">'+
				'<div class="mp-n">'+p.lc.n+'</div></div></div>';
			}
	
			if(p.sh && p.sh.d)
			{
				var s=p.sh.d;
				$v+='<div class="sh-z">'+
						'<div class="av" av="'+s.u._id+'"><a href="/'+s.u.link+'" class="h" title="'+s.u.name+'"><img src="'+s.u.img+'" class="img-uid-'+s.u._id+'"></a></div>'+
						'<div class="sh-hd-ur"><a href="/'+s.u._link+'" class="h u">'+s.u.name+'</a> แบ่งปัน<a href="'+(p.is_profile?'/'+p.is_profile:'')+'/line/'+s._id+'" class="h">โพสต์นี้</a>เป็นคนแรก </div>'+
						'<div class="ct">'+
						'<div class="dt">'+s.ms+'</div>';
				if(s.pt&&s.pt.tmp)
				{
					$v+='<div class="pt"><a href="/line/'+s._id+'" data-rel="dialog" data-transition="slidedown"><img src="'+s.pt.tmp+'"></a></div>';
				}
				else if(s.ty=='album' && s.pt && s.pt.f)
				{
					$v+='<div class="pt"><ul class="pt-al">';
					for(var j=0;j<s.pt.f.length;j++)
					{
						$v+='<li><a href="/line/'+s.pt.f[j].i+'" data-rel="dialog" data-transition="slidedown"><img src="'+s.pt.f[j].tmp+'"></a></li>';
					}
					$v+='<p class="clear"></p></ul></div>';
				}
				if(s.at)
				{
					$v+='<div class="vid-tt"><a href="'+s.at.l+'" target="_blank" rel="nofollow">'+s.at.t+'</a></div>';
					if(s.at.i)
					{
						$v+='<div class="vid-im"><a href="'+s.at.l+'" target="_blank" rel="nofollow"'+(s.at.v?' class="v" onclick="_.line.embed(this,\''+s.at.l+'\',\''+s.at.w+'\',\''+s.at.h+'\');return false;"':'')+'><img src="'+s.at.i+'" style="max-width:500px; max-height:375px;"><i></i></a></div>';
					}
					else if(s.at.v)
					{
						$v+='<div class="vid-eb">'+
									'<object width="'+s.at.v.w+'" height="'+s.at.v.h+'">'+
									'<param name="movie" value="'+s.at.v.l+'"><param name="wmode" value="opaque">'+
									'<embed src="'+s.at.l.v+'" wmode="opaque" width="'+s.at.v.w+'" height="'+s.at.v.h+'"></embed>'+
									'</object>'+
									'</div>';
					}
					if(s.at.d)
					{
						$v+='<div class="vid-dc">'+s.at.d+'</div>';
					}
				}
				if(s.lc)
				{
					$v+='<div>'+
								'<div class="mp">'+
								'<img src="//maps.googleapis.com/maps/api/staticmap?center='+s.lc.l[0]+','+s.lc.l[1]+'&markers=color:blue%7Clabel:A%7C'+s.lc.l[0]+','+s.lc.l[1]+'&zoom=15&size=490x150&maptype=roadmap&sensor=false" style="margin:5px 0px 5px 5px">'+
								'<div class="mp-n">'+s.lc.n+'</div>'+
								'</div>'+
								'</div>';
				}
				$v+='<div class="clear"></div></div><div class="clear"></div></div>';
			}
			$v+= '<div class="bk">'+
				//	'<span class="lk lk-'+p._id+(_.my && p.lk && $.inArray(_.my._id,p.lk.u)>-1?' like':'')+'">'+
				'<span class="bk-ca-b lk-c-'+p._id+'">'+(p.lk&&p.lk.c?p.lk.c:'0')+'</span> โดน &#8226; <span class="cm-c-'+p._id+'">'+(p.cm&&p.cm.c?p.cm.c:'0')+'</span> ความคิดเห็น</div>';
			$v+='</div>';
			$v += '</div>';
			$v+='<p class="clear"></p>'+
			'<div class="nav-bk">'+
			'<div data-role="navbar" data-theme="d" data-iconpos="left">'+
			'<ul>'+
			'<li><a href="#" onClick="_.api(\'/me/like/'+p._id+'\'+($(this).hasClass(\'like\')?\'/unlike\':\'\')); $(this).toggleClass(\'like\')" class="lk lk-'+p._id+(_.my && p.lk && $.inArray(_.my._id,p.lk.u)>-1?' like':'')+'">โดน</a></li>'+
			'<li><a href="/line/'+p._id+'" data-rel="dialog" data-transition="slidedown">แสดงความเห็น</a></li>'+
			'</ul></div></div></div>';
			return $v;
		},
	},
	chat:
	{
		lastid:0,tmr:'',lastinp:null,index:0,zindex:1000,lastemo:'o',tmp:'',dl:null,ide:100,info:new Object,enabled:true,_status:{'online':'ออนไลน์','away':'ไม่อยู่','busy':'ไม่ว่าง','invisible':'ซ่อนตัว','offline':'ออฟไลน์'},
		api:function(a)
		{
			clearTimeout(_.chat.tmr);
			_.api('/me/chat/'+a,(arguments.length>1?arguments[1]:[]));
			if($('.chat').length)_.chat.tmr=setTimeout(function(){_.chat.delay()},Math.max(2,Math.min(30,1+parseInt(_.chat.ide/10)))*1000);
		},
		cpop:function(){$('.bz-chat-popup').css('display','none');$('html').removeClass('hdMode');	},
		emoticon:function(t)
		{
			if(arguments.length>1)
			{
				if($('.post-wrap .emo').hasClass('dropdown-open'))
				{
					_.chat.lastinp='tinyMCE';
					$('#dropdown-chat-emo').dropdown('hide', 1);
				}
				else if(arguments[1]=='emo')
				{
					_.chat.lastinp=$('.emo.dropdown-open').parent().parent().find('input');
					$('#dropdown-chat-emo').dropdown('hide', 1);
				}
			}
			else if(t)
			{
				t='[emoticon='+t+']';
			}
			
			if(_.chat.lastinp&&t)
			{
				if(_.chat.lastinp=='tinyMCE')
				{
					tinyMCE.execCommand('mceInsertContent', false, ' '+t);
					tinyMCE.execCommand('mceFocus',false,'post-msg');
				}
				else
				{
					_.chat.lastinp.val(_.chat.lastinp.val()+' '+t).focus();
				}
				_.chat.cpop();
			}
			else if(arguments[1]=='emo')
			{
				_.chat.emo('');
			}
		},
		emo:function(ty)
		{
			if(!ty)
			{
				ty=_.chat.lastemo;
			}
			else
			{
				_.chat.lastemo=ty;
			}
			$('#dropdown-chat-emo').dropdown('hide', 1);
			var w=$(window).width(),h=$(window).height(),c='',cn='';
			var _c={o:117,y:180,r:94,p:95,a:110,m:53,l:21,b:18,c:10};
			if(c=_c[ty])
			{
				if(!$('.bz-chat-popup').length)
				{
					$('body').append('<div class="bz-chat-popup"></div>');
				}
				$('.bz-chat-popup').css({'display':'block','width':w,'height':h,'left':$(window).scrollLeft(),'top':$(window).scrollTop()}).html('<div class="bz-chat-popup-ct"><div class="bz-chat-popup-in"><div class="bz-chat-popup-wr"><div class="bz-chat-popup-wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
				var t='<div style="height:24px;line-height:24px; background:#f5f5f5; padding:0px 10px;">';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'o\')"'+(ty=='o'?' style="font-weight:bold;color:#f90"':'')+'">Onion</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'y\')"'+(ty=='y'?' style="font-weight:bold;color:#f90"':'')+'">Yoyo</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'r\')"'+(ty=='r'?' style="font-weight:bold;color:#f90"':'')+'">Rabbit</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'p\')"'+(ty=='p'?' style="font-weight:bold;color:#f90"':'')+'">Panda</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'a\')"'+(ty=='a'?' style="font-weight:bold;color:#f90"':'')+'">Raccoon</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'m\')"'+(ty=='m'?' style="font-weight:bold;color:#f90"':'')+'">Milk Bottle</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'l\')"'+(ty=='l'?' style="font-weight:bold;color:#f90"':'')+'">Leaf</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'b\')"'+(ty=='b'?' style="font-weight:bold;color:#f90"':'')+'">Red Crab</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.emo(\'c\')"'+(ty=='c'?' style="font-weight:bold;color:#f90"':'')+'">Cloud</a>';
				t+='</div><ul class="bz-chat-pemo" style="width:'+(w-100)+'px; height:'+(h-220)+'px; overflow:auto;">';
				for(var i=1;i<=c;i++)
				{
					t+='<li><a href="#['+ty+i+']" onClick="_.chat.emoticon(\''+ty+i+'\');return false;"><img src="http://s0.boxza.com/static/chat/emoticon/'+ty+'/'+i+'.gif" class="bz-chat-click-emo '+ty+'"></a></li>'
				}
				t+='<p style="clear:both;"></p></ul><div style="padding:5px; text-align:center;"><input type="button" value="ปิดหน้าต่างนี้" class="button" onclick="_.chat.cpop()"></div>';
				$('.bz-chat-popup-wl').html(t);
				$('html').addClass('hdMode');	
			}
		},
		sound:function()
		{
			_.chat.api('sound',{'last':_.chat.lastid,'sound':(_.chat._sound?0:1)});
		},
		playsnd:function()
		{
			if(_.chat._sound && typeof($('#bz_chat_swf').get(0).playsound)=='function')
			{
				$('#bz_chat_swf').get(0).playsound(1);
			}
		},
		parse:function(a,b)
		{
			switch(b)
			{
				case 'info':
					if(a)
					{
						_.chat.info[a._id]=a;
						$('.ch-ps-'+a._id+' .bz-chat-info').find('a').html(a.name).end().find('img').attr('src',a.img);
					}
					break;
				case 'sound':
					(_.chat._sound=(a?true:false))?$('.ch-sound').addClass('on'):$('.ch-sound').removeClass('on');
					break;
				case 'list':
				case 'online':
				case 'away':
				case 'busy':
				case 'invisible':
				case 'offline':
						//if(!$('#dropdown-chat-status').length)
						//{
						//	var st='<div id="dropdown-chat-status" class="dropdown dropdown-tip"><ul class="dropdown-menu"><li><a href="javascript:;" onClick="_.api(\'/me/chat/online\');"><i class="ch-status-online"></i> ออนไลน์</a></li><li><a href="javascript:;" onClick="_.api(\'/me/chat/away\');"><i class="ch-status-away"></i> ไม่อยู่</a></li><li><a href="javascript:;" onClick="_.api(\'/me/chat/busy\');"><i class="ch-status-busy"></i> ไม่ว่าง</a></li><li><a href="javascript:;" onClick="_.api(\'/me/chat/invisible\');"><i class="ch-status-invisible"></i> ซ่อนตัว</a></li><li><a href="javascript:;" onClick="_.api(\'/me/chat/offline\');"><i class="ch-status-offline"></i> ออฟไลน์</a></li><li class="dropdown-divider"></li><li><a href="javascript:;" onClick="_.chat.sound()"><i class="ch-sound'+(_.chat._sound?' on':'')+'"></i> เปิด/ปิดเสียง</a></li></ul></div>';
						//	$('body').append(st);
						//}
						
					
					$('.ch-list-on > li').removeClass('uid-on');
					clearInterval(_.chat.dl);
					if(b=='offline')
					{
						$('.ch-list-on i').attr('class','ch-status-offline');
					}
					else
					{
						_.chat.dl=setInterval(function(){_.chat.ide++;if(_.chat.ide>600)_.chat.ide=300;},1000);
						if(a)
						{
							var ol=a.length,ud;
							for(var i=0;i<a.length;i++)
							{
								if(a[i])
								{
									ud=$('.nav-chat .uid-'+a[i]._id);
									if(!ud.length||a[i].status=='offline')
									{
										if(status=='offline')
										{
											ol--;
											ud.remove();
										}
										// onclick="_.chat.add('+a[i]._id+');return false;"
										$('.nav-chat').append('<li class="uid-'+a[i]._id+' uid-on" data-uid="'+a[i]._id+'" data-icon="star"><a href="/'+a[i].link+'"><img src="'+a[i].img+'" class="ui-li-icon"> '+a[i].name+'</a></li>');
									}
									else
									{
										$('.nav-chat .uid-'+a[i]._id).addClass('uid-on');
									}
									//$('.uid-'+a[i]._id).find('i').attr('class','ch-status-'+a[i].status).data('status',a[i].status).end().find('.st').html(_.chat._status[a[i].status]);
								}
							}
						}
						
						$('.nav-chat > li').each(function() {
							if(!$(this).hasClass('uid-on'))
							{
								$('.uid-'+$(this).data('uid')).find('i').attr('class','ch-status-offline').data('status','offline').end().find('.st').html(_.chat._status['offline']);
								$(this).remove();
							}
						});
					}
					$('.nav-chat').listview('refresh');
					break;
				case 'chat':
					var play=false;
					_.chat.ide=0;
					if(!a)return;
					for(var i=0;i<a.length;i++)
					{
						if(_.chat.message(a[i],true))play=true;
					}
					if(play)_.chat.playsnd();
					break;
				case 'more':
					if(!a)return;
					var u = parseInt(a[0].u==_.my._id?a[0].p:a[0].u);
					$('#bz_box_'+u+'_div_l').find('.more').remove();
					for(var i=0;i<a.length;i++)
					{
						_.chat.message(a[i],false);
					}
					if(a.length==30)
					{
						$('#bz_box_'+u+'_div_l').prepend('<div class="more"><a href="javascript:;" onclick="_.chat.api(\'more\',{\'last\':_.chat.lastid,\'uid\':'+u+',\'more\':'+a[29]._id+'});$(this).remove();">ดูก่อนหน้านี้</a></div>');
					}
					_.chat.info[u].loaded=true;
			}
		},
		message:function(a,b)
		{
			var al=(_.chat.lastid>0?true:false),ret=false;
			var u = parseInt(a.u==_.my._id?a.p:a.u);
			if(a._id)_.chat.lastid=a._id;
			if(a.u==_.my._id)
			{
				_.title.clear();
			}
			if(!$('.ch-ps-'+u).length)
			{
				_.chat.add(u);
			}
			if(!$('#bz_chat_text'+a._id).length || !a._id)
			{
				var cp=true;
				if(a.u!=_.my._id && cp && a.u && b)
				{
					_.title.insert('chat_'+a.u,_.chat.info[a.u].name+' สนทนากับคุณ');
					ret=true;
				}
				
				var h=$('#bz_box_'+u+'_div_l > div:'+(b?'last':'first')),t='',nt=false,d,o;
				if(a.da)
				{
					d=new Date(a.da.sec * 1000),o=h.data('date');
					t='<p>'+d.getHours()+':'+d.getMinutes()+'</p>';
					if(o)
					{
						var ot=new Date(parseInt(o)*1000);
						if(d.toLocaleDateString()!=ot.toLocaleDateString())
						{
							nt=true;
							if(!b)
							{
								d=ot;
							}
						}
					}
					else if(b)
					{
						nt=true;
					}
				}
				var af='';
				if(nt && d)
				{
					var _d=["อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"];
					var _m=["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
					af='<div class="ch-time">'+_d[d.getDay()]+' '+d.getDate()+' '+_m[d.getMonth()]+' '+(d.getFullYear()+543)+'</div>';
					if(b)
					{
						$('#bz_box_'+u+'_div_l').append(af);
					}
				}
				$('#bz_box_'+u+'_div_l')[b?'append':'prepend']('<div id="bz_chat_text'+a._id+'" data-date="'+a.da.sec+'" class="'+(_.my._id==a.u?'u':'p')+'"><span class="m">'+_.itag(a.ms)+'</span><span class="t">'+(d.getHours()<10?'0':'')+d.getHours()+':'+(d.getMinutes()<10?'0':'')+d.getMinutes()+'</span></div><p class="clear"></p>');
				if(!b&&af)
				{
					$('#bz_box_'+u+'_div_l').prepend(af);
				}
				if(b||!_.chat.info[u].loaded)$('#bz_box_'+u+'_div').scrollTop(Math.max($('#bz_box_'+u+'_div_l').height(),$('#bz_box_'+u+'_div').height())+100);
			}
			return ret;
		},
		add:function(id)
		{
			/*
			if(!$('.ch-ps-'+id).length)
			{
				//if(!_.chat.info[id])
				//{
					var v=$('.ch-list-on .uid-'+id+' a'),l,t;
					if(v.length)
					{
						_.chat.info[id]={_id:id,name:v.find('span').html(),img:v.find('img').attr('src'),link:v.attr('href'),status:v.find('i').data('status')}
						l=v.offset().left;
						t=v.offset().top - $(window).scrollTop();		
					}
					else
					{
						l=$('.ch-cap').offset().left;
						t=$('.ch-cap').offset().top - $(window).scrollTop();
						//_.chat.api('info',{'last':_.chat.lastid,'uid':id});
						_.chat.info[id]={_id:id,name:'กรุณารอซักครู่...',link:'',img:'',status:'offline'}
					}
					_.chat.api('info',{'last':_.chat.lastid,'uid':id});
				//}
				var name=_.chat.info[id].name;
				var w=Math.floor(Math.random()*($(window).width()-350-100))+100,h=Math.floor(Math.random()*($(window).height()-350-100))+100;
				_.chat.zindex++;
				var y='<div class="bz-chat-box ch-ps-'+id+' uid-on" data-uid="'+id+'" id="bz-chat-box-'+id+'" style="z-index:'+_.chat.zindex+';opacity:0.1;left:'+l+'px;top:'+t+'px;width:100px;height:20px" zindex="'+_.chat.zindex+'"><div class="bz-chat-info uid-'+id+'"><img src="'+_.chat.info[id].img+'"><i class="ch-status-'+(_.chat.info[id].status?_.chat.info[id].status:'offline')+'"></i><span class="emo emo-1" data-dropdown="#dropdown-chat-emo"></span><span class="st">'+_.chat._status[(_.chat.info[id].status?_.chat.info[id].status:'offline')]+'</span><span class="close">X</span><span class="bz-chat-user"><a href="'+(_.chat.info[id].link?_.chat.info[id].link:'/'+id)+'" class="h">'+name+'</a></span></div><div id="bz_box_'+id+'_div" class="bz_box_div"><div class="bz_chat_ch_l" id="bz_box_'+id+'_div_l"></div></div><div class="inp"><input type="text" class="bz_box_input" id="bz_box_'+id+'_input" data-uid="'+id+'"></div></div>';
				$('body').append(y);
				
				var m=_.storage.get('chat-'+id);
				if(m)
				{
					if(!m.l||m.l<1||m.l>$(window).width()-350)m.l=w;
					if(!m.t||m.t<1||m.t>$(window).height()-350)m.t=h;
					if(!m.w||m.w<200||m.w>700)m.w=300;
					if(!m.h||m.h<200||m.h>700)m.h=265;
				}
				else
				{
					m={'l':w,'t':h,'w':300,'h':265};
				}
				_.storage.set('chat-'+id,m);
				$('#bz-chat-box-'+id).animate({opacity: 1,left: m.l,top: m.t,width: m.w,height: m.h}, 200, 'easeOutExpo', function() {
					$(this)
						.attr('style','z-index:'+_.chat.zindex+';left:'+m.l+'px;top:'+m.t+'px;width:'+m.w+'px;height:'+m.h+'px;')
						.draggable({
													handle:'.bz-chat-info',containment: 'parent', scroll: false,
													stop: function(event,ui){_.storage.set('chat-'+$(this).data('uid'),{'l':ui.position.left,'t':ui.position.top,'w':$(this).width(),'h':$(this).height()});}
						})
						.resizable({
													start:function(event,ui){if($(this).find('input').length){$(this).find('input').css({'display':'none'});}},
													stop:function(event,ui){var w=$(this).width(),h=$(this).height();
																											$(this).find('input').css({'display':'inline-block'});
																											$(this).find('.bz_box_div').css({'height':h-70});
																											_.storage.set('chat-'+$(this).data('uid'),{'l':$(this).offset().left,'t':$(this).offset().top,'w':w,'h':h});	
																											}
						})
						.click(function(){
							if(Math.floor($(this).attr('zindex'))!=_.chat.zindex)
							{
								_.chat.zindex++;
								$(this).attr('zindex',_.chat.zindex).css({'z-index':_.chat.zindex});
							}
						})
						.find('.bz_box_div')
							.css({'height':m.h-70})
						.end()
						.find('.bz_box_input')
							.keypress(function(e){
								var c=(e.keyCode?e.keyCode:e.which);
								var ms=$.trim($(this).val());
								if(c==13&&ms!='')
								{
									$(this).val('');
									_.chat.api('send',{'last':_.chat.lastid,'uid':$(this).data('uid'),'ms':ms});
								}
							})
							.focus(function(e){})
							.trigger('focus')
						.end()
						.find('.close')
							.click(function(){
								$('#bz-chat-box-'+id).animate({opacity: 0.1,left: $('.ch-cap').offset().left,top: $('.ch-cap').offset().top- $(window).scrollTop(),width: 10,height: 10,}, 300, 'easeInExpo', function(){$('#bz-chat-box-'+id).remove(); });
								_.chat.api('close',{'last':_.chat.lastid,'uid':id});
							})
							.end()
						.trigger('resize');
					
					if(id=='0')
					{
						var b={_id:0,n:'ผู้ช่วยเหลือ (Bot)',ms:'ยินดีต้อนรับสู่ http://boxza.com',p:_.my._id,u:0,l:'',i:'//s1.boxza.com/profile/00/00/00/s.jpg',da:{sec:(new Date).getTime()/1000}};
						_.chat.message(b);
						b.ms='คุณสามารถโพสข้อความไปยัง facebook (timeline, fanpage) และ twitter ได้พร้อมกันหลังจากทำการผูกบัญชีใช้งานกับ facebook และ twitter (เมนู <a href="/settings" onclick="_.line.go(\'/settings\',true);return false">ตั้งค่า</a>)';
						_.chat.message(b);
					}
			  });		
			  
		 	}	*/
		},
		delay:function()
		{
			_.chat.index++;
			if(_.chat.index>12)
			{
				_.chat.index=0;
				_.chat.api('list',{'last':_.chat.lastid});
			}
			else
			{
				_.chat.api('idle',{'last':_.chat.lastid});
			}
		},
	},
});


$(function(){
	_.line.update();
	if(_.my)
	{
		_.chat.api('list',{'last':_.chat.lastid});
	}
	
		$(document).on('bottomreached', '#bz-content-in', function() {
			_.line.next();
		});
		
		$(document).on('pulled', '#bz-content-in', function() {
			if(_.profile.updating)
			{
				  _.line.reload(true);
			}
			else
			{
				$('#bz-content-in').scrollz('hidePullHeader');
			}
		});
		
		$('#bz-content-in').scrollz('hidePullHeader');
});

$(window).bind('popstate', function(event){
  	var initialPop = (!_.hash.popped && location.href == _.hash.initurl);
  	_.hash.popped = true;
  	if ( initialPop ) return;
	if(event.state)
	{
		_.line.go(location.pathname);
	}
	else
	{
		_.line.go(location.pathname,0,1);
	}
});
$(window).bind('hashchange', _.hash.hash);

$( document ).on( "pagebeforeload", function( event, data ) {
	if(!data.options.role || data.options.role!='dialog')
	{
		event.preventDefault();
		data.options.allowSamePageTransition=true;
		data.options.reloadPage=true;
		data.deferred.reject(data.absUrl, data.options);
		$('#bz-menu').panel('close');
		_.line.go(data.dataUrl);
	}
	else if(data.options.role=='dialog')
	{
		data.deferred.done(function(){
					_.line.update();
			});
	}
});
