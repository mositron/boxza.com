$.extend(_,{
	video:{
		set:function(s)
		{
			_.chat._vid=s;
		},
	},
	chat:
	{
		version:1.0,hash:'',logged:false,radio:true,_scroll:true,_sound:true,first:false,loaded:false,lastid:0,tmr:'',_vid:'',index:0,_cbot:0,_cbg:0,_ubg:0,tmp:'',dl:null,ide:100,room:'1',_text:new Object,msl:0,_zindex:0,_spy:true,_emo:new Object,lastemo:'o',lastfocus:'',
		bantime:{1:'1 นาที',5:'5 นาที',15:'15 นาที',30:'30 นาที',60:'1 ชั่วโมง',120:'2 ชั่วโมง',180:'3 ชั่วโมง',360:'6 ชั่วโมง',720:'12 ชั่วโมง',1440:'24 ชั่วโมง'},
		info:new Object,cin:0,u:new Object,ds:0,my:new Object,banned:false,_ms:'',_repeat:0,_flood:0,_flemo:false,_rmemo:0,_autodc:true,_remaindc:0,_remainsv:0,_emodl:30,
		enablecolor:function(a,b)
		{
			if(!$(a).is(':checked'))
			{
				$('.bz_chat').addClass('ecolor'+b);
			}
			else
			{
				$('.bz_chat').removeClass('ecolor'+b);
			}
		},
		embed:function(e,u,w,h)
		{
			var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
			var match = u.match(regExp);
			if (match&&match[7].length==11){
				u = 'http://www.youtube.com/embed/'+match[7]+'?autoplay=1&autohide=1&border=0&wmode=transparent&hl=th&cc_lang_pref=th';
				h = Math.floor((500*h)/w);
				w=500;
			}
			var l=$(e).parent().offset().left+300,t=$(e).parent().offset().top-100;
			if(l-$(document).scrollLeft()<100)l=100+$(document).scrollLeft();
			if(t-$(document).scrollTop()<50)t=50+$(document).scrollTop();
		
			var a=$(e).parent().parent().find('.vid-tt a').html();
			var b='<iframe src="'+u+'" width="'+w+'" height="'+h+'" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0"></iframe>';
			
			var c=$('<div>').addClass('puw');
			$('body').append(c);
			c.css({'left':l-$(document).scrollLeft(),'top':t-$(document).scrollTop()})
			.html('<div class="phd"><div class="pda">'+a+'</div><div class="pbt"><img src="'+_.static+'images/profile/popup/close.gif"></div></div><div class="pco">'+b+'</div>')
			.draggable({containment: 'parent', scroll: false})
			.click(function(){
				if(Math.floor($(this).data('zindex'))!=_.chat.zindex)
				{
					_.chat.zindex++;
					$(this).data('zindex',_.chat.zindex).css({'z-index':_.chat.zindex});
				}
			})
			.find('.pbt img').click(function(){$(this).parent().parent().parent().remove();});
		},
		game:function()
		{
			if(!$('#bz_box_game').length)
			{
				_.chat._zindex++;	
				var y='<div class="bz_box" id="bz_box_game" style="z-index:'+_.chat._zindex+';left:100px;top:50px; width:550px; height:300px;" zindex="'+_.chat._zindex+'"><h4><span class="close">X</span> เกมส์</h4><div id="bz_box_game_div" class="bz_box_div" style="height:278px;"><div class="bz_chat_ch_l one" id="bz_box_game_div_l"></div></div></div>';
				$('.bz_chat').append(y);
				$('#bz_box_game .close').click(function(){$('#bz_box_game').css('display','none');$('#bz_box_game_div_l').html('');});
				$('#bz_box_game').draggable({handle:'h4',containment: 'parent', scroll: false}).resizable({/*helper:'ui-resizable-helper',*/start:_.chat.boxresize1,stop:_.chat.boxresize2}).click(function(){
					if(Math.floor($(this).attr('zindex'))!=_.chat._zindex)
					{
						_.chat._zindex++;
						$(this).attr('zindex',_.chat._zindex).css({'z-index':_.chat._zindex});
					}
				});
			}
		},
		getfocus:function()
		{
			if(!_.chat.lastfocus || !$(_.chat.lastfocus).length || !_.chat.lastfocus.is('input[type=text]'))
			{
				_.chat.lastfocus=$('.bz_chat_mb');
			}
		},
		emoticon:function(t)
		{
			_.chat.getfocus();
			_.chat.lastfocus.val(_.chat.lastfocus.val()+'['+t+']').focus();
			_.chat.cpop();
		},
		query:function(n){n=n.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");var s="[\\?&#]"+n+"=([^&#]*)",r=new RegExp(s),u=r.exec(arguments.length>1?window.location.hash:window.location.search);return u?decodeURIComponent(u[1].replace(/\+/g, " ")):'';},
		cpname:function(a)
		{
			var c=$('.bz_chat_mb').attr('color');
			_.chat.getfocus();
			_.chat.lastfocus.val(_.chat.lastfocus.val()+' ^C14 ---> ^C'+c+' '+_.chat.u[a].name+' ^C14 <--- ^C'+c+' ').focus();
		},
		savenick:function()
		{
			var t=$.trim($('.bz_chat_nick').val());
			if(t.length<3)
			{
				$('.bz_chat_nick_err').html('ชื่อสั้นเกินไป 3-40 ตัวอักษร');
			}
			else
			{
				_.chat.api('nick',{'last':_.chat.lastid,'cmd':_.chat.rmcolor(t,_.chat.my.member)});
				_.chat.cpop();
			}
		},
		restorenick:function(){_.chat.api('restore',{'last':_.chat.lastid});_.chat.cpop();},
		ban:function(a)
		{
			var l=$('.bz_chat_bantime').val();
			if(confirm('คุณต้องการแบน '+(_.chat.u[a]?_.chat.u[a].name:'')+' เป็นเวลา '+_.chat.bantime[l]+' หรือไม่'))
			{
				_.chat.api('ban',{'last':_.chat.lastid,'cmd':a+' '+l});
				_.chat.cpop();
			}
		},
		kick:function(a)
		{
			if(confirm('คุณต้องเตะ '+(_.chat.u[a]?_.chat.u[a].name:'')+' หรือไม่'))
			{
				_.chat.api('kick',{'last':_.chat.lastid,'cmd':a+' '+$('.bz_chat_kick').val()});
				_.chat.cpop();
			}
		},
		setadmin:function(a,b)
		{
			if(_.chat.u[a])
			{
				if(confirm('คุณต้องการ '+(b>0?'แต่งตั้ง':'ปลด')+' '+_.chat.u[a].name+' เป็น '+(b==2?'ผู้ดูแลสูงสุด':(b==1?'ผู้ดูแล':'สมาชิกทั่วไป'))+' หรือไม่'))
				{
					_.chat.api('admin',{'last':_.chat.lastid,'cmd':a+' '+b});
					_.chat.cpop();
				}
			}
			else
			{
				alert('ไม่มีสมาชิกดังกล่าว');
			}
		},
		popup:function(a)
		{
			if(_.chat.banned)
			{
				return;
			}
			var w=$(window).width(),h=$(window).height(),t='';
			$('.bz_chat_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_chat_popup_ct"><div class="bz_chat_popup_in"><div class="bz_chat_popup_wr"><div class="bz_chat_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
			t='<div style="width:300px; text-align:center">';
			if(_.chat.my._id==a)
			{
				t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.chat.member(_.chat.u[a].member,_.chat.u[a].admin)+' [ID: '+a+']</h4>';
				t+='<div style="padding:10px;">ชื่อ: <input type="text" class="bz_chat_nick tbox" value="'+_.chat.my.name+'"> <br><input type="button" class="button" onclick="_.chat.savenick();" value="บันทึก">'+(_.chat.my.name!=_.chat.my.dname && _.chat.my.name?' <input type="button" class="button" onclick="_.chat.restorenick();" value="กลับไปใช้ชื่อเริ่มต้น"> ':'')+'<p style="padding:3px;text-align:center">* สามารถใช้สีได้สูงสุด 3สี</p><p class="bz_chat_nick_err"></p>';
				t+='<div style="height:1px; overflow:hidden; margin:10px 5px; border-top:1px solid #eee;"></div>'+(_.chat.u[a].member?'<a href="http://boxza.com/'+_.chat.u[a].link+'" class="button" target="_blank" onclick="_.chat.cpop()">เปลี่ยนรูปโปรไฟล์</a> <a href="http://boxza.com/'+_.chat.u[a].link+'" class="button" target="_blank" onclick="_.chat.cpop()">ปรับแต่งข้อมูลส่วนตัว</a> <div style="height:1px; overflow:hidden; margin:10px 5px; border-top:1px solid #eee;"></div>':'')+'<input type="button" value="ปิดหน้าต่างนี้" class="btn whfocus" onclick="_.chat.cpop()"></div>';
			}
			else if(_.chat.u[a])
			{
				t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.chat.member(_.chat.u[a].member,_.chat.u[a].admin)+' [ID: '+a+']</h4>';
				t+='<div style="padding:10px;text-align:left; line-height:2em"><img src="'+_.chat.u[a].img+'" style="float:left; margin:5px 5px 0px 0px"><a href="javascript:;" onclick="_.chat.cpname(\''+a+'\');_.chat.cpop();"><strong class="bz_chat_user bz_chat_level_'+(_.chat.u[a].admin?_.chat.u[a].admin:0)+'">'+_.chat.cvcolor(_.chat.u[a].name,(_.chat.u[a].member?_.chat.u[a].member:0))+'</strong></a><br>'+(!_.chat.u[a].member?'<a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress='+_.chat.u[a].ip+'" class="button" target="_blank" onclick="_.chat.cpop()">IP: '+_.chat.u[a].ip+'</a> ':'')+(_.chat.u[a].link?'<a href="javascript:;" class="button" onclick="_.ajax.gourl(\'/game/thief\',\'doit\',\''+_.chat.room+'\',\''+a+'\');_.chat.cpop()">ขโมย</a> <a href="http://boxza.com/'+_.chat.u[a].link+'" class="button" target="_blank" onclick="_.chat.cpop()">โปรไฟล์</a> ':'')+'<a href="javascript:;" class="button whfocus" onclick="_.chat.whisper(\''+a+'\')">กระซิบ</a> '+'<p class="clear"></p>';
				if(_.chat.my.admin&&_.chat.my.member)
				{
					var l;
					t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>เตะ</strong><br>ข้อหา <input type="text" class="bz_chat_kick" style="width:140px;"> <a href="javascript:;" class="button" onclick="_.chat.kick(\''+a+'\')">ตกลง</a></div>'
					
					if(!_.chat.u[a].admin)
					{
						t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>แบนสมาชิก</strong><br>เป็นเวลา <select name="bnt" class="bz_chat_bantime">';
						for(l in _.chat.bantime)
						{
							t+='<option value="'+l+'">'+_.chat.bantime[l]+'</option>';
						}
						t+='</select> <a href="javascript:;" class="button" onclick="_.chat.ban(\''+a+'\')">ตกลง</a></div>';
					}
					if(_.chat.my.admin>1 && _.chat.u[a].member)
					{				
						t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>แต่งตั้งสมาชิก</strong><br>';
						if(_.chat.my.admin>=3 && _.chat.u[a].admin!=2)
						{
							t+='<a href="javascript:;" class="button" onclick="_.chat.setadmin(\''+a+'\',2)">ตั้งเป็นผู้ดูแลสูงสุด</a> ';
						}
						if(_.chat.u[a].admin!=1)
						{
							t+='<a href="javascript:;" class="button" onclick="_.chat.setadmin(\''+a+'\',1)">ตั้งเป็นผู้ดูแล</a> ';
						}
						if(_.chat.u[a].admin)
						{
							t+='<a href="javascript:;" class="button" onclick="_.chat.setadmin(\''+a+'\',-1)">ตั้งเป็นสมาชิกธรรมดา</a> ';
						}
						t+='</div>';
					}
				}
				t+='</div>';
				t+='<input type="button" value="ปิดหน้าต่างนี้" class="btn" onclick="_.chat.cpop()"></div>';
			}
			else
			{
				t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">ออฟไลน์ [ID: '+a+']</h4>';
				t+='<div style="padding:10px;">สมาชิกนี้ออฟไลน์ไปแล้ว</div>';
				t+='<input type="button" value="ปิดหน้าต่างนี้" class="btn whfocus" onclick="_.chat.cpop()"></div>';
			}
			$('.bz_chat_popup_wl').html(t);
			$('.whfocus').focus();
		},
		open:function(ty)
		{
			if(!ty)
			{
				ty=_.chat.lastemo;
			}
			else
			{
				_.chat.lastemo=ty;
			}
			var w=$(window).width(),h=$(window).height(),c='',cn='';
			var _c={o:117,y:180,r:94,p:95,a:110,m:53,l:21,b:18,c:10,w:109,s:71};
			if(c=_c[ty])
			{
				$('.bz_chat_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_chat_popup_ct"><div class="bz_chat_popup_in"><div class="bz_chat_popup_wr"><div class="bz_chat_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
				var t='<div style="height:24px;line-height:24px; background:#f5f5f5; padding:0px 10px;">';
				t+='<a href="javascript:;" onclick="_.chat.open(\'o\')"'+(ty=='o'?' style="font-weight:bold;color:#f90"':'')+'">Onion</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'y\')"'+(ty=='y'?' style="font-weight:bold;color:#f90"':'')+'">Yoyo</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'r\')"'+(ty=='r'?' style="font-weight:bold;color:#f90"':'')+'">Rabbit</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'p\')"'+(ty=='p'?' style="font-weight:bold;color:#f90"':'')+'">Panda</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'a\')"'+(ty=='a'?' style="font-weight:bold;color:#f90"':'')+'">Raccoon</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'m\')"'+(ty=='m'?' style="font-weight:bold;color:#f90"':'')+'">Milk Bottle</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'l\')"'+(ty=='l'?' style="font-weight:bold;color:#f90"':'')+'">Leaf</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'b\')"'+(ty=='b'?' style="font-weight:bold;color:#f90"':'')+'">Red Crab</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'c\')"'+(ty=='c'?' style="font-weight:bold;color:#f90"':'')+'">Cloud</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'w\')"'+(ty=='w'?' style="font-weight:bold;color:#f90"':'')+'">WanWan</a> | ';
				t+='<a href="javascript:;" onclick="_.chat.open(\'s\')"'+(ty=='s'?' style="font-weight:bold;color:#f90"':'')+'">Soldier</a>';
				t+='</div><ul class="bz_chat_pemo" style="width:'+(w-100)+'px; height:'+(h-220)+'px; overflow:auto;">';
				for(var i=1;i<=c;i++)
				{
					t+='<li><a href="#['+ty+i+']" onClick="_.chat.emoticon(\''+ty+i+'\');return false;"><img src="http://s0.boxza.com/static/chat/emoticon/'+ty+'/'+i+'.gif" class="bz_chat_click_emo '+ty+'"></a></li>'
				}
				t+='<p style="clear:both;"></p></ul><div style="padding:5px; text-align:center;"><input type="button" value="ปิดหน้าต่างนี้" class="btn" onclick="_.chat.cpop()"></div>';
				$('.bz_chat_popup_wl').html(t);
			}
		},
		whisper:function(a)
		{
			var s=false;
			$('.bz_chat_pv option').each(function(){if($(this).attr('value')==a){s=true;}});
			if(!s)
			{
				$('.bz_chat_pv').append('<option value="'+a+'">ส่งถึง.. '+_.chat.cvcolor(_.chat.u[a].name,0)+'</option>')
			}
			_.chat.cpop();
			_.chat.createbox(a);
			$('#bz_box_'+a+'_input').focus();
		},
		cpop:function(){$('.bz_chat_popup').css('display','none');},
		sroom:function(t)
		{
			$('.bz_chat_ch_l_main,.bz_chat_nl_lll,.bz_chat_nl_llll,.bz_chat_nl_lllll').html('');
			_.chat.u=new Object;
			_.chat.first=false;
			_.chat.room=Math.floor(t);
			_.chat.lastid=0;
			_.chat.ide=0;
			$('#bz_chat_nl_ol,#bz_chat_nl_ol1,#bz_chat_nl_ol2,#bz_chat_nl_ol3').html('0');
			_.chat.api('list',{'last':_.chat.lastid},true);
		},
		convert:function(t)
		{
			_.chat.cin=0;
			_.chat.cinl='';
			t=' '+t+' ';
			var em=[
										['(\\:\\)|\\:\\-\\)|\\:\\]|\\=\\))',0,-221],
										['(\\:D|\\:\\-D|\\=D)',-68,-374],
										['(;\\)|;\\-\\))',-17,-289],
										['\\^_\\^',-51,-187],
										['(\\&gt;:o|&gt;:O|\\&gt;&lt;)',0,-238],
										['\\:3',-17,-357],
										['(&gt;\\:\\(|&gt;\\:\\-\\()',0,-391],
										['(\\:\\(|\\:\\-\\(|\\:\\[|\\=\\()',-17,-374],
										['(\\:\\&\\#039;\\(|\\:\'\\()',-68,-357],
										['\\-_\\-',-17,-221],
										['(\\:\\\\|\\:\\/|\\:\\-\\\\|\\:\\-\\/)',-68,-221],
										['(3\\:\\)|3\\:\\-\\))',0,-374],
										['(O\\:\\)|O\\:\\-\\))',0,-357],
										['(\\:\\-\\*|\\:\\*)',-68,-187],
										['&lt;3',-17,-340],
										['\\:v',0,-204],
										['(\\:o|\\:\\-o|\\:O|\\:\\-O)',-34,-374],
										['(8\\)|8\\-\\)|B\\)|B\\-\\))',-51,-374],
										['(8\\||8\\-\\||B\\||B\\-\\|)',-34,-221],
										['(\\:p|\\:\\-p|\\:P|\\:\\-P|\\=P)',-51,-221],
										['o.O',-34,-357],
										['O.o',-51,-357],
										['\\(\\^\\^\\^\\)',-68,-204],
										['\\(y\\)',-51,-799],
										['(\\&lt;\\(&quot;\\)|\\&lt;\\("\\))',-17,-204]
								];
				
				for(var j=0;j<em.length;j++)
				{
					var rp=new RegExp('\\s'+em[j][0]+'', "g");
					t=t.replace(rp,'<span class="emo" style="background-position:'+em[j][1]+'px '+em[j][2]+'px "></span>');
				}
				
			return t.replace(/(.*)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?\s]*)?(.*)?/,function(t2){
					var regExp = /(.*)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?\s]*)?(.*)?/;
					var m = t2.match(regExp);
					if (m&&m[8]){
						t2+='<div style="padding:5px"><a href="http://www.youtube.com/watch?v='+m[8]+'" target="_blank"><img src="http://img.youtube.com/vi/'+m[8]+'/1.jpg"></a></div>';
					}
					return t2
				}).replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
					_.chat.cin++;
					if(_.chat.cinl==i1+i2)
					{
						return '';
					}
					_.chat.cinl=i1+i2;
					return (_.chat.cin>2)?'':t2.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz_chat_click_emo $1" onClick="_.chat.emoticon(\'$1$2\');">');
				}).replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
					_.chat.cin++;
					if(_.chat.cinl==i1+i2)
					{
						return '';
					}
					_.chat.cinl=i1+i2;
					return (_.chat.cin>2)?'':t2.replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz_chat_click_emo $1" onClick="_.chat.emoticon(\'$1$2\');">');
				});
		},
		api:function(a)
		{
			if(_.chat.banned)
			{
				return;
			}
			var dt=(arguments.length>1?arguments[1]:[]);dt.ntf=_.chat.ds;	
			dt.vid=_.chat._vid;
			dt.ver=1;
			dt.hash=_.chat.hash;
			if(_.chat.loaded)
			{
				_.chat.ide++;
				clearTimeout(_.chat.tmr);
				_.chat.tmr=setTimeout(function(){_.chat.delay()},20000);
			}
			$.ajax({url:'http://api.boxza.com/global/chat/'+_.chat.room+'/'+a,type:'GET',crossDomain:true,data:dt,dataType:'jsonp',jsonpCallback:'_'+new Date().getTime(),success:function(d){
				for(var i=0;i<d.length;i++)
				{
					switch(d[i].method)
					{
						case 'chatbox': _.chat.parse(d[i].data,d[i].type);break;
					}
				}
				if(_.chat.loaded)
				{
					clearTimeout(_.chat.tmr);
					_.chat.tmr=setTimeout(function(){_.chat.delay()},Math.max(2,Math.min(10,1+parseInt(_.chat.ide/10)))*1000);
				}
			},
			error:function (xhr, ajaxOptions, thrownError)
			{	
				if(_.chat.loaded)
				{
					clearTimeout(_.chat.tmr);
					_.chat.tmr=setTimeout(function(){_.chat.delay()},20000);
				}
			 } 
			});
		},
		color:function(a)
		{
			var o=$('.bz_chat_mb').attr('color');
			$('.bz_chat_mb').attr('color',a);
			if(arguments.length==1)$('.bz_chat_mb').focus();
			$('.bz_chat_col .sel').removeClass('sel');
			$('.bz_chat_col li ul li a.f'+a).addClass('sel');
			$('.bz_chat_col_sel').removeClass('f'+o).addClass('f'+a);
		},
		clear:function(){$('.bz_chat_ch_l.on').html('');},
		delay:function()
		{	
			_.chat.index++;
			if(_.chat.index>5)
			{
				_.chat.index=0;
				_.chat.api('list',{'last':_.chat.lastid});
			}
			else
			{
				_.chat.api('idle',{'last':_.chat.lastid});
			}
		},
		scroll:function(){(_.chat._scroll=!_.chat._scroll)?$('.bz_chat_scroll').removeClass('off'):$('.bz_chat_scroll').addClass('off');},
		esound:function(){(_.chat._sound=!_.chat._sound)?$('.bz_chat_sound').removeClass('off'):$('.bz_chat_sound').addClass('off');},
		oneline:function(){
			if($('.bz_chat_ch_l_main').hasClass('one'))
			{
				$('.bz_chat_oneline').addClass('off');
				$('.bz_chat_ch_l_main').removeClass('one');
			}
			else
			{
				$('.bz_chat_oneline').removeClass('off');
				$('.bz_chat_ch_l_main').addClass('one');
			}
			_.chat.upscroll(1);
		},
		upscroll:function(){
			if(_.chat._scroll)
			{
				if(arguments.length)
				{
					$('.bz_chat_ch').scrollTop(Math.max($('.bz_chat_ch_l.on').height(),$('.bz_chat_ch').height())+100);
				}
				else
				{
					$('.bz_chat_ch').animate({ scrollTop: Math.max($('.bz_chat_ch_l.on').height(),$('.bz_chat_ch').height())+100});
				}
			}
		},
		login:function(){
			window.open('http://oauth.boxza.com/login/?redirect_uri=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.chat.room,'_blank');
		},
		signup:function(){
			window.open('http://oauth.boxza.com/signup/?redirect_uri=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.chat.room,'_blank');
		},
		assign:function(t){_.chat._cbg++;_.chat._cbg=_.chat._cbg%2;$('.bz_chat_ch_l_main').append(t);if(arguments.length==1)_.chat.upscroll();},
		parse:function(a,b)
		{
			var c;
			switch(b)
			{
				case 'info':
					_.chat.logged=a.logged;
					break;
				case 'room':
					_.chat.room=Math.floor(a.data);
					_.chat.sroom(_.chat.room);
					break;
				case 'notice':
					_.chat.assign('<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">'+a+'</div><span></span></div>');
					break;
				case 'duplicate':
					_.chat.banned=true;
					_.chat.assign('<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณมีการล็อคอินซ้อน กรุณารีเฟรสหน้านี้ใหม่อีกครั้ง</div><span></span></div>');
					break;
				case 'banned':
					_.chat.banned=true;
					_.chat.assign('<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณถูกแบนจากระบบ</div><span></span></div>');
					break;
				case 'rank':
							var t='';
							t += 'คุณมีคะแนนออนไลน์ '+a.val+' บั๊ก<br>';
							_.chat.assign('<p id="bz_chat_text_first" class="l'+_.chat._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;"><strong style="color:#0099D2">คะแนนออนไลน์</strong><br>'+t+'</p>');
					break;
				case 'first':
							_.chat.hash=a.hash;
							_.chat.assign('<p id="bz_chat_text_first" class="l'+_.chat._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;"><strong style="color:#0099D2">ห้อง'+a.name+'</strong><br>'+
							'"'+a.welcome+'"<br>'+
							'- ชื่อในการสนทนาของ<strong>คุณ</strong>คือ <a href="javascript:;" onclick="_.chat.popup(\''+_.chat.my._id+'\');"><strong>'+_.chat.cvcolor(_.chat.my.name,_.chat.my.member)+'</strong></a> (คลิกที่ชื่อเพื่อเปลี่ยน)<br>'+
							'- หากต้องการเปลี่ยนชื่อแบบถาวร หรือเปลี่ยนรูป กรุณา<a href="javascript:;" onclick="_.chat.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.chat.signup()">สมัครสมาชิก</a> (<a href="http://boxza.com/me" target="_blank">เปลี่ยนรูปโปรไฟล์</a>, <a href="http://boxza.com/settings" target="_blank">เปลี่ยนชื่อหรือข้อมูลอื่นๆ</a>)<br>'+
							'- พิมพ์ /help ที่หน้าห้อง เพื่อดูคำสั่งการใช้งานเบื้องต้น<br>'+
							'');
							if(!_.chat.lastid)
							{
								_.chat.lastid=1;
							}
							$('body.loading').removeClass('loading');
							_.chat.resize();
							if(a.bg)
							{
								if(a.bg.al&&a.bg.al.cl)
								{
									$('body').css('background',a.bg.al.cl+(a.bg.al.bg?' url('+a.bg.al.bg+') center center repeat':''));
								}
								if(a.bg.pc)
								{
									$('.bz_chat_ch').addClass('rgba'+a.bg.pc);
								}
								if(a.bg.pn)
								{
									$('.bz_chat_nl').addClass('rgba'+a.bg.pn);
								}
								if(a.bg.lc||a.bg.tc)
								{
									var str='';
									if(a.bg.tc)
									{
										str+='body{color:'+a.bg.tc+';}';
									}
									if(a.bg.lc)
									{
										str+='a{color:'+a.bg.lc+';}';
									}
									var el= document.createElement('style');
									el.type= "text/css";
									el.media= 'screen';
									if(el.styleSheet) el.styleSheet.cssText= str;//IE only
									else el.appendChild(document.createTextNode(str));
									document.getElementsByTagName('head')[0].appendChild(el);
								}
							
								_.chat._sound=!(a.bg.snd?true:false);
								_.chat.esound();
								a.bg.one?$('.bz_chat_ch_l_main').removeClass('one'):$('.bz_chat_ch_l_main').addClass('one');
								_.chat.oneline();
								_.chat._scroll=true;
								setTimeout(function(){_.chat.upscroll();},1000);
								a.bg.col?_.chat.color(_.chat.shuffle([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])[0],1):_.chat.color(1,1);
							}
							
							if(a.radio&&_.chat.radio)
							{
								$('.bz_chat_radio').html('<object width="100%" height="100%">'+
	'<param name="movie" value="http://s0.boxza.com/static/js/jwplayer/player.swf"></param>'+
	'<param name="allowscriptaccess" value="always"></param>'+
	'<param name="seamlesstabbing" value="true"></param>'+
	'<param name="wmode" value="opaque"></param>'+
	'<param name="flashvars" value="netstreambasepath=http%3A%2F%2Fchat.boxza.com%2F&amp;id=mediaspace&amp;file='+encodeURIComponent(a.radio)+'&amp;bufferlength=3&amp;autostart=true&amp;controlbar.position=bottom&amp;display.icons=false&amp;volume=90"></param>'+
	'<embed src="http://s0.boxza.com/static/js/jwplayer/player.swf" type="application/x-shockwave-flash" width="100%" height="100%" allowscriptaccess="always" wmode="opaque" flashvars="netstreambasepath=http%3A%2F%2Fchat.boxza.com%2F&amp;id=mediaspace&amp;file='+encodeURIComponent(a.radio)+'&amp;bufferlength=3&amp;autostart=true&amp;controlbar.position=bottom&amp;display.icons=false&amp;volume=90"></embed>'+
	'</object>');
							}
							if(_.chat.my.admin)
							{
								var s=false;
								$('.bz_chat_pv option').each(function(){if($(this).attr('value')=='admin'){s=true;}});
								if(!s)
								{
									$('.bz_chat_pv').append('<option value="admin">ส่งถึงเฉพาะแอดมิน</option>')
								}
							}
							_.chat.first=true;
					break;
				case 'my':
					_.chat.u[a._id]=_.chat.my={'_id':a._id,'name':a.n,'img':a.i,'link':a.l,'member':a.mb,'dname':a.d,'admin':a.am,'ip':a.ip,'rank':(a.rk?a.rk:'')};
					if(a.mb)
					{
						_.chat._autodc=false;
					}
					$('.bz_chat_nl_ll').html('<div id="bz_chat_user_my" class="l"><a href="javascript:;" onclick="_.chat.popup(\''+_.chat.my._id+'\',1);"><img src="'+_.chat.my.img+'">'+(_.chat.my.rank?' <img src="http://s0.boxza.com/static/chat/rank/'+_.chat.my.rank+'.gif"> ':'')+'</a><p><a href="javascript:;" onclick="_.chat.popup(\''+_.chat.my._id+'\',1);" class="bz_chat_user bz_chat_level_'+(_.chat.my.admin&&_.chat.my.member?_.chat.my.admin:'0')+'">'+_.chat.cvcolor(_.chat.my.name,_.chat.my.member)+'</a></p><span></span></div>');
					if(_.chat.my.member)
					{
						if(_.chat.my.admin)
						{
							_.chat._emodl=20;
						}
						else
						{
							_.chat._emodl=25;
						}
						$('.bz_chat_nl_ll').append('<p style="padding:0px 0px 0px 5px;border-bottom:1px solid #f0f0f0;">ประเภท: '+(_.chat.my.admin?'ผู้ดูแล':'สมาชิก')+'</p><p style="padding:0px 0px 0px 5px;">คะแนน: '+a.bux+' บั๊ก</p><p style="padding:0px 0px 0px 5px;">เครดิต: '+a.box+' บ๊อก</p>');
					}
					else
					{
						_.chat._emodl=30;
						$('.bz_chat_nl_ll').append('<p style="padding:0px 0px 0px 5px;border-bottom:1px solid #f0f0f0;">ประเภท: บุคคลทั่วไป</p><p style="text-align:center"><a href="javascript:;" onclick="_.chat.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.chat.signup()">สมัครสมาชิก</a></p><p style="text-align:center">เพื่อรับคะแนนออนไลน์</p>');
					}
					break;
				case 'list':
					if(a)
					{
						var t=''+Math.floor(Math.random()*100000),j,l,p,pv;
						var id_s2=false;
						//if(_.chat.my._id==1||_.chat.my._id==7)
						if(_.chat.my.admin>5)
						{
							id_s2=true;
						}
						for(j in a)
						{
							c=a[j];
							l=$('#bz_chat_user'+c._id).length;
							//if(_.chat.my._id!=c._id && ((c._id!=1 && c._id!=7)||(id_s2)))
							//if(_.chat.my._id!=c._id && ((c.am<=5)||(id_s2)))
							if(_.chat.my._id!=c._id && ((c.am<=5)||(c.am!=8)||(id_s2)))
							{
								_.chat.u[c._id]={'_id':c._id,'name':c.n,'img':c.i,'link':c.l,'admin':c.am,'member':c.mb,'default':c.d,'ip':c.ip,'rank':(c.rk?c.rk:''),'vid':(c.vid&&c.vid=='publish'?1:0)};
								p=(_.chat.u[c._id].vid?'<a class="cam" href="javascript:;" onclick="_.chat.video.open(\''+_.chat.u[c._id]._id+'\')"><i class="icon-cam"></i></a> ':'')+'<a href="javascript:;" onclick="_.chat.popup(\''+c._id+'\');"><img src="'+c.i+'">'+(_.chat.u[c._id].rank?' <img src="http://s0.boxza.com/static/chat/rank/'+_.chat.u[c._id].rank+'.gif">':'')+'</a><p><a href="javascript:;" onclick="_.chat.popup(\''+c._id+'\');" class="bz_chat_user bz_chat_level_'+(c.am&&c.mb?c.am:'0')+'">'+_.chat.cvcolor(c.n,c.mb)+'</a></p><span></span>';
								if(!l)
								{
									pv='<div id="bz_chat_user" class="'+c._id+(_.chat.u[c._id].vid?' bz_chat_cam':'')+'" lasttime="'+t+'">'+p+'</div>';
									if(c.am&&c.mb)
									{
										$('.bz_chat_nl_lll').append(pv);
									}
									else if(c.mb)
									{
										$('.bz_chat_nl_llll').append(pv);
									}
									else
									{
										$('.bz_chat_nl_lllll').append(pv);
									}
								}
								else
								{
									if(_.chat.u[c._id].vid)
									{
										$('#bz_chat_user'+c._id).addClass('bz_chat_cam').attr('lasttime',t).html(p);
									}
									else
									{
										$('#bz_chat_user'+c._id).removeClass('bz_chat_cam').attr('lasttime',t).html(p);
									}
								}
							}
						}
						$('.bz_chat_nl_lll > div, .bz_chat_nl_llll > div, .bz_chat_nl_lllll > div').each(function() {
							if($(this).attr('lasttime')!=t)
							{
								$(this).remove();
							}
						});
						$('.bz_chat_nl_l > div.l0').removeClass('l0');
						$('.bz_chat_nl_l > div:odd').addClass('l0');
						var _co1=$('.bz_chat_nl_lll > div').length,_co2=$('.bz_chat_nl_llll > div').length,_co3=$('.bz_chat_nl_lllll > div').length;
						$('#bz_chat_nl_ol').html(_co1+_co2+_co3);
						$('#bz_chat_nl_ol1').html(_co1);
						$('#bz_chat_nl_ol2').html(_co2);
						$('#bz_chat_nl_ol3').html(_co3);
						_.chat.resize();
						if(!_.chat.loaded)
						{
							_.chat.tmr=setTimeout(function(){_.chat.delay()},2000);
							_.chat.loaded=true;
						}
					}
					break;
				case 'chat':		
					if(a)
					{
						var snd=0,p,tx;
						for(var j=0;j<a.length;j++)
						{
							c=a[j];
							_.chat.lastid=c._id;
							if(!$('#bz_chat_text'+c._sn).length)
							{
								if(!_.chat.u[c.u])
								{
									_.chat.u[c.u]={'_id':c.u,'name':c.n,'img':c.i,'link':c.l,'admin':c.am,'member':c.mb,'default':c.d,'ip':c.ip};
								}
								
								if(c.ty)
								{
									if(c.ty=='admin' && c.par && _.chat.u[c.par.uid])
									{
										if(c.par.admin==-1)
										{
											_.chat.u[c.par.uid].admin=0;
										}
										else
										{
											_.chat.u[c.par.uid].admin=c.par.admin;
										}
									}
									else if(c.ty=='kick' && c.par && _.chat.first)
									{
										if(c.par.uid==_.chat.my._id)
										{
											if(c.par.room)
											{
												_.chat.sroom(c.par.room);
											}
											else
											{
												_.chat.banned=true;
												c.m+='<br><span class="f0 b4"> คุณถูกเตะออกจากห้อง กรุณารีเฟรสแชทใหม่อีกครั้ง เพื่อเข้าห้องสนทนา </span>';
											}
										}
									}
								}
								if(snd!=11)
								{
									snd=2;
								}
								if(c.p)
								{
									snd=11;
									if(c.p=='admin')
									{
										p=' (ส่งถึงผู้ดูแลทุกคน)'; //ส่งข้อความถึงแอดมินทุกคน
									}
									else
									{
										p=' ส่งถึง '+(c.p==_.chat.my._id?'[คุณ] ':'')+'<a href="javascript:;" onclick="_.chat.popup(\''+c.p+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+(_.chat.u[c.p]&&_.chat.u[c.p].admin?_.chat.u[c.p].admin:'0')+'">'+_.chat.cvcolor(c.pn,(_.chat.u[c.p]&&_.chat.u[c.p].member?_.chat.u[c.p].member:0))+'</a>';
									}
								}
								else
								{
									p='';	
								}
								var pid=(c.u==_.chat.my._id?c.p:c.u),fl=true;
								if(c.p && (_.chat.u[pid]||c.p=='admin') && (c.u==_.chat.my._id||c.p==_.chat.my._id||c.p=='admin'))
								{
									if(c.p=='admin')
									{
										pid='admin';
									}
									tx='<div id="bz_chat_text'+c._sn+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p><span onclick="_.chat.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.chat.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.chat.cvcolor(c.n,c.mb)+'</a> :</p><div class="f'+c.c+'">'+_.chat.cvcolor(_.chat.convert(c.m),1,1)+'</div><span></span></div>';
									_.chat.createbox(pid);
									$('#bz_box_'+pid+'_div_l').append(tx);
									$('#bz_box_'+pid+'_div').scrollTop(Math.max($('#bz_box_'+pid+'_div_l').height(),$('#bz_box_'+pid+'_div').height())+100);
									fl=false;
									if(c.u!=_.chat.my._id)
									{
										_.title.insert(pid,(pid=='admin'?'ข้อความถึงผู้ดูแลทุกคน':_.chat.cvcolor(_.chat.u[pid].name,0)+' ส่งข้อความถึงคุณ.'));
									}
								}
								if(c.ty=='game')
								{
									_.chat.game();
									if($('#bz_box_game').css('display')!='none')
									{
										tx='<div id="bz_chat_text'+c._sn+'" class="l'+_.chat._cbg+(c.p?' p':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.chat.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.chat.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.chat.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.chat.cvcolor(_.chat.convert(c.m),1,1)+'</div><span></span></div>';
										$('#bz_box_game_div_l').append(tx);
										$('#bz_box_game_div').scrollTop(Math.max($('#bz_box_game_div_l').height(),$('#bz_box_game_div').height())+100);
									}
								}
								else if(c.p && fl && (c.u!=_.chat.my._id && c.p!=_.chat.my._id))
								{
									if(!$('#bz_box_spy').length)
									{
										_.chat._zindex++;	
										var y='<div class="bz_box" id="bz_box_spy" style="z-index:'+_.chat._zindex+';left:100px;top:50px; width:550px; height:300px;" zindex="'+_.chat._zindex+'"><h4><span class="close">X</span> SPY</h4><div id="bz_box_spy_div" class="bz_box_div" style="height:278px;"><div class="bz_chat_ch_l" id="bz_box_spy_div_l"></div></div></div>';
										$('.bz_chat').append(y);
										$('#bz_box_spy .close').click(function(){$('#bz_box_spy').css('display','none');$('#bz_box_spy_div_l').html('');});
										$('#bz_box_spy').draggable({handle:'h4',containment: 'parent', scroll: false}).resizable({/*helper:'ui-resizable-helper',*/start:_.chat.boxresize1,stop:_.chat.boxresize2}).click(function(){
											if(Math.floor($(this).attr('zindex'))!=_.chat._zindex)
											{
												_.chat._zindex++;
												$(this).attr('zindex',_.chat._zindex).css({'z-index':_.chat._zindex});
											}
										});
									}
									if($('#bz_box_spy').css('display')!='none')
									{
										tx='<div id="bz_chat_text'+c._sn+'" class="l'+_.chat._cbg+(c.p?' p':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.chat.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.chat.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.chat.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.chat.cvcolor(_.chat.convert(c.m),1,1)+'</div><span></span></div>';
										$('#bz_box_spy_div_l').append(tx);
										if(_.chat._scroll)
										{
											$('#bz_box_spy_div').scrollTop(Math.max($('#bz_box_spy_div_l').height(),$('#bz_box_spy_div').height())+100);
										}
									}
								}
								else if(fl)
								{
									tx='<div id="bz_chat_text'+c._sn+'" class="l'+_.chat._cbg+(c.p?' p':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.chat.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.chat.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+(c.u==_.chat.my._id?'[คุณ] ':'')+'<a href="javascript:;" onclick="_.chat.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.chat.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.chat.cvcolor(_.chat.convert(c.m),1,1)+'</div><span></span></div>';
									_.chat.assign(tx,false);
								}
								if(_.chat.first)
								{
									_.chat.msl++;
								}
							}
						}
						if(snd)
						{
							_.chat.sound(snd);
						}
						if(_.chat.msl>=5)
						{
							_.chat.msl=0;
							if(!_.chat.my.member)
							{
								_.chat.assign('<p id="bz_chat_text_first" class="l'+_.chat._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;">'+
								'- คุณยังไม่ได้ล็อคอิน กรุณาล็อคอินเพื่อปิดข้อความแจ้งเตือนนี้<br>'+
								//'- คุยแบบเต็มจอ <a href="http://chat.boxza.com/room/'+_.chat.room+'" target="_blank">คลิกที่นี่</a> (พร้อมลูกเล่นอื่นๆอีกมากมายได้ที่ <a href="http://chat.boxza.com/" target="_blank">http://chat.boxza.com</a>)<br>'+
								'- คุณสามารถล็อคอินได้ที่: <a href="javascript:;" onclick="_.chat.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.chat.signup()">สมัครสมาชิก</a>  เพื่อ <a href="http://boxza.com/me" target="_blank">เปลี่ยนรูปโปรไฟล์</a> หรือ <a href="http://boxza.com/settings" target="_blank">เปลี่ยนชื่อหรือข้อมูลอื่นๆ</a><br>'+
								'</p>');
							}
						}
						_.chat.upscroll();
					}
					break;
			}
		},
		member:function(m,a)
		{
			if(m)
			{
				if(a==1)
				{
					return '<span class="bz_chat_level_1">ผู้ดูแล</span>';
				}
				else if(a==2)
				{
					return '<span class="bz_chat_level_2">ผู้ดูแลสูงสุด</span>';
				}
				else if(a==3)
				{
					return '<span class="bz_chat_level_3">เจ้าของห้อง</span>';
				}
				else if(a==8)
				{
					return '<span class="bz_chat_level_8">ตรวจสอบ</span>';
				}
				else if(a==9)
				{
					return '<span class="bz_chat_level_9">The Killer</span>';
				}
				else
				{
					return '<span class="bz_chat_level_0">สมาชิก</span>';
				}
			}
			else
			{
				return 'บุคคลทั่วไป';
			}
		},
		createbox:function(pid)
		{
			if(!$('#bz_box_'+pid).length)
			{
				var w=Math.floor(Math.random()*($(window).width()-300)),h=Math.floor(Math.random()*($(window).height()-200));
				_.chat._zindex++;	
				var y='<div class="bz_box" id="bz_box_'+pid+'" style="z-index:'+_.chat._zindex+';left:'+w+'px;top:'+h+'px;" zindex="'+_.chat._zindex+'"><h4><span class="close">X</span> <a href="javascript:;" onclick="_.chat.popup(\''+pid+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+(pid=='admin'?'1':(_.chat.u[pid].admin&&_.chat.u[pid].member?_.chat.u[pid].admin:'0'))+'">'+(pid=='admin'?'ส่งถึงผู้ดูแลทุกคน':_.chat.cvcolor(_.chat.u[pid].name,_.chat.u[pid].member))+'</a></h4><div id="bz_box_'+pid+'_div" class="bz_box_div"><div class="bz_chat_ch_l" id="bz_box_'+pid+'_div_l"></div></div><input type="text" class="tbox bz_box_input" id="bz_box_'+pid+'_input" uid="'+pid+'"></div>';
				$('.bz_chat').append(y);
				$('#bz_box_'+pid+' .bz_box_input').keypress(_.chat.keypress).focus(function(e){_.chat.lastfocus=$(this);_.title.remove(pid);});
				$('#bz_box_'+pid+' .close').click(function(){$('#bz_box_'+pid).remove(); $('.bz_chat_mb').focus();_.title.remove(pid);});
				$('#bz_box_'+pid).draggable({handle:'h4',containment: 'parent', scroll: false}).resizable({/*helper:'ui-resizable-helper',*/start:_.chat.boxresize1,stop:_.chat.boxresize2}).click(function(){
					if(Math.floor($(this).attr('zindex'))!=_.chat._zindex)
					{
						_.chat._zindex++;
						$(this).attr('zindex',_.chat._zindex).css({'z-index':_.chat._zindex});
					};
					_.title.remove(pid);
				});
				$('#bz_box_'+pid).trigger('resize');
			}
		},
		boxresize1:function(event,ui)
		{
			if($(ui.element).find('input').length)
			{
				$(ui.element).find('input').css({'display':'none'});
			}
		},
		boxresize2:function(event,ui)
		{
			var w=$(ui.element).width(),h=$(ui.element).height();
			if($(ui.element).find('input').length)
			{
				$(ui.element).find('input').css({'width':w-14,'display':'inline-block'});
				$(ui.element).find('.bz_box_div').css({'height':h-55});
			}
			else
			{
				$(ui.element).find('.bz_box_div').css({'height':h-28});
			}
		},
		sound:function(s){if(_.chat._sound && typeof($('#bz_chat_swf').get(0).sdcplay)=='function'){$('#bz_chat_swf').get(0).sdcplay(s);}},
		shuffle:function(o)
		{
			for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
			return o;
		},
		clearflood:function()
		{
			clearTimeout(_.chat.tmf);
			_.chat._flood=0;
			//_.chat._cbot++;
			//if(_.chat.room=='1')
			//{
				//if(_.chat._cbot>720&&!_.chat.my.admin)
				//{
				//	_.chat.banned=true;
				//	clearTimeout(_.chat.tmr);
				//}
			//}
			if(_.chat._autodc)
			{
				_.chat._remaindc++;
				if(_.chat._remaindc>=6)
				{
					clearTimeout(_.chat.tmr);
					if(_.chat._remaindc==6)
					{
							_.chat.assign('<p id="bz_chat_text_first" class="l'+_.chat._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;">'+
							'- ระบบทำการตัดการติดต่ออัตโนมัติ เนื่องจากคุณไม่ได้ทำการสนทนา (กรุณาล็อคอินเพื่อยกเลิกการตัดแบบอัตโนมัติ)<br>'+
							'</p>');
					}
				}
			}
			_.chat._remainsv++;
			
			_.chat.tmf=setTimeout(function(){_.chat.clearflood()},10000);
		},
		clearemo:function()
		{
			clearTimeout(_.chat.tme);
			_.chat.tme=setTimeout(function()
			{
				if(_.chat._rmemo>0)
				{
					_.chat._rmemo--;
					if(_.chat._rmemo==0)
					{
						_.chat._flemo=false;
					}
				}
				_.chat.clearemo();
			},1000);
			if(_.chat._rmemo>0)
			{
				$('.bz_chat_emo > strong').addClass('show').html('กรุณารออีก '+_.chat._rmemo+' วินาที เพื่อใช้งานอีโมอีกครั้ง');
				$('.bz_chat_emo > a,.bz_chat_emo > span').addClass('hide');
			}
			else
			{
				$('.bz_chat_emo > strong').removeClass('show');
				$('.bz_chat_emo > .hide').removeClass('hide');
			}
		},
		cvcolor:function(t,a)
		{
			if(t)
			{
				if(!a || a=='0')
				{
					var b=t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig,function(t2){
							return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig, '');
					});
				}
				else
				{
					_.chat.cc=new Object;
					_.chat.cci=(arguments.length>2?-16:0);
					var b='<span>'+(t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig,function(t2,i1){
						if(!_.chat.cc[i1])
						{
							if(_.chat.cci<3)
							{
								_.chat.cci++;
								_.chat.cc[i1]=1;
							}
							else
							{
								return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig, '</span><span>');
							}
						}
						return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig, '</span><span class="f$1 s$3 b$5">');
					}))+'</span>';
				}
				
				return b;
			}
			else
			{
				return '';
			}
		},
		rmcolor:function(t,a)
		{
			if(t)
			{
				if(!a || a=='0')
				{
					var b=t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig,function(t2){
							return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig, '');
					});
				}
				else
				{
					_.chat.cc=new Object;
					_.chat.cci=(arguments.length>2?-16:0);
					var b=(t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig,function(t2,i1){
						if(!_.chat.cc[i1])
						{
							if(_.chat.cci<3)
							{
								_.chat.cci++;
								_.chat.cc[i1]=1;
							}
							else
							{
								return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig, '');
							}
						}
						return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig, '^C$1$2$4');
					}));
				}
				
				return b;
			}
			else
			{
				return '';
			}
		},
		load:function(r)
		{
			_.chat.color(_.chat.shuffle([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])[0],1);
			_.chat.clearflood();
			$('.bz_chat_moreclick').html('[<a href="javascript:;" onClick="_.chat.open(\'\');">อีโมชั่นอื่นๆ</a>]');
			$('.bz_chat_col div').click(function(e){$('.bz_chat_col ul').css({'display':'block'});});
			$('.bz_chat_col > li').hover(function(){$(this).find('ul').css('display','block');},function(){$(this).find('ul').css('display','none');});
			$('.bz_chat_mb').keypress(_.chat.keypress).focus(function(e){_.chat.lastfocus=$(this);});
			_.chat.sroom(_.chat.room);
			_.chat.resize()
			$(window).resize(_.chat.resize);
			$(window).load(_.chat.resize);
			$('.bz_chat_ch').scroll(function(e) {
				var v=$('.bz_chat_ch').scrollTop(),h2=$('.bz_chat_ch').height(),h1=$('.bz_chat_ch_l.on').height(),h=h1-h2;
				if((h-v>150) && _.chat._scroll)
				{
					_.chat.scroll();
				}
				else if((h-v <50)&&!_.chat._scroll)
				{
					_.chat.scroll();
				}
			})
		},
		
		video:
		{
			set:function(s)
			{
				_.chat._vid=s;
			},
			publish:function(key)
			{
				if(!_.chat.logged)
				{
					_.box.alert('กรุณาล็อคอินก่อนใช้งานกล้อง');
				}
				else if(!$('#bz_cam').length)
				{
					var vid='<object width="100%" height="100%">'+
	'<param name="movie" value="/_static/chat/chat-stream.swf?v=4"></param>'+
	'<param name="allowscriptaccess" value="always"></param>'+
	'<param name="seamlesstabbing" value="true"></param>'+
	'<param name="wmode" value="opaque"></param>'+
	'<param name="flashvars" value="user='+_.chat.my._id+'&amp;key='+key+'"></param>'+
	'<embed src="/_static/chat/chat-stream.swf?v=4" type="application/x-shockwave-flash" width="100%" height="100%" allowscriptaccess="always" wmode="opaque" flashvars="user='+_.chat.my._id+'&amp;key='+key+'"></embed>'+
	'</object>';
					var w=Math.floor(Math.random()*($(window).width()-300)),h=Math.floor(Math.random()*($(window).height()-200));
					_.chat._zindex++;	
					var y='<div class="bz_cam" id="bz_cam" style="z-index:'+_.chat._zindex+';left:'+w+'px;top:'+h+'px;" zindex="'+_.chat._zindex+'"><h4><span class="close">X</span> <a href="javascript:;">กล้องเว็บแคมของคุณ</a></h4><div id="bz_cam_div" class="bz_cam_div">'+vid+'</div></div>';
					$('.bz_chat').append(y);
					$('#bz_cam .close').click(function(){$('#bz_cam').remove(); _.chat.video.set('stop');});
					$('#bz_cam').draggable({handle:'h4',containment: 'parent', scroll: false}).click(function(){
						if(Math.floor($(this).attr('zindex'))!=_.chat._zindex)
						{
							_.chat._zindex++;
							$(this).attr('zindex',_.chat._zindex).css({'z-index':_.chat._zindex});
						}
					});
					//_.chat.my._id
				}
			},
			open:function(u)
			{
				if(!_.chat.logged)
				{
					_.box.alert('กรุณาล็อคอินก่อนใช้งานกล้อง');
				}
				else if(!$('#bz_cam_'+u).length)
				{
					var vid='<object width="100%" height="100%">'+
	'<param name="movie" value="http://s0.boxza.com/static/chat/chat-play.swf?v=2"></param>'+
	'<param name="allowscriptaccess" value="always"></param>'+
	'<param name="seamlesstabbing" value="true"></param>'+
	'<param name="wmode" value="opaque"></param>'+
	'<param name="flashvars" value="user='+u+'"></param>'+
	'<embed src="http://s0.boxza.com/static/chat/chat-play.swf?v=2" type="application/x-shockwave-flash" width="100%" height="100%" allowscriptaccess="always" wmode="opaque" flashvars="user='+u+'"></embed>'+
	'</object>';
					var w=Math.floor(Math.random()*($(window).width()-300)),h=Math.floor(Math.random()*($(window).height()-200));
					_.chat._zindex++;	
					var y='<div class="bz_cam" id="bz_cam_'+u+'" style="z-index:'+_.chat._zindex+';left:'+w+'px;top:'+h+'px;" zindex="'+_.chat._zindex+'"><h4><span class="close">X</span> <a href="javascript:;">วิดีโอของ '+_.chat.cvcolor(_.chat.u[u].name,_.chat.u[u].member)+'</a></h4><div id="bz_cam_div" class="bz_cam_div">'+vid+'</div></div>';
					$('.bz_chat').append(y);
					$('#bz_cam_'+u+' .close').click(function(){$('#bz_cam_'+u).remove();});
					$('#bz_cam_'+u).draggable({handle:'h4',containment: 'parent', scroll: false}).click(function(){
						if(Math.floor($(this).attr('zindex'))!=_.chat._zindex)
						{
							_.chat._zindex++;
							$(this).attr('zindex',_.chat._zindex).css({'z-index':_.chat._zindex});
						}
					});
				}
			}
		},
		keypress:function(e)
		{
			var c=(e.keyCode?e.keyCode:e.which);
			var ms=$.trim($(this).val());
			if(c==13&&ms!='')
			{
				var _femo=false,_maxemo=1;
				ms=ms.replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,function(t2){
					_femo=true;
					return t2;
				});
				var ms3=ms.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
					_femo=true;
					return t2;
				});
				if(_.my&&(_.my._id==1||_.my._id==7)&&_femo)
				{
					_femo=false;
				}
				if(_femo)
				{
					_.chat._rmemo=_.chat._emodl;
					_.chat.clearemo();
					if(_.chat._flemo)
					{
						_.chat.assign('<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณใช้ Emoticon มากเกินไป กรุณารออีก '+_.chat._rmemo+' วินาที เพื่อใช้งานอีกครั้ง...</div><span></span></div>');
						return false;
					}
					_.chat._flemo=true;
				}
				$(this).val('');
				if(ms.substr(0,1)=='/')
				{
					var cmd=(ms.substr(1).split(' '))[0],ms2=ms.substr(cmd.length+2);
					if(cmd=='color')
					{
						var _t='<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">การใช้งานรหัสสี พิม <strong>^C[รหัสสี 1-16]ข้อความ</strong> เช่น... <br>';
						for( var i=1;i<=16;i++)
						{
							_t+=' &nbsp; &nbsp; &nbsp; ^C'+i+'ข้อความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f'+i+'">ข้อความ</span><br>';
						}
						_t+=' &nbsp; &nbsp; &nbsp; ^C4ข้อ^C7ความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f4">ข้อ</span><span class="f7">ความ</span><br>';
						_t+=' &nbsp; &nbsp; &nbsp; ^C11,11ข้อ^C16,4ความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f11 s11">ข้อ</span><span class="f16 s4">ความ</span><br>';
						_t+=' &nbsp; &nbsp; &nbsp; ^0,2,11ข้อ^C8,11,2ความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f0 s2 b11">ข้อ</span><span class="f8 s11 b2">ความ</span><br>';
						_t+='  &nbsp;   &nbsp; <span class="f4">*** กรุณาอย่าใช้สีสรรแสบตาจนเกินไป ***</span></div><span></span></div>';
						_.chat.assign(_t);
						if(ms2)
						{
							_.chat.color(ms2);	
						}
					}
					else if(cmd=='help')
					{
						var _t='<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คำสั่งเบื้องต้นสำหรับการใช้งาน /command<br>';
						_t+=' &nbsp; <strong>คำสั่งทั่วไป</strong><br>';
						_t+=' &nbsp; &nbsp; - <strong>ดูรหัสสี</strong>: /color<br>';
						_t+=' &nbsp; &nbsp; - <strong>เปลี่ยนชื่อ</strong>: /nick [ชื่อใหม่]<br>';
						_t+=' &nbsp; &nbsp; - <strong>กระซิบ</strong>: /private [ไอดีสมาชิก] [ข้อความ]<br>';
						_t+=' &nbsp; <strong>คำสั่งเฉพาะแอดมิน</strong><br>';
						_t+=' &nbsp; &nbsp; - <strong>ปิดการสนทนา</strong>(เป็นใบ้): /shutup [ไอดีสมาชิก] [ตัวเลขจำนวนเวลาหน่วยเป็นนาที]<br>';
						_t+=' &nbsp; &nbsp; - <strong>ดูรายการสมาชิกที่โดนปิดการสนทนาทั้งหมด</strong>: /shutup list<br>';
						_t+=' &nbsp; &nbsp; - <strong>ยกเลิกปิดการสนทนา</strong>: /shutup [ไอดีสมาชิก]<br>';
						_t+=' &nbsp; &nbsp; - <strong>เตะ</strong>: /kick [ไอดีสมาชิก] [ข้อความหรือเหตุผลในการเตะ]<br>';
						_t+=' &nbsp; &nbsp; - <strong>เตะย้ายห้อง</strong>:  /move [ไอดีของคนที่ถูกเตะ] [ไอดีห้อง 1-4 เรียงจากทั่วไป,เกย์,เลสเบี้ยน,ผู้หญิง] [เหตุผลที่จะเตะ มีหรือไม่มีก็ได้]<br>';
						_t+=' &nbsp; &nbsp; - <strong>แบน</strong>: /ban [ไอดีสมาชิก] [ตัวเลขจำนวนเวลาหน่วยเป็นนาที]<br>';
						_t+=' &nbsp; &nbsp; - <strong>ดูรายการที่แบนทั้งหมด</strong>: /ban list<br>';
						_t+=' &nbsp; &nbsp; - <strong>ปลดแบนด้วย ID</strong>: /unban id [ID ที่ถูกแบน]<br>';
						_t+=' &nbsp; &nbsp; - <strong>ปลดแบนด้วย IP</strong>: /unban ip [IP ที่ถูกแบน]<br>';
						_t+=' &nbsp; &nbsp; - <strong>ปลดแบนทั้งหมด</strong>: /unban all<br>';
						_t+=' &nbsp; &nbsp; - <strong>คุยเฉพาะในกลุ่มแอดมิน</strong>: /private admin [ข้อความ]<br>';
						_t+=' &nbsp; &nbsp; - <strong>ดูแอดมินทั้งหมด</strong>: /admin list<br>';
						_t+=' &nbsp; &nbsp; - <strong>ตั้งหรือปลด แอดมิน</strong>: /admin [ไอดีสมาชิก] [ตัวเลขรหัสของแอดมิน] : ตัวเลขรหัสของแอดมิน แบ่งเป็น -1 คือ ปลดแอดมิน, 1 คือ ผู้ดูแล, 2 คือ ผู้ดูแลสูงสุด<br>';
						_t+='</div><span></span></div>';
						_.chat.assign(_t);
					}
					else if(cmd=='msg'||cmd=='private')
					{
						_.chat.api(cmd,{'last':_.chat.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+ms2});
					}
					else if(cmd=='spy')
					{
						if(ms2=='on')
						{
							$('#bz_box_spy').css('display','block');
						}
						else if(ms2=='off')
						{
							$('#bz_box_spy').css('display','none');
						}
					}
					else if(cmd=='nick')
					{
						ms2=_.chat.rmcolor(ms2,_.chat.my.member);
						_.chat.api(cmd,{'last':_.chat.lastid,'cmd':ms2});
					}
					else if(cmd)
					{
						_.chat.api(cmd,{'last':_.chat.lastid,'cmd':ms2});
					}
				}
				else
				{
					_.chat._repeat=(_.chat._ms==ms?_.chat._repeat+1:1);
					_.chat._flood++;
					_.chat._ms=ms;
					_.chat._autodc=false;
					_.chat._cbot=0;				
					if(_.my&&(_.my._id==1||_.my._id==7))
					{
						_.chat._flood==0;
						_.chat._repeat=0;
					}
					if(_.chat._flood>3)
					{
						_.chat.assign('<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">กรุณาพิมพ์ช้าๆ อย่าฟลัดข้อความ</div><span></span></div>');
					}
					else if(_.chat._repeat>2)
					{
						_.chat.assign('<div id="bz_chat_text_login" class="l'+_.chat._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">กรุณาอย่าพิมข้อความซ้ำกันเกิน 2ครั้ง</div><span></span></div>');
					}
					else if($(this).attr('uid'))
					{
						_.chat.ide=0;
						_.chat.api('private',{'last':_.chat.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+$(this).attr('uid')+' '+ms});
					}
					else if($('.bz_chat_pv').val()&&$('.bz_chat_pv').val()!='0')
					{
						_.chat.ide=0;
						_.chat.api('private',{'last':_.chat.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+$('.bz_chat_pv').val()+' '+ms});
					}
					else
					{
						_.chat.ide=0;
						_.chat.api('msg',{'last':_.chat.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+ms});
					}
				}
			}
		},
		resize:function()
		{
			var w=$(window).width(),h=$(window).height(),l,_h=147;
			var ha=(h-_h);
			$('.bz_chat').height(h-42);
			$('.bz_chat_rl,.bz_chat_ch,.bz_chat_nl').height(ha);
			$('.bz_chat_ch').css({'width':w-$('.bz_chat_nl').width()-140,'left':125});
			$('.bz_chat_game').css({'display':'block','height':ha});
			l=w-210;
			$('.bz_chat_emo').width(l);
			$('.bz_chat_emo .h').css('display','inline-block');
			$('.bz_chat_mb').width(w-$('.bz_chat_pv').width()-32);
			$('.bz_chat_popup').css({'width':w,'height':h})
			$('.bz_chat_radio').width(Math.min(400,Math.max(250,$('.bz_chat_rl').width()-600)));
		}
	}
});