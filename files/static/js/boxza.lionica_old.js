_.lionica={
	cur:[0,0],
	face:'d',
	tostep:[0,0],
	fromstep:[0,0],
	step:0,
	mstep:4,
	eai:false,
	sindex:1,
	lastchat:0,
	online:true,
	attack:0,
	full:false,
	hwidth:485,
	hheight:300,
	dindex:0,
	khash:'',
	obj:[],
	go:function(x,y)
	{
		if(_.lionica.attacking.state>0)
		{
			_.lionica.logs([{'type':'','text':'<p class="logs-warning">ไม่สามารถเคลื่อนที่ในขณะต่อสู้ได้</p>'}]);
			return;
		}
		if(_.lionica.shop.vender>0)
		{
			_.lionica.logs([{'type':'','text':'<p class="logs-warning">ไม่สามารถเคลื่อนที่ในขณะตั้งร้านได้</p>'}]);
			return;
		}
		clearTimeout(_.lionica.tmrmove);
		if(!_.lionica.loaded)
		{
			return;	
		}
		if(y>=0&&y<=_.lionica.map.loc[0].length-1&&x>=0&&x<=_.lionica.map.loc.length-1)
		{
			var b=_.lionica.map.loc[x][y];
			if((!b)||(b.substr(0,1)!='b'))
			{
				if(_.lionica.pet.hp>0)
				{
					var v=_.lionica.routing(_.lionica.map.loc,_.lionica.cur,[x,y]);
					_.lionica.rindex=0;
					_.lionica.path=v;
					_.lionica.walk();
				}
				else
				{
					_.box.alert('ไม่สามารถเคลื่อนที่ได้ในขณะนี้')	
				}
			}
		}
	},
	menu:
	{
		npc:[],
		open:function(e)
		{
			e.preventDefault();
			$('#lionica_menu').remove();
			var m=$('<div id="lionica_menu"></div>').appendTo($('#lionica'));
			var x = (e.pageX - $('#lionica').position().left),y = (e.pageY - $('#lionica').position().top);	
			m.css({'left':x,'top':y});
			var tmp='<ul>'+
			'<li><a href="javascript:;" onclick="_.lionica.ai()">'+(_.lionica.eai?'ปิด':'เปิด')+'ระบบช่วยเล่น</a></li>';
			if(_.lionica.menu.npc.length>0)
			{
				tmp+='<li class="lmn-npc"><a href="javascript:;">NPC</a><ul>';
				for(var i in _.lionica.menu.npc)
				{
					var n=_.lionica.menu.npc[i];
					tmp+='<li><a href="javascript:;" onclick="_.lionica.go('+n[1]+','+n[2]+')">'+n[0]+'</a></li>';
				}
				tmp+='</ul></li>';
			}
			tmp+='<li class="lmn-win"><a href="ajavascript:;">หน้าต่าง</a><ul>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'char\',\'toggle\');">ข้อมูลสัตว์เลี้ยง</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'guild\',\'toggle\');">กิลด์</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'inventory\',\'toggle\');">กระเป๋า</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'chat\',\'toggle\');">สนทนา</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'logs\',\'toggle\');">เหตุการณ์</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'minimap\',\'toggle\');">แผนที่</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'skill\',\'toggle\');">สกิล</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'ai\',\'toggle\');">ตั้งร้าน</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.box(\'ai\',\'toggle\');">ระบบช่วยเล่น</a></li>'+
			'</ul></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.sound.open()">เปิด/ปิดเสียง</a></li>'+
			'<li><a href="javascript:;" onClick="_.lionica.fullscreen()">เต็มจอ</a></li>'+
			'</ul>';
			m.html(tmp);
			_.lionica.menu.opened=true;
		},
		close:function(e)
		{
			if(e.which==1 && _.lionica.menu.opened)
			{
				$('#lionica_menu').remove();
				_.lionica.menu.opened=false;
			}
		}
	},
	clear:{
		tmr:'',index:0,last:0,
		load:function()
		{
			clearInterval(_.lionica.clear.tmr)	;
			_.lionica.clear.tmr=setInterval(function(){
				_.lionica.clear.index++;	
				if(_.lionica.clear.index%10==0)
				{
					var d=new Date();
					if(d.getTime()-_.lionica.clear.last<9000)
					{
						_.lionica.box('logs','block');
						clearTimeout(_.lionica.tmrai);
						_.lionica.khash="";
						_.lionica.eai=false;
						_.lionica.loaded=false;
						$('#logs_text').append('<p style="color:#f00;background:#121212">ความเร็วของบราวเซอร์ไม่ถูกต้อง.. กรุณารีเฟรสหน้าเว็บใหม่อีกครั้ง</p>');
						$('.logs_div').scrollTop(Math.max($('.logs_div').height(),$('#logs_text').height())+100);
					}
					_.lionica.clear.last=d.getTime();
					_.lionica.clear.index=0;
					var s=$('#logs_text > p').length;
					if(s>100)
					{
						$('#logs_text').children().slice(0, s-50).remove();
					}
					var s=$('#chat_text > p').length;
					if(s>100)
					{
						$('#chat_text').children().slice(0, s-50).remove();
					}
				}
			},1000);
		}
	},
	effect:
	{
		resource:{pet1:{},pet2:{},pet3:{},pet4:{},pet5:{},heal:{ho:-40},hp:{},mp:{},success:{hs:6},fail:{},dead:{hs:6},evolution:{hs:5}},
		show:function(type,x,y)
		{
			if(typeof(_.lionica.effect.resource[type])!='undefined')
			{
				var e=_.lionica.effect.resource[type],d,w=e.w||192,h=e.h||192,ws=e.ws||5,hs=e.hs||4,wo=e.wo||0,ho=e.ho||0,ind=0,tmr;
				function delay()
				{
					if(ind>=ws*hs)
					{
						clearInterval(tmr);
						d.remove();	
					}
					else
					{
						d.css({'background-position':((ind%ws)*w*-1)+'px '+(Math.floor(ind/ws)*h*-1)+'px'});	
					}
					ind++;
				}
				d=$('<div></div>').css({'position':'absolute','z-index':80,'width':w,'height':h,'left':((x*32)-((w-32)/2))+wo,'top':((y*32)-((h-32)/2))+ho,'background':'url(http://s0.boxza.com/static/images/game/lionica/effect/'+type+'.png) 0px 0px no-repeat'})
					.prependTo($('.map'));
				tmr=setInterval(function(){delay()},100);
			}
		}
	},
	shop:
	{
		vender:0,
		buy:function(a,b,c,d,e)
		{
			var n=$(a).find('span').text();
			if(c>1)
			{
				c=Math.floor(prompt('ชื่อ '+n+' ในราคา '+d+' Silver'+"\nใส่จำนวนที่ต้องการซื้อ",'1'));
			};
			if(c>0)
			{
				if(confirm('คุณต้องการซื้อ '+n+' '+c+' ชิ้น ในราคา '+(c*d)+' Silver หรือไม่'))
				{
					_.lionica.api('vender',{'type':'buy','item':b,'count':c,'shop':e});
				}
			}
		},
		open:function(e)
		{
			if($(this).find('.player-shop').length)
			{
				var s=$(this).find('.player-shop').data('shop');
				_.lionica.box('shop','block');
				$('.shop .name .text').html('ร้านค้า');
				$('.shop_text').html('<p style="padding:10px;text-align:center">กรุณารอซักครู่</p>');
				_.lionica.api('vender',{'type':'shop','shop':s});
			}
		},
		insert:function(e,i,c,p1)
		{
			if(c>1)
			{
				var c1=Math.floor(prompt('ต้องการขาย '+$(e).find('span').html()+' จำนวนกี่ชิ้น',c));	
				if(c1&&c1>0)
				{
					if(c1>c)
					{
						_.box.alert('กรอกจำนวนไอเท็มไม่ถูกต้อง');
						c=0;
					}
					else
					{
						c=c1;
					}
				}
				else
				{
					c=0;
				}
			}
			if(c&&c>0)
			{
				var p=Math.floor(prompt('ต้องการขาย '+$(e).find('span').html()+' ในราคาชิ้นละเท่าไหร่ (Silver).',p1));
				if(p&&p>0)
				{
					_.lionica.api('vender',{'type':'insert','item':i,'count':c,'price':p});
				}
			}
		},
		cancel:function()
		{
			_.lionica.api('vender',{'type':'cancel'});	
		}
	},
	objs:function(o,x,y)
	{	
		var move=['d','l','r','u'],ing=false;
		var obj=$.extend({},_.lionica.mons[o]);
		obj.id=o;
		obj.x=x;
		obj.y=y;
		obj.xy=x+'_'+y;
		obj.cur=[x,y];
		obj.to=[x,y];
		obj.face=move[Math.floor(Math.random()*move.length)];
		obj.html=$('<i class="_plot _plot-m _plot-'+(obj.swing?'s':'m')+'-'+obj.face+(obj.attack?' lionica-popup _plot-obj':'')+'" style="left:'+(x*32)+'px;top:'+((y*32)-16)+'px;z-index:'+(100+y)+';background-image:url(http://s0.boxza.com/static/images/game/lionica/monster/'+o+'.png);" data-popup="'+obj.name+' (Lv.'+obj.lv+')"></i>');
		$('.map').append(obj.html);
						
		var tmr,ind=0,path,mx2,my2,step=6,sind=0,mto;
		
		function start()
		{
			clearTimeout(tmr);
			var v=true;
			if(obj.move&&obj.html.css('display')!='none'&&!obj.html.hasClass('hideobj'))
			{
				if(Math.floor(Math.random()*10)>5)
				{
					var x=Math.max(0,obj.x-obj.move);
					var y=Math.max(0,obj.y-obj.move);
					obj.to[0]=Math.min(x+Math.floor(Math.random()*((2*obj.move))),_.lionica.map.loc[0].length-1);
					obj.to[1]=Math.min(y+Math.floor(Math.random()*((2*obj.move))),_.lionica.map.loc.length-1);
					var b=_.lionica.map.loc[obj.to[0]][obj.to[1]];
					if((!b)||(b.substr(0,1)!='b'))
					{
						v=_.lionica.routing(_.lionica.map.loc,obj.cur,obj.to);
						if(v&&v.length>0)
						{
							//obj.html.data('popup','len '+v.length);
							obj.html.prop('class','_plot _plot-m _plot-s-'+obj.face+' '+(obj.attack?'lionica-popup':'_plot-obj'));
							ind=0;
							path=v;
							walk();
							v=false;
						}
					}
				}
			}
			else
			{
				obj.face=move[Math.floor(Math.random()*move.length)];
				obj.html.prop('class','_plot _plot-m _plot-'+(obj.swing?'s':'m')+'-'+obj.face+' '+(obj.attack?'lionica-popup':'_plot-obj')+(obj.html.hasClass('hideobj')?' hideobj':''));
			}
			if(v)
			{
				tmr=setTimeout(function(){start()},Math.floor(Math.random()*60)*1000);
			}
		}
		
		function walk()
		{
			clearTimeout(tmr);
			if(path.length-1==ind)
			{
				obj.html.prop('class','_plot _plot-m _plot-'+(obj.swing?'s':'m')+'-'+obj.face+' '+(obj.attack?'lionica-popup':'_plot-obj')+(obj.html.hasClass('hideobj')?' hideobj':''));
				tmr=setTimeout(function(){start()},Math.floor(Math.random()*10)*1000);
			}
			else
			{
				ind++;
				var pcur=[],nf='';
				pcur[0] = path[ind][0];
				pcur[1] = path[ind][1];
				
				step=16;
				if(obj.cur[0]>pcur[0])
				{
					nf='l';
					if(obj.cur[1]!=pcur[1])
					{
						step=32;
					}
				}
				else if(obj.cur[0]<pcur[0])
				{
					nf='r';
					if(obj.cur[1]!=pcur[1])
					{
						step=32;
					}
				}
				else if(obj.cur[1]>pcur[1])
				{
					nf='u';
				}
				else
				{
					nf='d';
				}
				if(obj.face!=nf)
				{
					obj.face=nf;
					obj.html.prop('class','_plot _plot-m _plot-s-'+obj.face+' '+(obj.attack?'lionica-popup':'_plot-obj')+(obj.html.hasClass('hideobj')?' hideobj':''));
				}
				sind=0;
				mto=pcur;
				tmr=setTimeout(function(){walking()},40);
			}
		}
		function walking()
		{
			clearTimeout(tmr);
			sind++;
			if(sind<step)
			{
				var pstep=[];
				pstep[0] = Math.floor(((((mto[0]-obj.cur[0])*32)*(sind/step))+(obj.cur[0]*32)));
				pstep[1] = Math.floor(((((mto[1]-obj.cur[1])*32)*(sind/step))+(obj.cur[1]*32)));
				obj.html.css({'left':pstep[0],'top':pstep[1]-16,'z-index':(100+pstep[1])});
				tmr=setTimeout(function(){walking()},40);
			}
			else
			{
				obj.cur=mto;
				tmr=setTimeout(function(){walk()},40);	
			}
		}
		start();
		return obj;
	},
	people:{
		obj:{},
		get:function(j,c)
		{
			if(!_.lionica.people.obj['p'+j])
			{
				_.lionica.people.obj['p'+j]=new _.lionica.people.objpet(j,c);
			}
			_.lionica.people.obj['p'+j].move(j,c);
		},
		objpet:function(j,c)
		{
			var cm=$('.map'),play=c;
			if($('#_player-'+j).length<1)
			{
				cm.append('<i id="_player-'+j+'" data-popup="'+c.n+' (Lv.'+c.lv+')" class="_player-obj" data-pet="'+j+'" data-x="'+c.x+'" data-y="'+c.y+'"><div><div id="_player-'+j+'-pet"></div><div id="_player-'+j+'-head" class="head"></div><div id="_player-'+j+'-guild" class="gname">'+(c.g?c.g:'')+'</div></div></i>');
			}
			$('#_player-'+j).css({'left':c.x*32,'top':(c.y*32)-16}).prop('class','_player-obj _player _plot-s-'+c.z+'-in lionica-popup');
			$('#_player-'+j+'-pet').css({'background-image':'url(http://s0.boxza.com/static/images/game/lionica/pet/'+c.ty+'.png)'});
			$('#_player-'+j+'-head').css({'background-image':'url(http://s0.boxza.com/static/images/game/lionica/head/'+(c.hd?c.hd:'0')+'.png)'});
		
			var m=$('#_player-'+j),mf=c.z,mp=[c.x,c.y],ms=1,tmr,ind=0,path,mx2,my2,step=6,sind=0,mto,nh=c.nh;
		
			this.move=function(j,c)
			{
				clearTimeout(tmr);
				var p=_.lionica.cur;
				var x=Math.floor(Math.sqrt(((c.x-p[0])*(c.x-p[0]))+((c.y-p[1])*(c.y-p[1]))));
				var x2=Math.floor(Math.sqrt(((mp[0]-p[0])*(mp[0]-p[0]))+((mp[1]-p[1])*(mp[1]-p[1]))));
				if(x>10)
				{
					mf=c.z,mp=[c.x,c.y];
					m.prop('class','_player-obj _player _plot-s-'+mf+'-in lionica-popup hideobj').data({x:c.x,y:c.y}).css({'z-index':100+c.y});
					m.css({'left':c.x*32,'top':(c.y*32)-16});
					return;	
				}
				else if(x2>10)
				{
					mf=c.z,mp=[c.x,c.y];
					m.prop('class','_player-obj _player _plot-s-'+mf+'-in lionica-popup').data({x:c.x,y:c.y}).css({'z-index':100+c.y});
					m.css({'left':c.x*32,'top':(c.y*32)-16});
					return;	
				}
				else
				{
					m.removeClass('hideobj');
				}
				
				if(c.nh)
				{
					if(!$('#_player-'+j+'-nh').length)
					{
						$('#_player-'+j+' > div').append('<p id="_player-'+j+'-nh"></p>');
					}
					$('#_player-'+j+'-nh').prop('class','_plot-nh _plot-nh-'+c.nh);
				}
				else
				{
					$('#_player-'+j+'-nh').remove();
				}
				if(c.v)
				{
					if(!$('#_player-'+j+'-shop').length)
					{
						$('#_player-'+j+' > div').append('<div id="_player-'+j+'-shop" class="player-shop" data-shop="'+c.v+'">ร้านค้า</div>');
						mf=c.z,mp=[c.x,c.y];
						m.prop('class','_player-obj _player _plot-s-'+mf+'-in lionica-popup').data({x:c.x,y:c.y});
						m.css({'left':c.x*32,'top':(c.y*32)-16});
						return;	
					}
				}
				else if($('#_player-'+j+'-shop').length)
				{
					$('#_player-'+j+'-shop').remove();	
				}
				if(c.x==mp[0]&&c.y==mp[1])return;
				var b=_.lionica.map.loc[c.x][c.y],v=true;
				if((!b)||(b.substr(0,1)!='b'))
				{
					var v=_.lionica.routing(_.lionica.map.loc,mp,[c.x,c.y]);
					if(v&&v.length>0)
					{
						ind=0;
						path=v;
						walk();
					}
				}
			}
			
			function walk()
			{
				clearTimeout(tmr);
				if(path.length-1==ind)
				{
					mp[0] = path[ind][0];
					mp[1] = path[ind][1];
					//tmr=setTimeout(function(){start()},Math.floor(Math.random()*10)*1000);
					m.prop('class','_player-obj _player _plot-s-'+mf+'-in lionica-popup').data({x:mp[0],y:mp[1]});
				}
				else
				{
					ind++;
					var pcur=[];
					pcur[0] = path[ind][0];
					pcur[1] = path[ind][1];
					
					step=16;
					if(mp[0]>pcur[0])
					{
						mf='l';
						if(mp[1]!=pcur[1])
						{
							step=32;
						}
					}
					else if(mp[0]<pcur[0])
					{
						mf='r';
						if(mp[1]!=pcur[1])
						{
							step=32;
						}
					}
					else if(mp[1]>pcur[1])
					{
						mf='u';
					}
					else
					{
						mf='d';
					}
					
					m.prop('class','_player-obj _player _plot-s-'+mf+'-in lionica-popup');
					sind=0;
					mto=pcur;
					tmr=setTimeout(function(){walking()},40);
				}
			}
			function walking()
			{
				clearTimeout(tmr);
				sind++;
				if(sind<step)
				{
					var pstep=[];
					pstep[0] = Math.floor(((((mto[0]-mp[0])*32)*(sind/step))+(mp[0]*32)));
					pstep[1] = Math.floor(((((mto[1]-mp[1])*32)*(sind/step))+(mp[1]*32)));
					m.css({'left':pstep[0],'top':pstep[1]-16,'z-index':100+pstep[1]});
					tmr=setTimeout(function(){walking()},40);
				}
				else
				{
					mp=mto;
					tmr=setTimeout(function(){walk()},40);	
				}
			}
			//this.move(j,c);
			return this;
		}
	},
	sound:
	{
		_on:false,
		open:function()
		{
			_.lionica.sound._on=!_.lionica.sound._on;
			if(!_.lionica.sound._on)
			{
				$('#psound').html('');
				$('#btn-sound').css('background-position','-240px -192px');
			}
			else
			{
				var tmp='<p id="sound-map"><audio autoplay loop volume="0.5"><source src="http://s0.boxza.com/static/images/game/lionica/sound/map1.mp3" type="audio/mpeg" /><source src="http://s0.boxza.com/static/images/game/lionica/sound/map1.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="true" src="http://s0.boxza.com/static/images/game/lionica/sound/map1.mp3" /></audio></p>';
				tmp+='<p id="sound-spell"><audio volume="0.5"><source src="http://s0.boxza.com/static/images/game/lionica/sound/spell.mp3" type="audio/mpeg" /><source src="http://s0.boxza.com/static/images/game/lionica/sound/spell.ogg" type="audio/ogg" /><embed hidden="true" autostart="false" loop="false" src="http://s0.boxza.com/static/images/game/lionica/sound/spell.mp3" /></audio></p>';
				$('#psound').html(tmp);
				$('#btn-sound').css('background-position','-216px -192px');
				$('#psound audio').each(function(){
					$(this).get(0).volume=0.5;
				});
			}
		},
		play:function(s)
		{
			if(_.lionica.sound._on)
			{
				if($('#sound-'+s+' audio').length>0)
				{
					$('#sound-'+s+' audio').get(0).play();
				}
			}
		}
	},
	attacking:{
		state:0,
		monster:'',
		score:[],
		mons:{},
		index:0,
		pos:{monster:[],pet:[]},
		drop:'',
		start:function(v)
		{
			_.lionica.attacking.monster=_.lionica.monster[v.monster];
			_.lionica.attacking.score=[];
			_.lionica.attacking.drop='';
			_.lionica.attacking.php=v.hp;
		},
		damage:function(m)
		{
			_.lionica.attacking.score.push(m);
		},
		stop:function(v)
		{
			clearTimeout(_.lionica.tmrfm);
			_.lionica.attacking.drop=v;
			var p=_.lionica.cur,f=[],m=[],mf,mt;
			if(_.lionica.face=='d')
			{
				m[0]=f[0]=p[0];
				f[1]=p[1]-1;
				m[1]=p[1]+1;
				mf='u';
			}
			else if(_.lionica.face=='l')
			{
				f[0]=p[0]+1;
				m[0]=p[0]-1;
				m[1]=f[1]=p[1];
				mf='r';
			}
			else if(_.lionica.face=='r')
			{
				f[0]=p[0]-1;
				m[0]=p[0]+1;
				m[1]=f[1]=p[1];
				mf='l';
			}
			else 
			{
				m[0]=f[0]=p[0];
				f[1]=p[1]+1;
				m[1]=p[1]-1;
				mf='d';
			}
			_.lionica.attacking.pos.pet=[f[0]*32,(f[1]*32)-16];
			_.lionica.attacking.pos.monster=[m[0]*32,(m[1]*32)-16];
			$('#player').prop('css','_plot-s-'+_.lionica.face+'-in').css({'left':_.lionica.attacking.pos.pet[0],'top':_.lionica.attacking.pos.pet[1]});
			//_.lionica.attacking.monster=_.lionica.monster[p[0]+'_'+p[1]];
			_.lionica.attacking.mons[p[0]+'_'+p[1]]=true;
			if(mt=_.lionica.attacking.monster)
			{
				mt.html.prop('class','lionica-popup _plot _plot-m _plot-'+(mt.swing?'s':'m')+'-'+mf).css({'display':'','left':_.lionica.attacking.pos.monster[0],'top':_.lionica.attacking.pos.monster[1]});
			}
			_.lionica.attacking.index=0;
			_.lionica.attacking.state=1;
			
			var m=_.lionica.attacking.drop.monster;
			_.lionica.box('target','block');
			$('#target_name').html(m.name+' (Lv.'+m.lv+')');
			$('#target_hp').css('background-position','150px 0px').html(m.hp+' / '+m.hp);
			_.lionica.attacking.hp=m.hp;
			_.lionica.attacking.indeff=0;
			_.lionica.attacking.delay();
		},
		delay:function()
		{
			clearTimeout(_.lionica.attacking.tmr)
			if(_.lionica.attacking.index>=_.lionica.attacking.score.length)
			{
				_.lionica.box('target','none');
				_.lionica.logs([{'type':'','text':_.lionica.attacking.drop.text}]);
				_.lionica.attacking.state=0;
				$('#player').prop('class','_plot-s-'+_.lionica.face+'-in').css({'left':(_.lionica.cur[0]*32),'top':(_.lionica.cur[1]*32)-16});
				var mt;
				if(mt=_.lionica.attacking.monster)
				{
					mt.html.prop('class','lionica-popup _plot _plot-m _plot-'+(mt.swing?'s':'m')+'-'+mt.face).css({'display':'none','left':mt.cur[0]*32,'top':(mt.cur[1]*32)-16});
					setTimeout(function(){mt.html.css('display','')},4000);
				}
				if(_.lionica.attacking.drop.dead=='pet')
				{
					new _.lionica.effect.show('dead',_.lionica.cur[0],_.lionica.cur[1]);
					setTimeout(function(){
					_.lionica.cur=_.lionica.map.start;
					_.lionica.center(_.lionica.cur);
					},3000);
				}
				if(_.lionica.eai)
				{
					clearTimeout(_.lionica.tmrai);
					_.lionica.tmrai=setTimeout(function(){_.lionica.startai()},100);
				}
			}
			else
			{
				if(_.lionica.attacking.drop.skill>0 && _.lionica.attacking.indeff==0)
				{
					_.lionica.attacking.drop.skill--;
					_.lionica.sound.play('spell');
					var ty=(_.lionica.pet.ty%5);
					if(ty<1)ty=5;
					new _.lionica.effect.show('pet'+ty,_.lionica.cur[0],_.lionica.cur[1]);
				}
				else if(_.lionica.attacking.indeff>30)
				{
					_.lionica.attacking.indeff=-1;
				}
				_.lionica.attacking.indeff++;
				
				var mt=_.lionica.attacking.monster;
				var t=_.lionica.attacking.score[_.lionica.attacking.index];
				var p=_.lionica.attacking.pos[t.def];
				if(!t.atk)
				{
					var d=$('<p class="damage damage-miss" style="left:'+p[0]+'px;top:'+p[1]+'px;z-index:'+(1000+_.lionica.attacking.index)+'"><span>Miss</span></p>');
				}
				else
				{
					var d=$('<p class="damage damage-'+t.def+'" style="left:'+p[0]+'px;top:'+p[1]+'px;z-index:'+(1000+_.lionica.attacking.index)+'"><span>'+t.atk+'</span></p>');
					if(t.def=='pet')
					{
						_.lionica.attacking.php-=t.atk;
						if(_.lionica.attacking.php<0)
						{
							_.lionica.attacking.php=0;
						}
						$('#char_hp').html(_.lionica.attacking.php+' / '+_.lionica.pet.mhp+' ('+Math.floor((_.lionica.attacking.php/_.lionica.pet.mhp)*100)+'%)').css({'background-position':Math.floor((_.lionica.attacking.php/_.lionica.pet.mhp)*215)});
						$('#player_hp').css({'background-position':Math.floor((_.lionica.attacking.php/_.lionica.pet.mhp)*32)});
					}
					else
					{				
						_.lionica.attacking.hp-=t.atk;
						if(_.lionica.attacking.hp<0)
						{
							_.lionica.attacking.hp=0;
						}
						var m=_.lionica.attacking.drop.monster,hp=Math.floor((_.lionica.attacking.hp/m.hp)*150);
						$('#target_hp').css('background-position',hp).html(_.lionica.attacking.hp+' / '+m.hp);
					}
				}
				d.prependTo($('.map')).animate({'top':'-=30px'},300, 'linear', function(){setTimeout(function(){d.remove();},500)});
				_.lionica.attacking.index++;
				_.lionica.attacking.tmr=setTimeout(function(){_.lionica.attacking.delay()},100);
			}
		}
	},
	center:function(pos)
	{
		$('.minimap .name .text').html(_.lionica.map.name+': '+(pos[0]+1)+','+(pos[1]+1));
		$('#player').css({'left':pos[0]*32,'top':(pos[1]*32)-16,'z-index':100+pos[1]});
		$('#plot').css({'left':pos[0]*5,'top':pos[1]*5});
		$('.map_move').css({'top':(((32*pos[1])-_.lionica.hheight)*-1),'left':(((32*pos[0])-_.lionica.hwidth)*-1)});
	},
	ai:function()
	{
		clearTimeout(_.lionica.tmrai);
		if(!(_.lionica.eai=!_.lionica.eai))
		{
			$('._btn-ai').val('เริ่มการทำงาน');
		}
		else
		{
			$('._btn-ai').val('หยุดการทำงาน');
			_.lionica.attacking.mons={};
			_.lionica.startai();
		}
	},
	startai:function()
	{
		clearTimeout(_.lionica.tmrai);
		if(_.lionica.shop.vender>0)
		{
			_.lionica.eai=false;
			$('._btn-ai').val('เริ่มการทำงาน');
			return;	
		}
		if(_.lionica.eai)
		{
			var hp=Math.floor($.trim($('._inp-ai-hp').val()));
			var mp=Math.floor($.trim($('._inp-ai-mp').val()));
			if(hp<=Math.floor((_.lionica.pet.hp/_.lionica.pet.mhp)*100)&&mp<=Math.floor((_.lionica.pet.mp/_.lionica.pet.mmp)*100))
			{
				//_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] กำลังค้นหามอนสเตอร์</p>'}]);			
				if(_.lionica.attacking.state==0)
				{
					_.lionica.tmrai=setTimeout(function(){_.lionica.findmon(false)},100);
				}
			}
			else
			{
				_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] HP/MP ไม่เพียงพอ ระบบกำลังรอฟื้นค่า HP/MP (20 วินาที)</p>'}]);
				_.lionica.tmrai=setTimeout(function(){_.lionica.startai()},20000);
			}
		}
	},
	hidesofar:function()
	{
		var i,x,y,c,p=_.lionica.cur;
		for(i in _.lionica.monster)
		{
			if(_.lionica.monster.hasOwnProperty(i))
			{
				c=_.lionica.monster[i];
				x=Math.floor(Math.sqrt(((c.cur[0]-p[0])*(c.cur[0]-p[0]))+((c.cur[1]-p[1])*(c.cur[1]-p[1]))));
				if(x>10)
				{
					c.html.addClass('hideobj');//.css('border','1px solid #000').data('popup',x+' = '+'((('+c.cur[0]+'-'+p[0]+')*('+c.cur[0]+'-'+p[0]+'))+(('+c.cur[0]+'-'+p[1]+')*('+c.cur[0]+'-'+p[1]+')))');
				}
				else
				{
					c.html.removeClass('hideobj');//.css('border','').data('popup',x+' = '+'((('+c.cur[0]+'-'+p[0]+')*('+c.cur[0]+'-'+p[0]+'))+(('+c.cur[0]+'-'+p[1]+')*('+c.cur[0]+'-'+p[1]+')))');
				}
			}
		}
		
		$('._player-obj').each(function() {
			x=$(this).data('x');
			y=$(this).data('y');
			i=Math.floor(Math.sqrt(((x-p[0])*(x-p[0]))+((y-p[1])*(y-p[1]))));
			if(i>10)
			{
				$(this).addClass('hideobj')	
			}
			else
			{
				$(this).removeClass('hideobj');	
			}
		});
	},
	findmon:function(cur)
	{
		clearTimeout(_.lionica.tmrfm);
		if((!_.lionica.eai)&&(!cur))
		{
			return;
		}
		var i,f=-1,x,c,p=_.lionica.cur;
		for(i in _.lionica.monster)
		{
			if(_.lionica.monster.hasOwnProperty(i))
			{
				c=_.lionica.monster[i];
				if(c.attack&&c.html.css('display')!='none')
				{
					if(cur)
					{
						if(f==-1)
						{
							if(p[0]==c.cur[0]&&p[1]==c.cur[1])
							{
								return c;
							}
						}
					}
					else if(x=_.lionica.routing(_.lionica.map.loc,p,c.cur))
					{
						if(x.length>0)
						{
							if(f==-1||x.length<f)
							{
								f=x.length;
								to=c;
							}
							else if(x.length==f && _.lionica.attacking.mons[c.cur[0]+'_'+c.cur[1]])
							{
								f=x.length;
								to=c;
							}
						}
					}
				}
			}
		}
		if(cur)
		{
			return false;	
		}
		if(f>-1)
		{
			_.lionica.mons[to.id].lock=true;
			//var m=_.lionica.mons[to.id];
			
			_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] พบ '+to.name+' ['+(to.cur[0]+1)+','+(to.cur[1]+1)+']</p>'}]);
			
			_.lionica.box('target','block');
			$('#target_name').html(to.name+' (Lv.'+to.lv+')');
			$('#target_hp').css('background-position','150px 0px').html(to.hp+' / '+to.hp);
			
			_.lionica.rindex=0;
			_.lionica.path=_.lionica.routing(_.lionica.map.loc,_.lionica.cur,to.cur);
			_.lionica.walk();
		}
		else
		{
			_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] ไม่พบมอนสเตอร์ในบริเวณนี้</p>'}]);
		}
	},
	swing:function()
	{
		clearTimeout(_.lionica.tmrswing);
		$('#lionica').prop('class','swing'+Math.ceil(_.lionica.sindex/5)+' enhance-swing'+_.lionica.sindex);	
		_.lionica.sindex++
		if(_.lionica.sindex>20)_.lionica.sindex=1;
		_.lionica.tmrswing=setTimeout(function(){_.lionica.swing()},50);
	},
	walk:function()
	{
		clearTimeout(_.lionica.tmrmove);
		var p=_.lionica,m;
		if(p.path.length-1==p.rindex)
		{
			var b3=0,c;
			var l,l1,l2,i;
			l=_.lionica.map.loc[p.cur[0]][p.cur[1]],l1=l.split(',');
			for(i=0;i<l1.length;i++)
			{
				l=l1[i];
				l2=l.split(':');
				if(l2[0]=='n')
				{
					b3=2;
				}
				else if(l2[0]=='w')
				{
					b3=3;
				}
				else if(l2[0]=='f')
				{
					b3=4;
				}
			}
			if(b3==0)
			{
				if(m=_.lionica.findmon(true))
				{
					b3=1;
				}
			}
			if(b3>0)
			{
				if(b3==1)
				{
					m.html.css('display','none');
					var sk=[];
					$('input[name="skill"]:checked').each(function() {sk[sk.length]=$(this).val();});
					_.lionica.api('position',{'x':m.x,'y':m.y,'skill':sk});
				}
				else
				{
					_.lionica.api((b3==4?'farm':'position'),{'x':p.cur[0],'y':p.cur[1]});
				}
				if(_.lionica.eai)
				{
					_.lionica.tmrfm=setTimeout(function(){_.lionica.findmon(false);},15000);
				}
			}		
			else if(_.lionica.eai)
			{
				if(_.lionica.pet.u==1)
				{
				//	alert(p.cur[0]+' - '+p.cur[1]);	
				}
				_.lionica.tmrfm=setTimeout(function(){_.lionica.findmon(false);},50);
			}
		}
		else
		{
			p.rindex++;
			var pcur=[];
			pcur[0] = _.lionica.path[p.rindex][0];
			pcur[1] = _.lionica.path[p.rindex][1];
			
			_.lionica.mstep=4;
			if(p.cur[0]>pcur[0])
			{
				_.lionica.face='l';
				if(p.cur[1]!=pcur[1])
				{
					_.lionica.mstep=6;
				}
			}
			else if(p.cur[0]<pcur[0])
			{
				_.lionica.face='r';
				if(p.cur[1]!=pcur[1])
				{
					_.lionica.mstep=6;
				}
			}
			else if(p.cur[1]>pcur[1])
			{
				_.lionica.face='u';
			}
			else
			{
				_.lionica.face='d';
			}
			
			$('#player').prop('class','_plot-s-'+_.lionica.face+'-in');	
			
			_.lionica.step=0;
			_.lionica.fromstep=_.lionica.cur;
			_.lionica.tostep=pcur;
			_.lionica.tmrmove=setTimeout(function(){_.lionica.walking()},50);
			
		}
	},
	walking:function()
	{
		clearTimeout(_.lionica.tmrmove);
		_.lionica.step++;
		if(_.lionica.step<_.lionica.mstep)
		{
			var pstep=[],p=_.lionica;
			pstep[0] = Math.floor(((((p.tostep[0]-p.fromstep[0])*32)*(p.step/_.lionica.mstep))+(p.fromstep[0]*32)));
			pstep[1] = Math.floor(((((p.tostep[1]-p.fromstep[1])*32)*(p.step/_.lionica.mstep))+(p.fromstep[1]*32)));
			$('#player').css({'left':pstep[0],'top':pstep[1]-16});
			$('.map_move').css({'left':(pstep[0]-_.lionica.hwidth)*-1,'top':(pstep[1]-_.lionica.hheight)*-1});
			_.lionica.tmrmove=setTimeout(function(){_.lionica.walking()},50);
		}
		else
		{
			_.lionica.cur=_.lionica.tostep;
			_.lionica.center(_.lionica.cur);
			_.lionica.tmrmove=setTimeout(function(){_.lionica.walk()},50);	
		}
	},
	api:function(a,b)
	{
		if(_.lionica.loaded&&_.lionica.khash)
		{
			var d=new Date();
			//if(d.getTime()-_.lionica.clear.last>19000){clearTimeout(_.lionica.tmrai);_.lionica.khash="";_.lionica.eai=false;_.lionica.loaded=false;return;}
			b.func=a;
			b.last=_.lionica.lastchat;
			b.pos={'x':_.lionica.cur[0],'y':_.lionica.cur[1],'z':_.lionica.face};
			b.khash=_.lionica.khash;
			b.vender=_.lionica.shop.vender;
			if(_.lionica.online)
			{
				b.online=1;
				_.lionica.online=false;
				_.lionica.tmronline=setTimeout(function(){_.lionica.online=true;},9000);
			}
			_.ajax.gourl('/lionica/play','socket',b);
			_.lionica.delay();
		}
	},
	delay:function(){clearTimeout(_.lionica.tmr);_.lionica.tmr=setTimeout(function(){_.lionica.api('ide',{});_.lionica.delay();},10000);},
	box:function(a,b){if(b=='toggle'){b=($('.lbox.'+a).css('display')=='none'?'block':'none');};$('.lbox.'+a).css('display',b);if((a=='guild'||a=='vender')&&b=='block')_.lionica.api(a,{'type':'open'});if((a=='chat'||a=='logs')&&b=='none')$('#'+a+'_text').html('');},
	buy:function(a,b,c,d){var e=1;if(d<=0){e=Math.floor(prompt('ชื่อ '+$(a).text()+' ในราคา '+c+' Silver'+"\nใส่จำนวนที่ต้องการซื้อ",'1'));};if(e>0){if(confirm('คุณต้องการซื้อ '+$(a).text()+' '+e+' ชิ้น ในราคา '+(c*e)+' Silver หรือไม่')){_.lionica.api('buyitem',{'item':b,'count':e});}}},
	sell:function(a,b,c,d){if(d>1){d=Math.floor(prompt('ขาย '+$(a).text()+' ในราคา '+c+' Silver'+"\nใส่จำนวนที่ต้องการขาย",d));};if(d>0){if(confirm('คุณต้องการขาย '+$(a).text()+' '+d+' ชิ้น ในราคา '+(c*d)+' Silver หรือไม่')){_.lionica.api('sellitem',{'item':b,'count':d});}}},
	use:function(e){if($(this).data('type')>=0){_.lionica.api('useitem',{'item':$(this).data('inv')});}},
	skill:function(a,b){_.lionica.api('skill',{'type':a,'skill':a});},
	enhance:function(a,b,c,d,e){var n=$(a).find('span').text();if(confirm('ต้องการเพิ่มประสิทธิภาพให้กับ '+n+' จาก '+c+'->'+(c+1)+' โดยใช้ '+(d>1?'Defence':'Attack')+' Crystal กับเงิน '+(e=='enhance'?'1,000 Silver':'100 ฺSilver(ถ้าพลาดไอเท็มจะหาย)')+' หรือไม่')){_.lionica.api('enhance',{'type':e,'item':b});}},
	create:function(a)
	{
		$('#lionica').on({
			mouseenter: function()
			{
				var w=$(this).width(),t=$(this).position().top,l=$(this).position().left,h=$(this).height();
				$('#lionica-balloon').remove();
				if($(this).is('i'))
				{
					if($(this).hasClass('online'))
					{
						$('.minimap_text').prepend('<div id="lionica-balloon"></div>');
					}
					else
					{
						$('.map').prepend('<div id="lionica-balloon"></div>');
					}
					$('#lionica-balloon').html($(this).data('popup'));
					$('#lionica-balloon').css({'left':l-Math.floor(($('#lionica-balloon').width()-w)/2),'top':t+h+3});
				}
				else
				{
					$(this).after('<div id="lionica-balloon"></div>');
					$('#lionica-balloon').html($(this).data('popup')).css({'width':$(this).offsetParent().width()});
					var t2=t-$('#lionica-balloon').height()-3;
					if(t2<10)
					{
						t2=t+h+8;
					}
					$('#lionica-balloon').css({'left':0,'top':t2});
				}
			},
			mouseleave: function()
			{
				$('#lionica-balloon').remove();
			}
		},'.lionica-popup')
		.on({click:_.lionica.shop.open},'._player-obj')
		.on({dblclick:_.lionica.use},'.inv-use')
		.bind('contextmenu',_.lionica.menu.open)
		.bind('click',_.lionica.menu.close);
		
		$('.chat_input input').keypress(function(e){
			var c=(e.keyCode?e.keyCode:e.which);
			var ms=$.trim($(this).val());
			if(c==13&&ms!='')
			{
				$(this).val('');
				_.lionica.chat._repeat=(_.lionica.chat._ms==ms?_.lionica.chat._repeat+1:1);
				_.lionica.chat._flood++;
				_.lionica.chat._ms=ms;
				if(_.lionica.chat._repeat>2)
				{
					_.lionica.chat.assign('<p class="logs-waning">ห้ามพิมพ์ข้อความซ้ำเกิน 2 ครั้ง</p>');
				}
				else
				{
					_.lionica.api('chat',{'msg':ms,'ty':_.lionica.chat.to});
				}
			}
		});
		
		
		$('.chat_div').scroll(function(e) {
			var v=$('.chat_div').scrollTop(),h2=$('.chat_div').height(),h1=$('#chat_text').height(),h=h1-h2;
			if((h-v>150) && _.lionica.chat._scroll)
			{
				_.lionica.chat._scroll=!_.lionica.chat._scroll;
			}
			else if((h-v <50)&&!_.lionica.chat._scroll)
			{
				_.lionica.chat._scroll=!_.lionica.chat._scroll;
			}
		});
		
		$('.lbox').hover(function(){$(this).addClass('chat-hover')},function(){$(this).removeClass('chat-hover')});
		
		$('.lbox.lresize').resizable({
			stop:function(event,ui)
			{
				var w=$(ui.element).width(),h=$(ui.element).height();
				if($(ui.element).find('input').length)
				{
					$(ui.element).find('.bresize').css({'height':h-56});
					$(ui.element).find('input').css('width',w-90);
				}
				else
				{
					var b=$(ui.element).find('.bresize'),o=b.data('offset');
					b.css({'height':h-30-(o?o:0)});
				}
			}
		});
		$('.lbox.lmove').draggable({handle:'.name',containment: 'parent', scroll: false});
		
		$('input[name="chonline"]').click(function(){
			if($(this).is(':checked'))
			{
				$('#conline').html(' (รออัพเดทซักครู่)');	
			}
			else
			{
				$('._player-obj').remove();
				delete _.lionica.people.obj;
				_.lionica.people.obj={};
			}
		});
		$(window).resize(_.lionica.resize);
		
		
		$('.minimap_text').click(function(e){
									//Math.floor(((e.pageX - $('#lionica').position().left - $('.minimap_text').position().left)-5)/5),
									///Math.floor(((e.pageY - $('#lionica').position().top - $('.minimap_text').position().top)-10)/5)
			_.lionica.go(
									Math.floor(((e.pageX - $('.minimap_text').offset().left))/5),
									Math.floor(((e.pageY - $('.minimap_text').offset().top))/5)
								);
		});
		$('.map').click(function(e){
			_.lionica.go(
			Math.floor((e.pageX - $('#lionica').position().left - $('.map_move').position().left)/32),
			Math.floor((e.pageY - $('#lionica').position().top - $('.map_move').position().top)/32)
			);
		});
		_.lionica.swing();
		setInterval(function(){_.lionica.hidesofar()},3000);
		_.lionica.sound.open();
		_.lionica.tile = new Image;	
		var d=new Date();
		$(_.lionica.tile).load(function(){_.lionica.load()}).attr('src','http://s0.boxza.com/static/images/game/lionica/map/map'+_.lionica.map._id+'.png?v='+d.getTime());  
	},
	load:function()
	{
		delete _.lionica.obj;
		_.lionica.obj=[];
		_.lionica.monster={};
		$('#lionica .mons').remove();
		$('#lionica ._plot').remove();
		var w=_.lionica.map.loc[0].length,h=_.lionica.map.loc.length,x,y,z,l,l2,l3,g,p='',b,m,move=['d','l','r','u'],bs='';
		var canvas=document.getElementById('map_canvas');
		var ctx=canvas.getContext('2d');
		var canvas2=document.getElementById('minimap_canvas');
		var ctx2=canvas2.getContext('2d');
		var mobj={},o,ontop=[],i;
		var d=new Date();
		_.lionica.clear.last=d.getTime();
		_.lionica.clear.load();
		
		mobj['i']=['',0,0,32,32];
		for(var i in _.lionica.map.obj)
		{
			o=_.lionica.map.obj[i]
			mobj['i'+o[0]]=o;
		}
		
		for(y=0;y<w;y++)
		{
			for (x=0;x<h;x++)
			{
				l = _.lionica.map.loc[x][y];
				l2=l.split(',');
				bs='';
				ctx2.fillStyle="#59B200";
				for(z=0;z<l2.length;z++)
				{
					l3=l2[z].split(':');
					if(l3[0]=='b')
					{
						ctx2.fillStyle="#000000";
						if(l3.length>1)
						{
							if(mobj['i'+l3[1]][5])
							{
								ontop.push([l3[1],x,y]);
							}
							else
							{
								bs=l3[1];
							}
						}
					}
					else if(l3[0]=='g')
					{
						if(l3.length>1)
						{
							if(mobj['i'+l3[1]][5])
							{
								ontop.push([l3[1],x,y]);
							}
							else
							{
								bs=l3[1];
							}
						}
					}
					else if(l3[0]=='n')
					{
						ctx2.fillStyle="#FFCC00";
						var mo=_.lionica.npc[l3[1]];
						_.lionica.menu.npc.push([mo.name,x,y]);
						p +='<i class="lionica-popup _plot _plot-n" style="left:'+(x*32)+'px;top:'+((y*32)-16)+'px; background-position:'+mo.css+';z-index:'+(100+y)+'" data-popup="'+mo.name+'"></i>';
					}
					else if(l3[0]=='m')
					{
						_.lionica.monster[x+'_'+y]=new _.lionica.objs(l3[1],x,y);
					}
					else if(l3[0]=='w')
					{
						ctx2.fillStyle="#FF0000";
						p +='<i class="_plot _plot-nh _plot-warp" style="left:'+(x*32)+'px;top:'+((y*32)+2)+'px;"></i>';
					}
					else if(l3[0]=='f')
					{
						ctx2.fillStyle="#A9FD38";
						p +='<i class="_plot _plot-farm" id="farm_'+x+'_'+y+'" style="left:'+(x*32)+'px;top:'+((y*32)+2)+'px;"><span></span></i>';
					}
				}
				if(mobj['i'+bs])
				{
					
					ctx.drawImage(_.lionica.tile, mobj['i'+bs][1], mobj['i'+bs][2],mobj['i'+bs][3],mobj['i'+bs][4],x*32,y*32,mobj['i'+bs][3],mobj['i'+bs][4]);
					//ctx.drawImage(_.lionica.tile, bs*32, 0,32,32,x*32,y*32,32,32);
					ctx2.fillRect(x*5,y*5,5,5);
				}
			}
		}
		
		for(i=0;i<ontop.length;i++)
		{
			o=ontop[i];
			ctx.drawImage(_.lionica.tile, mobj['i'+o[0]][1], mobj['i'+o[0]][2],mobj['i'+o[0]][3],mobj['i'+o[0]][4],o[1]*32,o[2]*32,mobj['i'+o[0]][3],mobj['i'+o[0]][4]);
		}
		$('#lionica .map').prepend(p);
		
		_.ajax.cursor=false;
		_.lionica.loaded=true;
		_.lionica.center(_.lionica.cur);
		_.lionica.api('ide',{});
		_.lionica.delay();
		if(_.lionica.shop.vender==2)
		{
			_.lionica.box('vender','block');
		}
	},
	convert:function(t)
	{
		_.lionica.chat.cin=0;
		_.lionica.chat.cinl='';
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
				t=t.replace(rp,'<span class="emo" style="background-position:'+em[j][1]+'px '+em[j][2]+'px"></span>');
			}
			
		return t.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
				_.lionica.chat.cin++;
				if(_.lionica.chat.cinl==i1+i2)
				{
					return '';
				}
				_.lionica.chat.cinl=i1+i2;
				return (_.lionica.chat.cin>2)?'':t2.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="cemo $1">');
			}).replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
				_.lionica.chat.cin++;
				if(_.lionica.chat.cinl==i1+i2)
				{
					return '';
				}
				_.lionica.chat.cinl=i1+i2;
				return (_.lionica.chat.cin>2)?'':t2.replace(/\[([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="cemo $1">');
			});
	},
	notice:function(a)
	{
		$('#chat_text').append('<p id="chat_text_notice">ระบบ: '+_.lionica.convert(a)+'</p>');
		$('.chat_div').scrollTop(Math.max($('.chat_div').height(),$('#chat_text').height())+100);
	},
	char:function(a)
	{
		_.lionica.pet=a;
		_.lionica.lastchat=a.last;
		_.lionica.charup();
		if(a.chat)
		{
			var p,tx,ct=$('#chat_text');
			var lo=$('#logs_text');
			
			for(var j=0;j<a.chat.length;j++)
			{
				c=a.chat[j];
				if(!$('#chat_text_'+c._sn).length)
				{
					if(c.ty=='item')
					{
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else if(c.ty=='shop')
					{
						if(c.seller==_.lionica.pet.u)
						{
							_.lionica.box('logs','block');
							//_.lionica.box('vender','block');	
						}
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else if(c.ty=='enhance')
					{
						if(c.pet==_.lionica.pet._id)
						{
							_.lionica.box('logs','block');
							new _.lionica.effect.show(c.effect,_.lionica.cur[0],_.lionica.cur[1]);	
						}
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else if(c.ty=='evolution')
					{
						if(c.pet==_.lionica.pet._id)
						{
							new _.lionica.effect.show('evolution',_.lionica.cur[0],_.lionica.cur[1]);	
						}
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else
					{
						ct.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="http://boxza.com/'+c.l+'" target="_blank">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
				}
			}
			if(!_.lionica.chat.first)
			{
				_.lionica.chat.first=true;
				$('#chat_text').append('<p id="chat_text_notice" style="margin:5px 0px; padding:5px;border:1px solid #333; background:#111;color:#fff"><strong style="color:#f60">วิธีการเล่นเกม Lionica</strong> (เกมนี้)<br>'+
				' - <a href="http://game.boxza.com/forum/topic/9292" target="_blank">เริ่มเล่นเกมครั้งแรก ต้องทำอะไรบ้าง คลิกที่นี่</a><br>'+
				' - <a href="http://game.boxza.com/forum/topic/9293" target="_blank">วิธีสั่งให้สัตว์เลี้ยง ตีมอนสเตอร์ เก็บเลเวลเอง  (AI)</a><br>'+
				' - <a href="http://game.boxza.com/forum/lionica" target="_blank">รวมกระทู้ พูดคุย แนะนำ วิธีการเล่นต่างๆ ทั้งหมด</a>'+
				'</p>');
				
			}
			if(_.lionica.chat._scroll)
			{
				$('.chat_div').scrollTop(Math.max($('.chat_div').height(),$('#chat_text').height())+100);
				$('.logs_div').scrollTop(Math.max($('.logs_div').height(),$('#logs_text').height())+100);
			}
		}
		if(a.online)
		{
			var co=$('input[name="chonline"]:checked').length>0?true:false;
			var t=''+Math.floor(Math.random()*100000),j,l,p,pv;
			var cn=$('.minimap_text'),cm=$('.map');
			for(j in a.online)
			{
				if(j!=a._id)
				{						
					c=a.online[j];
					l=$('#pet-online-'+j);
					if(l.length<1)
					{
						l=$('<i id="pet-online-'+j+'" data-pet="'+j+'" class="plot online'+(c.gi?' g'+c.gi:'')+' lionica-popup" data-popup="'+c.n+'"></i>');
						cn.append(l);
					}
					l.data('lasttime',t).css({'left':c.x*5,'top':c.y*5});
					if(co)
					{
						_.lionica.people.get(j,c);
						$('#_player-'+j).data('lasttime',t)
					}
				}
			}
			$('.plot.online').each(function() {
				if($(this).data('lasttime')!=t)
				{
					$(this).remove();	
				}
			});
			$('._player-obj').each(function() {
				if($(this).data('lasttime')!=t)
				{
					delete _.lionica.people.obj['p'+$(this).data('pet')];
					$(this).remove();	
				}
			});
			$('#conline').html(_.lionica.pet.u==1?' ('+($('.plot.online').length+1)+' คน)':'');
		}
		if(a.farms)
		{
			$('._plot-farm').prop('class','_plot _plot-farm').data('popup','').html('<span></span>');
			var cl,f;
			for(var xy in a.farms)
			{
				cl='32px 32px';
				f=a.farms[xy];
				if(f.st==4)
				{
					cl='-'+(f.pl*96)+'px -'+(f.gd*32)+'px';
				}
				else if(f.st==5)
				{
					cl='-'+((f.pl*96))+'px -'+(f.gd*32)+'px';
				}
				else if(f.st==6)
				{
					cl='-'+((f.pl*96)+32)+'px -'+(f.gd*32)+'px';
				}
				else if(f.st==7)
				{
					cl='-'+((f.pl*96)+64)+'px -'+(f.gd*32)+'px';
				}
				$('#farm_'+xy).prop('class','lionica-popup _plot _plot-farm _plot-farm-'+f.st).data('popup','เจ้าของ: '+f.pn).find('span').css({'background-position':cl});
			}
		}
	},
	charup:function()
	{
		var a=_.lionica.pet;
		$('#char_lv').html(a.lv);
		$('#char_hp').html(a.hp+' / '+a.mhp+' ('+Math.floor((a.hp/a.mhp)*100)+'%)').css({'background-position':Math.floor((a.hp/a.mhp)*185)});
		$('#char_mp').html(a.mp+' / '+a.mmp+' ('+Math.floor((a.mp/a.mmp)*100)+'%)').css({'background-position':Math.floor((a.mp/a.mmp)*185)});
		$('#char_exp').html(a.xp+' / '+a.mxp+' ('+Math.floor((a.xp/a.mxp)*100)+'%)').css({'background-position':Math.floor((a.xp/a.mxp)*185)});
		$('#player_pet').css('background-image','url(http://s0.boxza.com/static/images/game/lionica/pet/'+a.ty+'.png)');
		$('#player_head').css('background-image','url(http://s0.boxza.com/static/images/game/lionica/head/'+((a.eq&&a.eq.i2)?a.eq.i2['item']:'0')+'.png)');
		$('#player_nh').prop('class','_plot-nh _plot-nh-'+(a.nh?a.nh:0));
		$('#player_hp').css({'background-position':Math.floor((a.hp/a.mhp)*32)});
		$('#player_mp').css({'background-position':Math.floor((a.mp/a.mmp)*32)});
		
		$('#char_atk').html(a.atk?a.atk:'-');
		$('#char_def').html(a.def?a.def:'-');
		$('#char_job').html(a.job?_.lionica.job[a.job].name:'-');
		$('#char_silver').html(a.silver);
	},
	logs:function(a)
	{
		if(_.lionica.khash)
		{
			var lo=$('#logs_text'),txt;
			$.each(a, function(k, v)
			{
				txt='';
				switch(v.type)
				{
					case 'use':
						txt='ใช้ไอเท็ม '+v.name+' '+v.text;
						break;
					case 'skill':
						txt='ใช้สกิล '+v.name+' '+v.text;
						break;
					case 'eq':
						txt='สวม '+v.name;
						$('#eq_'+v.eq).html('<i class="item" style="background-position:'+v.css+'"></i>');
						break;
					case 'uneq':
						txt='ถอด '+v.name;
						$('#eq_'+v.eq).html('');
						break;
					case 'attack':
						_.lionica.attacking.start(v);
						break;
					case 'damage':
						_.lionica.attacking.damage(v);
						//txt=v.text;
						break;
					case 'finished':
						_.lionica.attacking.stop(v);
						break;
					case 'login':
						_.lionica.box('logs','block');
						clearTimeout(_.lionica.tmrai);
						_.box.alert(txt=v.text);
						_.lionica.khash="";
						_.lionica.eai=false;
						_.lionica.loaded=false;
						break;
					default:
						txt=v.text;
				}
				
				if(txt)
				{
					lo.append('<p>'+txt+'</p>');
				}
				if(v.effect)
				{
					new _.lionica.effect.show(v.effect,_.lionica.cur[0],_.lionica.cur[1]);	
				}
			});
			$('.logs_div').scrollTop(Math.max($('.logs_div').height(),$('#logs_text').height())+100);
		}
	},
	chat:{to:'map',_ms:'',_repeat:0,_flood:0,_scroll:true,cp:function(e){var c=$('.chat_input input');c.val(' -> '+$(e).parent().find('a').text()+' <- '+c.val());c.focus();}},
	resize:function()
	{
		if(_.lionica.full)
		{
			$('#lionica_container').css({'position':'absolute','left':0,'top':0,'overflow':'hidden','width':$(window).width(),'height':$(window).height(),'z-index':1001});
			$('#lionica .map_frame').css({'width':$(window).width(),'height':$(window).height()});
		}
	},
	drop:function(i)
	{
		clearInterval(_.lionica.tmrdrop);
		_.lionica.box('drop','block');
		var l=400+Math.floor(Math.random()*100),t=100+Math.floor(Math.random()*100);
		$('#lionica .drop').css({'left':l,'top':t});
		var p=$('<p class="item-drop" data-time="'+_.lionica.dindex+'"><i class="item" style="background-position:'+i.c+'"></i> '+i.n+' <span class="btn btn-mini btn-warning pull-right" onclick="_.lionica.hidedrop(this,'+i.d+');">เก็บ</span></p>');
		$('#drop_text').prepend(p);
		_.lionica.tmrdrop=setInterval(function(){_.lionica.delaydrop()},1000);
	},
	delaydrop:function()
	{
		_.lionica.dindex++;
		$('#drop_text p:not(.rp)').each(function() {
            var t=Math.floor($(this).data('time'));
			if(_.lionica.dindex-10800>t)
			{
				$(this).addClass('rp').find('span').replaceWith('<a href="javascript:;" onclick="_.lionica.hidedrop(this,false)" class="btn btn-mini btn-inverse pull-right">ลบ</a><span class="pull-right">หมดเวลา </span>');
			}
        });
	},
	hidedrop:function(a,b)
	{
		if(_.lionica.inventory.icount>=_.lionica.inventory.imax)
		{
			 _.box.alert('กระเป๋าเต็ม ไม่สามารถเก็บไอเท็มเพิ่มได้')	;
		}
		else
		{
			if(a)
			{
				$(a).parent().remove();
			}
			if(b)
			{
				_.lionica.api('keep',{'drop':b});
			}
			if($('#drop_text p').length==0)
			{
				_.lionica.box('drop','none');
			}
		}
	},
	fullscreen:function()
	{
		$('#lionica_container').prop('style','').removeAttr('style');
		$('#lionica .map_frame').prop('style','').removeAttr('style');
		if(_.lionica.full=!_.lionica.full)
		{
			_.lionica.hwidth=Math.floor($(window).width()/2);
			_.lionica.hheight=Math.floor($(window).height()/2);
		}
		else
		{
			_.lionica.hwidth=485;	
			_.lionica.hheight=300;
		}
		_.lionica.resize();
		_.lionica.center(_.lionica.cur);
	},
	routing:function(world, pathStart, pathEnd)
	{
		var	abs = Math.abs;
		var	max = Math.max;
		var	pow = Math.pow;
		var	sqrt = Math.sqrt;
		var worldWidth = world[0].length;
		var worldHeight = world.length;
		var worldSize =	worldWidth * worldHeight;
		var distanceFunction = ManhattanDistance;
		var findNeighbours = function(){};
		function ManhattanDistance(Point, Goal)
		{
			return abs(Point.x - Goal.x) + abs(Point.y - Goal.y);
		}
		function DiagonalDistance(Point, Goal)
		{
			return max(abs(Point.x - Goal.x), abs(Point.y - Goal.y));
		}
		function EuclideanDistance(Point, Goal)
		{
			return sqrt(pow(Point.x - Goal.x, 2) + pow(Point.y - Goal.y, 2));
		}
		function Neighbours(x, y)
		{
			var	N = y - 1,
			S = y + 1,
			E = x + 1,
			W = x - 1,
			myN = N > -1 && canWalkHere(x, N),
			myS = S < worldHeight && canWalkHere(x, S),
			myE = E < worldWidth && canWalkHere(E, y),
			myW = W > -1 && canWalkHere(W, y),
			result = [];
			if(myN)
			result.push({x:x, y:N});
			if(myE)
			result.push({x:E, y:y});
			if(myS)
			result.push({x:x, y:S});
			if(myW)
			result.push({x:W, y:y});
			findNeighbours(myN, myS, myE, myW, N, S, E, W, result);
			return result;
		}
		function DiagonalNeighbours(myN, myS, myE, myW, N, S, E, W, result)
		{
			if(myN)
			{
				if(myE && canWalkHere(E, N))
				result.push({x:E, y:N});
				if(myW && canWalkHere(W, N))
				result.push({x:W, y:N});
			}
			if(myS)
			{
				if(myE && canWalkHere(E, S))
				result.push({x:E, y:S});
				if(myW && canWalkHere(W, S))
				result.push({x:W, y:S});
			}
		}
		function DiagonalNeighboursFree(myN, myS, myE, myW, N, S, E, W, result)
		{
			myN = N > -1;
			myS = S < worldHeight;
			myE = E < worldWidth;
			myW = W > -1;
			if(myE)
			{
				if(myN && canWalkHere(E, N))
				result.push({x:E, y:N});
				if(myS && canWalkHere(E, S))
				result.push({x:E, y:S});
			}
			if(myW)
			{
				if(myN && canWalkHere(W, N))
				result.push({x:W, y:N});
				if(myS && canWalkHere(W, S))
				result.push({x:W, y:S});
			}
		}
		function canWalkHere(x, y)
		{
			return ((world[x] != null) &&
				(world[x][y] != null) &&
				(world[x][y].substr(0,1) != 'b'));
		};
		function Node(Parent, Point)
		{
			var newNode = {
				Parent:Parent,
				value:Point.x + (Point.y * worldWidth),
				x:Point.x,
				y:Point.y,
				f:0,
				g:0
			};
			return newNode;
		}
	
		function calculatePath()
		{
			var	mypathStart = Node(null, {x:pathStart[0], y:pathStart[1]});
			var mypathEnd = Node(null, {x:pathEnd[0], y:pathEnd[1]});
			var AStar = new Array(worldSize);
			var Open = [mypathStart];
			var Closed = [];
			var result = [];
			var myNeighbours;
			var myNode;
			var myPath;
			var length, max, min, i, j;
			while(length = Open.length)
			{
				max = worldSize;
				min = -1;
				for(i = 0; i < length; i++)
				{
					if(Open[i].f < max)
					{
						max = Open[i].f;
						min = i;
					}
				}
				myNode = Open.splice(min, 1)[0];
				if(myNode.value === mypathEnd.value)
				{
					myPath = Closed[Closed.push(myNode) - 1];
					do
					{
						result.push([myPath.x, myPath.y]);
					}
					while (myPath = myPath.Parent);
					AStar = Closed = Open = [];
					result.reverse();
				}
				else 
				{
					myNeighbours = Neighbours(myNode.x, myNode.y);
					for(i = 0, j = myNeighbours.length; i < j; i++)
					{
						myPath = Node(myNode, myNeighbours[i]);
						if (!AStar[myPath.value])
						{
							myPath.g = myNode.g + distanceFunction(myNeighbours[i], myNode);
							myPath.f = myPath.g + distanceFunction(myNeighbours[i], mypathEnd);
							Open.push(myPath);
							AStar[myPath.value] = true;
						}
					}
					Closed.push(myNode);
				}
			}
			return result;
		}
		return calculatePath();
	}
}