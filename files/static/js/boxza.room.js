$.extend(_,{
	room:{
		version:0.5,_scroll:true,_sound:true,first:false,loaded:false,lastid:0,tmr:'',index:0,_cbg:0,_ubg:0,tmp:'',dl:null,ide:100,room:'1',_text:new Object,msl:0,_zindex:1000,_spy:true,_emo:new Object,lastemo:'o',lastfocus:'',
		bantime:{1:'1 นาที',5:'5 นาที',15:'15 นาที',30:'30 นาที',60:'1 ชั่วโมง',120:'2 ชั่วโมง',180:'3 ชั่วโมง',360:'6 ชั่วโมง',720:'12 ชั่วโมง',1440:'24 ชั่วโมง'},
		info:new Object,cin:0,u:new Object,ds:0,my:new Object,banned:false,_ms:'',_repeat:0,_flood:0,_flemo:false,_rmemo:0,_autodc:true,_remaindc:0,_remainsv:0,_emodl:30,
		enablecolor:function(a,b)
		{
			if(!$(a).is(':checked'))
			{
				$('.bz_room').addClass('ecolor'+b);
			}
			else
			{
				$('.bz_room').removeClass('ecolor'+b);
			}
		},
		getfocus:function()
		{
			if(!_.room.lastfocus || !$(_.room.lastfocus).length || !_.room.lastfocus.is('input[type=text]'))
			{
				_.room.lastfocus=$('.bz_room_mb');
			}
		},
		emoticon:function(t)
		{
			_.room.getfocus();
			_.room.lastfocus.val(_.room.lastfocus.val()+'['+t+']').focus();
			_.room.cpop();
		},
		query:function(n){n=n.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");var s="[\\?&#]"+n+"=([^&#]*)",r=new RegExp(s),u=r.exec(arguments.length>1?window.location.hash:window.location.search);return u?decodeURIComponent(u[1].replace(/\+/g, " ")):'';},
		info:function()
		{
			var w=$(window).width(),h=$(window).height();
			$('.bz_room_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_room_popup_ct"><div class="bz_room_popup_in"><div class="bz_room_popup_wr"><div class="bz_room_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
			$('.bz_room_popup_wl').html('<div style="width:400px; text-align:center"><h4 style="color:#ff6600; background:#eee; padding:5px;">BoxZa Chat</h4><div style="padding:10px;"><a href="http://chat.boxza.com/room/'+_.room.room+'" class="button" target="_blank">แบบเต็มจอ</a> </div>'+
			'<div style="padding:"5px"><h4 style="margin:5px 0px 0px 0px; padding:5px; background:#f9f9f9; color:#F60">นำแชทไปใช้งานในเว็บ</h4><div style="padding:5px; margin:5px 0px;"><textarea style="width:300px; height:60px; line-height:24px; padding:0px; margin:0px;"><iframe frameborder="0" width="100%" height="550" src="http://s0.boxza.com/static/chat/"></iframe></textarea></div>'+
			'</div><input type="button" value="ปิดหน้าต่างนี้" class="button" onclick="_.room.cpop()">');
		},
		cpname:function(a)
		{
			var c=$('.bz_room_mb').attr('color');
			_.room.getfocus();
			_.room.lastfocus.val(_.room.lastfocus.val()+' ^C'+c+' '+_.room.u[a].name+' ^C14 <--- ^C'+c+' ').focus();
		},
		savenick:function()
		{
			var t=$.trim($('.bz_room_nick').val());
			if(t.length<3)
			{
				$('.bz_room_nick_err').html('ชื่อสั้นเกินไป 3-40 ตัวอักษร');
			}
			else if(t.length>40)
			{
				$('.bz_room_nick_err').html('ชื่อยาวเกินไป 3-40 ตัวอักษร');
			}
			else
			{
				_.room.api('nick',{'last':_.room.lastid,'cmd':_.room.rmcolor(t,_.room.my.member)});
				_.room.cpop();
			}
		},
		restorenick:function(){_.room.api('restore',{'last':_.room.lastid});_.room.cpop();},
		ban:function(a)
		{
			var l=$('.bz_room_bantime').val();
			if(confirm('คุณต้องการแบน '+(_.room.u[a]?_.room.u[a].name:'')+' เป็นเวลา '+_.room.bantime[l]+' หรือไม่'))
			{
				_.room.api('ban',{'last':_.room.lastid,'cmd':a+' '+l});
				_.room.cpop();
			}
		},
		kick:function(a)
		{
			if(confirm('คุณต้องเตะ '+(_.room.u[a]?_.room.u[a].name:'')+' หรือไม่'))
			{
				_.room.api('kick',{'last':_.room.lastid,'cmd':a+' '+$('.bz_room_kick').val()});
				_.room.cpop();
			}
		},
		setadmin:function(a,b)
		{
			if(_.room.u[a])
			{
				if(confirm('คุณต้องการ '+(b>0?'แต่งตั้ง':'ปลด')+' '+_.room.u[a].name+' เป็น '+(b==2?'ผู้ดูแลสูงสุด':(b==1?'ผู้ดูแล':'สมาชิกทั่วไป'))+' หรือไม่'))
				{
					_.room.api('admin',{'last':_.room.lastid,'cmd':a+' '+b});
					_.room.cpop();
				}
			}
			else
			{
				alert('ไม่มีสมาชิกดังกล่าว');
			}
		},
		popup:function(a)
		{
			if(_.room.banned)
			{
				return;
			}
			var w=$(window).width(),h=$(window).height(),t='';
			$('.bz_room_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_room_popup_ct"><div class="bz_room_popup_in"><div class="bz_room_popup_wr"><div class="bz_room_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
			t='<div style="width:300px; text-align:center">';
			if(_.room.my._id==a)
			{
				t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.room.member(_.room.u[a].member,_.room.u[a].admin)+' [ID: '+a+']</h4>';
				t+='<div style="padding:10px;">ชื่อ: <input type="text" class="bz_room_nick tbox" value="'+_.room.my.name+'"> <br><input type="button" class="button" onclick="_.room.savenick();" value="บันทึก">'+(_.room.my.name!=_.room.my.dname && _.room.my.name?' <input type="button" class="button" onclick="_.room.restorenick();" value="กลับไปใช้ชื่อเริ่มต้น"> ':'')+'<p style="padding:3px;text-align:center">* สามารถใช้สีได้สูงสุด 3สี</p><p class="bz_room_nick_err"></p>';
				t+='<div style="height:1px; overflow:hidden; margin:10px 5px; border-top:1px solid #eee;"></div>'+(_.room.u[a].member?'<a href="http://boxza.com/'+_.room.u[a].link+'" class="button" target="_blank" onclick="_.room.cpop()">เปลี่ยนรูปโปรไฟล์</a> <a href="http://boxza.com/'+_.room.u[a].link+'" class="button" target="_blank" onclick="_.room.cpop()">ปรับแต่งข้อมูลส่วนตัว</a> <div style="height:1px; overflow:hidden; margin:10px 5px; border-top:1px solid #eee;"></div>':'')+'<input type="button" value="ปิดหน้าต่างนี้" class="button whfocus" onclick="_.room.cpop()"></div>';
			}
			else if(_.room.u[a])
			{
				t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">'+_.room.member(_.room.u[a].member,_.room.u[a].admin)+' [ID: '+a+']</h4>';
				t+='<div style="padding:10px;text-align:left; line-height:2em"><img src="'+_.room.u[a].img+'" style="float:left; margin:5px 5px 0px 0px"><strong class="bz_room_user bz_room_level_'+(_.room.u[a].admin?_.room.u[a].admin:0)+'">'+_.room.cvcolor(_.room.u[a].name,(_.room.u[a].member?_.room.u[a].member:0))+'</strong><br>'+(!_.room.u[a].member?'<a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress='+_.room.u[a].ip+'" class="button" target="_blank" onclick="_.room.cpop()">IP: '+_.room.u[a].ip+'</a> ':'')+(_.room.u[a].link?'<a href="http://boxza.com/'+_.room.u[a].link+'" class="button" target="_blank" onclick="_.room.cpop()">โปรไฟล์</a> ':'')+'<a href="javascript:;" class="button whfocus" onclick="_.room.whisper(\''+a+'\')">กระซิบ</a> '+'<p class="clear"></p>';
				if(_.room.my.admin&&_.room.my.member)
				{
					var l;
					t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>เตะ</strong><br>ข้อหา <input type="text" class="bz_room_kick" style="width:140px;"> <a href="javascript:;" class="button" onclick="_.room.kick(\''+a+'\')">ตกลง</a></div>'
					
					if(!_.room.u[a].admin)
					{
						t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>แบนสมาชิก</strong><br>เป็นเวลา <select name="bnt" class="bz_room_bantime">';
						for(l in _.room.bantime)
						{
							t+='<option value="'+l+'">'+_.room.bantime[l]+'</option>';
						}
						t+='</select> <a href="javascript:;" class="button" onclick="_.room.ban(\''+a+'\')">ตกลง</a></div>';
					}
					if(_.room.my.admin>1 && _.room.u[a].member)
					{				
						t+='<div style="padding:5px;margin:5px 0px;text-align:center; line-height:2em;border:1px solid #ccc;"><strong>แต่งตั้งสมาชิก</strong><br>';
						if(_.room.my.admin>=3 && _.room.u[a].admin!=2)
						{
							t+='<a href="javascript:;" class="button" onclick="_.room.setadmin(\''+a+'\',2)">ตั้งเป็นผู้ดูแลสูงสุด</a> ';
						}
						if(_.room.u[a].admin!=1)
						{
							t+='<a href="javascript:;" class="button" onclick="_.room.setadmin(\''+a+'\',1)">ตั้งเป็นผู้ดูแล</a> ';
						}
						if(_.room.u[a].admin)
						{
							t+='<a href="javascript:;" class="button" onclick="_.room.setadmin(\''+a+'\',-1)">ตั้งเป็นสมาชิกธรรมดา</a> ';
						}
						t+='</div>';
					}
				}
				t+='</div>';
				t+='<input type="button" value="ปิดหน้าต่างนี้" class="button" onclick="_.room.cpop()"></div>';
			}
			else
			{
				t+='<h4 style="color:#ff6600; background:#eee; padding:5px;">ออฟไลน์ [ID: '+a+']</h4>';
				t+='<div style="padding:10px;">สมาชิกนี้ออฟไลน์ไปแล้ว</div>';
				t+='<input type="button" value="ปิดหน้าต่างนี้" class="button whfocus" onclick="_.room.cpop()"></div>';
			}
			$('.bz_room_popup_wl').html(t);
			$('.whfocus').focus();
		},
		open:function(ty)
		{
			if(!ty)
			{
				ty=_.room.lastemo;
			}
			else
			{
				_.room.lastemo=ty;
			}
			var w=$(window).width(),h=$(window).height(),c='',cn='';
			var _c={o:117,y:180,r:94,p:95,a:110,m:53,l:21,b:18,c:10};
			if(c=_c[ty])
			{
				$('.bz_room_popup').css({'display':'block','width':w,'height':h}).html('<div class="bz_room_popup_ct"><div class="bz_room_popup_in"><div class="bz_room_popup_wr"><div class="bz_room_popup_wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
				var t='<div style="height:24px;line-height:24px; background:#f5f5f5; padding:0px 10px;">';
				t+='<a href="javascript:;" onclick="_.room.open(\'o\')"'+(ty=='o'?' style="font-weight:bold;color:#f90"':'')+'">Onion</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'y\')"'+(ty=='y'?' style="font-weight:bold;color:#f90"':'')+'">Yoyo</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'r\')"'+(ty=='r'?' style="font-weight:bold;color:#f90"':'')+'">Rabbit</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'p\')"'+(ty=='p'?' style="font-weight:bold;color:#f90"':'')+'">Panda</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'a\')"'+(ty=='a'?' style="font-weight:bold;color:#f90"':'')+'">Raccoon</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'m\')"'+(ty=='m'?' style="font-weight:bold;color:#f90"':'')+'">Milk Bottle</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'l\')"'+(ty=='l'?' style="font-weight:bold;color:#f90"':'')+'">Leaf</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'b\')"'+(ty=='b'?' style="font-weight:bold;color:#f90"':'')+'">Red Crab</a> | ';
				t+='<a href="javascript:;" onclick="_.room.open(\'c\')"'+(ty=='c'?' style="font-weight:bold;color:#f90"':'')+'">Cloud</a>';
				t+='</div><ul class="bz_room_pemo" style="width:'+(w-100)+'px; height:'+(h-220)+'px; overflow:auto;">';
				for(var i=1;i<=c;i++)
				{
					t+='<li><a href="#['+ty+i+']" onClick="_.room.emoticon(\''+ty+i+'\');return false;"><img src="http://s0.boxza.com/static/chat/emoticon/'+ty+'/'+i+'.gif" class="bz_room_click_emo '+ty+'"></a></li>'
				}
				t+='<p style="clear:both;"></p></ul><div style="padding:5px; text-align:center;"><input type="button" value="ปิดหน้าต่างนี้" class="button" onclick="_.room.cpop()"></div>';
				$('.bz_room_popup_wl').html(t);
			}
		},
		whisper:function(a)
		{
			var s=false;
			$('.bz_room_pv option').each(function(){if($(this).attr('value')==a){s=true;}});
			if(!s)
			{
				$('.bz_room_pv').append('<option value="'+a+'">ส่งถึง.. '+_.room.cvcolor(_.room.u[a].name,0)+'</option>')
			}
			_.room.cpop();
			_.room.createbox(a);
			$('#bz_box_'+a+'_input').focus();
		},
		cpop:function(){$('.bz_room_popup').css('display','none');},
		sroom:function(t)
		{
			$('.bz_choose_room li').removeClass('on');
			$('.bz_choose_room_'+t).addClass('on');
			$('.bz_room_ch_l_main,.bz_room_nl_lll,.bz_room_nl_llll,.bz_room_nl_lllll').html('');
			_.room.u=new Object;
			_.room.first=false;
			_.room.room=t;
			_.room.lastid=0;
			_.room.ide=0;
			_.room.share2fb();
			$('#bz_room_nl_ol,#bz_room_nl_ol1,#bz_room_nl_ol2,#bz_room_nl_ol3').html('0');
			_.room.api('list',{'last':_.room.lastid},true);
		},
		convert:function(t)
		{
			_.room.cin=0;
			_.room.cinl='';
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
										['(\\&lt;\\(&quot;\\)|\\&lt;\\("\\))',-17,-204],
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
						//var h,w=Math.min($('.bz_room_ch_l.on').width()-11,700);
						//h=(w/16)*9;
						t2+='<div style="padding:5px"><a href="http://www.youtube.com/watch?v='+m[8]+'" target="_blank"><img src="http://img.youtube.com/vi/'+m[8]+'/1.jpg"></a></div>';
						//t2+=' <div style="padding:5px;"><iframe src="http://www.youtube.com/embed/'+m[7]+'?autoplay=0&autohide=1&border=0&wmode=transparent&hl=th&cc_lang_pref=th" width="'+w+'" height="'+h+'" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0"></iframe></div>';
					}
					return t2
				}).replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
					_.room.cin++;
					if(_.room.cinl==i1+i2)
					{
						return '';
					}
					_.room.cinl=i1+i2;
					return (_.room.cin>2)?'':t2.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz_room_click_emo $1" onClick="_.room.emoticon(\'$1$2\');">');
				}).replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
					_.room.cin++;
					if(_.room.cinl==i1+i2)
					{
						return '';
					}
					_.room.cinl=i1+i2;
					return (_.room.cin>2)?'':t2.replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz_room_click_emo $1" onClick="_.room.emoticon(\'$1$2\');">');
				});
		},
		api:function(a)
		{
			if(_.room.banned||$('#bz_room').length==0)
			{
				return;
			}
			var dt=(arguments.length>1?arguments[1]:[]);dt.ntf=_.room.ds;	
			if(_.room.loaded)
			{
				_.room.ide++;
				clearTimeout(_.room.tmr);
				_.room.tmr=setTimeout(function(){_.room.delay()},20000);
			}
			$.ajax({url:'http://api.boxza.com/global/chat/'+_.room.room+'/'+a,type:'GET',crossDomain:true,data:dt,dataType:'jsonp',jsonpCallback:'_'+new Date().getTime(),success:function(d){
				for(var i=0;i<d.length;i++)
				{
					switch(d[i].method)
					{
						case 'chatbox': _.room.parse(d[i].data,d[i].type);break;
					}
				}
				if(_.room.loaded)
				{
					clearTimeout(_.room.tmr);
					_.room.tmr=setTimeout(function(){_.room.delay()},Math.max(2,Math.min(10,1+parseInt(_.room.ide/10)))*1000);
				}
			},
			error:function (xhr, ajaxOptions, thrownError)
			{	
				if(_.room.loaded)
				{
					clearTimeout(_.room.tmr);
					_.room.tmr=setTimeout(function(){_.room.delay()},20000);
				}
			 } 
			});
		},
		color:function(a)
		{
			var o=$('.bz_room_mb').attr('color');
			$('.bz_room_mb').attr('color',a);
			if(arguments.length==1)$('.bz_room_mb').focus();
			$('.bz_room_col .sel').removeClass('sel');
			$('.bz_room_col li ul li a.f'+a).addClass('sel');
			$('.bz_room_col_sel').removeClass('f'+o).addClass('f'+a);
		},
		clear:function(){$('.bz_room_ch_l.on').html('');},
		delay:function()
		{	
			_.room.index++;
			if(_.room.index>5)
			{
				_.room.index=0;
				_.room.api('list',{'last':_.room.lastid});
			}
			else
			{
				_.room.api('idle',{'last':_.room.lastid});
			}
		},
		scroll:function(){(_.room._scroll=!_.room._scroll)?$('.bz_room_scroll').removeClass('off'):$('.bz_room_scroll').addClass('off');},
		esound:function(){(_.room._sound=!_.room._sound)?$('.bz_room_sound').removeClass('off'):$('.bz_room_sound').addClass('off');},
		oneline:function(){
			if($('.bz_room_ch_l_main').hasClass('one'))
			{
				$('.bz_room_oneline').addClass('off');
				$('.bz_room_ch_l_main').removeClass('one');
			}
			else
			{
				$('.bz_room_oneline').removeClass('off');
				$('.bz_room_ch_l_main').addClass('one');
			}
			_.room.upscroll(1);
		},
		upscroll:function(){
			if(_.room._scroll)
			{
				if(arguments.length)
				{
					$('.bz_room_ch').scrollTop(Math.max($('.bz_room_ch_l.on').height(),$('.bz_room_ch').height())+100);
				}
				else
				{
					$('.bz_room_ch').animate({ scrollTop: Math.max($('.bz_room_ch_l.on').height(),$('.bz_room_ch').height())+100});
				}
			}
		},
		login:function(){
			window.open('http://oauth.boxza.com/login/?redirect_uri=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.room.room,'_blank');
		},
		signup:function(){
			window.open('http://oauth.boxza.com/signup/?redirect_uri=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.room.room,'_blank');
		},
		assign:function(t){_.room._cbg++;_.room._cbg=_.room._cbg%2;$('.bz_room_ch_l_main').append(t);if(arguments.length==1)_.room.upscroll();},
		parse:function(a,b)
		{
			var c;
			switch(b)
			{
				case 'notice':
					_.room.assign('<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">'+a+'</div><span></span></div>');
					break;
				case 'banned':
					_.room.banned=true;
					_.room.assign('<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณถูกแบนจากระบบ</div><span></span></div>');
					break;
				case 'rank':
							var t='';
							t += 'คุณมีคะแนนออนไลน์ '+a.val+' คะแนน<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/1.gif"> = 0-'+(1*60)+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/2.gif"> = '+((1*60)+1)+'-'+((5*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/3.gif"> = '+((5*60)+1)+'-'+((25*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/4.gif"> = '+((25*60)+1)+'-'+((75*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/5.gif"> = '+((75*60)+1)+'-'+((150*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/6.gif"> = '+((150*60)+1)+'-'+((300*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/7.gif"> = '+((300*60)+1)+'-'+((500*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/8.gif"> = '+((500*60)+1)+'-'+((900*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/9.gif"> = '+((900*60)+1)+'-'+((1500*60))+'<br>';
							t += '<img src="http://s0.boxza.com/static/chat/rank/10.gif"> = '+((1500*60)+1)+'-'+((2500*60))+'<br>'
							t += '<img src="http://s0.boxza.com/static/chat/rank/11.gif"> = '+((2500*60)+1)+'-'+((4000*60))+'<br>'
							t += '<img src="http://s0.boxza.com/static/chat/rank/12.gif"> = '+((4000*60)+1)+'-'+((7000*60))+'<br>'
							t += '<img src="http://s0.boxza.com/static/chat/rank/13.gif"> = '+((7000*60)+1)+'-'+((70000*60))+'<br>'
							t += '<img src="http://s0.boxza.com/static/chat/rank/14.gif"> = '+((70000*60)+1)+'+<br> ';
		
							_.room.assign('<p id="bz_room_text_first" class="l'+_.room._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;"><strong style="color:#0099D2">คะแนนออนไลน์</strong><br>'+t+'</p>');
					break;
				case 'first':
							_.room.assign('<p id="bz_room_text_first" class="l'+_.room._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;">ยินดีต้อนรับสู่ <strong style="color:#0099D2">ห้อง'+a.name+'</strong><br>'+
							'- '+(_.room.my.member?'คุณมีคะแนนสะสมประจำห้องนี้คือ '+a.rank+' คะแนน':'กรุณาล็อคอินเข้าระบบ เพื่อเก็บคะแนนสะสมประจำห้องแชทนี้')+'<br>'+
							'- ชื่อในการสนทนาของ<strong>คุณ</strong>คือ <a href="javascript:;" onclick="_.room.popup(\''+_.room.my._id+'\');"><strong>'+_.room.cvcolor(_.room.my.name,_.room.my.member)+'</strong></a> (คลิกที่ชื่อเพื่อเปลี่ยน)<br>'+
							'- หากต้องการเปลี่ยนชื่อแบบถาวร หรือเปลี่ยนรูป กรุณา<a href="javascript:;" onclick="_.room.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.room.signup()">สมัครสมาชิก</a> (<a href="http://boxza.com/me" target="_blank">เปลี่ยนรูปโปรไฟล์</a>, <a href="http://boxza.com/settings" target="_blank">เปลี่ยนชื่อหรือข้อมูลอื่นๆ</a>)<br>'+
							//'- คุยกับเพื่อนแบบส่วนตัว ให้คลิกที่ชื่อของเพื่อน แล้วเลือก "กระซิบ"<br>'+
							//'- พิมพ์ /help ที่หน้าห้อง เพื่อดูคำสั่งการใช้งานเบื้องต้น<br>'+
							'- สร้างห้องแชทฟรี เป็นเจ้าของห้องแชทแบบง่ายๆ พร้อมลูกเล่นการใช้งานมากๆ พร้อมทั้งยังนำไปติดเว็บของคุณได้ด้วย..  ที่ <a href="http://boxza.com/chat" target="_blank">http://boxza.com/chat</a> (เร็วๆนี้)</p>');
							if(!_.room.lastid)
							{
								_.room.lastid=1;
							}
							if(_.room.my.admin)
							{
								var s=false;
								$('.bz_room_pv option').each(function(){if($(this).attr('value')=='admin'){s=true;}});
								if(!s)
								{
									$('.bz_room_pv').append('<option value="admin">ส่งถึงเฉพาะแอดมิน</option>')
								}
							}
							_.room.first=true;
					break;
				case 'my':
					_.room.u[a._id]=_.room.my={'_id':a._id,'name':a.n,'img':a.i,'link':a.l,'member':a.mb,'dname':a.d,'admin':a.am,'ip':a.ip,'rank':(a.rk?a.rk:'')};
					if(a.mb)
					{
						_.room._autodc=false;
					}
					$('.bz_room_nl_ll').html('<div id="bz_room_user_my" class="l"><a href="javascript:;" onclick="_.room.popup(\''+_.room.my._id+'\',1);"><img src="'+_.room.my.img+'">'+(_.room.my.rank||_.room.my.member?' <img src="http://s0.boxza.com/static/chat/rank/'+(_.room.my.rank||_.room.my.member)+'.gif"> ':'')+'</a><p><a href="javascript:;" onclick="_.room.popup(\''+_.room.my._id+'\',1);" class="bz_room_user bz_room_level_'+(_.room.my.admin&&_.room.my.member?_.room.my.admin:'0')+'">'+_.room.cvcolor(_.room.my.name,_.room.my.member)+'</a></p><span></span></div>');
					if(_.room.my.member)
					{
						if(_.room.my.admin)
						{
							_.room._emodl=20;
						}
						else
						{
							_.room._emodl=25;
						}
						$('.bz_room_nl_ll').append('<p style="padding:0px 0px 0px 5px;border-bottom:1px solid #f0f0f0;">ประเภท: '+(_.room.my.admin?'ผู้ดูแล':'สมาชิก')+'</p><p style="padding:0px 0px 0px 5px;">คะแนน: '+a.rank+' (<a href="javascript:;" onclick="_.room.api(\'rank\',{last:_.room.lastid});">/rank</a>)</p>');
					}
					else
					{
						_.room._emodl=30;
						$('.bz_room_nl_ll').append('<p style="padding:0px 0px 0px 5px;border-bottom:1px solid #f0f0f0;">ประเภท: บุคคลทั่วไป</p><p style="text-align:center"><a href="javascript:;" onclick="_.room.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.room.signup()">สมัครสมาชิก</a></p><p style="text-align:center">เพื่อรับคะแนนออนไลน์</p>');
					}
					break;
				case 'list':
					if(a)
					{
						var t=''+Math.floor(Math.random()*100000),j,l,p;
						for(j in a)
						{
							c=a[j];
							l=$('#bz_room_user'+c._id).length;
							if(_.room.my._id!=c._id)
							{
								
								_.room.u[c._id]={'_id':c._id,'name':c.n,'img':c.i,'link':c.l,'admin':c.am,'member':c.mb,'default':c.d,'ip':c.ip,'rank':(c.rk?c.rk:'')};
								//_.room._ubg++;
								//_.room._ubg = _.room._ubg % 2;
								p='<a href="javascript:;" onclick="_.room.popup(\''+c._id+'\');"><img src="'+c.i+'">'+(_.room.u[c._id].rank||_.room.u[c._id].member?' <img src="http://s0.boxza.com/static/chat/rank/'+(_.room.u[c._id].rank||_.room.u[c._id].member)+'.gif">':'')+'</a><p><a href="javascript:;" onclick="_.room.popup(\''+c._id+'\');" class="bz_room_user bz_room_level_'+(c.am&&c.mb?c.am:'0')+'">'+_.room.cvcolor(c.n,c.mb)+'</a></p><span></span>';
								if(!l)
								{
									if(c.am&&c.mb)
									{
										$('.bz_room_nl_lll').append('<div id="bz_room_user'+c._id+'" class="l'+_.room._ubg+'" lasttime="'+t+'">'+p+'</div>');
									}
									else if(c.mb)
									{
										$('.bz_room_nl_llll').append('<div id="bz_room_user'+c._id+'" class="l'+_.room._ubg+'" lasttime="'+t+'">'+p+'</div>');
									}
									else
									{
										$('.bz_room_nl_lllll').append('<div id="bz_room_user'+c._id+'" class="l'+_.room._ubg+'" lasttime="'+t+'">'+p+'</div>');
									}
								}
								else
								{
									$('#bz_room_user'+c._id).attr('lasttime',t).html(p);
								}
							}
						}
						$('.bz_room_nl_lll > div, .bz_room_nl_llll > div, .bz_room_nl_lllll > div').each(function() {
							if($(this).attr('lasttime')!=t)
							{
								$(this).remove();
							}
						});
						var _co1=$('.bz_room_nl_lll > div').length,_co2=$('.bz_room_nl_llll > div').length,_co3=$('.bz_room_nl_lllll > div').length;
						$('#bz_room_nl_ol').html(_co1+_co2+_co3);
						$('#bz_room_nl_ol1').html(_co1);
						$('#bz_room_nl_ol2').html(_co2);
						$('#bz_room_nl_ol3').html(_co3);
						_.room.resize();
						if(!_.room.loaded)
						{
							_.room.tmr=setTimeout(function(){_.room.delay()},2000);
							_.room.loaded=true;
						}
					}
					break;
				case 'chat':		
					//document.title=$(_.room.lastfocus).hasClass('bz_box_input')
					if(a)
					{
						var snd=0,p,tx;
						for(var j=0;j<a.length;j++)
						{
							c=a[j];
							_.room.lastid=c._id;
							if(!$('#bz_room_text'+c._sn).length)
							{
								if(!_.room.u[c.u])
								{
									_.room.u[c.u]={'_id':c.u,'name':c.n,'img':c.i,'link':c.l,'admin':c.am,'member':c.mb,'default':c.d,'ip':c.ip};
								}
								
								if(c.ty)
								{
									if(c.ty=='admin' && c.par && _.room.u[c.par.uid])
									{
										if(c.par.admin==-1)
										{
											_.room.u[c.par.uid].admin=0;
										}
										else
										{
											_.room.u[c.par.uid].admin=c.par.admin;
										}
									}
									else if(c.ty=='kick' && c.par && _.room.first)
									{
										if(c.par.uid==_.room.my._id)
										{
											if(c.par.room)
											{
												_.room.sroom(c.par.room);
											}
											else
											{
												_.room.banned=true;
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
										//ส่งข้อความถึง
										p=' ส่งถึง '+(c.p==_.room.my._id?'[คุณ] ':'')+'<a href="javascript:;" onclick="_.room.popup(\''+c.p+'\');" class="bz_room_user bz_room_level_'+(_.room.u[c.p]&&_.room.u[c.p].admin?_.room.u[c.p].admin:'0')+'">'+_.room.cvcolor(c.pn,(_.room.u[c.p]&&_.room.u[c.p].member?_.room.u[c.p].member:0))+'</a>';
									
										
									}
								}
								else
								{
									p='';	
								}
								var pid=(c.u==_.room.my._id?c.p:c.u),fl=true;
								if(c.p && (_.room.u[pid]||c.p=='admin') && (c.u==_.room.my._id||c.p==_.room.my._id||c.p=='admin'))
								{
									if(c.p=='admin')
									{
										pid='admin';
									}
									tx='<div id="bz_room_text'+c._sn+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.room.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p><span onclick="_.room.cpname(\''+c.u+'\');">['+c.t+']</span> <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.room.popup(\''+c.u+'\');" class="bz_room_user bz_room_level_'+c.am+'">'+_.room.cvcolor(c.n,c.mb)+'</a> :</p><div class="f'+c.c+'">'+_.room.cvcolor(_.room.convert(c.m),1,1)+'</div><span></span></div>';
									_.room.createbox(pid);
									$('#bz_box_'+pid+'_div_l').append(tx);
									$('#bz_box_'+pid+'_div').scrollTop(Math.max($('#bz_box_'+pid+'_div_l').height(),$('#bz_box_'+pid+'_div').height())+100);
									fl=false;
								}
								if(c.p && fl && (c.u!=_.room.my._id && c.p!=_.room.my._id))
								{
									if(!$('#bz_box_spy').length)
									{
										_.room._zindex++;	
										var y='<div class="bz_box" id="bz_box_spy" style="z-index:'+_.room._zindex+';left:100px;top:50px; width:550px; height:300px;" zindex="'+_.room._zindex+'"><h4><span class="close">X</span> SPY</h4><div id="bz_box_spy_div" class="bz_box_div" style="height:278px;"><div class="bz_room_ch_l" id="bz_box_spy_div_l"></div></div></div>';
										$('.bz_room').append(y);
										$('#bz_box_spy .close').click(function(){$('#bz_box_spy').css('display','none');});
										$('#bz_box_spy').draggable({handle:'h4',containment: 'parent', scroll: false}).resizable({/*helper:'ui-resizable-helper',*/start:_.room.boxresize1,stop:_.room.boxresize2}).click(function(){
											if(Math.floor($(this).attr('zindex'))!=_.room._zindex)
											{
												_.room._zindex++;
												$(this).attr('zindex',_.room._zindex).css({'z-index':_.room._zindex});
											}
										});
									}
									
									tx='<div id="bz_room_text'+c._sn+'" class="l'+_.room._cbg+(c.p?' p':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.room.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.room.cpname(\''+c.u+'\');">['+c.t+']</span> <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+'<a href="javascript:;" onclick="_.room.popup(\''+c.u+'\');" class="bz_room_user bz_room_level_'+c.am+'">'+_.room.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.room.cvcolor(_.room.convert(c.m),1,1)+'</div><span></span></div>';
									
									$('#bz_box_spy_div_l').append(tx);
									$('#bz_box_spy_div').scrollTop(Math.max($('#bz_box_spy_div_l').height(),$('#bz_box_spy_div').height())+100);
								}
								else if(fl)
								{
									tx='<div id="bz_room_text'+c._sn+'" class="l'+_.room._cbg+(c.p?' p':'')+'" ip="'+c.ip+'" admin="'+(c.my?c.my:'0')+'"><a href="javascript:;" onclick="_.room.popup(\''+c.u+'\');"><img src="'+c.i+'"></a><p'+(c.p?' class="p'+(c.p=='admin'?'a':'')+'"':'')+'><span onclick="_.room.cpname(\''+c.u+'\');">['+c.t+']</span> <i'+(c.mb?' class="m m'+c.am+'"':'')+'></i>'+(c.rk?'<img src="http://s0.boxza.com/static/chat/rank/'+c.rk+'.gif"> ':'')+(c.u==_.room.my._id?'[คุณ] ':'')+'<a href="javascript:;" onclick="_.room.popup(\''+c.u+'\');" class="bz_room_user bz_room_level_'+c.am+'">'+_.room.cvcolor(c.n,c.mb)+'</a>'+p+' :</p><div class="f'+c.c+'">'+_.room.cvcolor(_.room.convert(c.m),1,1)+'</div><span></span></div>';
									_.room.assign(tx,false);
								}
								if(_.room.first)
								{
									_.room.msl++;
								}
							}
						}
						if(snd)
						{
							_.room.sound(snd);
						}
						if(_.room.msl>=5)
						{
							_.room.msl=0;
							if(!_.room.my.member)
							{
								_.room.assign('<p id="bz_room_text_first" class="l'+_.room._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;">'+
								'- คุณยังไม่ได้ล็อคอิน กรุณาล็อคอินเพื่อปิดข้อความแจ้งเตือนนี้<br>'+
								'- คุยแบบเต็มจอ <a href="http://chat.boxza.com/" target="_blank">คลิกที่นี่</a> (พร้อมลูกเล่นอื่นๆอีกมากมายได้ที่ <a href="http://chat.boxza.com/" target="_blank">http://chat.boxza.com</a>)<br>'+
								//'- แยกห้องการสนทนาเป็น  <a href="#r=1" onClick="_.room.sroom(\'1\');">ห้องทั่วไป</a>, <a href="#r=2" onClick="_.room.sroom(\'2\');">ห้องเกย์</a>, <a href="#r=3" onClick="_.room.sroom(\'3\');">ห้องเลสเบี้ยน</a>, <a href="#r=4" onClick="_.room.sroom(\'4\');">ห้องผู้หญิง</a>, <a href="#r=5" onClick="_.room.sroom(\'5\');">ห้องฟุตบอล</a><br>'+
								'- คุณสามารถล็อคอินได้ที่: <a href="javascript:;" onclick="_.room.login()">ล็อคอิน</a> หรือ <a href="javascript:;" onclick="_.room.signup()">สมัครสมาชิก</a>  เพื่อ <a href="http://boxza.com/me" target="_blank">เปลี่ยนรูปโปรไฟล์</a> หรือ <a href="http://boxza.com/settings" target="_blank">เปลี่ยนชื่อหรือข้อมูลอื่นๆ</a><br>'+
								'</p>');
							}
						}
						_.room.upscroll();
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
					return '<span class="bz_room_level_1">ผู้ดูแล</span>';
				}
				else if(a==2)
				{
					return '<span class="bz_room_level_2">ผู้ดูแลสูงสุด</span>';
				}
				else if(a==3)
				{
					return '<span class="bz_room_level_3">เจ้าของห้อง</span>';
				}
				else
				{
					return '<span class="bz_room_level_0">สมาชิก</span>';
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
				_.room._zindex++;	
				var y='<div class="bz_box" id="bz_box_'+pid+'" style="z-index:'+_.room._zindex+';left:'+w+'px;top:'+h+'px;" zindex="'+_.room._zindex+'"><h4><span class="close">X</span> <a href="javascript:;" onclick="_.room.popup(\''+pid+'\');" class="bz_room_user bz_room_level_'+(pid=='admin'?'1':(_.room.u[pid].admin&&_.room.u[pid].member?_.room.u[pid].admin:'0'))+'">'+(pid=='admin'?'ส่งถึงผู้ดูแลทุกคน':_.room.cvcolor(_.room.u[pid].name,_.room.u[pid].member))+'</a></h4><div id="bz_box_'+pid+'_div" class="bz_box_div"><div class="bz_room_ch_l" id="bz_box_'+pid+'_div_l"></div></div><input type="text" class="tbox bz_box_input" id="bz_box_'+pid+'_input" uid="'+pid+'"></div>';
				$('body').append(y);
				$('#bz_box_'+pid+' .bz_box_input').keypress(_.room.keypress).focus(function(e){_.room.lastfocus=$(this);});
				$('#bz_box_'+pid+' .close').click(function(){$('#bz_box_'+pid).remove(); $('.bz_room_mb').focus();});
				$('#bz_box_'+pid).draggable({handle:'h4',containment: 'parent', scroll: false}).resizable({/*helper:'ui-resizable-helper',*/start:_.room.boxresize1,stop:_.room.boxresize2}).click(function(){
					if(Math.floor($(this).attr('zindex'))!=_.room._zindex)
					{
						_.room._zindex++;
						$(this).attr('zindex',_.room._zindex).css({'z-index':_.room._zindex});
					}
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
			//$(ui.element).find('.bz_box_div').css({'display':'none'});
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
			//$(ui.element).find('.bz_box_div').css({'height':h-55,'display':'block'});
		},
		share2fb:function()
		{
			/*
			$('.bz_room_share').html('<a name="fb_share" type="button_count" share_url="http://chat.boxza.com/room/'+_.room.room+'" href="http://www.facebook.com/sharer.php"></a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>');
			*/
			//$('.bz_room_share').html('<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fchat.boxza.com%2Froom%2F'+_.room.room+'&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;colorscheme=dark&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>');
		},
		sound:function(s){if(_.room._sound && typeof($('#bz_room_swf').get(0).sdcplay)=='function'){$('#bz_room_swf').get(0).sdcplay(s);}},
		shuffle:function(o)
		{
			for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
			return o;
		},
		clearflood:function()
		{
			clearTimeout(_.room.tmf);
			_.room._flood=0;
			if(_.room._autodc)
			{
				_.room._remaindc++;
				if(_.room._remaindc>=6)
				{
					clearTimeout(_.room.tmr);
					if(_.room._remaindc==6)
					{
							_.room.assign('<p id="bz_room_text_first" class="l'+_.room._cbg+'" style="padding: 5px 10px;border: 1px solid #CCC;margin: 5px;">'+
							'- ระบบทำการตัดการติดต่ออัตโนมัติ เนื่องจากคุณไม่ได้ทำการสนทนา (กรุณาล็อคอินเพื่อยกเลิกการตัดแบบอัตโนมัติ)<br>'+
							'</p>');
					}
				}
			}
			if(_.room._remainsv>18)
			{
				//$('.bz_room_other2').prop('src','http://s1.boxza.com/chat/_html/service.html?r'+Math.floor(Math.random()*99999));
				_.room._remainsv=-1;
			}
			_.room._remainsv++;
			
			_.room.tmf=setTimeout(function(){_.room.clearflood()},10000);
		},
		clearemo:function()
		{
			clearTimeout(_.room.tme);
			_.room.tme=setTimeout(function()
			{
				if(_.room._rmemo>0)
				{
					_.room._rmemo--;
					if(_.room._rmemo==0)
					{
						_.room._flemo=false;
					}
				}
				_.room.clearemo();
			},1000);
			if(_.room._rmemo>0)
			{
				$('.bz_room_emo > strong').addClass('show').html('กรุณารออีก '+_.room._rmemo+' วินาที เพื่อใช้งานอีโมอีกครั้ง');
				$('.bz_room_emo > a,.bz_room_emo > span').addClass('hide');
			}
			else
			{
				$('.bz_room_emo > strong').removeClass('show');
				$('.bz_room_emo > .hide').removeClass('hide');
			}
		},
		cvcolor:function(t,a)
		{
			if(t)
			{
				if(!a || a=='0')
				{
					var b=t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig,function(t2){
							return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig, '');
					});
				}
				else
				{
					_.room.cc=new Object;
					_.room.cci=(arguments.length>2?-16:0);
					var b='<span>'+(t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig,function(t2,i1){
						if(!_.room.cc[i1])
						{
							if(_.room.cci<3)
							{
								_.room.cci++;
								_.room.cc[i1]=1;
							}
							else
							{
								return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig, '</span><span>');
							}
						}
						return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig, '</span><span class="f$1 b$3">');
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
					var b=t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig,function(t2){
							return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig, '');
					});
				}
				else
				{
					_.room.cc=new Object;
					_.room.cci=(arguments.length>2?-16:0);
					var b=(t.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig,function(t2,i1){
						if(!_.room.cc[i1])
						{
							if(_.room.cci<3)
							{
								_.room.cci++;
								_.room.cc[i1]=1;
							}
							else
							{
								return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig, '');
							}
						}
						return t2.replace(/\^C([0-9]{1,2})(\,([0-9]{1,2}))?/ig, '^C$1$2');
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
			//_.room.color(_.room.shuffle([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])[0],1);
			_.room.color(1,1);
			_.room.clearflood();
			var r,a=_.room.query('radio');
			if(a=='0'||a=='false'){$('.bz_room_radio').html('');}
			//_.room.room=_.room.shuffle([1,1,1,2,3,4])[0];
			if(r=_.room.query('r')){_.room.room=r;}
			if(r=_.room.query('r',1)){_.room.room=r;}
			r='[<a href="javascript:;" onClick="_.room.open(\'\');">อีโมชั่นอื่นๆ</a>]';
			r+=' [<a href="javascript:;" onClick="window.open(\'http://chat.boxza.com/room/\'+_.room.room,\'_blank\');">คุยแบบเต็มจอ</a>]';
			$('.bz_room_moreclick').html(r);
			$('.bz_room_col div').click(function(e){$('.bz_room_col ul').css({'display':'block'});});
			$('.bz_room_col > li').hover(function(){$(this).find('ul').css('display','block');},function(){$(this).find('ul').css('display','none');});
			$('.bz_room_mb').keypress(_.room.keypress).focus(function(e){_.room.lastfocus=$(this);});
			_.room.sroom(_.room.room);
			_.room.resize()
			$(window).resize(_.room.resize);
			$(window).load(_.room.resize);
			$('.bz_room_ch').scroll(function(e) {
				var v=$('.bz_room_ch').scrollTop(),h2=$('.bz_room_ch').height(),h1=$('.bz_room_ch_l.on').height(),h=h1-h2;
				if((h-v>150) && _.room._scroll)
				{
					_.room.scroll();
				}
				else if((h-v <50)&&!_.room._scroll)
				{
					_.room.scroll();
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
				if(_femo)
				{
					_.room._rmemo=_.room._emodl;
					_.room.clearemo();
					if(_.room._flemo)
					{
						_.room.assign('<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คุณใช้ Emoticon มากเกินไป กรุณารออีก '+_.room._rmemo+' วินาที เพื่อใช้งานอีกครั้ง...</div><span></span></div>');
						return false;
					}
					_.room._flemo=true;
				}
				$(this).val('');
				if(ms.substr(0,1)=='/')
				{
					var cmd=(ms.substr(1).split(' '))[0],ms2=ms.substr(cmd.length+2);
					if(cmd=='color')
					{
						var _t='<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">การใช้งานรหัสสี พิม <strong>^C[รหัสสี 1-16]ข้อความ</strong> เช่น... <br>';
						for( var i=1;i<=16;i++)
						{
							_t+=' &nbsp; &nbsp; &nbsp; ^C'+i+'ข้อความ  &nbsp; &nbsp; &nbsp; -จะได้ผลคือ- &nbsp; &nbsp; &nbsp; <span class="f'+i+'">ข้อความ</span><br>';
						}
						_t+='  &nbsp;   &nbsp; <span class="f4">*** กรุณาอย่าใช้สีสรรแสบตาจนเกินไป ***</span></div><span></span></div>';
						_.room.assign(_t);
					}
					else if(cmd=='help')
					{
						var _t='<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">คำสั่งเบื้องต้นสำหรับการใช้งาน /command<br>';
						_t+=' &nbsp; <strong>คำสั่งทั่วไป</strong><br>';
						_t+=' &nbsp; &nbsp; - <strong>ดูอันดับคะแนน</strong>: /rank<br>';
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
						_.room.assign(_t);
					}
					else if(cmd=='msg'||cmd=='private')
					{
						_.room.api(cmd,{'last':_.room.lastid,'cmd':$('.bz_room_mb').attr('color')+' '+ms2});
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
						ms2=_.room.rmcolor(ms2,_.room.my.member);
						_.room.api(cmd,{'last':_.room.lastid,'cmd':ms2});
					}
					else if(cmd)
					{
						_.room.api(cmd,{'last':_.room.lastid,'cmd':ms2});
					}
				}
				else
				{
					_.room._repeat=(_.room._ms==ms?_.room._repeat+1:1);
					_.room._flood++;
					_.room._ms=ms;
					_.room._autodc=false;
					
					if(_.room._flood>3)
					{
						_.room.assign('<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">กรุณาพิมพ์ช้าๆ อย่าฟลัดข้อความ</div><span></span></div>');
					}
					else if(_.room._repeat>2)
					{
						_.room.assign('<div id="bz_room_text_login" class="l'+_.room._cbg+'"><a href="http://boxza.com/" target="_blank"><img src="http://s1.boxza.com/profile/00/00/00/s.jpg"></a><p><span></span> <i></i><a href="http://boxza.com/" target="_blank">ระบบ</a>:</p><div class="f1">กรุณาอย่าพิมข้อความซ้ำกันเกิน 2ครั้ง</div><span></span></div>');
					}
					else if($(this).attr('uid'))
					{
						_.room.ide=0;
						_.room.api('private',{'last':_.room.lastid,'cmd':$('.bz_room_mb').attr('color')+' '+$(this).attr('uid')+' '+ms});
					}
					else if($('.bz_room_pv').val()&&$('.bz_room_pv').val()!='0')
					{
						_.room.ide=0;
						_.room.api('private',{'last':_.room.lastid,'cmd':$('.bz_room_mb').attr('color')+' '+$('.bz_room_pv').val()+' '+ms});
					}
					else
					{
						_.room.ide=0;
						_.room.api('msg',{'last':_.room.lastid,'cmd':$('.bz_room_mb').attr('color')+' '+ms});
					}
				}
			}
		},
		resize:function()
		{
			var w=$('.bz_room').width(),h=$(window).height(),l,_h=150;
			
			
			var ha=(h-_h);
			$('.bz_room_rl').height(ha);
			$('.bz_room_ch').height(h-_h); // 120 | 145
				$('.bz_room_nl').css({'height':ha});
				$('.bz_room_ch').css({'width':w-$('.bz_room_nl').width()-5,'left':0});
			l=w-210;
			$('.bz_room_emo').width(l);
			if(l<500)
			{
				$('.bz_room_emo .h').css('display','none');
			}
			else
			{
				$('.bz_room_emo .h').css('display','inline-block');
			}
			$('.bz_room_mb').width(w-$('.bz_room_pv').width()-20);
			$('.bz_room_popup').css({'width':$(window).width(),'height':h})
		}
	}
});