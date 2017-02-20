var _={
	version:1.0,hash:'',logged:false,radio:true,_scroll:true,_asound:true,_sound:true,first:false,loaded:false,lastid:0,tmr:'',_vid:'',index:0,_cbot:0,_cbg:0,_ubg:0,tmp:'',dl:null,ide:100,room:'1',_text:new Object,msl:0,_zindex:0,_spy:true,_emo:new Object,lastemo:'o',lastfocus:'',
	bantime:{1:'1 นาที',5:'5 นาที',15:'15 นาที',30:'30 นาที',60:'1 ชั่วโมง',120:'2 ชั่วโมง',180:'3 ชั่วโมง',360:'6 ชั่วโมง',720:'12 ชั่วโมง',1440:'24 ชั่วโมง'},
	info:new Object,cin:0,u:new Object,ds:0,my:new Object,banned:false,_ms:'',_repeat:0,_flood:0,_flemo:false,_rmemo:0,_autodc:true,_remaindc:0,_remainsv:0,_emodl:30,
	
	getfocus:function()
	{
		if(!_.lastfocus || !$(_.lastfocus).length || !_.lastfocus.is('input[type=text]'))
		{
			_.lastfocus=$('.bz_chat_mb');
		}
	},
	emoticon:function(t)
	{
		_.getfocus();
		_.lastfocus.val(_.lastfocus.val()+'['+t+']').focus();
		_.cpop();
	},
	cpname:function(a)
	{
		var c=$('.bz_chat_mb').attr('color');
		_.getfocus();
		_.lastfocus.val(_.lastfocus.val()+' ^C14 ---> ^C'+c+' '+_.u[a].name+' ^C14 <--- ^C'+c+' ').focus();
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
			_.api('nick',{'last':_.lastid,'cmd':_.rmcolor(t,_.my.member)});
			_.cpop();
		}
	},
	restorenick:function(){_.api('restore',{'last':_.lastid});_.cpop();},
	ban:function(a)
	{
		var l=$('.bz_chat_bantime').val();
		if(confirm('คุณต้องการแบน '+(_.u[a]?_.u[a].name:'')+' เป็นเวลา '+_.bantime[l]+' หรือไม่'))
		{
			_.api('ban',{'last':_.lastid,'cmd':a+' '+l});
			_.cpop();
		}
	},
	kick:function(a)
	{
		if(confirm('คุณต้องเตะ '+(_.u[a]?_.u[a].name:'')+' หรือไม่'))
		{
			_.api('kick',{'last':_.lastid,'cmd':a+' '+$('.bz_chat_kick').val()});
			_.cpop();
		}
	},
	setadmin:function(a,b)
	{
		if(_.u[a])
		{
			if(confirm('คุณต้องการ '+(b>0?'แต่งตั้ง':'ปลด')+' '+_.u[a].name+' เป็น '+(b==2?'ผู้ดูแลสูงสุด':(b==1?'ผู้ดูแล':'สมาชิกทั่วไป'))+' หรือไม่'))
			{
				_.api('admin',{'last':_.lastid,'cmd':a+' '+b});
				_.cpop();
			}
		}
		else
		{
			alert('ไม่มีสมาชิกดังกล่าว');
		}
	},
	popup:function(a)
	{
		if(_.banned)
		{
			return;
		}
		var w=$(window).width(),h=$(window).height(),t='';
		$('.bz_chat_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_chat_popup_ct"><div class="bz_chat_popup_in"><div class="bz_chat_popup_wr"><div class="bz_chat_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
		t='<div style="width:300px; text-align:center">';
		if(_.my._id==a)
		{
			t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.member(_.u[a].member,_.u[a].admin)+' [ID: '+a+']</h4>';
			t+='<div style="padding:10px;">ชื่อ: <input type="text" class="bz_chat_nick tbox" value="'+_.my.name+'"> <br><input type="button" class="button" onclick="_.savenick();" value="บันทึก">'+(_.my.name!=_.my.dname && _.my.name?' <input type="button" class="button" onclick="_.restorenick();" value="กลับไปใช้ชื่อเริ่มต้น"> ':'')+'<p style="padding:3px;text-align:center">* สามารถใช้สีได้สูงสุด 3สี</p><p class="bz_chat_nick_err"></p>';
			t+='<div style="height:1px; overflow:hidden; margin:10px 5px; border-top:1px solid #eee;"></div>'+(_.u[a].member?'<a href="http://boxza.com/'+_.u[a].link+'" class="button" target="_blank" onclick="_.cpop()">เปลี่ยนรูปโปรไฟล์</a> <a href="http://boxza.com/'+_.u[a].link+'" class="button" target="_blank" onclick="_.cpop()">ปรับแต่งข้อมูลส่วนตัว</a> <div style="height:1px; overflow:hidden; margin:10px 5px; border-top:1px solid #eee;"></div>':'')+'<input type="button" value="ปิดหน้าต่างนี้" class="btn whfocus" onclick="_.cpop()"></div>';
		}
		else if(_.u[a])
		{
			t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.member(_.u[a].member,_.u[a].admin)+' [ID: '+a+']</h4>';
			t+='<div style="padding:10px;text-align:left; line-height:2em"><img src="'+_.u[a].img+'" style="float:left; margin:5px 5px 0px 0px"><a href="javascript:;" onclick="_.cpname(\''+a+'\');_.cpop();"><strong class="bz_chat_user bz_chat_level_'+(_.u[a].admin?_.u[a].admin:0)+'">'+_.cvcolor(_.u[a].name,(_.u[a].member?_.u[a].member:0))+'</strong></a><br>'+(!_.u[a].member?'<a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress='+_.u[a].ip+'" class="button" target="_blank" onclick="_.cpop()">IP: '+_.u[a].ip+'</a> ':'')+(_.u[a].link?'<a href="http://boxza.com/'+_.u[a].link+'" class="button" target="_blank" onclick="_.cpop()">โปรไฟล์</a> ':'')+'<a href="javascript:;" class="button whfocus" onclick="_.whisper(\''+a+'\')">กระซิบ</a> '+'<p class="clear"></p>';
			if(_.my.admin&&_.my.member)
			{
				var l;
				t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>เตะ</strong><br>ข้อหา <input type="text" class="bz_chat_kick" style="width:140px;"> <a href="javascript:;" class="button" onclick="_.kick(\''+a+'\')">ตกลง</a></div>'
				
				if(!_.u[a].admin)
				{
					t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>แบนสมาชิก</strong><br>เป็นเวลา <select name="bnt" class="bz_chat_bantime">';
					for(l in _.bantime)
					{
						t+='<option value="'+l+'">'+_.bantime[l]+'</option>';
					}
					t+='</select> <a href="javascript:;" class="button" onclick="_.ban(\''+a+'\')">ตกลง</a></div>';
				}
				if(_.my.admin>1 && _.u[a].member)
				{				
					t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>แต่งตั้งสมาชิก</strong><br>';
					if(_.my.admin>=3 && _.u[a].admin!=2)
					{
						t+='<a href="javascript:;" class="button" onclick="_.setadmin(\''+a+'\',2)">ตั้งเป็นผู้ดูแลสูงสุด</a> ';
					}
					if(_.u[a].admin!=1)
					{
						t+='<a href="javascript:;" class="button" onclick="_.setadmin(\''+a+'\',1)">ตั้งเป็นผู้ดูแล</a> ';
					}
					if(_.u[a].admin)
					{
						t+='<a href="javascript:;" class="button" onclick="_.setadmin(\''+a+'\',-1)">ตั้งเป็นสมาชิกธรรมดา</a> ';
					}
					t+='</div>';
				}
			}
			t+='</div>';
			t+='<input type="button" value="ปิดหน้าต่างนี้" class="btn" onclick="_.cpop()"></div>';
		}
		else
		{
			t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">ออฟไลน์ [ID: '+a+']</h4>';
			t+='<div style="padding:10px;">สมาชิกนี้ออฟไลน์ไปแล้ว</div>';
			t+='<input type="button" value="ปิดหน้าต่างนี้" class="btn whfocus" onclick="_.cpop()"></div>';
		}
		$('.bz_chat_popup_wl').html(t);
		$('.whfocus').focus();
	},
	open:function(ty)
	{
		if(!ty)
		{
			ty=_.lastemo;
		}
		else
		{
			_.lastemo=ty;
		}
		var w=$(window).width(),h=$(window).height(),c='',cn='';
		var _c={o:117,y:180,r:94,p:95,a:110,m:53,l:21,b:18,c:10};
		if(c=_c[ty])
		{
			$('.bz_chat_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_chat_popup_ct"><div class="bz_chat_popup_in"><div class="bz_chat_popup_wr"><div class="bz_chat_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
			var t='<div style="height:24px;line-height:24px; background:#f5f5f5; padding:0px 10px;">';
			t+='<a href="javascript:;" onclick="_.open(\'o\')"'+(ty=='o'?' style="font-weight:bold;color:#f90"':'')+'">Onion</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'y\')"'+(ty=='y'?' style="font-weight:bold;color:#f90"':'')+'">Yoyo</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'r\')"'+(ty=='r'?' style="font-weight:bold;color:#f90"':'')+'">Rabbit</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'p\')"'+(ty=='p'?' style="font-weight:bold;color:#f90"':'')+'">Panda</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'a\')"'+(ty=='a'?' style="font-weight:bold;color:#f90"':'')+'">Raccoon</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'m\')"'+(ty=='m'?' style="font-weight:bold;color:#f90"':'')+'">Milk Bottle</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'l\')"'+(ty=='l'?' style="font-weight:bold;color:#f90"':'')+'">Leaf</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'b\')"'+(ty=='b'?' style="font-weight:bold;color:#f90"':'')+'">Red Crab</a> | ';
			t+='<a href="javascript:;" onclick="_.open(\'c\')"'+(ty=='c'?' style="font-weight:bold;color:#f90"':'')+'">Cloud</a>';
			t+='</div><ul class="bz_chat_pemo" style="width:'+(w-100)+'px; height:'+(h-220)+'px; overflow:auto;">';
			for(var i=1;i<=c;i++)
			{
				t+='<li><a href="#['+ty+i+']" onClick="_.emoticon(\''+ty+i+'\');return false;"><img src="http://s0.boxza.com/static/chat/emoticon/'+ty+'/'+i+'.gif" class="bz_chat_click_emo '+ty+'"></a></li>'
			}
			t+='<p style="clear:both;"></p></ul><div style="padding:5px; text-align:center;"><input type="button" value="ปิดหน้าต่างนี้" class="btn" onclick="_.cpop()"></div>';
			$('.bz_chat_popup_wl').html(t);
		}
	},
	whisper:function(a)
	{
		var s=false;
		$('.bz_chat_pv option').each(function(){if($(this).attr('value')==a){s=true;}});
		if(!s)
		{
			$('.bz_chat_pv').append('<option value="'+a+'">ส่งถึง.. '+_.cvcolor(_.u[a].name,0)+'</option>')
		}
		_.cpop();
		_.createbox(a);
		_.openb(a);
		$('#bz_box_'+a+'_input').focus();
	},
	cpop:function(){$('.bz_chat_popup').css('display','none');},
	sroom:function(t)
	{
		$('.bz_chat_ch_l_main,.bz_chat_nl_lll,.bz_chat_nl_llll,.bz_chat_nl_lllll').html('');
		_.u=new Object;
		_.first=false;
		_.room=Math.floor(t);
		_.lastid=0;
		_.ide=0;
		_.share2fb();
		$('#bz_chat_nl_ol,#bz_chat_nl_ol1,#bz_chat_nl_ol2,#bz_chat_nl_ol3').html('0');
		_.api('list',{'last':_.lastid},true);
	},
	convert:function(t)
	{
		_.cin=0;
		_.cinl='';
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
				if(em[j]&&em[j][0])
				{
					var rp=new RegExp('\\s'+em[j][0]+'', "g");
					t=t.replace(rp,'<span class="emo" style="background-position:'+em[j][1]+'px '+em[j][2]+'px "></span>');
				}
			}
			
		return t.replace(/(.*)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?\s]*)?(.*)?/,function(t2){
				var regExp = /(.*)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?\s]*)?(.*)?/;
				var m = t2.match(regExp);
				if (m&&m[8]){
					t2+='<div style="padding:5px"><a href="http://www.youtube.com/watch?v='+m[8]+'" target="_blank"><img src="http://img.youtube.com/vi/'+m[8]+'/1.jpg"></a></div>';
				}
				return t2
			}).replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
				_.cin++;
				if(_.cinl==i1+i2)
				{
					return '';
				}
				_.cinl=i1+i2;
				return (_.cin>2)?'':t2.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz_chat_click_emo $1" onClick="_.emoticon(\'$1$2\');">');
			}).replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
				_.cin++;
				if(_.cinl==i1+i2)
				{
					return '';
				}
				_.cinl=i1+i2;
				return (_.cin>2)?'':t2.replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz_chat_click_emo $1" onClick="_.emoticon(\'$1$2\');">');
			});
	},
	api:function(a)
	{
		if(_.banned)
		{
			return;
		}
		var dt=(arguments.length>1?arguments[1]:[]);dt.ntf=_.ds;	
		dt.vid=_._vid;
		dt.hash=_.hash;
		if(_.loaded)
		{
			_.ide++;
			clearTimeout(_.tmr);
			_.tmr=setTimeout(function(){_.delay()},20000);
		}
		$.ajax({url:'http://api.boxza.com/global/chat/'+_.room+'/'+a,type:'GET',crossDomain:true,data:dt,dataType:'jsonp',jsonpCallback:'_'+new Date().getTime(),success:function(d){
			for(var i=0;i<d.length;i++)
			{
				switch(d[i].method)
				{
					case 'chatbox': _.parse(d[i].data,d[i].type);break;
				}
			}
			if(_.loaded)
			{
				clearTimeout(_.tmr);
				_.tmr=setTimeout(function(){_.delay()},Math.max(2,Math.min(10,1+parseInt(_.ide/10)))*1000);
			}
		},
		error:function (xhr, ajaxOptions, thrownError)
		{	
			if(_.loaded)
			{
				clearTimeout(_.tmr);
				_.tmr=setTimeout(function(){_.delay()},20000);
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
		_.index++;
		if(_.index>5)
		{
			_.index=0;
			_.api('list',{'last':_.lastid});
		}
		else
		{
			_.api('idle',{'last':_.lastid});
		}
	},
	scroll:function(){(_._scroll=!_._scroll)?$('.bz_chat_scroll').removeClass('off'):$('.bz_chat_scroll').addClass('off');},
	esound:function(){(_._sound=!_._sound)?$('.bz_chat_sound').removeClass('off'):$('.bz_chat_sound').addClass('off');},
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
		_.upscroll(1);
	},
	upscroll:function(){
		if(_._scroll)
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
		window.open('http://oauth.boxza.com/login/?redirect_uri=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.room,'_blank');
	},
	signup:function(){
		window.open('http://oauth.boxza.com/signup/?redirect_uri=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.room,'_blank');
	},
	assign:function(t){_._cbg++;_._cbg=_._cbg%2;$('.bz_chat_ch_l_main').append(t);if(arguments.length==1)_.upscroll();},
	parse:function(a,b)
	{
		var c;
		switch(b)
		{		
			case 'info':
				_.logged=a.logged;
				break;
			case 'room':
				_.room=Math.floor(a.data);
				_.sroom(_.room);
				break;
			case 'notice':
				_.assign('<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">'+a+'</div><span></span></div>');
				break;
			case 'duplicate':
				_.banned=true;
				_.assign('<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณมีการล็อคอินซ้อน กรุณารีเฟรสหน้านี้ใหม่อีกครั้ง</div><span></span></div>');
				break;
			case 'banned':
				_.banned=true;
				_.assign('<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณถูกแบนจากระบบ</div><span></span></div>');
				break;
			case 'rank':
						var t='';
						t += 'คุณมีคะแนนออนไลน์ '+a.val+' บั๊ก<br>';
						_.assign('<p id="bz_chat_text_first" class="l'+_._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;"><strong style="color:#0099D2">คะแนนออนไลน์</strong><br>'+t+'</p>');
				break;
			case 'first':
						_.hash=a.hash;
						/*
						_.assign('<p id="bz_chat_text_first" class="l'+_._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;"><strong style="color:#0099D2">ห้อง'+a.name+'</strong> - '+
						'"'+a.welcome+'"'+
						'</p>'+
						'');
						*/
						if(!_.lastid)
						{
							_.lastid=1;
						}
						_.resize();
						if(_.my.admin)
						{
							var s=false;
							$('.bz_chat_pv option').each(function(){if($(this).attr('value')=='admin'){s=true;}});
							if(!s)
							{
								$('.bz_chat_pv').append('<option value="admin">ส่งถึงเฉพาะแอดมิน</option>')
							}
						}
						_.first=true;
				break;
			case 'my':
				_.u[a._id]=_.my={'_id':a._id,'name':a.n,'img':a.i,'link':a.l,'member':a.mb,'dname':a.d,'admin':a.am,'ip':a.ip,'rank':(a.rk?a.rk:'')};
				if(a.mb)
				{
					_._autodc=false;
				}
				$('.bz_chat_nl_ll').html('<div id="bz_chat_user_my" class="l"><a href="javascript:;" onclick="_.popup(\''+_.my._id+'\',1);"><img src="'+_.my.img+'">'+(_.my.rank?' <img src="http://s0.boxza.com/static/chat/rank/'+_.my.rank+'.gif"> ':'')+'</a><p><a href="javascript:;" onclick="_.popup(\''+_.my._id+'\',1);" class="bz_chat_user bz_chat_level_'+(_.my.admin&&_.my.member?_.my.admin:'0')+'">'+_.cvcolor(_.my.name,_.my.member)+'</a></p><span></span></div>');
				if(_.my.member)
				{
					if(_.my.admin)
					{
						_._emodl=20;
					}
					else
					{
						_._emodl=25;
					}
					$('.bz_chat_nl_ll').append('<p style="padding:0px 0px 0px 5px;border-bottom:1px solid #f0f0f0;">ประเภท: '+(_.my.admin?'ผู้ดูแล':'สมาชิก')+'</p><p style="padding:0px 0px 0px 5px;">คะแนน: '+a.bux+' บั๊ก</p><p style="padding:0px 0px 0px 5px;">เครดิต: '+a.box+' บ๊อก</p>');
				}
				else
				{
					_._emodl=30;
					$('.bz_chat_nl_ll').append('<p style="padding:0px 0px 0px 5px;border-bottom:1px solid #f0f0f0;">ประเภท: บุคคลทั่วไป</p><p style="text-align:center"><a href="javascript:;" onclick="_.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.signup()">สมัครสมาชิก</a></p><p style="text-align:center">เพื่อรับคะแนนออนไลน์</p>');
				}
				break;
			case 'list':
				if(a)
				{
					var t=''+Math.floor(Math.random()*100000),j,l,p,pv;
					for(j in a)
					{
						c=a[j];
						l=$('#bz_chat_user'+c._id).length;
						//if(_.my._id!=c._id && c._id!=1)
						//if(_.my._id!=c._id)
						if(_.my._id!=c._id && c._id!=1)
						{
							_.u[c._id]={'_id':c._id,'name':c.n,'img':c.i,'link':c.l,'admin':c.am,'member':c.mb,'default':c.d,'ip':c.ip,'rank':(c.rk?c.rk:''),'vid':(c.vid&&c.vid=='publish'?1:0)};
							p=(_.u[c._id].vid?'<a class="cam" href="javascript:;" onclick="_.video.open(\''+_.u[c._id]._id+'\')"><i class="icon-cam"></i></a> ':'')+'<a href="javascript:;" onclick="_.popup(\''+c._id+'\');"><img src="'+c.i+'">'+(_.u[c._id].rank?' <img src="http://s0.boxza.com/static/chat/rank/'+_.u[c._id].rank+'.gif">':'')+'</a><p><a href="javascript:;" onclick="_.popup(\''+c._id+'\');" class="bz_chat_user bz_chat_level_'+(c.am&&c.mb?c.am:'0')+'">'+_.cvcolor(c.n,c.mb)+'</a></p><span></span>';
							if(!l)
							{
								pv='<div id="bz_chat_user" class="'+c._id+(_.u[c._id].vid?' bz_chat_cam':'')+'" lasttime="'+t+'">'+p+'</div>';
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
								if(_.u[c._id].vid)
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
					$('#bz_chat_nl_ol,#room_count').html(_co1+_co2+_co3);
					$('#bz_chat_nl_ol1').html(_co1);
					$('#bz_chat_nl_ol2').html(_co2);
					$('#bz_chat_nl_ol3').html(_co3);
					_.resize();
					if(!_.loaded)
					{
						_.tmr=setTimeout(function(){_.delay()},2000);
						_.loaded=true;
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
						_.lastid=c._id;
						if(!$('#bz_chat_text'+c._sn).length)
						{
							if(!_.u[c.u])
							{
								_.u[c.u]={'_id':c.u,'name':c.n,'img':c.i,'link':c.l,'admin':c.am,'member':c.mb,'default':c.d,'ip':c.ip};
							}
							
							if(c.ty)
							{
								if(c.ty=='admin' && c.par && _.u[c.par.uid])
								{
									if(c.par.admin==-1)
									{
										_.u[c.par.uid].admin=0;
									}
									else
									{
										_.u[c.par.uid].admin=c.par.admin;
									}
								}
								else if(c.ty=='kick' && c.par && _.first)
								{
									if(c.par.uid==_.my._id)
									{
										if(c.par.room)
										{
											_.sroom(c.par.room);
										}
										else
										{
											_.banned=true;
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
									p=' ส่งถึง '+(c.p==_.my._id?'[คุณ] ':'')+'<a href="javascript:;" onclick="_.popup(\''+c.p+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+(_.u[c.p]&&_.u[c.p].admin?_.u[c.p].admin:'0')+'">'+_.cvcolor(c.pn,(_.u[c.p]&&_.u[c.p].member?_.u[c.p].member:0))+'</a>';
								}
							}
							else
							{
								p='';	
							}
							var pid=(c.u==_.my._id?c.p:c.u),fl=true;
							if(c.p && (_.u[pid]||c.p=='admin') && (c.u==_.my._id||c.p==_.my._id||c.p=='admin'))
							{
								if(c.p=='admin')
								{
									pid='admin';
								}
								tx='<div id="bz_chat_text'+c._sn+'" ip="'+c.ip+'"'+(c.u==_.my._id?' class="my"':'')+' admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p><span onclick="_.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.cvcolor(c.n,c.mb)+'</a> :</p><div class="f'+c.c+'">'+_.cvcolor(_.convert(c.m),1,1)+'</div><span></span></div>';
								_.createbox(pid);
								
								
								var d=$('#bz_box_'+pid).css('display');
								if(d=='none')
								{
									var no=parseInt($('#bz_box_'+pid).data('no'))+1;	
									$('#bz_box_'+pid).data('no',no);
									$('#bz_notify_'+pid).css('display','inline-block').html(no);
								}
								
								$('#bz_box_'+pid+'_div_l').append(tx);
								$('#bz_box_'+pid+'_div').scrollTop(Math.max($('#bz_box_'+pid+'_div_l').height(),$('#bz_box_'+pid+'_div').height())+100);
								fl=false;
							}
							if(c.ty=='game')
							{
								/*
								if(!$('#bz_box_game').length)
								{
									_._zindex++;	
									var y='<div class="bz_box" id="bz_box_game" style="z-index:'+_._zindex+';left:160px;top:10px; width:400px; height:90px;" zindex="'+_._zindex+'"><h4><span class="close">X</span> เกมส์ <small style="font-weight:normal;font-size:13px;">(สามารถเล่นเกมส์ได้ที่ หน้าคุยแบบเต็มจอ)</small></h4><div id="bz_box_game_div" class="bz_box_div" style="height:61px;"><div class="bz_chat_ch_l one" id="bz_box_game_div_l"></div></div></div>';
									$('.bz_chat').append(y);
									$('#bz_box_game .close').click(function(){$('#bz_box_game').css('display','none');$('#bz_box_game_div_l').html('');});
									
								}
								if($('#bz_box_game').css('display')!='none')
								{
									tx='<div id="bz_chat_text'+c._sn+'" class="l'+_._cbg+(c.p?' p':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.cvcolor(_.convert(c.m),1,1)+'</div><span></span></div>';
									$('#bz_box_game_div_l').append(tx);
									$('#bz_box_game_div').scrollTop(Math.max($('#bz_box_game_div_l').height(),$('#bz_box_game_div').height())+100);
								}
								*/
							}
							else if(c.p && fl && (c.u!=_.my._id && c.p!=_.my._id))
							{
							}
							else if(fl)
							{
								tx='<div id="bz_chat_text'+c._sn+'" class="l'+_._cbg+(c.p?' p':'')+(c.u==_.my._id?' my':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.cpname(\''+c.u+'\');"'+(c.inn?' class="in"':'')+'>['+c.t+']</span>'+(c.vid&&c.vid=='publish'?' <a href="javascript:;" onclick="_.video.open(\''+c.u+'\')"><i class="v v-'+c.vid+'"></i></a>':'')+' <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+(c.u==_.my._id?'[คุณ] ':'')+'<a href="javascript:;" onclick="_.popup(\''+c.u+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+c.am+'">'+_.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.cvcolor(_.convert(c.m),1,1)+'</div><span></span></div>';
								_.assign(tx,false);
							}
							if(_.first)
							{
								_.msl++;
							}
						}
					}
					if(snd)
					{
						_.sound(snd);
					}
					if(_.msl>=5)
					{
						_.msl=0;
					}
					_.upscroll();
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
	openb:function(pid)
	{
		//bz_box_'+pid+'
		
		if(!$('#bz_box_'+pid).length)
		{
			
		}
		var d=$('#bz_box_'+pid).css('display');
		if(d!='none')
		{
			$('#bz_box_'+pid).css('display','none');
		}
		else
		{
			$('#bz_box_'+pid).css('display','block');
		}
		$('#bz_box_'+pid).data('no',0);
		$('#bz_notify_'+pid).css('display','none').html('');
	},
	createbox:function(pid)
	{
		if(!$('#bz_box_'+pid).length)
		{
			var av='<a href="javascript:;" onclick="_.openb(\''+pid+'\');" id="bz_uicon_'+pid+'"><img src="'+(pid=='admin'?'http://s0.boxza.com/static/images/chat/admin.png':_.u[pid].img)+'"><i id="bz_notify_'+pid+'" style="display:none">0</i></a>';
			$('#bz_priv').append(av);
			var w=Math.floor(Math.random()*($(window).width()-300)),h=Math.floor(Math.random()*($(window).height()-200));
			_._zindex++;	
			var y='<div class="bz_box" id="bz_box_'+pid+'" data-no="0"><h4><span class="close">X</span><span class="min">_</span> <a href="javascript:;" onclick="_.popup(\''+pid+'\');" class="bz_chat_user bz_chat_user_width bz_chat_level_'+(pid=='admin'?'1':(_.u[pid].admin&&_.u[pid].member?_.u[pid].admin:'0'))+'">'+(pid=='admin'?'ส่งถึงผู้ดูแลทุกคน':_.cvcolor(_.u[pid].name,_.u[pid].member))+'</a></h4><div id="bz_box_'+pid+'_div" class="bz_box_div"><div class="bz_chat_ch_l" id="bz_box_'+pid+'_div_l"></div></div><div class="bz_box_input"><textarea rows="1" id="bz_box_'+pid+'_input" uid="'+pid+'"></textarea></div></div>';
			$('.bz_chat').append(y);
			$('#bz_box_'+pid+' .bz_box_input textarea').keypress(_.keypress).focus(function(e){_.lastfocus=$(this);});
			$('#bz_box_'+pid+' .close').click(function(){$('#bz_box_'+pid).remove();$('#bz_uicon_'+pid).remove();$('#bz_box_'+pid).remove(); $('.bz_chat_mb').focus();});
			$('#bz_box_'+pid+' .min').click(function(){_.openb(pid)});
			//$('#bz_box_'+pid).trigger('resize');
			_.resize();
		}
	},
	share2fb:function()
	{
		$('.bz_chat_share').html('<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FBoxzaNetwork&amp;send=false&amp;layout=button_count&amp;width=115&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowTransparency="true"></iframe><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FIntrend365-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%25A2%25E0%25B8%25B7%25E0%25B8%2594-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%&amp;send=false&amp;layout=button_count&amp;width=115&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowTransparency="true"></iframe>');
	//	$('.bz_chat_share').html('<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.room+'&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>');
	},
	sound:function(s){},
	shuffle:function(o)
	{
    	for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
   	return o;
	},
	clearflood:function()
	{
		clearTimeout(_.tmf);
		_._flood=0;
		//_._cbot++;
		//if(_.room=='1')
		//{
		//	if(_._cbot>720&&!_.my.admin)
		//	{
		//		_.banned=true;
		//		clearTimeout(_.tmr);
		//	}
		//}
		
		if(_._autodc)
		{
			_._remaindc++;
			if(_._remaindc>=6)
			{
				clearTimeout(_.tmr);
				if(_._remaindc==6)
				{
						_.assign('<p id="bz_chat_text_first" class="l'+_._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;">'+
						'- ระบบทำการตัดการติดต่ออัตโนมัติ เนื่องจากคุณไม่ได้ทำการสนทนา (กรุณาล็อคอินเพื่อยกเลิกการตัดแบบอัตโนมัติ)<br>'+
						'</p>');
				}
			}
		}
		if(_._remainsv>18)
		{
			$('.bz_chat_other2').prop('src','http://s.boxza.com/chat/_html/service.html?r'+Math.floor(Math.random()*99999));
			_._remainsv=-1;
		}
		_._remainsv++;
		
		_.tmf=setTimeout(function(){_.clearflood()},10000);
	},
	clearemo:function()
	{
		clearTimeout(_.tme);
		_.tme=setTimeout(function()
		{
			if(_._rmemo>0)
			{
				_._rmemo--;
				if(_._rmemo==0)
				{
					_._flemo=false;
				}
			}
			_.clearemo();
		},1000);
		if(_._rmemo>0)
		{
			$('.bz_chat_emo > strong').addClass('show').html('กรุณารออีก '+_._rmemo+' วินาที เพื่อใช้งานอีโมอีกครั้ง');
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
				_.cc=new Object;
				_.cci=(arguments.length>2?-16:0);
				var b='<span>'+(t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig,function(t2,i1){
					if(!_.cc[i1])
					{
						if(_.cci<3)
						{
							_.cci++;
							_.cc[i1]=1;
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
				_.cc=new Object;
				_.cci=(arguments.length>2?-16:0);
				var b=(t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/ig,function(t2,i1){
					if(!_.cc[i1])
					{
						if(_.cci<3)
						{
							_.cci++;
							_.cc[i1]=1;
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
	load:function()
	{
		_.color(_.shuffle([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])[0],1);
		_.clearflood();
		$('.bz_chat_mb').keypress(_.keypress).focus(function(e){_.lastfocus=$(this);});
		_.sroom(_.room);
		_.resize()
		$(window).resize(function(){_.resize();setTimeout(function(){_.resize()},1000)});
		$(window).load(_.resize);
		$('.bz_chat_ch').scroll(function(e) {
			var v=$('.bz_chat_ch').scrollTop(),h2=$('.bz_chat_ch').height(),h1=$('.bz_chat_ch_l.on').height(),h=h1-h2;
			if((h-v>150) && _._scroll)
			{
				_.scroll();
			}
			else if((h-v <50)&&!_._scroll)
			{
				_.scroll();
			}
		})
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
			if(_femo)
			{
				_._rmemo=_._emodl;
				_.clearemo();
				if(_._flemo)
				{
					_.assign('<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณใช้ Emoticon มากเกินไป กรุณารออีก '+_._rmemo+' วินาที เพื่อใช้งานอีกครั้ง...</div><span></span></div>');
					return false;
				}
				_._flemo=true;
			}
			$(this).val('');
			if(ms.substr(0,1)=='/')
			{
				var cmd=(ms.substr(1).split(' '))[0],ms2=ms.substr(cmd.length+2);
				if(cmd=='color')
				{
					var _t='<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">การใช้งานรหัสสี พิม <strong>^C[รหัสสี 1-16]ข้อความ</strong> เช่น... <br>';
					for( var i=1;i<=16;i++)
					{
						_t+=' &nbsp; &nbsp; &nbsp; ^C'+i+'ข้อความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f'+i+'">ข้อความ</span><br>';
					}					
					_t+=' &nbsp; &nbsp; &nbsp; ^C4ข้อ^C7ความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f4">ข้อ</span><span class="f7">ความ</span><br>';
					_t+=' &nbsp; &nbsp; &nbsp; ^C11,11ข้อ^C16,4ความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f11 s11">ข้อ</span><span class="f16 s4">ความ</span><br>';
					_t+=' &nbsp; &nbsp; &nbsp; ^0,2,11ข้อ^C8,11,2ความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f0 s2 b11">ข้อ</span><span class="f8 s11 b2">ความ</span><br>';
					_t+='  &nbsp;   &nbsp; <span class="f4">*** กรุณาอย่าใช้สีสรรแสบตาจนเกินไป ***</span></div><span></span></div>';
					_.assign(_t);
					if(ms2)
					{
						_.color(ms2);	
					}
				}
				else if(cmd=='help')
				{
					var _t='<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คำสั่งเบื้องต้นสำหรับการใช้งาน /command<br>';
					_t+=' &nbsp; <strong>คำสั่งทั่วไป</strong><br>';
					_t+=' &nbsp; &nbsp; - <strong>ดูรหัสสี</strong>: /color<br>';
					_t+=' &nbsp; &nbsp; - <strong>เปลี่ยนชื่อ</strong>: /nick [ชื่อใหม่]<br>';
					_t+=' &nbsp; &nbsp; - <strong>กระซิบ</strong>: /private [ไอดีสมาชิก] [ข้อความ]<br>';
					_t+=' &nbsp; <strong>คำสั่งเฉพาะแอดมิน</strong><br>';
					_t+=' &nbsp; &nbsp; - <strong>ปิดการสนทนา</strong>(เป็นใบ้): /shutup [ไอดีสมาชิก] [ตัวเลขจำนวนเวลาหน่วยเป็นนาที]<br>';
					_t+=' &nbsp; &nbsp; - <strong>ดูรายการสมาชิกที่โดนปิดการสนทนาทั้งหมด</strong>: /shutup list<br>';
					_t+=' &nbsp; &nbsp; - <strong>ยกเลิกปิดการสนทนา</strong>: /shutup [ไอดีสมาชิก]<br>';
					_t+=' &nbsp; &nbsp; - <strong>เตะ</strong>: /kick [ไอดีสมาชิก] [ข้อความหรือเหตุผลในการเตะ]<br>';
					_t+=' &nbsp; &nbsp; - <strong>เตะย้ายห้อง</strong>:  /move [ไอดีของคนที่ถูกเตะ] [ไอดีห้อง 1-4 เรียงจากทั่วไป,เกย์,เลสเบี้ยน,ผู้หญิง] [เหตุผลที่จะเตะ มีหรือไม่มีก็ได้]';
					_t+=' &nbsp; &nbsp; - <strong>แบน</strong>: /ban [ไอดีสมาชิก] [ตัวเลขจำนวนเวลาหน่วยเป็นนาที]<br>';
					_t+=' &nbsp; &nbsp; - <strong>ดูรายการที่แบนทั้งหมด</strong>: /ban list<br>';
					_t+=' &nbsp; &nbsp; - <strong>ปลดแบนด้วย ID</strong>: /unban id [ID ที่ถูกแบน]<br>';
					_t+=' &nbsp; &nbsp; - <strong>ปลดแบนด้วย IP</strong>: /unban ip [IP ที่ถูกแบน]<br>';
					_t+=' &nbsp; &nbsp; - <strong>ปลดแบนทั้งหมด</strong>: /unban all<br>';
					_t+=' &nbsp; &nbsp; - <strong>คุยเฉพาะในกลุ่มแอดมิน</strong>: /private admin [ข้อความ]<br>';
					_t+=' &nbsp; &nbsp; - <strong>ดูแอดมินทั้งหมด</strong>: /admin list<br>';
					_t+=' &nbsp; &nbsp; - <strong>ตั้งหรือปลด แอดมิน</strong>: /admin [ไอดีสมาชิก] [ตัวเลขรหัสของแอดมิน] : ตัวเลขรหัสของแอดมิน แบ่งเป็น -1 คือ ปลดแอดมิน, 1 คือ ผู้ดูแล, 2 คือ ผู้ดูแลสูงสุด<br>';
					_t+='</div><span></span></div>';
					_.assign(_t);
				}
				else if(cmd=='msg'||cmd=='private')
				{
					_.api(cmd,{'last':_.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+ms2});
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
					ms2=_.rmcolor(ms2,_.my.member);
					_.api(cmd,{'last':_.lastid,'cmd':ms2});
				}
				else if(cmd)
				{
					_.api(cmd,{'last':_.lastid,'cmd':ms2});
				}
			}
			else
			{
				_._repeat=(_._ms==ms?_._repeat+1:1);
				_._flood++;
				_._ms=ms;
				_._autodc=false;
				_._cbot=0;
				
				if(_._flood>3)
				{
					_.assign('<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">กรุณาพิมพ์ช้าๆ อย่าฟลัดข้อความ</div><span></span></div>');
				}
				else if(_._repeat>2)
				{
					_.assign('<div id="bz_chat_text_login" class="l'+_._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">กรุณาอย่าพิมข้อความซ้ำกันเกิน 2ครั้ง</div><span></span></div>');
				}
				else if($(this).attr('uid'))
				{
					_.ide=0;
					_.api('private',{'last':_.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+$(this).attr('uid')+' '+ms});
				}
				else if($('.bz_chat_pv').val()&&$('.bz_chat_pv').val()!='0')
				{
					_.ide=0;
					_.api('private',{'last':_.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+$('.bz_chat_pv').val()+' '+ms});
				}
				else
				{
					_.ide=0;
					_.api('msg',{'last':_.lastid,'cmd':$('.bz_chat_mb').attr('color')+' '+ms});
				}
			}
		}
	},
	resize:function()
	{
		var w=$(window).width(),h=$(window).height(),l,_h=138;
		
		$('body').scrollTop(0);
		$('.bz_chat_ch').scrollTop(Math.max($('.bz_chat_ch_l.on').height(),$('.bz_chat_ch').height())+100);
		
		var ha=(h-_h),hb=Math.floor(ha/3),hc=$('.bz_chat_other > div').height();
		$('.bz_chat_rl').height(ha);
		$('.bz_chat_ch,.bz_chat_nl').height(ha); // 120 | 145
		$('.bz_box_div').height(h-96-125+48);
		
		$('.bz_chat_popup').css({'width':w,'height':h-96})
	}
}
