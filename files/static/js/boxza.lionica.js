_.lionica={
	mscale:4,
	eai:false,
	sw1:1,
	sw2:1,
	lastchat:0,
	online:true,
	attack:0,
	full:false,
	hwidth:485,
	hheight:300,
	dindex:0,
	khash:'',
	obj:[],
	map:{},
	inventory:
	{
		icount:0,imax:40,tmr:{},
		use:function(e){if($(this).data('type')>=0){var inv=$(this).data('inv');clearTimeout(_.lionica.inventory.tmr['i'+inv]);_.lionica.inventory.tmr['i'+inv]=setTimeout(function(){ _.lionica.api('item',{'type':'use','item':inv});},500);};return false},
		unuse:function(e){e.preventDefault();if($(this).data('type')>=0){_.lionica.api('item',{'type':'unuse','item':$(this).data('inv')});};return false},
	},
	sprite:{},
	render:{
		tmr:'',time:0,loc:{},s:{monster:true,people:true},
		show:function(e,s)
		{
			_.lionica.render.s[s]=$(e).is(':checked');
		},
		mouse:function(e)
		{
			var x=Math.floor((e.pageX - $('#lionica').position().left - $('#map_move').position().left)/32),
			y=Math.floor((e.pageY - $('#lionica').position().top - $('#map_move').position().top)/32),cursor='normal',
			c=_.lionica.render.loc[x+'_'+y],i;
			if(c)
			{
				for(i in c)
				{
					if(c[i].type=='monster'||c[i].type=='boss')
					{
						cursor='attack';
						break;
					}
					else if(c[i].type=='npc'||c[i].type=='warp'||c[i].type=='farm'||c[i].type=='vender')
					{
						cursor='talk';
						break;
					}
				}
			}
			$('#lionica').prop('class','cursor-'+cursor);
		},
		start:function()
		{
			_.lionica.render.tmr=requestAnimationFrame(_.lionica.render.start);
			
			var now = new Date().getTime(),dt = now - _.lionica.render.time,p=_.lionica.player;
			if(dt>=100)
			{
				_.lionica.stats.begin();
				_.lionica.render.time = now;
				_.lionica.center();
				_.lionica.render.ctx.clearRect(0, 0, _.lionica.render.width, _.lionica.render.height);
				
				var l,t,s,ch=[],text={},cp=[],dp=true;
				var c,m,loc,x,y,x1=Math.max(0,p.cur[0]-10),x2=Math.min(_.lionica.map.width-1,p.cur[0]+10),y1=Math.max(0,p.cur[1]-10),y2=Math.min(_.lionica.map.height-1,p.cur[1]+10);
				
				ch=[
							[((p.char.hair-1)*672)+((p.char.color-1)*96)+32,((p.char.gender-1)*192)+(p.face*48)],
							[((p.char.job-1)*384)+((p.char.gender-1)*96)+32,384+(p.face*48)],
							false,
							false,
							false
						];
				if(p.char.eq)
				{
					if(p.char.eq.i11)
					{
						ch[3]=[((p.char.eq.i11.item-401)*96)+32,576+(p.face*48)];	
					}
					if(p.char.eq.i12)
					{
						ch[4]=[((p.char.eq.i12.item-451)*96)+32+2016,384+(p.face*48)];	
					}
				}
				if(_.lionica.attacking.state)
				{
					if(_.lionica.sw1==2||_.lionica.sw1==3)
					{
						ch[0][0]+=32;
						ch[1][0]+=32;
						if(ch[3])
						{
							ch[3][0]+=32;
						}
						if(ch[4])
						{
							ch[4][0]+=32;
						}
					}
					ch[2]=[((p.char.job*384)-192)+((_.lionica.sw1-1)*32),ch[1][1]];
				}
				else if(p.swinging)
				{
					if(_.lionica.sw1==2)
					{
						ch[0][0]-=32;
						ch[1][0]-=32;
						if(ch[3])
						{
							ch[3][0]-=32;
						}
						if(ch[4])
						{
							ch[4][0]-=32;
						}
					}
					else if(_.lionica.sw1==4)
					{
						ch[0][0]+=32;
						ch[1][0]+=32;
						if(ch[3])
						{
							ch[3][0]+=32;
						}
						if(ch[4])
						{
							ch[4][0]+=32;
						}
					}
				}
				
				var sid={npc:1,monster:101,boss:501,animal:1001},n,cu,cl,time=Math.floor((new Date).getTime()/1000);
				for(y=y1;y<=y2;y++)
				{
					for(x=x1;x<=x2;x++)
					{
						if(_.lionica.render.loc[x+'_'+y])
						{
							loc=_.lionica.render.loc[x+'_'+y];
							for(c in loc)
							{
								if(loc[c].type=='npc'||(loc[c].type=='monster'&&_.lionica.render.s.monster)||loc[c].type=='boss'||loc[c].type=='animal')
								{
									m=_.lionica.monster[loc[c].id];
									if(!m || m.hide==2)
									{
										continue;	
									}
									l=(m.id-sid[loc[c].type]) % 10;
									s=((l*m.size.w*3)+m.size.w);
									if(m.swinging)
									{
										if(_.lionica.sw1==2)
										{
											s-=m.size.w;
										}
										else if(_.lionica.sw1==4)
										{
											s+=m.size.w;
										}
									}
									t=Math.floor((m.id-sid[loc[c].type]) / 10);
									_.lionica.render.ctx.drawImage(_.lionica.sprite[loc[c].type], s, (t*m.size.h*4)+(m.face*m.size.h),m.size.w,m.size.h,m.pos[0],m.pos[1],m.size.w,m.size.h);
									
									if(n=m.name)
									{
										if(m.type=='npc')
										{
											cl='#fff';
										}
										else
										{
											if(m.type=='boss')
											{
												n+=' (BOSS)';	
											}
											
											cu=p.lv+'-'+m.lv;
											if(!text[cu])
											{
												text[cu]=p.target_color(m.lv);
											}
											cl=text[cu];
										}
										_.lionica.render.ctx.font = '10px Tahoma';
										_.lionica.render.ctx.textAlign = 'center';
										_.lionica.render.ctx.fillStyle = '#000';
										_.lionica.render.ctx.fillText(n, m.pos[0]+(m.size.w/2), m.pos[1]);
										_.lionica.render.ctx.fillStyle = cl;
										_.lionica.render.ctx.fillText(n, m.pos[0]+(m.size.w/2)-1, m.pos[1]-1);
									}
								}
								else if(loc[c].type=='pet')
								{
									m=_.lionica.pet.obj[loc[c].id];
									//$('.inventory .text').html('2');
									if(!m || !m.loaded)
									{
										continue;
									}
									//$('.inventory .text').html(JSON.stringify(m));
									l=(m.no-1)% 5;
									t=Math.floor((m.no-1)/5);
									s=((l*32*3)+32);
									if(_.lionica.sw1==2)
									{
										s-=32
									}
									else if(_.lionica.sw1==4)
									{
										s+=32;
									}
									//$('.inventory .text').html(s+' - '+(m.face*48));
									_.lionica.render.ctx.drawImage(_.lionica.sprite.pet, s, (t*192)+(m.face*48),32,48,m.pos[0],m.pos[1],32,48);
								}
								else if(loc[c].type=='warp')
								{
									_.lionica.render.ctx.drawImage(_.lionica.sprite.warp, (_.lionica.sw2%5)*32, Math.floor(_.lionica.sw1/5)*32, 32, 32, x*32, y*32, 32, 32);
								}
								else if(loc[c].type=='farm')
								{
									m=_.lionica.monster[loc[c].id];
									
									_.lionica.render.ctx.drawImage(_.lionica.sprite.farm,m.farm.st*32,128,32,32,x*32, y*32,32,32);
									//$('.inventory .text').html(m.farm.pl*96,m.farm.pl);
									switch(m.farm.st)
									{
										case 4:
										case 5:
										_.lionica.render.ctx.drawImage(_.lionica.sprite.farm,m.farm.pl*96,m.farm.gd*32,32,32,x*32, y*32,32,32);
										break;
										case 6:
										_.lionica.render.ctx.drawImage(_.lionica.sprite.farm,(m.farm.pl*96)+32,m.farm.gd*32,32,32,x*32, y*32,32,32);
										break;
										case 7:
										_.lionica.render.ctx.drawImage(_.lionica.sprite.farm,(m.farm.pl*96)+64,m.farm.gd*32,32,32,x*32, y*32,32,32);
										break;
									}
									if(m.farm.du&&m.farm.td)
									{
										var t=Math.floor(m.farm.du.sec)+Math.floor(m.farm.td)-time;
										if(t>0)
										{
											if(m.farm.p==_.lionica.player.char._id)
											{
												if(m.farm.st==7)
												{
													_.lionica.render.ctx.fillStyle = '#006600';
												}
												else
												{
													_.lionica.render.ctx.fillStyle = '#000';
												}
											}
											else
											{
												_.lionica.render.ctx.fillStyle = '#666';
											}	
											_.lionica.render.ctx.fillRect((x*32)+2, (y*32)-9,27,11);
											var s=t%60,mi=Math.floor(t/60);
											_.lionica.render.ctx.font = '10px Tahoma';
											_.lionica.render.ctx.textAlign = 'center';
											_.lionica.render.ctx.fillStyle = '#fff';
											_.lionica.render.ctx.fillText(mi+':'+s, (x*32)+15, (y*32));
										}
									}
								}
								else if(_.lionica.render.s.people&&(loc[c].type=='people'||loc[c].type=='vender'))
								{
									m=_.lionica.people.obj['p'+loc[c].id];
									if(!m)
									{
										continue;	
									}
									cp=[
												[m.draw[0][0],m.draw[0][1]+(m.face*48)],
												[m.draw[1][0],m.draw[1][1]+(m.face*48)],
												false,
												false,
												false
											];
									
									
									if(m.head)
									{
										cp[3]=[((m.head-401)*96)+32,576+(m.face*48)];	
									}
									if(m.back)
									{
										cp[4]=[((m.back-451)*96)+32+2016,384+(m.face*48)];	
									}
								
									if(m.swinging)
									{
										if(_.lionica.sw1==2)
										{
											cp[0][0]-=32;
											cp[1][0]-=32;
											if(cp[3])
											{
												cp[3][0]-=32;	
											}
											if(cp[4])
											{
												cp[4][0]-=32;	
											}
										}
										else if(_.lionica.sw1==4)
										{
											cp[0][0]+=32;
											cp[1][0]+=32;
											if(cp[3])
											{
												cp[3][0]+=32;	
											}
											if(cp[4])
											{
												cp[4][0]+=32;	
											}
										}
									}
									//$('.inventory .text').html(cp[0][0]+':'+cp[0][1]+' - '+cp[1][0]+':'+cp[1][1]+' - ');
									
									if(cp[4]&&m.face==0)
									{
										_.lionica.render.ctx.drawImage(_.lionica.sprite.char, cp[4][0], cp[4][1], 32, 48, m.pos[0], m.pos[1], 32, 48);
									}
									_.lionica.render.ctx.drawImage(_.lionica.sprite.char, cp[1][0], cp[1][1], 32, 48, m.pos[0], m.pos[1], 32, 48);
									_.lionica.render.ctx.drawImage(_.lionica.sprite.char, cp[0][0], cp[0][1], 32, 48, m.pos[0], m.pos[1], 32, 48);
									if(cp[3])
									{
										_.lionica.render.ctx.drawImage(_.lionica.sprite.char, cp[3][0], cp[3][1], 32, 48, m.pos[0], m.pos[1], 32, 48);
									}
									if(cp[4]&&m.face>0)
									{
										_.lionica.render.ctx.drawImage(_.lionica.sprite.char, cp[4][0], cp[4][1], 32, 48, m.pos[0], m.pos[1], 32, 48);
									}
									
									_.lionica.render.ctx.font = '10px Tahoma';
									_.lionica.render.ctx.textAlign = 'center';
									_.lionica.render.ctx.fillStyle = '#000';
									_.lionica.render.ctx.fillText(m.n, m.pos[0]+16, m.pos[1]);
									_.lionica.render.ctx.fillStyle = '#fff';
									_.lionica.render.ctx.fillText(m.n, m.pos[0]+15, m.pos[1]-1);
									
									if(loc[c].type=='vender')
									{	
										_.lionica.render.ctx.beginPath();
										_.lionica.render.ctx.rect(m.pos[0],m.pos[1]+20,32,20);
										_.lionica.render.ctx.fillStyle = '#fff';
										_.lionica.render.ctx.fill();
										_.lionica.render.ctx.lineWidth = 1;
										_.lionica.render.ctx.strokeStyle = '#000';
										_.lionica.render.ctx.stroke();
										_.lionica.render.ctx.font = '11px Tahoma';
										_.lionica.render.ctx.textAlign = 'center';
										_.lionica.render.ctx.fillStyle = '#000';
										_.lionica.render.ctx.fillText('ร้านค้า', m.pos[0]+16, m.pos[1]+34);
										
									}
								}
							}
						}
					}
					if(y==p.cur[1] && dp)
					{
						dp=false;
						if(ch[2]&&(p.face%2==1))
						{
							_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[2][0], ch[2][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						}
						if(ch[4]&&p.face==0)
						{
							_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[4][0], ch[4][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						}
						_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[1][0], ch[1][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[0][0], ch[0][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						if(ch[2]&&(p.face%2==0))
						{
							_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[2][0], ch[2][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						}
						if(ch[3])
						{
							_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[3][0], ch[3][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						}
						if(ch[4]&&p.face>0)
						{
							_.lionica.render.ctx.drawImage(_.lionica.sprite.char, ch[4][0], ch[4][1], 32, 48, p.pos[0], p.pos[1], 32, 48);
						}
						_.lionica.render.ctx.fillStyle="#333";
						_.lionica.render.ctx.fillRect(p.pos[0],p.pos[1]+50,32,2);
						_.lionica.render.ctx.fillRect(p.pos[0],p.pos[1]+53,32,2);
						var hp=Math.floor((p.char.hp/p.char.mhp)*32);
						if(hp>0)
						{
							_.lionica.render.ctx.fillStyle="#f00";
							_.lionica.render.ctx.fillRect(p.pos[0],p.pos[1]+50,hp,2);
						}
						var mp=Math.floor((p.char.mp/p.char.mmp)*32);
						if(mp>0)
						{
							_.lionica.render.ctx.fillStyle="#09f";
							_.lionica.render.ctx.fillRect(p.pos[0],p.pos[1]+53,mp,2);
						}
						
						if(p.char.g&&p.char.g.n)
						{
							_.lionica.render.ctx.font = '10px Tahoma';
							_.lionica.render.ctx.textAlign = 'center';
							_.lionica.render.ctx.fillStyle = '#000';
							_.lionica.render.ctx.fillText(p.char.g.n, p.pos[0]+16, p.pos[1]-10);
							_.lionica.render.ctx.fillStyle = '#fff';
							_.lionica.render.ctx.fillText(p.char.g.n, p.pos[0]+15, p.pos[1]-11);
						}
					}
				}
				_.lionica.stats.end();
			}
			//this.x += 10 * dt; 
		},
		stop:function()
		{
			cancelAnimationFrame(_.lionica.render.tmr);	
		}
	},
	draw:{
		life:function(y,x)
		{
			var v=_.lionica.map.life[y+'_'+x]||'';
			if(v)
			{
				_.lionica.monster[x+'_'+y]=new _.lionica.objs(v,x,y);
			}
		},
		object:function(ctx,y,x)
		{
			var v=_.lionica.map.object[y+'_'+x]||[],p;
			if(v.length>0)
			{
				for(var i=0;i<v.length;i++)
				{
					p=v[i].split('-');
					ctx.drawImage(_.lionica.sprite.map, (Math.floor(p[0])*32), (Math.floor(p[1])*32),(Math.floor(p[2])*32),(Math.floor(p[3])*32),x*32,y*32,(Math.floor(p[2])*32),(Math.floor(p[3])*32));
				}
			}
		},
		tile1:function(ctx,y,x)
		{
			var v=_.lionica.map.tile[y+'_'+x]||[];
			if(v.length>0)
			{
				for(var i=0;i<v.length;i++)
				{
					var partsData = _.lionica.draw.tiling.create(_.lionica.draw.findtile(y,x,v[i]));
					var j, partDat, part,sp=v[i].split('-'),sx=Math.floor(sp[1])*32,sy=Math.floor(sp[0])*32;
					for (j = 0; j < partsData.length; j++)
					{
						partDat = partsData[j];
						ctx.drawImage(_.lionica.sprite.map, (sx+partDat[1][1]), (sy+partDat[1][0]),16,16,(x*32)+partDat[0][1],(y*32)+partDat[0][0],16,16);
					}
				}
			}
		},
		tiling:
		{
			TILE_SIZE:[32, 32],
			TILE_PART_SIZE:[16, 16],
			TILE_SET_SIZE:[64, 96],
			TILE_SPECIFICATIONS:{
				'a': {
					'00000': [64, 32],
					'10000': [32, 32],
					'00010': [64,  0],
					'10010': [32,  0],
					'00001': [ 0, 32]
				},
				'b': {
					'00000': [64, 16],
					'10000': [32, 16],
					'01000': [64, 48],
					'11000': [32, 48],
					'00001': [ 0, 48]
				},
				'c': {
					'00000': [48, 16],
					'01000': [48, 48],
					'00100': [80, 16],
					'01100': [80, 48],
					'00001': [16, 48]
				},
				'd': {
					'00000': [48, 32],
					'00100': [80, 32],
					'00010': [48,  0],
					'00110': [80,  0],
					'00001': [16, 32]
				}
			},
			todata:function(data){
				var a = [0, 0, 0, 0, 0];
				var b = [0, 0, 0, 0, 0];
				var c = [0, 0, 0, 0, 0];
				var d = [0, 0, 0, 0, 0];
				if (data[0]) { a[0] += 1; b[0] += 1; }
				if (data[1]) b[4] += 1;
				if (data[2]) { b[1] += 1; c[1] += 1; }
				if (data[3]) c[4] += 1;
				if (data[4]) { c[2] += 1; d[2] += 1;}
				if (data[5]) d[4] += 1;
				if (data[6]) { a[3] += 1; d[3] += 1; }
				if (data[7]) a[4] += 1;
				return [
					_.lionica.draw.tiling.TILE_SPECIFICATIONS.a[a.join('')],
					_.lionica.draw.tiling.TILE_SPECIFICATIONS.b[b.join('')],
					_.lionica.draw.tiling.TILE_SPECIFICATIONS.c[c.join('')],
					_.lionica.draw.tiling.TILE_SPECIFICATIONS.d[d.join('')]
				];
			},
			tobound:function(data){
				var bd = [0, 0, 0, 0, 0, 0, 0, 0];
				var n = data; // Compact variable name
				if (n[0][1] === 0) bd[0]++; // top
				if (n[0][1] === 1 && n[0][2] === 0 && n[1][2] === 1) bd[1]++; // top-right
				if (n[1][2] === 0) bd[2]++; // right
				if (n[1][2] === 1 && n[2][2] === 0 && n[2][1] === 1) bd[3]++; // bottom-right
				if (n[2][1] === 0) bd[4]++; // bottom
				if (n[2][1] === 1 && n[2][0] === 0 && n[1][0] === 1) bd[5]++; // bottom-left
				if (n[1][0] === 0) bd[6]++; // left
				if (n[1][0] === 1 && n[0][0] === 0 && n[0][1] === 1) bd[7]++; // top-left
				return bd;
			},
			create:function(data){
				var data = _.lionica.draw.tiling.tobound(data);
				var partsData = _.lionica.draw.tiling.todata(data);
				return [// Merge part position in tile
					[[0, 0],                                         partsData[0]],
					[[0, _.lionica.draw.tiling.TILE_PART_SIZE[0]],                     partsData[1]],
					[[_.lionica.draw.tiling.TILE_PART_SIZE[1], _.lionica.draw.tiling.TILE_PART_SIZE[0]], partsData[2]],
					[[_.lionica.draw.tiling.TILE_PART_SIZE[1], 0],                     partsData[3]]//,
				];
			}
		},	
		find:function(v,f,type)
		{
			var vl=[],p;
			if(type=='all')
			{
				for(var i=0;i<v.length;i++)
				{
					if(v[i]==f)
					{
						return true;	
					}
				}
			}
			else if(type=='type')
			{
				for(var i=0;i<v.length;i++)
				{
					p=v[i].split('-');
					if(p[0]==f)
					{
						return true;	
					}
				}
			}
			return false;
		},
		findtile:function(y,x,tile)
		{
			var getTileType = function(y,x, t, l){
				var n = _.lionica.map.tile[(y+t)+'_'+(x+l)]||[];
				if (n.length==0) return 0;
				if(_.lionica.draw.find(n,tile,'all'))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			};
			return [
				[
					getTileType(y,x, -1, -1),
					getTileType(y,x, -1, 0),
					getTileType(y,x, -1, +1)
				],
				[
					getTileType(y,x, 0, -1),
					getTileType(y,x, 0, 0),
					getTileType(y,x, 0, +1)
				],
				[
					getTileType(y,x, +1, -1),
					getTileType(y,x, +1, 0),
					getTileType(y,x, +1, +1)
				]
			];
		}
	},
	player:
	{
		_id:0,next:false,stepwalk:false,offsetY:-16,face:0,
		select:function()
		{
			if(arguments.length>0)
			{
				_.lionica.player._id=arguments[0];
				$('.btn-delete,.btn-play').removeProp('disabled');
				$('#lionica_character .select').removeClass('select');
				$('#lionica_character .char-'+_.lionica.player._id).addClass('select');
			}
			else
			{
				clearTimeout(_.lionica.tmrai);
				clearTimeout(_.lionica.tmrfm);
				_.lionica.loaded=false;
				_.lionica.render.stop();
				_.lionica.eai=false;
				_.ajax.gourl('/lionica/play','select');
			}
		},
		play:function()
		{
			$('#lionica_game').css({'display':'none'});
			$('#lionica_loading').css({'display':'block'});
			_.ajax.gourl('/lionica/play','play',{'_id':_.lionica.player._id});
		},
		delete:function()
		{
			if(confirm('ต้องการลบตัวละครนี้หรือไม่'))
			{
				_.ajax.gourl('/lionica/play','delete',{'_id':_.lionica.player._id});
			}
		},
		create:function()
		{
			$('#lionica_character').animate({left:'100px'},500,function(){
				$('#lionica_create').css({'opacity':0,'display':'block'}).animate({'opacity':1},1000);
				_.lionica.player.preview();
			});
		},
		created:function()
		{
			$('#lionica_create').animate({'opacity':0},1000,function(){
				$('#lionica_character').animate({left:'235px'},500);
				$('#lionica_create').css('display','none');
			});
		},
		preview:function()
		{
			var v='char char-class-'+$('.new_job:checked').val()+'-'+$('.new_gender:checked').val()+' char-head-'+$('.new_gender:checked').val()+'-'+$('.new_hair:checked').val()+'-'+$('.new_color:checked').val()+' char-s ';
			$('#new_preview_d').prop('class',v+'char-d');
			$('#new_preview_l').prop('class',v+'char-l');
			$('#new_preview_r').prop('class',v+'char-r');
			$('#new_preview_u').prop('class',v+'char-u');
			_.lionica.swing();
		},
		warp:function(l)
		{
			clearTimeout(_.lionica.player.tmr);
			_.lionica.path=[];
			_.lionica.rindex=0;
			_.lionica.player.swinging=false;
			_.lionica.player.stepwalk=false;
			_.lionica.player.cur=l;
			_.lionica.player.pos=[_.lionica.player.cur[0]*32,(_.lionica.player.cur[1]*32)-16];
			_.lionica.center();
		},
		stats:function()
		{
			var p=_.lionica.player.char.stats,rq;
			$.each(['str','agi','vit','dex','int'],function() {
                rq=Math.floor((p[this] - 2)/10)+2;
				if((rq>p.ptr)||(p[this]>=99))
				{
					$('#char_'+this+'_up').hide();
				}
				else
				{
					$('#char_'+this+'_up').show();
				}
            });
		},
		target_color:function(lv)
		{
			var co='#F00',p=_.lionica.player.char;
			if(p.lv>=lv)
			{
				co='#FFF';	
			}
			else if(p.lv>=lv-1)
			{
				co='#FC0';	
			}
			else if(p.lv>=lv-2)
			{
				co='#F90';	
			}
			else if(p.lv>=lv-3)
			{
				co='#F60';	
			}
			else if(p.lv>=lv-4)
			{
				co='#F30';
			}
			return co;
		},
		target:function(to)
		{
			_.lionica.box('target','block');
			if(to.type=='npc'||to.type=='warp'||to.type=='farm'||to.type=='vender')
			{
				$('#target_name').css({'color':'#0cf'}).html(to.name);
				$('#target_hp').css('background-position','0px 0px').html(to.detail);
			}
			else
			{	
				$('#target_name').css({'color':_.lionica.player.target_color(to.lv)}).html(to.name);
				$('#target_hp').css('background-position','150px 0px').html(to.hp?to.hp.formatMoney(0,',','.')+' / '+to.hp.formatMoney(0,',','.'):'');
			}
		},
		lock:function()
		{
			if(_.lionica.attacking.lock)
			{
				var p=_.lionica.player,t=_.lionica.attacking.lock,v=_.lionica.routing(p.cur,t.cur),x=v.length,far={1:2,2:3,3:3,4:2};
				
				if(t.type=='npc')
				{
					if(x<=3)
					{	
						p.swinging=false;			
						$('#click_go').remove();
						_.lionica.api('position',{'x':t.x,'y':t.y});
						return true;
					}
				}
				else if(t.type=='vender')
				{
					if(x<=3)
					{
						p.swinging=false;	
						_.lionica.box('shop','block');
						$('.shop .name .text').html('ร้านค้า');
						$('.shop_text').html('<p style="padding:10px;text-align:center">กรุณารอซักครู่</p>');
						_.lionica.api('vender',{'type':'shop','shop':t.vender});
						return true;
					}
				}
				else if(t.type=='monster'||t.type=='boss')
				{
					if(x<=far[p.char.job])
					{
						p.swinging=false;
						var b3=0,c;
						var l,l1,l2,i;
						$('#click_go').remove();
						
						if(t.hide==0)
						{
							t.hide=1;
							setTimeout(function(){t.clear();t.hide=0;},11000);
							var sk=[];
							$('input[name="skill"]:checked').each(function() {sk[sk.length]=$(this).val();});
							_.lionica.api('position',{'x':t.x,'y':t.y,'skill':sk});
						}
						if(_.lionica.eai)
						{
							clearTimeout(_.lionica.tmrai);
							_.lionica.tmrai=setTimeout(function(){_.lionica.startai()},15000);
						}
						return true;
					}
				}
				else if(t.type=='warp')
				{
					if(x<=1)
					{	
						p.swinging=false;			
						$('#click_go').remove();
						_.lionica.api('position',{'x':t.x,'y':t.y});
						return true;
					}
				}
				else if(t.type=='farm')
				{
					if(x<=1)
					{
						p.swinging=false;		
						$('#click_go').remove();
						_.lionica.api('farm',{'x':t.x,'y':t.y});
						return true;
					}
				}
			}
			return false;
		},
		walk:function()
		{
			clearTimeout(_.lionica.player.tmr);
			var p=_.lionica,m,pcur=[],i;
	
			if(p.path.length-1>p.rindex)
			{
				i=p.rindex+1;
				pcur[0] = p.path[i][0];
				pcur[1] = p.path[i][1];
				if(p.player.cur[0]>pcur[0])
				{
					p.player.face=1;
				}
				else if(p.player.cur[0]<pcur[0])
				{
					p.player.face=2;
				}
				else if(p.player.cur[1]>pcur[1])
				{
					p.player.face=3;
				}
				else
				{
					p.player.face=0;
				}
			}
			
			if(p.player.lock())
			{
				return;	
			}
			
			if(p.path.length-1==p.rindex)
			{
				p.player.swinging=false;
				$('#click_go').remove();
				
				if(p.eai)
				{
					clearTimeout(p.tmrai);
					p.tmrai=setTimeout(function(){p.startai()},3000);
				}
			}
			else
			{
				p.rindex++;
				p.player.mstep=6;
				p.player.swinging=true;
				p.player.step=0;
				p.player.fromstep=p.player.cur;
				p.player.tostep=pcur;
				p.player.tmr=setTimeout(function(){p.player.walking()},50);
				
			}
		},
		walking:function()
		{
			var p=_.lionica.player;
			clearTimeout(p.tmr);
			p.step++;
			if(p.step<p.mstep)
			{
				p.stepwalk=true;
				p.pos=[Math.floor(((((p.tostep[0]-p.fromstep[0])*32)*(p.step/p.mstep))+(p.fromstep[0]*32))),
				Math.floor(((((p.tostep[1]-p.fromstep[1])*32)*(p.step/p.mstep))+(p.fromstep[1]*32)))+p.offsetY];
				p.tmr=setTimeout(function(){p.walking()},50);
			}
			else
			{
				p.stepwalk=false;
				p.cur=p.tostep;
				p.pos=[Math.floor(p.cur[0]*32),Math.floor(p.cur[1]*32)+p.offsetY];
				if(p.next)
				{
					p.go(p.next.x,p.next.y);
					p.next=false;
				}
				else
				{
					p.tmr=setTimeout(function(){p.walk()},50);
				}
			}
		},
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
			if(!_.lionica.loaded)
			{
				return;	
			}
			if(x>=0&&x<=_.lionica.map.width-1&&y>=0&&y<=_.lionica.map.height-1)
			{
				if(_.lionica.player.char.hp>0)
				{	
					_.lionica.box('target','none');
					if(_.lionica.attacking.lock)
					{
						_.lionica.attacking.lock.locked=false;	
					}
					_.lionica.attacking.lock=false;
					if(arguments.length>2)
					{
						if(arguments[2])
						{
							_.lionica.player.target(_.lionica.attacking.lock=arguments[2]);
							_.lionica.attacking.lock.locked=true;
							_.lionica.player.lock();
						}
						else
						{
							var c=_.lionica.render.loc[x+'_'+y],i;
							if(c)
							{
								for(i in c)
								{
									if(c[i].type=='monster'||c[i].type=='boss'||c[i].type=='npc'||c[i].type=='warp'||c[i].type=='farm')
									{
										_.lionica.player.target(_.lionica.attacking.lock=_.lionica.monster[c[i].id]);
										_.lionica.attacking.lock.locked=true;
										break;
									}
									else if(c[i].type=='vender')
									{
										var vd=_.lionica.people.obj['p'+c[i].id];
										_.lionica.attacking.lock={'name':vd.n,'detail':'ร้านค้า','cur':vd.cur,'type':'vender','vender':vd.v};
										_.lionica.player.target(_.lionica.attacking.lock);
										break;
									}
								}
							}
						}
					}
					
					var v=_.lionica.routing(_.lionica.player.cur,[x,y]);
					if((v&&v.length>0))
					{
						$('#click_go').remove();
						$('#map ').prepend('<div id="click_go" style="left:'+(x*32)+'px;top:'+(y*32)+'px"></div>');
						
						if(_.lionica.player.stepwalk)
						{
							_.lionica.player.next={x:x,y:y};
						}
						else
						{
							_.lionica.rindex=0;
							_.lionica.path=v;
							_.lionica.player.walk();
						}
					}
				}
				else
				{
					_.box.alert('ไม่สามารถเคลื่อนที่ได้ในขณะนี้')	
				}
			}
		},
	},
	pet:
	{
		obj:{},
		get:function(id)
		{
			if(!_.lionica.pet.obj[id])
			{
				_.lionica.pet.obj[id]=new _.lionica.pet.clone(id);
			}
			_.lionica.pet.obj[id].go();
		},
		clone:function(id)
		{
			var tmr,sind,step,mto,path=[],ind=0,face=0,cur=false,xy=false,pet={_id:id,loaded:true,face:0,no:0},char=_.lionica.player.char;
			if(id==char._id)
			{
				pet.my=true;
			}
			else
			{
				pet.my=false;
			}
			function getpos()
			{
				var cur=pet.my?_.lionica.player.cur:_.lionica.people.obj['p'+pet._id].cur;
				return [cur[0]-2+Math.floor(Math.random()*3),cur[1]+-2+Math.floor(Math.random()*3)];
			}
			pet.clear=function()
			{
				if(_.lionica.render.loc[pet.xy]&&_.lionica.render.loc[pet.xy]['e'+pet._id])
				{
					delete _.lionica.render.loc[pet.xy]['e'+pet._id];
				}
			}
			pet.go=function()
			{
				var char,cur;
				clearTimeout(tmr);
				if(pet.my)
				{
					char=_.lionica.player.char;
					cur=_.lionica.player.cur;
				}
				else
				{
					if(!_.lionica.people.obj['p'+pet._id])
					{
						pet.loaded=false;
						return;	
					}
					char=_.lionica.people.obj['p'+pet._id];
					cur=char.cur;
				}
				if(!pet.cur)
				{
					pet.cur=getpos();
					pet.pos=[pet.cur[0]*32,(pet.cur[1]*32)-16]
				}
				if(!char.pet)
				{
					if(pet.xy)
					{
						if(_.lionica.render.loc[pet.xy]&&_.lionica.render.loc[pet.xy]['e'+char._id])
						{
							delete _.lionica.render.loc[pet.xy]['e'+char._id];
						}
						pet.xy=false;
					}
					pet.loaded=false;
					return;	
				}
				if(!pet.xy)
				{
					pet.xy=pet.cur[0]+'_'+pet.cur[1];
					if(!_.lionica.render.loc[pet.xy])
					{
						_.lionica.render.loc[pet.xy]={};
					}
					_.lionica.render.loc[pet.xy]['e'+pet.xy]={id:char._id,type:'pet'};
				}
				
				pet.no=char.pet.no;
				pet.loaded=true;
				var v=_.lionica.routing(pet.cur,cur);
				if(v)
				{
					if(v.length>2)
					{
						ind=0;
						path=v;
						walk();
					}
					else
					{
						tmr=setTimeout(function(){pet.go()},3000);
					}
				}
				else
				{
					pet.cur=getpos();
					tmr=setTimeout(function(){pet.go()},3000);
				}
			}
			function walk()
			{
				clearTimeout(tmr);
				if(path.length-2<=ind)
				{
					tmr=setTimeout(function(){pet.go()},3000);
				}
				else
				{
					ind++;
					var pcur=[],nf='';
					pcur[0] = path[ind][0];
					pcur[1] = path[ind][1];
					
					step=6;
					if(pet.cur[0]>pcur[0])
					{
						pet.face=1;
					}
					else if(pet.cur[0]<pcur[0])
					{
						pet.face=2;
					}
					else if(pet.cur[1]>pcur[1])
					{
						pet.face=3;
					}
					else
					{
						pet.face=0;
					}
					sind=0;
					mto=pcur;
					tmr=setTimeout(function(){walking()},80);
				}
			}
			function walking()
			{
				clearTimeout(tmr);
				sind++;
				if(sind<step)
				{
					var pstep=[];
					pstep[0] = Math.floor(((((mto[0]-pet.cur[0])*32)*(sind/step))+(pet.cur[0]*32)));
					pstep[1] = Math.floor(((((mto[1]-pet.cur[1])*32)*(sind/step))+(pet.cur[1]*32)));
					pet.pos=[pstep[0],pstep[1]-16];
					tmr=setTimeout(function(){walking()},80);
				}
				else
				{
					pet.cur=mto;
					pet.pos=[(pet.cur[0]*32),(pet.cur[1]*32)-16];
					
					//$('._plot-'+obj._id).css({'left':obj.pos[0],'top':obj.pos[1]});
					if(_.lionica.render.loc[pet.xy]&&_.lionica.render.loc[pet.xy]['e'+pet._id])
					{
						delete _.lionica.render.loc[pet.xy]['m'+pet._id];
					}
					pet.xy=pet.cur[0]+'_'+pet.cur[1];
					if(!_.lionica.render.loc[pet.xy])
					{
						_.lionica.render.loc[pet.xy]={};
					}
					_.lionica.render.loc[pet.xy]['m'+pet._id]={id:pet._id,type:'pet'};
					tmr=setTimeout(function(){walk()},80);	
				}
			}
			return pet;
		},
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
			var i,c,mon='',tmp='<ul><li><a href="javascript:;" onclick="_.lionica.ai()">'+(_.lionica.eai?'ปิด':'เปิด')+'ระบบช่วยเล่น</a></li>';
			if(_.lionica.menu.npc.length>0)
			{
				tmp+='<li class="lmn-npc"><a href="javascript:;">NPC</a><ul>';
				for(i in _.lionica.menu.npc)
				{
					var n=_.lionica.menu.npc[i];
					tmp+='<li><a href="javascript:;" onclick="_.lionica.player.go('+n[1]+','+n[2]+')">'+n[0]+' ('+n[3]+')</a></li>';
				}
				tmp+='</ul></li>';
			}
			
			for(i in _.lionica.npc)
			{
				c=_.lionica.npc[i];
				if(c.loc&&c.loc.map&&c.loc.map==_.lionica.map._id)
				{
					mon+='<li><a href="javascript:;" onclick="_.lionica.player.go('+c.loc.x+','+c.loc.y+')" style="color:'+_.lionica.player.target_color(c.lv)+'">'+c.name+'</a></li>';
				}
			}
			if(mon)
			{
				tmp+='<li class="lmn-mon"><a href="javascript:;">Monster</a><ul>'+mon+'</ul></li>';
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
			var d=new Date();
			_.lionica.clear.last=d.getTime();
			_.lionica.clear.index=0;
			clearInterval(_.lionica.clear.tmr)	;
			_.lionica.clear.tmr=setInterval(function(){
				_.lionica.clear.index++;	
				if(_.lionica.clear.index%10==0)
				{
					var d=new Date();
					if(d.getTime()-_.lionica.clear.last<8000)
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
				}
			},1000);
		}
	},
	effect:
	{
		resource:{pet1:{},pet2:{},pet3:{},pet4:{},pet5:{},mage:{},heal:{ho:-40},hp:{},mp:{},success:{hs:6},fail:{},dead:{hs:6},evolution:{hs:5}},
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
					.prependTo($('#map '));
				tmr=setInterval(function(){delay()},50);
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
		var ing=false,rnd={npc:7,monster:6,animal:7,boss:4};
		var obj=$.extend({},_.lionica.npc[o]);
		obj.id=o;
		obj.x=x;
		obj.y=y;
		obj._id=x+'_'+y;
		obj.xy=x+'_'+y;
		obj.cur=[x,y];
		obj.to=[x,y];
		obj.hide=0;
		obj.locked=false;
		obj.swinging=obj.swing;
		obj.face=Math.floor(Math.random()*4);
		
		if(obj.size)
		{
			obj.offset={x:Math.ceil((obj.size.w-32)/2),y:obj.size.h-32};
		}
		else
		{
			obj.size={w:32,h:48};	
			obj.offset={x:0,y:16};
		}
		obj.pos=[(x*32)-obj.offset.x,(y*32)-obj.offset.y];
		_.lionica.map.lock[obj.xy]=true;
		
		if(!_.lionica.render.loc[obj.xy])
		{
			_.lionica.render.loc[obj.xy]={};
		}
		_.lionica.render.loc[obj.xy]['m'+obj.xy]={id:obj._id,type:obj.type};
		if(obj.type=='npc')
		{
			_.lionica.menu.npc.push([obj.name,x,y,obj.detail]);
		}			
		else if(obj.type=='farm')
		{
			obj.farm={st:0,pl:0,gd:0};
		}
		var tmr,ind=0,path,mx2,my2,step=6,sind=0,mto;
		
		obj.clear=function()
		{
			
		}
		
		function start()
		{
			clearTimeout(tmr);
			var v=true;
			if(obj.move&&!obj.hide&&!obj.locked)
			{
				if(Math.floor(Math.random()*10)>rnd[obj.type])
				{
					var p=_.lionica.player.cur;
					var x=Math.floor(Math.sqrt(((obj.x-p[0])*(obj.x-p[0]))+((obj.y-p[1])*(obj.y-p[1]))));
					if(x<12)
					{
						var lock=false;
						var x=Math.max(0,obj.x-obj.move);
						var y=Math.max(0,obj.y-obj.move);
						obj.to[0]=Math.min(x+Math.floor(Math.random()*((2*obj.move))),_.lionica.map.width-1);
						obj.to[1]=Math.min(y+Math.floor(Math.random()*((2*obj.move))),_.lionica.map.height-1);
					
						if(_.lionica.map.lock[obj.to[0]+'_'+obj.to[1]])
						{
							lock=true;
						}
					
						if(!lock)
						{
							v=_.lionica.routing(obj.cur,obj.to);
							if(v&&v.length>0)
							{
								delete _.lionica.map.lock[obj.cur[0]+'_'+obj.cur[1]];
								_.lionica.map.lock[obj.to[0]+'_'+obj.to[1]]=true;
								obj.swinging=true;
								ind=0;
								path=v;
								walk();
								v=false;
							}
						}
					}
				}
			}
			else
			{
				obj.face=Math.floor(Math.random()*4);
			}
			if(v)
			{
				tmr=setTimeout(function(){start()},(Math.floor(Math.random()*10)+10)*1000);
			}
		}
		
		function walk()
		{
			clearTimeout(tmr);
			if(path.length-1==ind || obj.locked)
			{
				obj.swinging=obj.swing;
				tmr=setTimeout(function(){start()},(Math.floor(Math.random()*10)+10)*1000);
			}
			else
			{
				ind++;
				var pcur=[],nf='';
				pcur[0] = path[ind][0];
				pcur[1] = path[ind][1];
				
				step=8;
				if(obj.cur[0]>pcur[0])
				{
					obj.face=1;
				}
				else if(obj.cur[0]<pcur[0])
				{
					obj.face=2;
				}
				else if(obj.cur[1]>pcur[1])
				{
					obj.face=3;
				}
				else
				{
					obj.face=0;
				}
				sind=0;
				mto=pcur;
				tmr=setTimeout(function(){walking()},80);
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
				obj.pos=[pstep[0]-obj.offset.x,pstep[1]-obj.offset.y];
				tmr=setTimeout(function(){walking()},80);
			}
			else
			{
				obj.cur=mto;
				obj.pos=[(obj.cur[0]*32)-obj.offset.x,(obj.cur[1]*32)-obj.offset.y];
				
				//$('._plot-'+obj._id).css({'left':obj.pos[0],'top':obj.pos[1]});
				if(_.lionica.render.loc[obj.xy]&&_.lionica.render.loc[obj.xy]['m'+obj._id])
				{
					delete _.lionica.render.loc[obj.xy]['m'+obj._id];
				}
				obj.xy=obj.cur[0]+'_'+obj.cur[1];
				if(!_.lionica.render.loc[obj.xy])
				{
					_.lionica.render.loc[obj.xy]={};
				}
				_.lionica.render.loc[obj.xy]['m'+obj._id]={id:obj._id,type:obj.type};
				tmr=setTimeout(function(){walk()},80);	
			}
		}
		if(rnd[obj.type])
		{
			start();
		}
		return obj;
	},
	people:{
		obj:{},
		get:function(j,c)
		{
			if(!_.lionica.people.obj['p'+j])
			{
				_.lionica.people.obj['p'+j]=new _.lionica.people.clone(j,c);
			}
			_.lionica.people.obj['p'+j].move(j,c);
		},
		clone:function(j,c)
		{
			var cm=$('#map'),play=c,cls='';
			var char=c;
			char.xy=c.x+'_'+c.y;
			char.cur=[c.x,c.y];
			char.pos=[(char.cur[0]*32),(char.cur[1]*32)-16];
			if(!_.lionica.render.loc[char.xy])
			{
				_.lionica.render.loc[char.xy]={};
			}
			_.lionica.render.loc[char.xy]['p'+char._id]={id:char._id,type:(char.v?'vender':'people')};
			
			char.draw=[
												[((c.hair-1)*672)+((c.color-1)*96)+32,((c.gender-1)*192)],
												[((c.job-1)*384)+((c.gender-1)*96)+32,384]
											];
											
											
			var ms=1,tmr,ind=0,path,mx2,my2,step=6,sind=0,mto,nh=c.nh;
		
			char.clear=function()
			{
				if(_.lionica.render.loc[char.xy]&&_.lionica.render.loc[char.xy]['p'+char._id])
				{
					delete _.lionica.render.loc[char.xy]['p'+char._id];
				}
			}
			char.point=function(l)
			{
				char.cur=l;
				char.pos=[l[0]*32,(l[1]*32)-16];
				char.clear();
				char.xy=l[0]+'_'+l[1];
				if(!_.lionica.render.loc[char.xy])
				{
					_.lionica.render.loc[char.xy]={};
				}
				_.lionica.render.loc[char.xy]['p'+char._id]={id:char._id,type:(char.v?'vender':'people')};
				char.swinging=false;
			}
			char.move=function(j,c)
			{
				clearTimeout(tmr);
				var p=_.lionica.player.cur;
				var x=Math.floor(Math.sqrt(((c.x-p[0])*(c.x-p[0]))+((c.y-p[1])*(c.y-p[1]))));
				var x2=Math.floor(Math.sqrt(((char.cur[0]-p[0])*(char.cur[0]-p[0]))+((char.cur[1]-p[1])*(char.cur[1]-p[1]))));
				char.swinging=false;
				char.v=c.v;
				char.head=(c.head?c.head:0);
				char.back=(c.back?c.back:0);
				if(char.pet=c.pet)
				{
					_.lionica.pet.get(char._id);
				}
				if(x>12||x2>12||c.v)
				{
					char.face=c.face;
					char.point([c.x,c.y]);
					return;	
				}
				
				ind=0;
				var v=_.lionica.routing(char.cur,[c.x,c.y]);
				if(v&&v.length>0)
				{
					path=v;
					walk();
				}
				else
				{
					path=[];
					char.face=c.face;
					char.point([c.x,c.y]);
				}
			}
			
			function walk()
			{
				clearTimeout(tmr);
				if(path.length==0)
				{
					
				}
				else if(path.length-1==ind)
				{
					char.point([path[ind][0],path[ind][1]]);
				}
				else
				{
					ind++;
					var pcur=[];
					pcur[0] = path[ind][0];
					pcur[1] = path[ind][1];
					
					step=6;
					if(char.cur[0]>pcur[0])
					{
						char.face=1
					}
					else if(char.cur[0]<pcur[0])
					{
						char.face=2;
					}
					else if(char.cur[1]>pcur[1])
					{
						char.face=3;
					}
					else
					{
						char.face=0;
					}
					char.swinging=true;
					sind=0;
					mto=pcur;
					tmr=setTimeout(function(){walking()},80);
				}
			}
			function walking()
			{
				clearTimeout(tmr);
				sind++;
				if(sind<step)
				{
					char.pos[0] = Math.floor(((((mto[0]-char.cur[0])*32)*(sind/step))+(char.cur[0]*32)));
					char.pos[1] = Math.floor(((((mto[1]-char.cur[1])*32)*(sind/step))+(char.cur[1]*32)))-16;
					tmr=setTimeout(function(){walking()},80);
				}
				else
				{
					char.cur=mto;
					tmr=setTimeout(function(){walk()},80);	
				}
			}
			return char;
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
				$('#btn-sound').css('background-position','-240px -456px');
			}
			else
			{
				var tmp='<p id="sound-map"><audio autoplay loop volume="0.5"><source src="http://s0.boxza.com/static/images/game/lionica/sound/map1.mp3" type="audio/mpeg" /><source src="http://s0.boxza.com/static/images/game/lionica/sound/map1.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="true" src="http://s0.boxza.com/static/images/game/lionica/sound/map1.mp3" /></audio></p>';
				tmp+='<p id="sound-spell"><audio volume="0.5"><source src="http://s0.boxza.com/static/images/game/lionica/sound/spell.mp3" type="audio/mpeg" /><source src="http://s0.boxza.com/static/images/game/lionica/sound/spell.ogg" type="audio/ogg" /><embed hidden="true" autostart="false" loop="false" src="http://s0.boxza.com/static/images/game/lionica/sound/spell.mp3" /></audio></p>';
				$('#psound').html(tmp);
				$('#btn-sound').css('background-position','-216px -456px');
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
		lock:false,
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
			var p=_.lionica.player.cur,f=[],m=[],mf,mt;
			if(_.lionica.player.face==0)
			{
				mf=3;
			}
			else if(_.lionica.player.face==2)
			{
				mf=1;
			}
			else if(_.lionica.player.face==1)
			{
				mf=2;
			}
			else 
			{
				mf=0;
			}
			mt=_.lionica.attacking.monster;
			_.lionica.attacking.pos.pet=_.lionica.player.pos;
			_.lionica.attacking.pos.monster=mt.pos;
			_.lionica.attacking.mons[p[0]+'_'+p[1]]=true;
			
			_.lionica.attacking.index=0;
			_.lionica.attacking.state=1;
			
			var m=_.lionica.attacking.drop.monster;
			_.lionica.player.target(m);
			_.lionica.attacking.hp=m.hp;
			_.lionica.attacking.indeff=0;
			_.lionica.sw1=4;
			_.lionica.swing();
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
				//$('#player').prop('class',_.lionica.player.cls+_.lionica.player.face).css({'left':(_.lionica.player.cur[0]*32),'top':(_.lionica.player.cur[1]*32)+_.lionica.player.offsetY});
				var mt;
				if(mt=_.lionica.attacking.monster)
				{
					if(_.lionica.render.loc[mt.xy]&&_.lionica.render.loc[mt.xy]['m'+mt._id])
					{
						delete _.lionica.render.loc[mt.xy]['m'+mt._id];
					}
				
					if(_.lionica.player.char.job==2)
					{
						mt.hide=1;
						setTimeout(function(){mt.hide=2},1000);
					}
					else
					{
						mt.hide=2;
					}
					setTimeout(function(){mt.clear();mt.hide=0;_.lionica.render.loc[mt.xy]['m'+mt._id]={id:mt._id,type:mt.type}},10000);
				}
				if(_.lionica.attacking.drop.dead=='pet')
				{
					new _.lionica.effect.show('dead',_.lionica.player.cur[0],_.lionica.player.cur[1]);
					if(_.lionica.eai)
					{
						_.lionica.ai();
					}
					setTimeout(function(){
					_.lionica.player.warp(_.lionica.map.start);
					},3000);
				}
				if(_.lionica.eai)
				{
					clearTimeout(_.lionica.tmrai);
					_.lionica.tmrai=setTimeout(function(){_.lionica.startai()},1000);
				}
			}
			else
			{
				if(_.lionica.attacking.indeff==0)
				{
					if(_.lionica.attacking.drop.skill>0)
					{
						_.lionica.attacking.drop.skill--;
						_.lionica.sound.play('spell');
						new _.lionica.effect.show('pet1',_.lionica.attacking.monster.cur[0],_.lionica.attacking.monster.cur[1]);
					}
					else if(_.lionica.player.char.job==2)
					{
						_.lionica.sound.play('spell');
						new _.lionica.effect.show('mage',_.lionica.attacking.monster.cur[0],_.lionica.attacking.monster.cur[1]);
					}
				}
				if(_.lionica.attacking.indeff>30)
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
						$('#char_hp_text').html(_.lionica.attacking.php+' / '+_.lionica.player.char.mhp);
						$('#char_hp_bar').css({'width':Math.floor((_.lionica.attacking.php/_.lionica.player.char.mhp)*100)+'%'});
						
					}
					else
					{				
						_.lionica.attacking.hp-=t.atk;
						if(_.lionica.attacking.hp<0)
						{
							_.lionica.attacking.hp=0;
						}
						var m=_.lionica.attacking.drop.monster,hp=Math.floor((_.lionica.attacking.hp/m.hp)*150);
						$('#target_hp').css('background-position',hp).html(_.lionica.attacking.hp.formatMoney(0,',','.')+' / '+m.hp.formatMoney(0,',','.'));
					}
				}
				d.prependTo($('#map ')).animate({'top':'-=30px'},300, 'linear', function(){setTimeout(function(){d.remove();},500)});
				_.lionica.attacking.index++;
				_.lionica.attacking.tmr=setTimeout(function(){_.lionica.attacking.delay()},100);
			}
		}
	},
	center:function()
	{
		var p=_.lionica.player,l=Math.floor(p.pos[0]/8),t=Math.floor(p.pos[1]/8);
		$('#minimap_xy').html(_.lionica.map.name+': '+(p.cur[0]+1)+','+(p.cur[1]+1));
		$('#plot').css({'left':l,'top': t});
		$('#map_move').css({'top':((p.pos[1]-_.lionica.hheight)*-1),'left':((p.pos[0]-_.lionica.hwidth)*-1)});
		t=((t-90)*-1);
		l=((l-90)*-1);
		if(t>0)
		{
			t=0;
		}
		else if(180-(_.lionica.mscale*_.lionica.map.height)>t)
		{
			t=180-(_.lionica.mscale*_.lionica.map.height);
		}
		if(l>0)
		{
			l=0;
		}
		else if(180-(_.lionica.mscale*_.lionica.map.width)>l)
		{
			l=180-(_.lionica.mscale*_.lionica.map.width);
		}
		
		$('.minimap_move').css({'top':t,'left':l});
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
			if($('._inp-ai-lock:checked').length)
			{
				_.lionica.player.lockai=[_.lionica.player.cur[0],_.lionica.player.cur[1]];
				$('._btn-ai').val('หยุดการทำงาน (Lock)');
			}
			else
			{
				_.lionica.player.lockai=false;	
				$('._btn-ai').val('หยุดการทำงาน');
			}
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
			if(hp<=Math.floor((_.lionica.player.char.hp/_.lionica.player.char.mhp)*100)&&mp<=Math.floor((_.lionica.player.char.mp/_.lionica.player.char.mmp)*100))
			{		
				if(_.lionica.attacking.state==0)
				{
					_.lionica.tmrai=setTimeout(function(){_.lionica.findmon()},100);
				}
			}
			else
			{
				_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] HP/MP ไม่เพียงพอ ระบบกำลังรอฟื้นค่า HP/MP (20 วินาที)</p>'}]);
				_.lionica.tmrai=setTimeout(function(){_.lionica.startai()},20000);
			}
		}
	},
	findmon:function()
	{
		clearTimeout(_.lionica.tmrfm);
		var i,f=-1,x,c,p=(_.lionica.player.lockai?_.lionica.player.lockai:_.lionica.player.cur);
		for(i in _.lionica.monster)
		{
			if(_.lionica.monster.hasOwnProperty(i))
			{
				c=_.lionica.monster[i];
				if(c.hide>0||(c.type!='monster'&&c.type!='boss'))
				{
					continue;	
				}
				x=Math.floor(Math.sqrt(((c.cur[0]-p[0])*(c.cur[0]-p[0]))+((c.cur[1]-p[1])*(c.cur[1]-p[1]))));
				if(x>12)
				{
					continue;	
				}
				 if(x=_.lionica.routing(p,c.cur))
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
		if(f>-1)
		{
			_.lionica.npc[to.id].lock=true;
			_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] พบ '+to.name+' ['+(to.cur[0]+1)+','+(to.cur[1]+1)+']</p>'}]);
			_.lionica.player.go(to.cur[0],to.cur[1],to);
		}
		else
		{
			_.lionica.logs([{'type':'','text':'<p class="logs-info">[AI] ไม่พบมอนสเตอร์ในบริเวณนี้</p>'}]);
		}
	},
	swing:function()
	{
		clearTimeout(_.lionica.tmrswing);
		_.lionica.sw1++
		_.lionica.sw2++
		if(_.lionica.sw1>4)_.lionica.sw1=1;
		if(_.lionica.sw2>20)_.lionica.sw2=1;
		_.lionica.tmrswing=setTimeout(function(){_.lionica.swing()},200);
	},
	api:function(a,b)
	{
		if(_.lionica.loaded&&_.lionica.khash)
		{
			var d=new Date();
			//if(d.getTime()-_.lionica.clear.last>19000){clearTimeout(_.lionica.tmrai);_.lionica.khash="";_.lionica.eai=false;_.lionica.loaded=false;return;}
			b.func=a;
			b.last=_.lionica.lastchat;
			b.pos={'x':_.lionica.player.cur[0],'y':_.lionica.player.cur[1],'z':_.lionica.player.face};
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
	enhance:function(a,b,c,d,e){var n=$(a).find('span').text();
	if(e=='enhance')
	{
		if(confirm('ต้องการเพิ่มประสิทธิภาพให้กับ '+n+' จาก '+c+'->'+(c+1)+' โดยใช้ '+(d>1?'Defence':'Attack')+' Crystal กับเงิน 100 Silver หรือไม่')){_.lionica.api('blacksmith',{'type':'enhance','item':b});}
	}
	else
	{
		var ele={321:'ดิน',322:'น้ำ',323:'ไฟ',324:'ลม',325:'สายฟ้า'};
		if(confirm('ต้องการหลอมธาตุ'+ele[_.lionica.tmp]+' กับ '+n+' หรือไม่')){
			_.lionica.api('blacksmith',{'type':'element','item':b,'stone':_.lionica.tmp});
		}
	}
	},
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
						$('#map ').prepend('<div id="lionica-balloon"></div>');
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
		.on({click:_.lionica.chat.popup},'.lionica-profile')
		.on({dblclick:_.lionica.inventory.use},'.inv-use')
		.on({dblclick:_.lionica.inventory.unuse},'.inv-unuse')
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
		$(window).resize(_.lionica.resize);
		
		
		$('.minimap_text').click(function(e){
			_.lionica.player.go(
									Math.floor((e.pageX - $('.minimap_div').offset().left - $('.minimap_move').position().left)/_.lionica.mscale),
									Math.floor((e.pageY - $('.minimap_div').offset().top - $('.minimap_move').position().top)/_.lionica.mscale)
								);
		});
		$('#map').click(function(e){
			_.lionica.player.go(
			Math.floor((e.pageX - $('#lionica').position().left - $('#map_move').position().left)/32),
			Math.floor((e.pageY - $('#lionica').position().top - $('#map_move').position().top)/32),
			false
			);
		})
		.mousemove(_.lionica.render.mouse)
		.disableSelection();
		_.lionica.swing();
		_.lionica.sound.open();
		
		if(_.lionica.monster)
		{
			for(var i in _.lionica.monster)
			{
				delete _.lionica.monster[i];
			}
		}
		if(_.lionica.people.obj)
		{
			for(var i in _.lionica.people.obj)
			{
				delete _.lionica.people.obj[i];
			}
		}
		if(_.lionica.pet.obj)
		{
			for(var i in _.lionica.pet.obj)
			{
				delete _.lionica.pet.obj[i];
			}
		}
		
		
		if(_.lionica.stats)
		{
			$(_.lionica.stats.domElement).remove();
			delete _.lionica.stats;
		}
		_.lionica.stats = new Stats();
		_.lionica.stats.setMode(1); // 0: fps, 1: ms
		$(_.lionica.stats.domElement).css({'position':'absolute','right':5,'bottom':203}).appendTo($('#lionica'));
		
		_.lionica.player.lv=0;
		_.lionica.player.cls='char char-'+_.lionica.player.char.job+'-'+_.lionica.player.char.gender+'-'+_.lionica.player.char.hair+'-'+_.lionica.player.char.color+' char-';
		_.lionica.monster={};
		_.lionica.menu.npc=[];
		_.lionica.map.lock={};
		_.lionica.render.loc={};
		_.lionica.people.obj={};
		_.lionica.pet.obj={};
		$('#lionica .mons').remove();
		$('#lionica ._plot').remove();
		var w=_.lionica.map.width,h=_.lionica.map.height,x,y,z,l,l2,l3,g,p='',b,m,move=['d','l','r','u'],bs='';
		$('#map_weather').css({'width':w*32,'height':h*32});
		var cv=$('#map_canvas');
		var cv3=$('#life_canvas');
		cv.width(w*32).height(h*32).attr({'width':w*32,'height':h*32});
		cv3.width(w*32).height(h*32).attr({'width':w*32,'height':h*32});
		var canvas=cv.get(0);
		var ctx=canvas.getContext('2d');
		_.lionica.render.cv=cv3.get(0);
		_.lionica.render.ctx=_.lionica.render.cv.getContext('2d');
		_.lionica.render.width=w*32;
		_.lionica.render.height=h*32;
		var cv2=$('#minimap_canvas');
		cv2.width(w*_.lionica.mscale).height(h*_.lionica.mscale).attr({'width':w*_.lionica.mscale,'height':h*_.lionica.mscale});
		var ctx2=cv2.get(0).getContext('2d');
		_.lionica.sprite.map=$('#sprite-map').get(0);
		_.lionica.sprite.char=$('#sprite-char').get(0);
		_.lionica.sprite.item=$('#sprite-item').get(0);
		_.lionica.sprite.npc=$('#sprite-npc').get(0);
		_.lionica.sprite.monster=$('#sprite-monster').get(0);
		_.lionica.sprite.boss=$('#sprite-boss').get(0);
		_.lionica.sprite.warp=$('#sprite-warp').get(0);
		_.lionica.sprite.farm=$('#sprite-farm').get(0);
		_.lionica.sprite.pet=$('#sprite-pet').get(0);
		//_.lionica.sprite.animal=$('#sprite-animal').get(0);
		var o,ontop=[],i;
		_.lionica.clear.load();
		
		var dx=Math.floor(_.lionica.map.bg[0])*32,dy=Math.floor(_.lionica.map.bg[1])*32;
		for(y=0;y<h;y++)
		{
			for (x=0;x<w;x++)
			{
					ctx.drawImage(_.lionica.sprite.map, dx, dy,32,32,x*32,y*32,32,32);
			}
		}
		for(y=0;y<h;y++)
		{
			for (x=0;x<w;x++)
			{
				_.lionica.draw.tile1(ctx,y,x);
			}
		}
		for(y=0;y<h;y++)
		{
			for (x=0;x<w;x++)
			{
				_.lionica.draw.object(ctx,y,x);
			}
		}
		for(y=0;y<h;y++)
		{
			for (x=0;x<w;x++)
			{
	    		_.lionica.draw.life(y,x);
			}
		}
		ctx2.drawImage(canvas, 0, 0,w*32,h*32,0,0,w*_.lionica.mscale,h*_.lionica.mscale);
		
		$('.minimap .name .text').html(_.lionica.map.name+': <span id="minimap_xy"></span> (<a href="http://game.boxza.com/lionica/info/map/'+_.lionica.map._id+'" target="_blank" style="color:#fff">ข้อมูลเพิ่มเติม</a>)');
		_.lionica.player.warp(_.lionica.player.cur);
		
		_.ajax.cursor=false;
		_.lionica.loaded=true;
		_.lionica.render.start();
		_.lionica.player.stats();
		//_.lionica.center(_.lionica.player.cur);
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
		_.lionica.player.char=a;
		_.lionica.lastchat=a.lastchat;
		_.lionica.charup();
		if(a.chat)
		{
			_.lionica.chat.parse(a.chat);
		}
		if(a.online)
		{
			var t=''+Math.floor(Math.random()*100000),j,l,p,pv;
			var cn=$('.minimap_text'),cm=$('#map ');
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
					l.data('lasttime',t).css({'left':c.x*_.lionica.mscale,'top':c.y*_.lionica.mscale});
					_.lionica.people.get(j,c);
					$('#_player-'+j).data('lasttime',t)
				}
			}
			$('.plot.online').each(function() {
				if($(this).data('lasttime')!=t)
				{
					var jd=$(this).data('pet');
					if(_.lionica.people.obj['p'+jd])
					{
						_.lionica.people.obj['p'+jd].clear();
						delete _.lionica.people.obj['p'+jd];
					}
					if(_.lionica.pet.obj[jd])
					{
						_.lionica.pet.obj[jd].clear();
						delete _.lionica.pet.obj[jd];
					}
					$(this).remove();
				}
			});
		}
		if(a.farms)
		{
			for(var m in _.lionica.monster)
			{
				if(_.lionica.monster[m].type=='farm')
				{
					_.lionica.monster[m].farm={st:0};
				}
			}
			for(var xy in a.farms)
			{
				_.lionica.monster[xy].farm=a.farms[xy];
			}
		}
	},
	charup:function()
	{
		var a=_.lionica.player.char,w=(a.xp/a.mxp)*100;
		$('#char_lv').html(a.lv);
		$('#char_hp_text').html(a.hp.formatMoney(0,',','.')+' / '+a.mhp.formatMoney(0,',','.'));
		$('#char_hp_bar').css({'width':Math.floor((a.hp/a.mhp)*100)+'%'});
		$('#char_mp_text').html(a.mp+' / '+a.mmp);
		$('#char_mp_bar').css({'width':Math.floor((a.mp/a.mmp)*100)+'%'});
		$('#char_exp').css({'width':w.toFixed(2)+'%'});
		$('#char_exp_text').html(a.xp.formatMoney(0,',','.')+' / '+a.mxp.formatMoney(0,',','.')+' ('+w.toFixed(2)+'%)');
		
		$('#char_mhp').html(a.mhp);
		$('#char_mmp').html(a.mmp);
		$('#char_atk').html(a.atk);
		$('#char_def').html(a.def);
		$('#char_hit').html(a.hit);
		$('#char_free').html(a.free);
		
		$('#char_str').html(a.stats.str);
		$('#char_agi').html(a.stats.agi);
		$('#char_vit').html(a.stats.vit);
		$('#char_dex').html(a.stats.dex);
		$('#char_int').html(a.stats.int);
		$('#char_ptr').html(a.stats.ptr);
		
		$('#char_silver').html(a.silver);
		
		$('#btn-profile-ptr').html(a.stats.ptr).css({'display':(a.stats.ptr>0?'inline-block':'none')});
		
		_.lionica.pet.get(a._id);
		var v=$('#pet-icon');
		if(a.pet)
		{
			var v=$('#pet-icon');
			if(!v.find('img').length)
			{
				$('.b-pet').css('display','block');
				v.html('<img src="http://s0.boxza.com/static/images/game/lionica/icon/'+a.pet.no+'.gif">');
			}
			w=Math.floor((a.pet.status.hp/a.pet.status.mhp)*100);
			$('#pet_hp_text').html(w+'%');
			$('#pet_hp_bar').css({'width':w+'%'});
			w=Math.floor((a.pet.status.xp/a.pet.status.mxp)*100);
			$('#pet_xp_text').html('Lv. '+a.pet.status.lv+' ('+w+'%)');
			$('#pet_xp_bar').css({'width':w+'%'});
		}
		else
		{
			if(v.find('img').length)
			{
				$('.b-pet').css('display','none');
				v.html('');
			}
		}
		_.lionica.player.stats();
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
						$('#eq_'+v.eq).prop('class','inv-unuse').data({'type':v.eq,'inv':v.inv}).html('<i class="item" style="background-position:'+v.css+'"></i>');			
						break;
					case 'uneq':
						txt='ถอด '+v.name;
						$('#eq_'+v.eq).removeProp('class').removeData(['type','inv']).html('');
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
					new _.lionica.effect.show(v.effect,_.lionica.player.cur[0],_.lionica.player.cur[1]);	
				}
			});
			$('.logs_div').scrollTop(Math.max($('.logs_div').height(),$('#logs_text').height())+100);
		}
	},
	chat:{
		to:'map',
		_ms:'',
		_repeat:0,
		_flood:0,
		_scroll:true,
		cp:function(e){var c=$('.chat_input input');c.val(' -> '+$(e).parent().find('a').text()+' <- '+c.val());c.focus();},
		whisper:function(pid,pn)
		{
			if(!$('#lionica_chat_'+pid).length)
			{
				var w=Math.floor(Math.random()*($('#lionica').width()-300)),h=Math.floor(Math.random()*($('#lionica').height()-200));
				var y='<div class="lbox lmove lresize lionica_chat" id="lionica_chat_'+pid+'" style="z-index:90;left:'+w+'px;top:'+h+'px;"><div class="name"><div class="text">'+pn+'</div><div class="close">X</div></div><div id="lionica_chat_'+pid+'_div" class="lionica_chat_div"><div class="lionica_chat_ch_l" id="lionica_chat_'+pid+'_div_l"></div></div><input type="text" class="tbox lionica_chat_input" id="lionica_chat_'+pid+'_input" data-uid="'+pid+'"></div>';
				$('#lionica').append(y);
				$('#lionica_chat_'+pid+' .lionica_chat_input').keypress(function(e){
					var c=(e.keyCode?e.keyCode:e.which);
					var ms=$.trim($(this).val());
					if(c==13&&ms!='')
					{
						$(this).val('');
						_.lionica.api('chat',{'msg':ms,'ty':'private','to':$(this).data('uid')});
					}
				});
				$('#lionica_chat_'+pid+' .close').click(function(){$('#lionica_chat_'+pid).remove();});
				$('#lionica_chat_'+pid).draggable({handle:'.name',containment: 'parent', scroll: false}).resizable({
					start:function(event,ui)
					{
						if($(ui.element).find('input').length)
						{
							$(ui.element).find('input').css({'display':'none'});
						}
					},
					stop:function(event,ui)
					{
						var w=$(ui.element).width(),h=$(ui.element).height();
						if($(ui.element).find('input').length)
						{
							$(ui.element).find('input').css({'width':w-5,'display':'inline-block'});
							$(ui.element).find('.lionica_chat_div').css({'height':h-55});
						}
						else
						{
							$(ui.element).find('.lionica_chat_div').css({'height':h-28});
						}
					}
				});
				$('#lionica_chat_'+pid).trigger('resize');
			}
		},
		popup:function(e)
		{
			e.preventDefault();
			e.stopPropagation();
			$('#lionica_menu').remove();
			var m=$('<div id="lionica_menu" class="menu-profile"></div>').appendTo($('#lionica'));
			var x = (e.pageX - $('#lionica').position().left),y = (e.pageY - $('#lionica').position().top);	
			m.css({'left':x,'top':y});
			var t=$(e.target),l=t.data('profile'),p=t.data('people'),n=t.text();
			var tmp='<ul>'+
			'<li><a href="javascript:;" onclick="_.lionica.chat.whisper(\''+p+'\',\''+n+'\')">กระซิบ</a></li>'+
			'<li><a href="http://boxza.com/'+l+'" target="_blank">โปรไฟล์</a></li>'+
			'</ul>';
			m.html(tmp);
			_.lionica.menu.opened=true;
		},
		parse:function(a)
		{
			if(!a)return;
			var p,tx,ct=$('#chat_text');
			var lo=$('#logs_text');
			for(var j=0;j<a.length;j++)
			{
				c=a[j];
				if(!$('#chat_text_'+c._sn).length)
				{
					if(c.ty=='item')
					{
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="javascript:;" class="lionica-profile" data-profile="'+c.l+'" data-people="'+c.p+'">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else if(c.ty=='shop')
					{
						if(c.seller==_.lionica.player.char.u)
						{
							_.lionica.box('logs','block');
							if(_.lionica.shop.vender)
							{
								_.lionica.box('vender','block');	
							}
						}
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="javascript:;" class="lionica-profile" data-profile="'+c.l+'" data-people="'+c.p+'">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else if(c.ty=='shop_state')
					{
						
					}
					else if(c.ty=='private')
					{
						var tx='<div id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="javascript:;" class="lionica-profile" data-profile="'+c.l+'" data-people="'+c.p+'">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>';
						var p;
						if(c.p==_.lionica.player.char._id)
						{
							_.lionica.chat.whisper(c.rl.p,c.rl.n);
							p=c.rl.p;
						}
						else
						{
							_.lionica.chat.whisper(c.p,c.n);
							p=c.p;
						}
						$('#lionica_chat_'+p+'_div_l').append(tx);
						$('#lionica_chat_'+p+'_div').scrollTop(Math.max($('#lionica_chat_'+p+'_div_l').height(),$('#lionica_chat_'+p+'_div').height())+100);
					}
					else if(c.ty=='enhance')
					{
						if(_.lionica.chat.first&&c.pet==_.lionica.player.char._id)
						{
							_.lionica.box('logs','block');
							new _.lionica.effect.show(c.effect,_.lionica.player.cur[0],_.lionica.player.cur[1]);	
						}
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="javascript:;" class="lionica-profile" data-profile="'+c.l+'" data-people="'+c.p+'">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else if(c.ty=='evolution')
					{
						if(_.lionica.chat.first&&c.pet==_.lionica.player.char._id)
						{
							new _.lionica.effect.show('evolution',_.lionica.player.cur[0],_.lionica.player.cur[1]);	
						}
						lo.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="javascript:;" class="lionica-profile" data-profile="'+c.l+'" data-people="'+c.p+'">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
					else
					{
						ct.append('<p id="chat_text_'+c._sn+'" class="chat-'+c.ty+'"><small onclick="_.lionica.chat.cp(this)">'+c.tm+'</small> <a href="javascript:;" class="lionica-profile" data-profile="'+c.l+'" data-people="'+c.p+'">'+c.n+'</a>: '+_.lionica.convert(c.t)+'</p>');
					}
				}
			}
			if(!_.lionica.chat.first)
			{
				_.lionica.chat.first=true;
				/*
				$('#chat_text').append('<p id="chat_text_notice" style="margin:5px 0px; padding:5px;border:1px solid #333; background:#111;color:#fff"><strong style="color:#f60">วิธีการเล่นเกม Lionica</strong> (เกมนี้)<br>'+
				' - <a href="http://game.boxza.com/forum/topic/9292" target="_blank">เริ่มเล่นเกมครั้งแรก ต้องทำอะไรบ้าง คลิกที่นี่</a><br>'+
				' - <a href="http://game.boxza.com/forum/topic/9293" target="_blank">วิธีสั่งให้สัตว์เลี้ยง ตีมอนสเตอร์ เก็บเลเวลเอง  (AI)</a><br>'+
				' - <a href="http://game.boxza.com/forum/lionica" target="_blank">รวมกระทู้ พูดคุย แนะนำ วิธีการเล่นต่างๆ ทั้งหมด</a>'+
				'</p>');
				*/
			}
			if(_.lionica.chat._scroll)
			{
				$('.chat_div').scrollTop(Math.max($('.chat_div').height(),$('#chat_text').height())+100);
				$('.logs_div').scrollTop(Math.max($('.logs_div').height(),$('#logs_text').height())+100);
			}
		}
	},
	resize:function()
	{
		if(_.lionica.full)
		{
			$('#lionica_container').css({'position':'absolute','left':0,'top':0,'overflow':'hidden','width':$(window).width(),'height':$(window).height(),'z-index':1001});
			$('#lionica #map_frame').css({'width':$(window).width(),'height':$(window).height()});
		}
	},
	drop:function(i)
	{
		clearInterval(_.lionica.tmrdrop);
		_.lionica.box('drop','block');
		var l=400+Math.floor(Math.random()*100),t=1+Math.floor(Math.random()*80);
		$('#lionica .drop').css({'left':l,'top':t});
		var p=$('<p class="item-drop" data-time="'+_.lionica.dindex+'"><i class="item" style="background-position:'+i.c+'"></i> '+i.n+' <span class="pull-right"><a href="javascript:;" class="btn btn-mini" onclick="_.lionica.hidedrop(this,'+i.d+');">เก็บ</a> <a href="javascript:;" onclick="_.lionica.hidedrop(this,false)" class="btn btn-mini"> ไม่เก็บ </a></span></p>');
		$('#drop_text').prepend(p);	
		var c=$('#drop_text > p').length;
		if(c==0)
		{
			_.lionica.box('drop','none');
		}
		if(c>100)
		{
			$('#drop_text').children().slice(100).remove();	
			c=100;
		}
		$('#drop_ea').html(c);
		_.lionica.tmrdrop=setInterval(function(){_.lionica.delaydrop()},1000);
	},
	delaydrop:function()
	{
		_.lionica.dindex++;
		$('#drop_text p:not(.rp)').each(function() {
            var t=Math.floor($(this).data('time'));
			if(_.lionica.dindex-10800>t)
			{
				$(this).addClass('rp').find('span').html('หมดเวลา - <a href="javascript:;" onclick="_.lionica.hidedrop(this,false)" class="btn btn-mini btn-inverse">ลบ</a>');
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
			if(b)
			{
				_.lionica.api('keep',{'drop':b});
				
				if(a)
				{
					var i=$(a).parent().parent().find('i'),t=i.clone(),p=$('#inventory_bin').offset();
					t.css({'position':'absolute','left':i.offset().left,'top':i.offset().top,'z-index':999}).appendTo($('body'));
					t.animate({'left':p.left,'top':p.top},1500,'easeOutBounce',function(){$(this).remove()});
				}
			}
			if(a)
			{
				$(a).parent().parent().remove();
			}
			var c=$('#drop_text > p').length;
			if(c==0)
			{
				_.lionica.box('drop','none');
			}
			if(c>100)
			{
				$('#drop_text').children().slice(99).remove();	
				c=100;
			}
			$('#drop_ea').html(c);
		}
	},
	fullscreen:function()
	{
		$('#lionica_container').prop('style','').removeAttr('style');
		$('#lionica #map_frame').prop('style','').removeAttr('style');
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
		//_.lionica.center(_.lionica.player.cur);
	},
	routing:function(pathStart, pathEnd)
	{
		var	abs = Math.abs;
		var	max = Math.max;
		var	pow = Math.pow;
		var	sqrt = Math.sqrt;
		var worldWidth = _.lionica.map.width;
		var worldHeight = _.lionica.map.height;
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
			return (_.lionica.map.block[y+'_'+x]||0)?false:true;
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
};


(function() {
    var lastTime = 0;
    var vendors = ['webkit', 'moz'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },  timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());


Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSeparator = decSeparator == undefined ? "." : decSeparator,
    thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
    sign = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};