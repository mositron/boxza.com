$.extend(inet,{
	profile:{
		history:new Object,
		updating:false,
		enabled:false,
		gif:{
			close:function()
			{			
				$('.sh-hd').remove();
				$('html').removeClass('hdMode');	
			},
			insert:function(a)
			{
				a=$.trim(a);
				if(a.substr(0,20)=='http://s1.boxza.com/')
				{
					$('#lgif').html('<div><span>แนบรูปภาพเคลื่อนไหวจากกล้องเว็บแคม (<a href="javascript:;" onclick="$(\'#lgif\').html(\'\')">ยกเลิก</a>)</span><img src="'+a+'"><input type="hidden" name="gif" value="'+a+'"></div>');
				}
				else
				{
					inet.box.alert(a);
				}
				inet.profile.gif.close();
			}
		},
		img:{
			up:function()
			{
				$('input[type=file]').unbind();
				inet.upload.create('input[type=file]',function(e,g){if(e.status=='OK'){
					if(e.update=='header')
					{
						inet.box.close();
						$('._pf-hd > img').attr('src',e.pic);
					}
					else if(e.update=='avatar-gif')
					{
						$('.img-uid-'+inet.my._id).attr('src',e.pics);
						$('.img-uid-my').attr('src',e.picn);
					}
					else
					{
						inet.get.js('jquery/jcrop/jquery.Jcrop.min.js').done(function(){inet.box.load('/dialog/avatar #avatar_thumb');});
					}
					}else{alert(e.message);}});
			},
			av:{
				boundx:0,boundy:0,
				thumb:function(j,w,h)
				{
					$('#gboxc #gcrop').Jcrop(
						{onChange: inet.profile.img.av.coords,onSelect: inet.profile.img.av.coords,aspectRatio: 1},
						function()
						{
							inet.profile.img.av.jcrop = this;
							if($('#gboxc #pvcrop').css('display')!='block')$('#gboxc #pvcrop').css({'display':'block'})
							$("#gboxc #gpf").attr({src:j});
							$('#gboxc #showsave').css({'display':'block'});
							inet.profile.img.av.jcrop.setImage(j);
							inet.profile.img.av.jcrop.animateTo([0,0,(w<h?w:h),(w<h?w:h)]);
							inet.profile.img.av.boundx = w;
							inet.profile.img.av.boundy = h;
						}
					);
				},
				coords:function(c){$('#gboxc #x').val(c.x);$('#gboxc #y').val(c.y);$('#gboxc #w').val(c.w);$('#gboxc #h').val(c.h);inet.profile.img.av.preview(c);},
				preview:function(c)
				{
				  if (parseInt(c.w) > 0)
				  {
					 var rx = 150 / c.w;
					 var ry = 150 / c.h;
					 $('#gboxc #gpf').css({
						width: Math.round(rx * inet.profile.img.av.boundx) + 'px',
						height: Math.round(ry * inet.profile.img.av.boundy) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					 });
				  }
				}
			},
		},
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
					$('.sh-hd').remove();
					$('html').addClass('hdMode');
					var w=$(window).width(),h=$(window).height(),l=$(document).scrollLeft(),t=$(document).scrollTop();
					$('body').prepend($('<div>').addClass('sh-hd close'));
					$('.sh-hd').html('<div class="sh-hd-ct close"><div class="sh-hd-in close"><div class="sh-hd-wr close"><div class="sh-hd-wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
					$('.sh-hd-ct,.sh-hd-in,.sh-hd-wr').click(inet.profile.sh.close);
					var u='';
					if(a.u && a.u.length)
					{
						for(var i=0;i<a.u.length;i++)
						{
							u+='<div class="n friend-'+a.u[i]._id+'"><span class="av"><a href="/'+a.u[i].link+'" title="'+a.u[i].name+'" class="h"><img src="'+a.u[i].img+'"></a></span><strong><a href="/'+a.u[i].link+'" title="'+a.u[i].name+'" class="h">'+a.u[i].name+'</a></strong>';
							if(inet.my)
							{
								if(a.u[i]._id==inet.my._id)
								{
									u+='<span class="friend" style="margin:5px 0px 0px 5px">คุณ</span>';
								}
								else if($.inArray(parseInt(a.u[i]._id),inet.my.ct.fr)>-1)
								{
									u+='<span class="friend" style="margin:5px 0px 0px 5px">เพื่อน</span>';
								}
								else if($.inArray(parseInt(a.u[i]._id),inet.my.ct.fq)>-1)
								{
									u+='<span class="frequest" style="margin:5px 0px 0px 5px">รอตอบกลับ</span>';
								}
								else
								{
									u+='<span class="fnot friend-request-'+a.u[i]._id+'" style="margin:5px 0px 0px 5px" onClick="inet.friend.request('+a.u[i]._id+')">เพิ่มเป็นเพื่อน</span>';
								}
							}
							u+='<div class="clear"></div></div>';
							if(i%2==1)u+='<div class="clear"></div>';
						}
						u+='<div class="clear"></div>';
					}
					else
					{
						u='<div style="padding:50px;">ยังไม่มีใครโดนข้อความนี้</div>';
					}
					$('.sh-hd-wl').html('<div class="sh-hd-ms" id="getfriends">'+u+'<div class="sh-hd-ms-x close">X<div><div>');
					inet.line.update();
				}
			}
		},
		cm:{
			del:function(a,b)
			{
				inet.box.confirm({title:'ลบความคิดเห็น',detail:'คุณต้องการลบความคิดเห็นนี้หรือไม่',click:function(){inet.api('/me/comment/'+a+'/delete/'+b);}});
			},
			pop:function(id)
			{
				var cm=$('#_cm-p-'+id);
				if(cm.html()=='')
				{
					if(!inet.my)
					{
						return;
					}
					else
					{
						cm.html('<div class="cm-p-i">'+
						'<div class="av"><a href="/'+inet.my.link+'"><img src="'+inet.my.img+'" class="img-uid-'+inet.my._id+'"></a></div>'+
						'<div class="cm-p-a">'+
						'<textarea class="tbox" data-cm="'+id+'" style="width:100%; height:40px" onkeypress="return inet.profile.cm.post(event,this)" placeholder="แสดงความคิดเห็น"></textarea>'+
						'</div><p class="clear"></p></div>');
					}
				}
				if(arguments.length==1)
				{
					$('#_cm-p-'+id+' textarea').focus();
				}
			},
			act:function(ln,idx)
			{
				var a=$('.cm-d-'+ln+' .cm-s-'+idx);
				if(a.length)
				{
					if(!$('.cm-du',a).length)
					{
						var d=$('<ul>').addClass('cm-du').appendTo($('.cm-d',a));
						if(inet.my)
						{
							var u=$('#_line_ln'+ln).data('uid'),p=$('#_line_ln'+ln).data('pid'),c=a.data('uid');
							if(u==inet.my._id||p==inet.my._id||c==inet.my._id)
							{
								$(d).html('<li><span onclick="inet.profile.cm.del('+ln+','+idx+')" class="ptr2">ลบความคิดเห็นนี้</span></i>');
							}
							else
							{
								$(d).html('<li>โดย '+$('.cm-u',a).text()+'</i>');
							}
						}
						else
						{
							$(d).html('<li>กรุณาล็อคอิน</i>');
						}
					}
					else
					{
						$('.cm-d-'+ln+' .cm-s-'+idx+' .cm-du').remove();
					}
				}
			},
			post:function(e,t){var c=(e.keyCode?e.keyCode:e.which);if(c==13&&!e.shiftKey){var txt=$.trim(t.value);if(txt)inet.api('/me/comment/'+$(t).data('cm')+'/insert',{'message':txt});t.value='';return false;}},
			parse:function(a)
			{
				if(a.type=='list')
				{
					if(a.cm && a.cm.d)
					{
						if(a.t=='clear')$('.cm-d-'+a._id+' .cm-s').remove();
						if(a.cm.c)$('.cm-c-'+a._id).html(a.cm.c);
						for(var i=0;i<a.cm.d.length;i++)inet.profile.cm.insert(a._id,a.cm.d[i]);
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
								'<div class="cm-r"><span class="cm-de" onclick="inet.profile.cm.act('+a+','+cm.i+');"></span>';
									_l+='<span class="bk">'+
									'<span class="lk lk-'+a+'-'+cm.i+(cm.lm?' like':'')+'">'+
									'<span onclick="inet.api(\'/me/like/'+a+'-'+cm.i+'\')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span>'+
									'<span onclick="inet.api(\'/me/like/'+a+'-'+cm.i+'/unlike\')" class="unlike ptr"><i class="show-tooltip-s ptr" original-title="เฉยๆ"></i></span>'+
									'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-'+a+'-'+cm.i+'">'+cm.lc+'</span></span>'+
									'</span>'+
									'</span>';
									_l+='<span class="ago" datetime="'+cm.t+'">'+inet.time.cal(cm.t)+'</span>';
								if(!n)
								{
									_t+=_l;
								}
								_t+=' <span class="cm-u"><a href="/'+cm.u.link+'" class="h">'+cm.u.name+'</a></span></div>';
								if(n)
								{
									_t+=_l;
								}
								_t+='<div class="cm-dt ev">'+inet.itag(cm.m)+'</div>'+
								'</div><p class="clear"></p></div>';
				if(!$('.cm-d-'+a+' .cm-s-'+cm.i).length && !n)
				{
					$('.cm-d-'+a).append(_t);
				}
				if($('.hd-cm-d-'+a).length && !n)
				{
					if(!$('.hd-cm-d-'+a+' .cm-s-'+cm.i).length)$('.hd-cm-d-'+a).append(inet.profile.cm.insert(a,cm,true));
				}
				return _t;
			}
		},
		pt:
		{
			width:0,height:0,ratio:1,cfilter:0,cache:'',
			del:function(a){inet.box.confirm({title:'ลบรูปภาพ',detail:'คุณต้องการลบรูปภาพนี้หรือไม่',click:function(){inet.ajax.gourl('/line','delline',a);}});},
			swf:function(a,s){
				if(inet.my)
				{
					inet.get.js('swfupload.js').done(function(){
						inet.get.css('upload.css');
						var sw={
												upload_url:'http://upload.boxza.com/line/photos',
												post_params: {"session":s},																
												button_width: 140,
												button_height: 23,
												button_text_top_padding: 2,
												button_text_left_padding: 0,
												button_placeholder_id : "file_select_top",
												button_text : '<span class="button">อัพโหลดรูปภาพ</span>',
												button_text_style : '.button{font-family: tahoma; font-size: 12px; color:#000000; text-shadow: 1px 1px 0px #FFFFFF; text-align:center; font-weight:bold;}',
												file_dialog_complete_handler:function(na,nb){
													if(na>0)
													{
														if(!$('.sh-hd').length)
														{
															$('html').addClass('hdMode');
															$('body').prepend($('<div>').addClass('sh-hd close'));
															$('.sh-hd').html('<div class="sh-hd-ct"><div class="sh-hd-in"><div class="sh-hd-wr"><div class="sh-hd-wl"></div></div></div></div>');
														}
														if(!$('.sh-hd-ms').length)
														{
															$('.sh-hd-wl').html('<div class="sh-hd-ms"><form onsubmit="return false" id="file_form""><div style="width:600px; min-height:200px"><h3 style="margin:0px 0px 10px">อัลบั้ม '+a+'</h3><div style="text-align:center;margin:5px 0px 15px 0px"><span><span id="file_select_file"></span></span></div><div id="upload_panel"></div><div id="file_up_file" class="flash"></div><div id="file_action" style="padding:5px; background:#f5f5f5;text-align:center">กรุณารอซักครู่...</div></div></form></div>');
														}
													};
													try{if(nb>0){this.startUpload();}}catch (ex) {this.debug(ex);};
												},
												upload_complete_handler:function(file)
												{												
													try {
														if (this.getStats().files_queued > 0) {
															this.startUpload();
														} else {
															var progress = new FileProgress(file,  this.customSettings.upload_target);
															progress.SetComplete();
															progress.SetStatus("อัพโหลดครบเรียบร้อยแล้ว.");
															progress.ToggleCancel(false);
															$('#file_action').html('<input type="button" class="button blue" value="          บันทึก          " onclick="inet.ajax.gourl(\'/photos\',\'setdetail\',$(\'#file_form\').get(0));inet.profile.sh.clear()">');
														}
													} catch (ex) {
														this.debug(ex);
													}
												},
												upload_success_handler:function(file,data){
													try{
														var progress = new FileProgress(file,this.customSettings.upload_target);
														progress.SetComplete();
														progress.SetStatus("ได้รับการตอบรับจากเซิฟเวอร์แล้ว.  ["+$KB(file.size)+"]");
														progress.ToggleCancel(false);
													}
													catch(ex)
													{
														this.debugMessage(ex);
													};
													var b=eval('('+data+')');
													if(b.status=='OK')
													{
														$('#upload_panel').append('<div style="margin:5px 0px"><div class="left" style="width:205px;"> <img src="'+b.img+'"></div><div class="right" style="width:380px"><textarea class="tbox" name="detail" style="width:380px; height:85px" placeholder="คำบรรยายรูปภาพ"></textarea><input type="hidden" name="_id" value="'+b._id+'"><select class="tbox" name="to"><option value="0">สาธารณะ</option><option value="-1">เฉพาะเพื่อน</option></select></div><p class="clear"></p></div> ');
													}
													else
													{
														inet.box.alert(b.message);
													}
												}
											}
						
						inetSWFUpload(sw);
					});
				}
			},
			up:function(a){
				inet.upload.choose('photo[]',{'album':a},function(b)
				{
					if(b.status=='OK')
					{
						inet.line.go('/photos/album-'+a,true);
					}
					else
					{
						inet.box.alert(b.message+' z '+b);
					}
				});
			},
			close:function(e){if(!e)e=window.event;e=e.target;if($(e).hasClass('close')){$('.pho-hd').remove();$('html').removeClass('hdMode');}},
			layout:function(a)
			{
				var o=12,i=190,f=o+i,b=$(a),n=b.parent(),w=n.width(),c=Math.floor(w/(o+i)),of=Math.round((w-(c*f)+o)/2),h=[],wc=[],q,k=0,s,si,z=0;
				while(h.length<c)h.push(0);while(wc.length<c)wc.push([]);
				for(i=0;i<b.length;i++){q=$(b[i]);q.addClass('sort').find('.i a img').css('height',200/(parseInt(q.data('w'))/parseInt(q.data('h'))));s=null;si=0;for(k=0;k<c;k++){if(s==null||h[k]<s){s=h[k];si=k;}}q.css({top:s,left:((si*f)+of)});h[si]=s+q.outerHeight()+o;z=Math.max(z,h[si]);wc[si].push(q);}
				n.css('height',z+40);
				$('.pt-next').css({width:w-20});
				if(!n.hasClass('ev')){n.addClass('ev');$(window).resize(function(){inet.profile.pt.layout(a)});}
			},
			savefilter:function()
			{
				var p={'l':inet.profile.pt.eid,'r':inet.profile.pt.crotate,'f':''};
				if(inet.profile.pt.cfilter)
				{
					var c=$('.pho-hd-img-cv canvas').get(0);
					if(c)
					{
						var dataURL = c.toDataURL('image/'+inet.profile.pt.tfilter);
						p['f']=dataURL.replace(/^data:image\/(gif|png|jpg);base64,/, "");
					}
				}
				inet.ajax.gourl('/photos','savefilter',p);
				$('.pho-hd').remove();
				$('html').removeClass('hdMode');
			},
			efilter:function(l,a,b,c){
				inet.profile.pt.eid=l;
				inet.profile.pt.tfilter=b;
				if($('.pho-hd').length)$('.pho-hd').remove();
				$('html').addClass('hdMode');
				$('body').prepend($('<div>').addClass('pho-hd close'));
				$('.pho-hd').html('<div class="pho-hd-ct close"><div class="pho-hd-in close"><div class="pho-hd-wr close"><div class="pho-hd-wl"><div style="padding:50px;text-align:center;font-size:16px;">กรุณารอซักครู่</div></div></div></div></div>');
				var d='<div class="pho-hd-edt"><div class="pho-hd-edt-img" style="text-align:center;line-height:0px">{thumb}</div>'+
				'<div class="pho-hd-edt-pb"><div class="pho-hd-img-cv"><img id="pho-hd-img-src"></div>'+
				'<div class="pho-hd-edt-sv"><i class="pho-hd-edt-rt-l"></i><i class="pho-hd-edt-rt-r"></i><input type="button" class="button pho-hd-img-cc" value="ใช้รูปแบบดั้งเดิม" style="display:none"> '+(c==2?'<input type="button" class="button blue" value="เผยแพร่ทันที" onclick="inet.post.postfilter()">':'<input type="button" class="button blue" value="บันทึก" onclick="inet.profile.pt.savefilter()"> <input type="button" class="button" value="ยกเลิก" onclick="$(\'.pho-hd\').remove();$(\'html\').removeClass(\'hdMode\');">')+'<p clear="clear"></p></div></div><div class="pho-hd-edt-ctrl">';
				for(var i=1;i<=10;i++)d+='<div data-take="'+i+'" class="pho-hd-img-pv-'+i+'"></div>';
				d+='<p class="clear"></p></div></div>';
				inet.profile.pt.crotate=0;
				$('.pho-hd-wl').html(d);
				$('.pho-hd-img-cc').click(function(e) {
               inet.profile.pt.cfilter=0;
					inet.profile.pt.crotate=0;
					inet.profile.pt.filter['e'+inet.profile.pt.cfilter]('pho-hd-img');
					$(this).css('display','none');
            });
				$('.pho-hd-edt-rt-r').click(function(e) {
               inet.profile.pt.crotate++;
					inet.profile.pt.filter['e'+inet.profile.pt.cfilter]('pho-hd-img');
            });
				$('.pho-hd-edt-rt-l').click(function(e) {
               inet.profile.pt.crotate+=3;
					inet.profile.pt.filter['e'+inet.profile.pt.cfilter]('pho-hd-img');
            });
				inet.get.js('jquery/filtrr/filtrr.js').done(function(){
					var im=$('#pho-hd-img-src').get(0);
					im.onload=function()
					{
						var w=this.width,h=this.height;
						var ratio = 1,maxWidth=500,maxHeight=500;
						if(w > maxWidth)
						ratio = maxWidth / w;
						else if(h > maxHeight)
						ratio = maxHeight / h;
						
						var canvas = document.createElement('canvas');
						var ctx = canvas.getContext("2d");
						canvas.width = w * ratio;
						canvas.height = h * ratio;
						ctx.drawImage(this, 0, 0, w, h, 0, 0, canvas.width, canvas.height);
						$('.pho-hd-edt-img').html('<img id="pho-hd-img" style="margin:0px auto" src="'+canvas.toDataURL("image/png")+'">');
						
						var ratio = 1,maxWidth=100,maxHeight=100;
						if(w > maxWidth)
						ratio = maxWidth / w;
						else if(h > maxHeight)
						ratio = maxHeight / h;
						
						for(var i=1;i<=10;i++)
						{
							canvas = document.createElement('canvas');
							ctx = canvas.getContext("2d");
							canvas.width = w * ratio;
							canvas.height = h * ratio;
							ctx.drawImage(this, 0, 0, w, h, 0, 0, canvas.width, canvas.height);
							$('.pho-hd-img-pv-'+i).html('<img id="pho-hd-img-pv-'+i+'" src="'+canvas.toDataURL("image/png")+'">');
							inet.profile.pt.filter['e'+i]('pho-hd-img-pv-'+i);
						};
						
						inet.profile.pt.filter['e0']('pho-hd-img');
						$(".pho-hd-edt-ctrl > div").click(function(){
							inet.profile.pt.cfilter=$(this).data('take');
							$('.pho-hd-img-cc').css('display','inline');
							window.setTimeout(function(){inet.profile.pt.filter['e'+inet.profile.pt.cfilter]('pho-hd-img-src');}, 1);
							window.setTimeout(function(){inet.profile.pt.filter['e'+inet.profile.pt.cfilter]('pho-hd-img');}, 50);
						});
					};
					im.src="data:image/"+b+";base64,"+a;
				});
				
			},
			update:function()
			{
				if($('.pho-hd').length)
				{
					var w=Math.max(500,$(window).width()-340),h=Math.max(300,$(window).height()-40),w1=w,h1=h;
					h=w/inet.profile.pt.ratio;
					if(h>h1)
					{
						h=h1;
						w=h*inet.profile.pt.ratio;
					}
					if(w>inet.profile.pt.width)
					{
						w=inet.profile.pt.width;
						h=w/inet.profile.pt.ratio;
					}
					if(h>inet.profile.pt.height)
					{
						h=inet.profile.pt.height;
						w=h*inet.profile.pt.ratio;
					}
					w=parseInt(w);
					h=parseInt(h);
					if($('.hd-cm-d').height()>h)
					{
						$('.hd-cm-d').parent().addClass('hd-cm-g');
						$('.hd-cm-g').height(Math.max(400,h)-$('.pho-hd .detail').height()-145);
					}
					else
					{
						$('.hd-cm-d').parent().removeClass('hd-cm-g');
					}
					$('.pho-hd-im').css({width:Math.max(500,w),height:Math.max(400,h)});
					$('.pho-hd-im img').css({width:w,height:h,'margin-top':(h>400?0:parseInt((400-h)/2)),'margin-left':(w>500?0:parseInt((500-w)/2))});
				}
			},
			parse:function(a,b)
			{
				if(b=='photo')
				{
					if(!$('.pho-hd').length)
					{
						$('html').addClass('hdMode');
						var w=$(window).width(),h=$(window).height(),l=$(document).scrollLeft(),t=$(document).scrollTop();
						$('body').prepend($('<div>').addClass('pho-hd close'));
						$('.pho-hd').html('<div class="pho-hd-ct close"><div class="pho-hd-in close"><div class="pho-hd-wr close"><div class="pho-hd-wl"><div class="pho-hd-im"></div><div class="pho-hd-cm ln"></div><div class="clear"></div></div></div></div></div>');
						$('.pho-hd-ct,.pho-hd-in,.pho-hd-wr').click(inet.profile.pt.close);
					}
					inet.profile.pt.width=a.pt.w;
					inet.profile.pt.height=a.pt.h;
					inet.profile.pt.ratio=a.pt.w/a.pt.h;
					$('.pho-hd-im').html('<img src="'+inet.protocol+'s1.boxza.com/line/photo/'+a.pt.f+'/'+a.pt.n+inet.profile.pt.cache+'">');
					if(a.pt.prev)$('.pho-hd-im').append('<a href="/photos/photo-'+a.pt.prev+'" onclick="inet.api(\'/me/photos/photo-'+a.pt.prev+'\');return false;" class="prev"></a>');
					if(a.pt.next)$('.pho-hd-im').append('<a href="/photos/photo-'+a.pt.next+'" onclick="inet.api(\'/me/photos/photo-'+a.pt.next+'\');return false;" class="next"></a>');
					$('.pho-hd-im').hover(function(){$('.pho-hd-im a').css('display','block');},function(){$('.pho-hd-im a').css('display','none');});
					var hm='<div><div class="av" av="'+a.u._id+'"><a href="/'+a.u.link+'" class="h" title="'+a.u.name+'"><img src="'+a.u.img+'" class="img-uid-'+a.u._id+'"></a></div><h3 class="b">'+a.u.name+'</h3>';
					hm+='<span class="ago b" datetime="'+a.ds+'">'+inet.time.cal(a.ds)+'</span>, <span>แสดงความเห็น</span><div class="clear"></div></div>';
					hm+='<div class="detail">'+a.ms+'</div>';
					
					
					hm+= '<div class="bk">'+
							'<span class="lk lk-'+a._id+(inet.my && a.lk && $.inArray(inet.my._id,a.lk.u)>-1?' like':'')+'">'+
							'<span onClick="inet.api(\'/me/like/'+a._id+'\')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span>'+
							'<span onClick="inet.api(\'/me/like/'+a._id+'/unlike\')" class="unlike ptr"><i class="show-tooltip-s ptr" title="เฉยๆ"></i></span>'+
							'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-'+a._id+'">'+(a.lk&&a.lk.c?a.lk.c:'0')+'</span></span>'+
							'</span>'+
							'<span onClick="inet.api(\'/me/share/'+((a.sh&&a.sh.f)?a.sh.f:a._id)+'\')" class="ptr"> แบ่งปัน</span>'+
							'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sh-c-'+a._id+'">'+(a.sh&&a.sh.c?a.sh.c:'0')+'</span></span>'+
							'</div>';

					hm+='<div class="cm-g"><div class="hd-cm-g"><div class="hd-cm-d hd-cm-d-'+a._id+'">';
					if(a.cm)
					{				
						if(a.cm.c>30)
						{
							hm+='<div class="cm-c cm-l-'+a._id+'"><span onClick="inet.api(\'/me/comment/'+a._id+'/list/clear/\')" class="txt ptr2">ดูทุกความคิดเห็น (<span class="cm-c-'+a._id+'">'+a.cm.c+'</span>)</span></div>';
						}
						else if(a.cm.c>10)
						{
							hm+='<div class="cm-c cm-l-'+a._id+'">ความคิดเห็นทั้งหมด (<span class="cm-c-'+a._id+'">'+a.cm.c+'</span>)</a></div>';
						}
						for(var i=0;i<a.cm.d.length;i++)
						{
							hm+=inet.profile.cm.insert(a._id,a.cm.d[i],true);
						}
					}
				
					hm+='</div></div>';
					if(inet.my)
					{
						hm+='<div class="cm-p-i">'+
						'<div class="av"><a href="/'+inet.my.link+'"><img src="'+inet.my.img+'" class="img-uid-'+inet.my._id+'"></a></div>'+
						'<div class="cm-p-a"><textarea class="tbox" data-cm="'+a._id+'" style="width:100%; height:40px" onKeyPress="inet.profile.cm.post(event,this)"></textarea>'+
						'</div><p class="clear"></p></div>';
					}
					hm+='</div><div class="pho-hd-cm-x close">X</div>';
					$('.pho-hd-cm').html(hm);
					inet.profile.pt.update();
				}
			},
			filter:{
				e0 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.put();
						
					});
				},
				e1 : function(m) {
					filtrr.img(m, function(filtr) {
						var topFiltr = filtr.duplicate();
						topFiltr.core.saturation(0).blur();
						filtr.blend.multiply(topFiltr);
						filtr.core.tint([60, 35, 10], [170, 140, 160]).contrast(0.8).brightness(10);
						filtr.put();
						
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e2 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.core.saturation(0.3).posterize(70).tint([50, 35, 10], [190, 190, 230]);	
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e3 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.core.tint([60, 35, 10], [170, 170, 230]).contrast(0.8);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e4 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.core.grayScale().tint([60,60,30], [210, 210, 210]);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e5 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.core.tint([30, 40, 30], [120, 170, 210])
								  .contrast(0.75)
								  .bias(1)
									.saturation(0.6)
									.brightness(20);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e6 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.core.saturation(0.4).contrast(0.75).tint([20, 35, 10], [150, 160, 230]);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e7 : function(m) {
					filtrr.img(m, function(filtr) {
						var topFiltr = filtr.duplicate();
						topFiltr.core.tint([20, 35, 10], [150, 160, 230]).saturation(0.6);
						filtr.core.adjust(0.1,0.7,0.4).saturation(0.6).contrast(0.8);
						filtr.blend.multiply(topFiltr);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e8 : function(m) {
					filtrr.img(m, function(filtr) {
						var topFiltr = filtr.duplicate();
						var topFiltr1 = filtr.duplicate();
						var topFiltr2 = filtr.duplicate();
						topFiltr2.core.fill(167, 118, 12);
						topFiltr1.core.gaussianBlur();
						topFiltr.core.saturation(0);
						filtr.blend.overlay(topFiltr);
						filtr.blend.softLight(topFiltr1);
						filtr.blend.softLight(topFiltr2);
						filtr.core.saturation(0.5).contrast(0.86);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e9 : function(m) {
					filtrr.img(m, function(filtr) {
						var topFiltr = filtr.duplicate();
						var topFiltr1 = filtr.duplicate();
						topFiltr1.core.fill(226, 217, 113).saturation(0.2);
						topFiltr.core.gaussianBlur().saturation(0.2);
						topFiltr.blend.multiply(topFiltr1);
						filtr.core.saturation(0.2).tint([30, 45, 40], [110, 190, 110]);
						filtr.blend.multiply(topFiltr);
						filtr.core.brightness(20).sharpen().contrast(1.1);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});
				},
				
				e10 : function(m) {
					filtrr.img(m, function(filtr) {
						filtr.core.sepia().bias(0.6);
						filtr.put();
						//filtr.canvas().getContext("2d").drawImage(whiteFrame, 0, 0);
					});	
				}
			}
		},
		sh:{
			width:0,height:0,ratio:1,
			close:function(e){if(!e)e=window.event;e=e.target;if($(e).hasClass('close')){inet.profile.sh.clear()}},
			clear:function(){$('.sh-hd').remove();$('html').removeClass('hdMode');/*inet.line.go('/line');*/},
			parse:function(a)
			{
				if(!$('.sh-hd').length)
				{
					$('html').addClass('hdMode');
					var w=$(window).width(),h=$(window).height(),l=$(document).scrollLeft(),t=$(document).scrollTop();
					$('body').prepend($('<div>').addClass('sh-hd close'));
					$('.sh-hd').html('<div class="sh-hd-ct close"><div class="sh-hd-in close"><div class="sh-hd-wr close"><div class="sh-hd-wl"></div></div></div></div>');
					$('.sh-hd-ct,.sh-hd-in,.sh-hd-wr').click(inet.profile.sh.close);
				}
				var b='<div class="sh-hd-ms"><form onsubmit="inet.ajax.gourl(\'/line\',\'postshare\',this);$(this).prop(\'disabled\',\'disabled\');return false;"><input type="hidden" name="share" value="'+a._id+'">'+
				'<div><textarea name="msg" id="share-msg" style="height: 60px; width: 500px; "></textarea></div>'+
				'<div class="post-bar" style="display: block; "><input type="submit" class="button blue" value=" โพสต์ ">'+
				'<div id="lto">'+
				'<span class="lto--1"><input type="hidden" name="to" value="-1"> เฉพาะเพื่อน </span>';
				b+='</div><div class="clear"></div></div></form>'+
				'<div class="sh-z">'+
				'<div ln="'+a._id+'" class="ln ln-'+a._id+'" uid="'+a.u._id+'" pid="'+(a.p?a.p._id:'')+'">'+
				'<div class="av" av="'+a.u._id+'"><a href="/'+a.u.link+'" class="h" title="'+a.u.name+'"><img src="'+a.u.img+'" class="img-uid-'+a.u._id+'"></a></div>'+
				'<div class="sh-hd-ur"><a href="/'+a.u.link+'" class="h u">'+a.u.name+'</a> แบ่งปัน<a href="/line/'+a._id+'">โพสต์นี้</a>เป็นคนแรก </div>'+
				'<div class="ct"><div class="dt ev">'+inet.itag(a.ms,a.uk)+'</div>';
				if(a.pt && a.pt.tmp)
				{
					b+='<div class="pt"><a href="/photos/photo-'+a._id+'" onClick="inet.api(\'/me/photos/photo-'+a._id+'\');return false;"><img src="'+a.pt.tmp+'"></a></div>';
				}
				else if(a.ty=='album' && a.pt && a.pt.f)
				{
					b+='<div class="pt"><ul class="pt-al">';
					for(var j=0;j<a.pt.f.length;j++)
					{
						b+='<li><a href="/photos/photo-'+a.pt.f[j].i+'" onClick="inet.api(\'/me/photos/photo-'+a.pt.f[j].i+'\');return false;"><img src="'+a.pt.f[j].tmp+'"></a></li>';
					}
					b+='<p class="clear"></p></ul></div>';
				}
				
				if(a.at)
				{
					b+='<div class="vid-tt"><a href="'+a.at.l+'" target="_blank" rel="nofollow">'+a.at.t+'</a></div>';
					if(a.at.i)
					{
						//b+='<div class="vid-im"><a href="'+a.at.l+'" target="_blank" rel="nofollow"'+(a.at.v?' onclick="inet.line.embed(this,\''+a.at.v.l+'\','+a.at.v.w+','+a.at.v.h+');return false;"':'')+'><img src="http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url='+encodeURIComponent(a.at.i)+'&container=focus&gadget=a&rewriteMime=image/*&refresh=31536000&resize_w=400&resize_h=400&no_expand=1"></a></div>';
						b+='<div class="vid-im"><a href="'+a.at.l+'" target="_blank" rel="nofollow"'+(a.at.v?' class="v" onclick="inet.line.embed(this,\''+a.at.v.l+'\','+a.at.v.w+','+a.at.v.h+');return false;"':'')+'><img src="'+a.at.i+'" style="max-width:500px; max-height:375px;"><i></i></a></div>';
					}
					else if(a.at.v)
					{
						b+='<div class="vid-eb"><object width="'+a.at.v.w+'" height="'+a.at.v.h+'">'+
									 '<param name="movie" value="'+a.at.v.h+'"><param name="wmode" value="opaque">'+
									 '<embed src="'+a.at.v.l+'" wmode="opaque" width="'+a.at.v.w+'" height="'+a.at.v.h+'"></embed></object></div>';
					}
					if(a.at.d)
					{
						b+='<div class="vid-dc">'+a.at.d+'</div>';
					}
				}
				if(a.lc)
				{
					b+= '<div><div class="mp">'+
					'<img src="http://maps.googleapis.com/maps/api/staticmap?center='+a.lc.l[0]+','+a.lc.l[1]+'&markers=color:blue%7Clabel:A%7C'+a.lc.l[0]+','+a.lc.l[1]+'&zoom=15&size=490x150&maptype=roadmap&sensor=false" style="margin:5px 0px 5px 5px">'+
					'<div class="mp-n">'+a.lc.n+'</div></div></div>';
				}
				
				b += '</div><p class="clear"></p></div></div><div class="sh-hd-ms-x close">X</div></div>';
				$('.sh-hd-wl').html(b);
				inet.line.update();
			}
		}
		,line:
		{		
			hide:function(i){
				inet.box.confirm({title:'ซ่อนโพสต์',detail:'คุณต้องการซ่อนโพสต์นี้ตลอดไปหรือไม่',click:function(){inet.api('/me/line/hide-'+i);}});
			},
			ignore:function(i){
				inet.box.confirm({title:'ซ่อนโพสต์จากบุคคลนี้',detail:'คุณต้องการซ่อนโพสต์ทั้งหมดจากบุคคลหรือไม่',click:function(){inet.api('/me/line/ignore-'+i);}});
			},
		}
	},
	line:{
		timer:null,start:0,end:0,last:'/line',lasted:'/line',replace:false,content:'',
		view:function(u,t)
		{
			inet.title.insert('default',t);
			inet.line.icn();
			inet.line.update();
		},
		go:function(url)
		{
			var $top=$(document).scrollTop();
			if(arguments.length>1 && arguments[1])inet.hash.top();
			if(url.length<2)url='/line';
			if(url==inet.url)$top=0;
			var tm=(new Date).getTime()/1000;
			if(!inet.profile.history[inet.url])
			{
				inet.profile.history[inet.url]={ct:$('#pf-content').clone(true),t:tm,h:document.title,top:$top};
			}
			else
			{
				var c=inet.profile.history[inet.url];
				c.ct=$('#pf-content').clone(true);
				c.t=tm;
				c.top=$top;
			}
			$('.lnav .ul ul').css('display','none');
			var u = url.split('/');
			
			if(inet.hash.popped || ('state' in window.history))
			{
				inet.hash.popped=true;
				if(arguments.length>2 && arguments[2])
				{
					
				}
				else if(url!=inet.url)
				{
					history.pushState({ path: url }, '', url);
				}
			}
			else
			{
				window.location.href = '#!'+url;
			}
			inet.url = url;
			inet.post.is_tinyMCE=false;
			var l=inet.line.last,s=l.split('/');
			var g=(!u[1]?'line':u[1]),h=(!s[1]?'line':s[1]);
			inet.line.last=url;
			inet.line.icn();
			var ifr=$('iframe#ijax');
			if(!ifr.length)
			{
				$('body').append('<iframe id="ijax" frameborder="0" style="position:absolute; top:-9999px; left:-9999px"'+(window.ActiveXObject?' src="javascript:false"':'')+ '></iframe>');
				$('#ijax').load(function(e) {});
			}
			$('#ijax').attr('src','/ajax'+url);
			inet.line.lasted=inet.line.last;
		},
		asyn:function(b)
		{
			$('#pf-content').html(b.html);
			inet.line.view(b.url,b.title);
			inet.profile.updating=false;
		},
		
		icn:function()
		{
			var s=inet.line.last.split('/'),l=(s.length<2?'line':s[1]);
			inet.line._icn=($.inArray(l,['line','friends','photos','notifications','import','settings','maps','messages','feedback','birthday','topvote','people','credit','chat','blogs'])>-1?l:'profile');
			if(inet.line._icn=='line')
			{
				$('.lnav .cur').removeClass('cur');
				var c=(s.length>2?s[2]:'');
				$('.lnav .ln-page-'+c).addClass('cur');
				if($.inArray(c,['all','spam','quiz'])>-1)
				{
					inet.line._icn=c;
				}
				else if(c=='list'&&s.length>3)
				{
					inet.line._icn=c+'-'+s[3];
				}
			}
			$('.nav-ln li a i.cur').removeClass('cur');
			$('.nav-ln li a i.nav-ln-'+inet.line._icn).addClass('cur');
		},
		parse:function(a,b)
		{
			inet.profile.updating=false;
			if(b=='hide')
			{
				$('.ln-'+a+' .ct').css('display','none').after('<div class="ct-h">ซ่อนโพสนี้เรียบร้อยแล้ว (<span class="ptr2" onclick="inet.api(\'/me/line/unhide-'+a+'\');">ยกเลิก</span>)</div>');
			}
			else if(b=='unhide')
			{
				$('.ln-'+a+' .ct').css('display','block');
				$('.ln-'+a+' .ct-h').remove();
			}
			else if(b=='ignore')
			{
				$('#_line .ln[uid='+a+'] .ct').css('display','none').after('<div class="ct-h">ซ่อนโพสทั้งหมดจากบุคคลนี้เรียบร้อยแล้ว (<span class="ptr2" onclick="inet.api(\'/me/line/unignore-'+a+'\');">ยกเลิก</span>)</div>');
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
				inet.line.content='';
				inet.line.start = parseInt($('#_line .ln:first').length?$('#_line .ln:first').data('ds'):0);
				inet.line.end = parseInt($('#_line .ln:last').length?$('#_line .ln:last').data('ds'):0);
		
				for(var j=0;j<a.length;j++)
				{
					var b=a[j];
					if($('#_line_ln'+b._id).length)
					{
						if(b.cm && b.cm.d)
						{
							$('.cm-c-'+b._id).html(b.cm.c);
							for(var i=0;i<b.cm.d.length;i++)
							{
								 inet.profile.cm.insert(b._id,b.cm.d[i]);
							}
						}
						$('.lk-c-'+b._id).html(b.lk&&b.lk.c?b.lk.c:'0');
						$('.sh-c-'+b._id).html(b.sh&&b.sh.c?b.sh.c:'0');
						$('.cm-c-'+b._id).html(b.cm&&b.cm.c?b.cm.c:'0');
					}
					else
					{
						if(b.ds >= inet.line.start)
						{
							inet.line.start = b.ds;
							$('#_line').prepend(inet.line.convert(b));
						}
						else if(b.ds <= inet.line.end)
						{
							inet.line.end = b.ds;
							$('#_line').append(inet.line.convert(b));
						}
						else
						{
							$('#_line .ln').each(function(){
								var  c = parseInt($(this).data('ds'));
								if(b.ds < c)
								{
									$(this).before(inet.line.convert(b));
									return false;
								}
							});
						}
					}
				}
				inet.line.lasted = inet.line.last;
				if(a.length==30 && !$('.ln-next').length)
				{
					$('#_line').append('<div class="ln-next"><span onclick="inet.line.next()" class="ptr2" style="display:block">โหลดข้อมูลเพิ่มเติม</span></div>');
				}
				inet.line.update();
				if(a.length==1)
				{
					inet.profile.cm.pop(a[0]._id,1);
				}
			}
		},
		next:function()
		{
			var n=parseInt($('#_line .ln:last').length?$('#_line .ln:last').data('ds'):0),a=inet.line.last,b=(a=='/'?'/line':a);
			if(n && $('.ln-next span').length && b.substring(0,5)=='/line')
			{
				inet.line.last=inet.line.lasted=b;
				$('.ln-next').html('กรุณารอซักครู่...');
				inet.api('/me'+b+'/next-'+n);
			}
			else if(n && $('.ln-next span').length && $('#_line').data('profile'))
			{
				inet.line.last=inet.line.lasted=b;
				$('.ln-next').html('กรุณารอซักครู่...');
				inet.api('/profile-'+$('#_line').data('profile')+'/line/next-'+n);
			}
		},
		convert:function(p)
		{
			var $v = '<div id="_line_ln'+p._id+'" data-ln="'+p._id+'" data-ha="'+(p.ha?1:0)+'" data-ds="'+p.ds+'" data-ty="'+p.ty+'" data-uid="'+p.u._id+'" data-pid="'+(p.p?p.p._id:'')+'" class="ln ln-'+p._id+'" data-expand="'+(p.is_profile?1:'')+'">'+
			(p.md&&p.md=='spam'?'<div class="sp-b">แจ้งรายงานเมื่อ: <span class="ago" datetime="'+(p.sp&&p.sp.ds?p.sp.ds.sec:'0')+'"></span>, แจ้งล่าสุดโดย: '+p.sp.un+', ข้อหา: '+p.sp.rn+'  - <input type="button" class="button" value="ยกเลิกการแจ้งสแปม" onClick="inet.ajax.gourl(\'/line\',\'unsetspam\','+p._id+')"></div>':'')+
			'<div class="av"'+(p.u._id?' av="'+p.u._id+'"':'')+'><a href="/'+p.u.link+'" class="h" title="'+p.u.name+'"><img src="'+p.u.himg+'" class="img-uid-'+p.u._id+'"></a>'+(p.u.pet?'<p class="pet"><img src="'+p.u.pet+'"></p>':'')+'</div>'+
			'<div class="ct-s">'+
			'<span class="inter" ';
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
			$v+='</span>, <a href="'+(p.is_profile?'/'+p.is_profile:'')+'/line/'+p._id+'" class="h"><span class="ago" datetime="'+(p.de?p.de:p.ds)+'">'+inet.time.cal(p.de?p.de:p.ds)+'</span></a>';
			if(p.de)$v+=' <span class="ln-ed">(แก้ไข)</span>';
			$v+='<span class="sm-a"><a href="/'+p.u.link+'" class="h">'+p.u.name+'</a></span></div>'+
			'<div class="ct">';
			if(p.p && !p.is_profile)
			{
				$v+='<div class="ct-pf">โพสต์บนไลน์ของ <span class="av" av="'+p.p._id+'"><a href="/'+p.p.link+'" class="h" title="'+p.p.name+'"><img src="'+p.p.himg+'"></a></span> <span class="n"><a href="/'+p.p.link+'" class="h" title="'+p.p.name+'">'+p.p.name+'</a></span></div>';
			}
			
			if(p.ty=='gift')
			{
				$v+='<div><div style="width:138px; margin:5px 5px 0px; padding:5px 0px; border:1px solid #f5f5f5; float:left"><img src="http://s1.boxza.com/gift/128/'+p.tt+'.png"></div>';
				$v+='<div class="dt ev" style="width:"400px; float:left">'+(p.ms?inet.itag(p.ms,p.uk,p.is_profile):'')+'</div>';
				$v+='<p class="clear"></p></div>';
			}
			else if(p.ty=='quiz')
			{
				$v+='<div><div style="width:138px; margin:5px 5px 0px; padding:5px 0px; border:1px solid #f5f5f5; float:left"><img src="http://s0.boxza.com/static/images/profile/quiz.png"></div>';
				$v+='<div class="dt ev" style="width:"350px; float:left">'+(p.ms?inet.itag(p.ms,p.uk,1):'')+'</div>';
				$v+='<p class="clear"></p><div>*** เฉพาะสมาชิกที่สมัครด้วย Facebook หรือยืนยันการสมัครสมาชิกผ่านอีเมล์แล้วเท่านั้น ***</div></div>';
			}
			else
			{
				$v+='<div class="dt ev">'+(p.ms?inet.itag(p.ms,p.uk,p.is_profile):'')+'</div>';
			}
			if(p.ty=='poll' && p.po && p.po.d)
			{
				$v+='<div class="ln-poll ln-poll-'+p._id+'"><div class="l">สร้างเมื่อ <span class="ago" datetime="'+p.da+'">'+inet.time.cal(p.da)+'</span>, จำนวนผู้ร่วมโหวตทั้งหมด '+p.po.c+' คน</div>';
				for(var b=0;b<p.po.d.length;b++)
				{
					$v+='<div><label style="background-position:'+Math.floor((p.po.d[b].c / Math.max(1,p.po.c))*560)+'px -143px"><input type="radio" name="poll-'+p._id+'" value="'+p.po.d[b].i+'" onClick="inet.api(\'/me/poll/'+p._id+'-'+p.po.d[b].i+'\')"'+(inet.my && $.inArray(inet.my._id,p.po.d[b].u)>-1?' checked':'')+'> '+p.po.d[b].m+'<i>'+p.po.d[b].c+' โหวต</i><p></p></label></div>';
				}
				$v+='</div>';
			}
			
			if(p.pt && p.pt.tmp)
			{
				if(p.ty=='cover')
				{
					$v+='<div class="pt"><a href="/'+p.u.link+'" class="h"><img src="'+p.pt.tmp+'"></a></div>';
				}
				else
				{
					$v+='<div class="pt"><a href="/photos/photo-'+p._id+'" onClick="inet.api(\'/me/photos/photo-'+p._id+'\');return false;"><img src="'+p.pt.tmp+'"></a></div>';
				}
			}
			else if(p.ty=='album' && p.pt && p.pt.f)
			{
				$v+='<div class="pt"><ul class="pt-al">';
				for(var j=0;j<p.pt.f.length;j++)
				{
					$v+='<li><a href="/photos/photo-'+p.pt.f[j].i+'" onClick="inet.api(\'/me/photos/photo-'+p.pt.f[j].i+'\');return false;"><img src="'+p.pt.f[j].tmp+'"></a></li>';
				}
				$v+='<p class="clear"></p></ul></div>';
			}
			if(p.at)
			{
				$v+='<div class="vid-tt"><a href="'+p.at.l+'" target="_blank" rel="nofollow">'+p.at.t+'</a></div>';
				if(p.at.i)
				{
					$v+='<div class="vid-im"><a href="'+p.at.l+'" target="_blank" rel="nofollow"'+(p.at.v?' class="v" onclick="inet.line.embed(this,\''+p.at.v.l+'\','+p.at.v.w+','+p.at.v.h+');return false;"':'')+'><img src="'+p.at.i+'" style="max-width:500px; max-height:375px;"><i></i></a></div>';
				}
				else if(p.at.v)
				{
					$v+='<div class="vid-eb"><object width="'+p.at.v.w+'" height="'+p.at.v.h+'"><param name="movie" value="'+p.at.v.h+'"><param name="wmode" value="opaque"><embed src="'+p.at.v.l+'" wmode="opaque" width="'+p.at.v.w+'" height="'+p.at.v.h+'"></embed></object></div>';
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
					$v+='<div class="pt"><a href="/photos/photo-'+s._id+'" onClick="inet.api(\'/me/photos/photo'+s._id+'\');return false;"><img src="'+s.pt.tmp+'"></a></div>';
				}
				else if(s.ty=='album' && s.pt && s.pt.f)
				{
					$v+='<div class="pt"><ul class="pt-al">';
					for(var j=0;j<s.pt.f.length;j++)
					{
						$v+='<li><a href="/photos/photo-'+s.pt.f[j].i+'" onClick="inet.api(\'/me/photos/photo-'+s.pt.f[j].i+'\');return false;"><img src="'+s.pt.f[j].tmp+'"></a></li>';
					}
					$v+='<p class="clear"></p></ul></div>';
				}
				if(s.at)
				{
					$v+='<div class="vid-tt"><a href="'+s.at.l+'" target="_blank" rel="nofollow">'+s.at.t+'</a></div>';
					if(s.at.i)
					{
						$v+='<div class="vid-im"><a href="'+s.at.l+'" target="_blank" rel="nofollow"'+(s.at.v?' class="v" onclick="inet.line.embed(this,\''+s.at.l+'\',\''+s.at.w+'\',\''+s.at.h+'\');return false;"':'')+'><img src="'+s.at.i+'" style="max-width:500px; max-height:375px;"><i></i></a></div>';
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
					'<span class="lk lk-'+p._id+(inet.my && p.lk && $.inArray(inet.my._id,p.lk.u)>-1?' like':'')+'">'+
					'<span onClick="inet.api(\'/me/like/'+p._id+'\')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span> '+
					'<span onClick="inet.api(\'/me/like/'+p._id+'/unlike\')" class="unlike ptr"><i class="show-tooltip-s ptr" title="เฉยๆ"></i></span> '+
					'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-'+p._id+' ptr2" onClick="inet.api(\'/me/like/'+p._id+'/list\')">'+(p.lk&&p.lk.c?p.lk.c:'0')+'</span></span> '+
					'</span> '+
					'<span onClick="inet.api(\'/me/share/'+((p.ty=='share'&&p.sh&&p.sh.f&&p.sh.d)?p.sh.f:p._id)+'\')" class="ptr2"> แบ่งปัน</span> '+
					'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sh-c-'+p._id+'">'+(p.sh&&p.sh.c?p.sh.c:'0')+'</span></span> '+
					'<span onClick="inet.profile.cm.pop('+p._id+')" class="ptr2"> แสดงความเห็น</span> '+
					'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b cm-c-'+p._id+'">'+(p.cm&&p.cm.c?p.cm.c:'0')+'</span></span> '+
					(p.sp?'<span> สแปม</span> '+
					'<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sp-c-'+p._id+'">'+p.sp+'</span></span> ':'')+
					(p.s?'<span> ผ่าน<a href="'+p.via.l+'" target="_blank">'+p.via.t+'</a></span> ':'');
					
			if(p.hs&&p.hs.length)
			{
				$v+='<span> ป้ายกำกับ: ';
				for(var i=0;i<p.hs.length;i++)
				{
					$v+='<a href="/line/hash/'+encodeURIComponent(p.hs[i])+'" class="h">#'+p.hs[i]+'</a>';
				}
				$v+='</span>';
			}
			$v+='</div>';


			$v += '<div class="cm-g">'+
			'<div class="cm-d-'+p._id+'">';
			if(p.cm && p.cm.d)
			{
				if(p.cm.c>3)
				{
					$v+='<div class="cm-c cm-l-'+p._id+'"><span onClick="inet.api(\'/me/comment/'+p._id+'/list/clear\')" class="txt ptr2">ดูทุกความคิดเห็น (<span class="cm-c-'+p._id+'">'+p.cm.c+'</span>)</span></div>';
				}
				for(var i=0;i<p.cm.d.length;i++)
				{
					$v+=inet.profile.cm.insert(p._id,p.cm.d[i]);
				}
			}
			
			$v+='</div>';
			$v+='<div class="cm-p cm-p-'+p._id+'" id="_cm-p-'+p._id+'">';
			if(p.cm && p.cm.c && inet.my)
			{
				$v+='<div class="cm-p-i">'+
				'<div class="av"><a href="/'+inet.my.link+'"><img src="'+inet.my.img+'" class="img-uid-'+inet.my._id+'"></a></div>'+
				'<div class="cm-p-a">'+
				'<textarea class="tbox" data-cm="'+p._id+'" style="width:100%; height:40px" onkeypress="return inet.profile.cm.post(event,this)" placeholder="แสดงความคิดเห็น"></textarea>'+
				'</div><p class="clear"></p></div>';
			}
			$v+='</div></div></div>';
			$v+='<ul class="ac"><li onClick="inet.line.act('+p._id+');return false"><i></i><ul></ul></li></ul>';
			$v+='<p class="clear"></p></div>';
			return $v;
		},
		act:function(ln)
		{
			var l=$('#_line_ln'+ln);
			if(l.length)
			{
				var l2=l.find('.ac ul');
				if(l2.css('display')=='none')
				{
					if(inet.line.act.last)
					{
						$(inet.line.act.last).css('display','none');
						inet.line.act.last='';
					}
					if(inet.my)
					{
						inet.line.act.last='#_line_ln'+ln+' .ac ul';
						var u=l.data('uid'),p=l.data('pid'),ty=l.data('ty');
						if(u==inet.my._id||p==inet.my._id)
						{
							l2.html('<li><span onclick="inet.profile.cm.pop('+ln+')" class="ptr2">แสดงความเห็น</span></li>'+
							(u==inet.my._id&&inet.my._id==1&&(ty=='post'||ty=='photo')?'<li><span onclick="inet.ajax.gourl(\'/line\',\'getedit\','+ln+')" class="ptr2">แก้ไขข้อความนี้</span></li>':'')+
							((ty&&ty!='album')||(!ty)?'<li><span onclick="inet.line.del('+ln+')" class="ptr2">ลบข้อความนี้</span></i>':'')).css('display','inline-block');
						}
						else
						{
							var g=l.find('.sm-a').html(),k='<li><span onclick="inet.profile.cm.pop('+ln+')" class="ptr2">แสดงความเห็น</span></li>'+
							'<li><span onclick="inet.profile.line.hide('+ln+')" class="ptr2">ซ่อนโพสนี้</span></li>'+
							'<li><span onclick="inet.profile.line.ignore('+u+')" class="ptr2">ซ่อนทุกโพสจาก '+g+'</span></li>'+
							'<li><span onclick="inet.box.load(\'/dialog/report/'+ln+' #report_line\')" class="ptr2">แจ้งการละเมิดหรือสแปม</span></li>';
							if(inet.my.am)
							{
								var inm=l.find('.inter').data('ref'),ha=l.data('ha');
								if((!ty || ty!='album') && inet.my.am==9)
								{
									k+='<li><span onclick="inet.line.del('+ln+')" class="ptr2">ลบโพสต์นี้ - Admin</span></i>';
								}
								if(inm=='0')
								{
									if(ha=='1')
									{
										k+='<li><span onclick="inet.ajax.gourl(\'/line\',\'setha\','+ln+',0)" class="ptr2">แสดงในหน้าทั้งหมด - Admin</span></li>';
									}
									else
									{
										k+='<li><span onclick="inet.ajax.gourl(\'/line\',\'setha\','+ln+',1)" class="ptr2">ไม่แสดงในหน้าทั้งหมด - Admin</span></li>';
									}
								}
							}
							l.find('.ac ul').html(k).css('display','inline-block');
						}
					}
					else
					{
						l.find('.ac ul').html('<li>กรุณาล็อคอิน</i>').css('display','inline-block');
					}
				}
				else
				{
					l.find('.ac ul').css('display','none');
				}
			}
		},
		getnew:function()
		{
			clearTimeout(inet.line.timer);
			var a=inet.line.last,b=(a=='/'?'/line':a);
			if(b.substring(0,5)=='/line')inet.api('/me'+b);
			inet.line.timer=setTimeout(function(){inet.line.getnew();},60000);
		},
		update:function(){
			if(inet.url.substr(0,7)=='/photos'){if($('.photos > li').length>0)inet.profile.pt.layout('.photos > li');}
			inet.time.ago();
			inet.people.load();
			clearTimeout(inet.line.timer);
			inet.line.timer=setTimeout(function(){inet.line.getnew();},60000);
			inet.tooltop();
			/*
			var u = inet.line.last.split('/'),g=(!u[1]?'line':u[1]);
			$('.lnav .cur').removeClass('cur');
			if(g=='line')
			{
				var c=(u.length>2?u[2]:'');
				$('.lnav .ln-page-'+c).addClass('cur');
			}
			*/
			$('.pt-al:not(.ev)').addClass('ev').each(function(index, element) {
            var a=$(this),b=a.children('li');
				if(b.length==1)
				{
					a.removeClass('pt-al');
				}
				else if(b.length==2)
				{
					$(b).eq(0).css('width',320);
					b.css('height',250).find('a').css('margin','auto');
				}
				else if(b.length==3)
				{
					$(b).eq(0).css({'width':320,'height':250});
				}
				else if(b.length==4)
				{
					$(b).eq(0).css('height',250).find('a').css('margin','auto');
					$(b).eq(1).css('height',250).find('a').css('margin','auto');
				}
				else if(b.length==5)
				{
					$(b).eq(0).css('height',250).find('a').css('margin','auto');
				}
         });
			$('.dt:not(.ev),.cm-dt:not(.ev)').each(function(){
				if(!$(this).hasClass('ev'))
				{
					$(this).addClass('ev').html(inet.itag($(this).html(),$(this).data('user'),$(this).parent().parent().data('expand')));
				}
			});
			inet.people.load();
		},
		del:function(i){inet.box.confirm({title:'ลบโพสต์',detail:'คุณต้องการลบโพสต์นี้หรือไม่',click:function(){inet.ajax.gourl('/line','delline',i);}});},
		embed:function(e,u,w,h)
		{
			var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
			var match = u.match(regExp);
			if (match&&match[7].length==11){
				u = 'http://www.youtube.com/embed/'+match[7]+'?autoplay=1&autohide=1&border=0&wmode=transparent&hl=th&cc_lang_pref=th';
				h = Math.floor((500*h)/w);
				w=500;
			}
			var em=inet.popup.open($(e).parent().parent().find('.vid-tt a').html(),'<iframe src="'+u+'" width="'+w+'" height="'+h+'" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0"></iframe>');
			var l=$(e).parent().offset().left+300,t=$(e).parent().offset().top-100;
			if(l-$(document).scrollLeft()<100)l=100+$(document).scrollLeft();
			if(t-$(document).scrollTop()<50)t=50+$(document).scrollTop();
			em.css({'position':'fixed','left':l-$(document).scrollLeft(),'top':t-$(document).scrollTop()});
			em.attr('wl',l-$(document).scrollLeft());
			em.attr('wt',t-$(document).scrollTop());
		}
	},
	hash: {
		popped: false, initurl:location.href,
		more:function(lt){inet.hashurl(inet.hash.last.substr(2),1,lt);},
		hash:function(){
			var h=window.location.hash
			_url= (h.substr(0,2)=='#!')?h.substr(2):'/';
			if(inet.profile.enabled && !inet.hash.popped)
			{
				inet.hash.go('#!'+_url);
			}
		},
		go:function(h)
		{
			if(h && h.substr(0,2)=='#!')
			{
				var url=h.substr(2);
				inet.line.go(h.substr(2),true,true);
			}
		},
		close:function()
		{
			if(inet.hash.popped)
			{
				history.pushState({ path: location.pathname }, '', location.pathname);
			}
		},
		top:function(){$('html,body').animate({scrollTop:0}, 500,'easeOutExpo');}
		//top:function(){$('html,body').animate({scrollTop:0}, 10);}
	},
	post:{
		key:false,
		update:function(l)
		{
			var m=$.trim($('#_line_ln'+l+' .ct-ed textarea').val());
			(m)?inet.ajax.gourl('/line','setedit',l,m):inet.box.alert('กรุณากรอกข้อความ');
		},
		postfilter:function()
		{
			$('#photo_base64').val('');
			//var arg = inet.ajax.form($('#spost').get(0));
			if(inet.profile.pt.cfilter)
			{
				//pho-hd-img-src
				var c=$('.pho-hd-img-cv canvas').get(0);
				if(c)
				{
					var dataURL = c.toDataURL('image/'+inet.profile.pt.tfilter);
					$('#photo_base64').val(dataURL.replace(/^data:image\/(gif|png|jpg);base64,/, ""));
				}
			}
			$('#photo_rotate').val(inet.profile.pt.crotate);
			inet.ajax.gourl('/line','post',$('#spost').get(0));
			inet.post.scn();
			$('#post-msg').prop('disabled','disabled');
			$('#lphoto').html('');
			$('.pho-hd').remove();
			$('html').removeClass('hdMode');
		},
		scn:function()
		{
			var p=$('._post'),w=p.width()+2,h=p.height()+2,l=p.offset().left,t=p.offset().top;
			if(!$('._post_tmp').length)
			{
				$('body').append($('<div>').addClass('_post_tmp').css({'position':'absolute',opacity:0.5,'background':'#666 url('+inet.images+'loading.gif) center center no-repeat'}));
			}
			$('._post_tmp').css({'left':l,'top':t,'width':w,'height':h});
		},
		send:function(e)
		{
			if($('input[name=poll]',e).length)
			{
				var ad=0;
				$('input[name=poll]',e).each(function()
				{
					if($.trim($(this).val()))ad++;
				});
				if(ad<2)
				{
					$('input[name=poll]:first',e).focus();
					inet.box.alert('กรุณากรอกคำตอบอย่างน้อย 2 ตัวเลือก');
					return;
				}
			}
			tinyMCE.triggerSave(true,true);
			if($('input[name=to]',e).length==0)
			{
				$('.lto li.to').mouseover()
			}
			else if($.trim($('textarea[name=msg]',e).val())=='')
			{
				tinyMCE.execCommand('mceFocus',false,'post-msg');
			}
			else
			{
				$('#post-bt').prop('disabled','disabled');
				if($('#post_photo').length && $('#post_photo').val())
				{
					inet.upload.start($('#post_photo')[0],function(f){
						f.append('<input type="hidden" name="album" value="'+$('#lphoto select[name=album]').val()+'">');
						inet.post.scn();
					},function(x){
						if(x.status=='OK')
						{
							$('#photo_id').val(x.photo);
							if($('select[name=photo_act]').val()=='edit')
							{
								inet.post.scn();
								inet.ajax.gourl('/photos','editfilter',x.photo);
							}
							else
							{
								inet.post.scn();
								inet.ajax.gourl('/line','post',e).fail(function(){inet.post.clear();});
								$('#post-msg').prop('disabled','disabled');
								$('#lphoto').html('');
							}
						}
						else
						{
							$('#lphoto').html('');
							$('#post-bt').removeProp('disabled');
							$('#post-msg').removeProp('disabled');
							$('._post_tmp').remove();
							inet.box.alert(x.message);
						}
					})
				}
				else
				{
					inet.ajax.gourl('/line','post',e).fail(function(){inet.post.clear();});
					inet.post.scn();
				}
			}
		},
		delto:function(e)
		{
			$(e).parent().remove();
		},
		clear:function()
		{
			$('#post-bt').removeProp('disabled');
			$('#post-msg').removeProp('disabled').val('');
			$('#llink > div').remove();
			$('#lloc > div').remove();
			$('#lgif > div').remove();
			$('#addlink').val('');
			$('#lpoll').html('');
			$('#lalink').hide('fast');
			$('._post').removeClass('expand');
			/*
			$('#post-msg').removeAttr('style');
			$('.post-bar').removeAttr('style');
			$('.ps-a').removeAttr('style');
			$('.ps-a a').removeAttr('style');
			$('.ps-a a img').removeAttr('style');
			$('.post-wrap').removeAttr('style');
			$('.ln-icon-exp').removeAttr('style');
			var c=$('#post-msg').clone(false);
			$('.post-wrap').html('').append(c);
			*/
			$('._post_tmp').remove();
			
			
			var l=inet.url.split('/');
			var g=(!l[1]||l[1]=='line')?'':'';
			
			
			inet.line.go(((!l[1]||l[1]=='line')?'/line':inet.url),true,true);
		},
		cancel:function(al)
		{
			$('#post-bt').removeProp('disabled');
			$('#post-msg').removeProp('disabled');
			$('._post_tmp').remove();
			inet.box.alert(al);
		},
		search:function(e)
		{
		},
		group:function(e,i)
		{
			if(!$('#lto .lto-'+i)[0])
			{
				var f=i.split('-');
				if(i=='-1')
				{
					$('.lto-0').remove();
				}
				else if(i=='0')
				{
					$('.lto--1').remove();
				}
				$('#lto').append('<span class="lto-'+i+(f[0]=='fb'?' lto-fb':'')+'"><p></p><input type="hidden" name="to" value="'+i+'"> '+$(e).html()+' <i onClick="inet.post.delto(this)"></i></span>');
			}
		},
		geo:function(){if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(p){inet.ajax.gourl('/line','getvar','geo',p.coords.latitude,p.coords.longitude);});}},
		photo:function(){inet.ajax.gourl('/line','getvar','photo');},
		checklink:function(url){
			if($('#addlink').val()==''&&$('#llink div').length==0 && $('#lphoto div').length==0 && $('#lloc div').length==0 && $('#lpoll div').length==0)
			{
				var u=$.trim(url);
				if(u.indexOf('://')==-1)u='http://'+u;
				 $('#lalink').toggle(true);
				 $('#addlink').val(u);
				 inet.post.getlink(u);
			}
		},
		getlink:function(l)
		{
			$('#lalink_img').css('display','inline');
			inet.ajax.gourl('/line','getvar','link',l)
		},
		tinyMCE:function()
		{
			if(inet.post.is_tinyMCE)
			{
				return;
			}
			tinyMCE.init({
				mode : "exact",
				elements : "post-msg" ,
				dialog_type : "modal",
				valid_elements : "a[href|target=_blank|rel=nofollow],strong/b,div[align],p,br,ol,ul,li,blockquote,span[style],img[src|alt|title],em",
				width:485,
				theme : "advanced",
				skin : "boxza",
				language : "en",
				plugins : "autolink,lists,pagebreak,advimage,advlink,paste,autoresize",
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink",
				theme_advanced_buttons2 : "",
				theme_advanced_buttons3 : "",
				theme_advanced_buttons4 : "",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "center",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_path : false,
				theme_advanced_resizing : true,
				theme_advanced_resize_horizontal : false,
				autoresize_min_height : 100,
				autoresize_max_height : 400,
				cleanup : true,
				convert_urls : false,
				remove_script_host: true,
				setup : function(ed)
				{
					ed.onInit.add(function(ed, evt){
						tinyMCE.execCommand('mceFocus',false,'post-msg');
						inet.post.is_tinyMCE=true;
					});			 
					ed.onKeyUp.add(function(ed, e) {
						var a = $(ed.getBody()).find('a');
						if(!a.length)return;
						inet.post.checklink(a.text());
					});
				},
			});
		},
		expand:function(a)
		{
			var e=$('#post-msg');
			$('._post').addClass('expand');
			//$('.post-bar').css({'display':'block'});
			//$('.post-tags').css({'display':'block'});
			//$('.post-title').css({'display':'block'});
			//$('.ps-a').animate({width:56},200);
			//$('.ps-a a').animate({width:56, height:56},200);
			//$('.ps-a a img').animate({width:50, height:50,'margin':3},200);
				
			if(!inet.post.is_tinyMCE)
			{
				//$('.ln-icon-exp').hide('fast');
				$(e).val('');
				//$('.post-wrap').css('width',490);
				inet.post.tinyMCE();
			}
			
			$('#post-tagged:not(.ev)').addClass('ev').bind('keypress',function(e){		
				 var c = e.which,t=$('#post-tagged').val(),s=String.fromCharCode(c);
				 //$('#post-tagged').val(t=t.replace(/[\u0021-\u002f\u003a-\u0040\u005b-\u005e\u0060\u007b-\u007e]/g,''));
				 if((c==13||c==44))
				 {
					 //e.preventDefault();
					 t=$.trim(t.replace(/\s+/,' '));
					 if(t)
					 {
						$('#post-tagged').before(' <span onclick="$(this).remove()" class="post-tags-span">#'+t+'<input type="hidden" name="hash" value="'+t+'"></span>' ); 
						$('#post-tagged').val('');
					 }
					return false;
				 }
				 else if(!s.replace(/[\u0021-\u002f\u003a-\u0040\u005b-\u005e\u0060\u007b-\u007e]/g,''))
				 {
					return false; 
				 }
			}).bind('keyup',function(v){		
				 v = v||window.event;
				 var c = v.which,t=$('#post-tagged').val(),t2=t.replace(/[\u0021-\u002f\u003a-\u0040\u005b-\u005e\u0060\u007b-\u007e]/g,'').replace(/\s+/,' ');
				 if(t!=t2)
				 {
					 $('#post-tagged').val(t2);
				 }
			});
			$('.post-tags:not(.ev)').addClass('ev').bind('click',function(v){$('#post-tagged').focus()});
			
			if(a)
			{
				$('#llink,#lloc,#lphoto,#lpoll,#lgif').html('');
				$('#lalink').toggle(false);
			}
			if(a=='pin')
			{
				inet.post.geo();
			}
			else if(a=='link')
			{
				$('#lalink').toggle();
			}
			else if(a=='photo')
			{
				inet.post.photo();
			}
			else if(a=='gif')
			{
				$('.sh-hd').remove();
				$('html').addClass('hdMode');

				$('body').prepend($('<div>').addClass('sh-hd'));
				$('.sh-hd').html('<div class="sh-hd-ct"><div class="sh-hd-in"><div class="sh-hd-wr"><div class="sh-hd-wl"><div class="sh-hd-ms"><div style="min-width:600px; min-height:200px"><h3 style="margin:0px 0px 10px">ถ่ายภาพเคลื่อนไหวจากกล้องเว็บแคม</h3><div style="text-align:center;margin:5px 0px 15px 0px" id="gif-cam"></div><div style="text-align:center" id="gif-help"></div><div class="sh-hd-ms-x close" onclick="inet.profile.gif.close()">X</div></div></div></div></div></div></div>');
				$('#gif-cam').html('<object width="895" height="380"><param name="movie" value="http://s0.boxza.com/static/flash/cam.swf"></param><param name="quality" value="high"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://s0.boxza.com/static/flash/cam.swf" type="application/x-shockwave-flash" width="895" height="380" quality="high" allowscriptaccess="always" allowfullscreen="true"></embed></object>');
				$('#gif-help').html('<div style="width:500px; margin:10px auto 0px auto;border:1px solid #f0f0f0; padding:10px;text-align:left"><h4 style="text-align:center">วิธีใช้งาน <small>(สำหรับท่านที่มีกล้องเว็บแคมเท่านั้น)</small></h4>1. เมื่อหน้าต่างนี้แสดงขึ้นมา ให้คลิก Allow เพื่อเปิดใช้กล้อง<br>2. คลิกปุ่ม "ถ่าย" เพื่อถ่ายรูปของท่าน (รูปจะถูกถ่ายหลังจากคลิก 3วินาที)<br>3. เมื่อถ่ายรูปมากกว่า 2 ครั้งขึ้นไป จะมีปุ่ม "บันทึก" แสดงขึ้นมา</div>');
			}
			else if(a=='poll')
			{
				$('#lpoll').html('<div id="anspoll"><h4><img src="'+inet.images+'del.gif" style="" class="right ptr" onclick="$(\'#anspoll\').remove()">ตัวเลือกคำตอบ<p class="clear"></p></h4>'+inet.post.poll.ch+inet.post.poll.ch+inet.post.poll.ch+'</div>');
			}
		},
		poll:{
			ch:'<div><input type="text" name="poll" class="tbox" placeholder="เพิ่มตัวเลือก" onfocus="inet.post.poll.add()"></div>',
			add:function()
			{
				var a=$('#anspoll input');
				if(a.length)
				{
					var ad=0,am=0;
					a.each(function()
					{
						if(!$(this).val())ad++;
						am++;
					});
					if(ad<2 && am<15)$('#anspoll').append(inet.post.poll.ch);
				}
			}
		},
	},
	chat:
	{
		lastid:0,tmr:'',lastinp:null,index:0,zindex:1000,lastemo:'o',tmp:'',dl:null,ide:100,info:new Object,enabled:true,_status:{'online':'ออนไลน์','away':'ไม่อยู่','busy':'ไม่ว่าง','invisible':'ซ่อนตัว','offline':'ออฟไลน์'},
		load:function()
		{
			if(inet.my&&inet.my._id)
			{
				if($('.chat').length)
				{
					if(inet.chat.tmp)
					{
						$('.chat').html(inet.chat.tmp);
					}
					else
					{
						inet.chat.api('list',{'last':inet.chat.lastid});
					}
				}
				clearInterval(inet.chat.dl);
				if(inet.chat.enabled)
				{
					inet.chat.dl=setInterval(function(){inet.chat.ide++;if(inet.chat.ide>600)inet.chat.ide=300;},1000);
				}
			}
		},
		api:function(a)
		{
			clearTimeout(inet.chat.tmr);
			inet.api('/me/chat/'+a,(arguments.length>1?arguments[1]:[]));
			if($('.chat').length)inet.chat.tmr=setTimeout(function(){inet.chat.delay()},Math.max(2,Math.min(30,1+parseInt(inet.chat.ide/10)))*1000);
		},
		cpop:function(){$('.bz-chat-popup').css('display','none');$('html').removeClass('hdMode');	},
		emoticon:function(t)
		{
			if(arguments.length>1)
			{
				if($('.post-wrap .emo').hasClass('dropdown-open'))
				{
					inet.chat.lastinp='tinyMCE';
					$('#dropdown-chat-emo').dropdown('hide', 1);
				}
				else if(arguments[1]=='emo')
				{
					inet.chat.lastinp=$('.emo.dropdown-open').parent().parent().find('input');
					$('#dropdown-chat-emo').dropdown('hide', 1);
				}
			}
			else if(t)
			{
				t='[emoticon='+t+']';
			}
			
			if(inet.chat.lastinp&&t)
			{
				if(inet.chat.lastinp=='tinyMCE')
				{
					tinyMCE.execCommand('mceInsertContent', false, ' '+t);
					tinyMCE.execCommand('mceFocus',false,'post-msg');
				}
				else
				{
					inet.chat.lastinp.val(inet.chat.lastinp.val()+' '+t).focus();
				}
				inet.chat.cpop();
			}
			else if(arguments[1]=='emo')
			{
				inet.chat.emo('');
			}
			//inet.chat.cpop();
		},
		emo:function(ty)
		{
			if(!ty)
			{
				ty=inet.chat.lastemo;
			}
			else
			{
				inet.chat.lastemo=ty;
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
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'o\')"'+(ty=='o'?' style="font-weight:bold;color:#f90"':'')+'">Onion</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'y\')"'+(ty=='y'?' style="font-weight:bold;color:#f90"':'')+'">Yoyo</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'r\')"'+(ty=='r'?' style="font-weight:bold;color:#f90"':'')+'">Rabbit</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'p\')"'+(ty=='p'?' style="font-weight:bold;color:#f90"':'')+'">Panda</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'a\')"'+(ty=='a'?' style="font-weight:bold;color:#f90"':'')+'">Raccoon</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'m\')"'+(ty=='m'?' style="font-weight:bold;color:#f90"':'')+'">Milk Bottle</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'l\')"'+(ty=='l'?' style="font-weight:bold;color:#f90"':'')+'">Leaf</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'b\')"'+(ty=='b'?' style="font-weight:bold;color:#f90"':'')+'">Red Crab</a> | ';
				t+='<a href="javascript:;" onclick="inet.chat.emo(\'c\')"'+(ty=='c'?' style="font-weight:bold;color:#f90"':'')+'">Cloud</a>';
				t+='</div><ul class="bz-chat-pemo" style="width:'+(w-100)+'px; height:'+(h-220)+'px; overflow:auto;">';
				for(var i=1;i<=c;i++)
				{
					t+='<li><a href="#['+ty+i+']" onClick="inet.chat.emoticon(\''+ty+i+'\');return false;"><img src="http://s0.boxza.com/chat/emoticon/'+ty+'/'+i+'.gif" class="bz-chat-click-emo '+ty+'"></a></li>'
				}
				t+='<p style="clear:both;"></p></ul><div style="padding:5px; text-align:center;"><input type="button" value="ปิดหน้าต่างนี้" class="button" onclick="inet.chat.cpop()"></div>';
				$('.bz-chat-popup-wl').html(t);
				$('html').addClass('hdMode');	
			}
		},
		sound:function()
		{
			inet.chat.api('sound',{'last':inet.chat.lastid,'sound':(inet.chat._sound?0:1)});
		},
		playsnd:function()
		{
			if(inet.chat._sound && typeof($('#bz_chat_swf').get(0).playsound)=='function')
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
						inet.chat.info[a._id]=a;
						$('.ch-ps-'+a._id+' .bz-chat-info').find('a').html(a.name).end().find('img').attr('src',a.img);
					}
					break;
				case 'sound':
					(inet.chat._sound=(a?true:false))?$('.ch-sound').addClass('on'):$('.ch-sound').removeClass('on');
					break;
				case 'list':
				case 'online':
				case 'away':
				case 'busy':
				case 'invisible':
				case 'offline':
					if(!$('.chat .ch-list').length)
					{
						if(!$('#dropdown-chat-status').length)
						{
							var st='<div id="dropdown-chat-status" class="dropdown dropdown-tip"><ul class="dropdown-menu"><li><a href="javascript:;" onClick="inet.api(\'/me/chat/online\');"><i class="ch-status-online"></i> ออนไลน์</a></li><li><a href="javascript:;" onClick="inet.api(\'/me/chat/away\');"><i class="ch-status-away"></i> ไม่อยู่</a></li><li><a href="javascript:;" onClick="inet.api(\'/me/chat/busy\');"><i class="ch-status-busy"></i> ไม่ว่าง</a></li><li><a href="javascript:;" onClick="inet.api(\'/me/chat/invisible\');"><i class="ch-status-invisible"></i> ซ่อนตัว</a></li><li><a href="javascript:;" onClick="inet.api(\'/me/chat/offline\');"><i class="ch-status-offline"></i> ออฟไลน์</a></li><li class="dropdown-divider"></li><li><a href="javascript:;" onClick="inet.chat.sound()"><i class="ch-sound'+(inet.chat._sound?' on':'')+'"></i> เปิด/ปิดเสียง</a></li></ul></div>';
							$('body').append(st);
						}
						$('.chat').html('<div class="ch-list">'+
						'<div class="swf">'+
						'<object width="100%" height="62">'+
						'<param name="movie" value="http://s0.boxza.com/static/flash/museter/ffmp3-config.swf" />'+
						'<param name="flashvars" value="url=http://115.178.60.121:8000/;&lang=en&codec=mp3&volume=80&introurl=&traking=false&jsevents=false&buffering=5&skin=http://s0.boxza.com/static/flash/museter/ffmp3-mcclean.xml&title=BoxZa%20Radio&welcome=ยินดีต้อนรับสูง%20BoxZa.com" />'+
						'<param name="wmode" value="transparent" />'+
						'<param name="allowscriptaccess" value="always" />'+
						'<embed src="http://s0.boxza.com/static/flash/museter/ffmp3-config.swf" flashvars="url=http://115.178.60.121:8000/;&lang=en&codec=mp3&volume=80&introurl=&traking=false&jsevents=false&buffering=5&skin=http://s0.boxza.com/static/flash/museter/ffmp3-mcclean.xml&title=BoxZa%20Radio&welcome=ยินดีต้อนรับสูง%20BoxZa.com" width="100%" height="62" wmode="transparent" allowscriptaccess="always" type="application/x-shockwave-flash" />'+
						'</object>'+
						'</div>'+
						'<div class="bz-chat-swf"><embed src="/_static/flash/sound.swf?v=2" quality="high" wmode="transparent" id="bz_chat_swf" allowscriptaccess="always" type="application/x-shockwave-flash" width="1" height="1"></embed></div>'+	
						'<div class="ch-cap"><small data-dropdown="#dropdown-chat-status" class="ptr2"><i class="ch-status-'+b+'"></i> '+inet.chat._status[b]+'</small> <span></span></div><ul class="ch-list-on"></ul></div>');
					}
					else
					{
						$('.ch-cap small').html('<i class="ch-status-'+b+'"></i> '+inet.chat._status[b]);
					}
					$('.ch-list-on > li').removeClass('uid-on');
					if(b=='offline')
					{
						inet.chat.enabled=false;
						$('.ch-list-on i').attr('class','ch-status-offline');
					}
					else
					{
						inet.chat.enabled=true;
						if(a)
						{
							$('.ch-cap span').html('('+a.length+')');
							for(var i=0;i<a.length;i++)
							{
								if(a[i])
								{
									if(!$('.ch-list-on .uid-'+a[i]._id).length)
									{
										$('.ch-list-on').append('<li class="uid-'+a[i]._id+' uid-on" data-uid="'+a[i]._id+'"><a href="/'+a[i].link+'" onclick="inet.chat.add('+a[i]._id+');return false;"><img src="'+a[i].img+'"> <span class="n">'+a[i].name+'</span><span class="i"><span class="c"></span><i data-status="'+a[i].status+'" class="ch-status-'+a[i].status+'"></i></span></a></li>');
									}
									else
									{
										$('.ch-list-on .uid-'+a[i]._id).addClass('uid-on');
									}
									$('.uid-'+a[i]._id).find('i').attr('class','ch-status-'+a[i].status).data('status',a[i].status).end().find('.st').html(inet.chat._status[a[i].status]);;
								}
							}
						}
						
						$('.ch-list-on > li').each(function() {
							if(!$(this).hasClass('uid-on'))
							{
								$('.uid-'+$(this).data('uid')).find('i').attr('class','ch-status-offline').data('status','offline').end().find('.st').html(inet.chat._status['offline']);
								$(this).remove();
							}
						});
					}
					break;
				case 'chat':
					var play=false;
					inet.chat.ide=0;
					if(!a)return;
					for(var i=0;i<a.length;i++)
					{
						if(inet.chat.message(a[i]))play=true;
					}
					if(play)inet.chat.playsnd();
			}
		},
		message:function(a)
		{
			var al=(inet.chat.lastid>0?true:false),ret=false;
			var u = parseInt(a.u==inet.my._id?a.p:a.u);
			if(a._id)inet.chat.lastid=a._id;
			
			
			if(a.u==inet.my._id)
			{
				inet.title.clear();
			}
			if(!$('.ch-ps-'+u).length)
			{
				inet.chat.add(u);
			}
			if(!$('#bz_chat_text'+a._id).length || !a._id)
			{
				var cp=true;
				/*
					var ck=(inet.cookie.get('ch-min')||'');
					var c=(ck?JSON.parse(ck):{});
					if(typeof(c[u])!='undefined')
					{
						if(c[u]>=a.da.sec)cp=false;
					}
					if(cp && a.u!=inet.my._id)
					{
						var c=$('.ch-ps-'+u+' h3 strong').addClass('count').html();
						if(!c)c=0;
						$('.ch-ps-'+u+' h3 strong').html(parseInt(c)+1);
					}
				}
				*/
				if(a.u!=inet.my._id && cp && a.u)
				{
					inet.title.insert('chat_'+a.u,inet.chat.info[a.u].name+' สนทนากับคุณ');
					ret=true;
				}
				
				var h=$('#bz_box_'+u+'_div_l > div:last'),t='',nt=false,d,o;
				if(a.da)
				{
					d=new Date(a.da.sec * 1000),o=h.data('date');
					t='<p>'+d.getHours()+':'+d.getMinutes()+'</p>';
					if(o)
					{
						var ot=new Date(parseInt(o)*1000);
						if(d.toLocaleDateString()!=ot.toLocaleDateString())nt=true;
					}
					else
					{
						nt=true;
					}
				}
				
				if(nt && d)
				{
					var _d=["อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"];
					var _m=["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
					$('#bz_box_'+u+'_div_l').append('<div class="ch-time">'+_d[d.getDay()]+' '+d.getDate()+' '+_m[d.getMonth()]+' '+(d.getFullYear()+543)+'</div>');
				}
				$('#bz_box_'+u+'_div_l').append('<div id="bz_chat_text'+a._id+'" data-date="'+a.da.sec+'" class="'+(inet.my._id==a.u?'u':'p')+'"><span class="m">'+inet.itag(a.ms)+'</span><span class="t">'+(d.getHours()<10?'0':'')+d.getHours()+':'+(d.getMinutes()<10?'0':'')+d.getMinutes()+'</span></div><p class="clear"></p>');
				$('#bz_box_'+u+'_div').scrollTop(Math.max($('#bz_box_'+u+'_div_l').height(),$('#bz_box_'+u+'_div').height())+100);
			}
			return ret;
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
			$(ui.element).find('input').css({'display':'inline-block'});
			$(ui.element).find('.bz_box_div').css({'height':h-70});
		},
		add:function(id)
		{
			if(!$('.ch-ps-'+id).length)
			{
				if(!inet.chat.info[id])
				{
					var v=$('.ch-list-on .uid-'+id+' a'),l,t;
					if(v.length)
					{
						inet.chat.info[id]={_id:id,name:v.find('span').html(),img:v.find('img').attr('src'),link:v.attr('href'),status:v.find('i').data('status')}
						l=v.offset().left;
						t=v.offset().top - $(window).scrollTop();		
					}
					else
					{
						l=$('.ch-cap').offset().left;
						t=$('.ch-cap').offset().top - $(window).scrollTop();
						inet.chat.api('info',{'last':inet.chat.lastid,'uid':id});
						inet.chat.info[id]={_id:id,name:'กรุณารอซักครู่...',link:'',img:'',status:'offline'}
					}
				}
				var name=inet.chat.info[id].name;
				var w=Math.floor(Math.random()*($(window).width()-350-100))+100,h=Math.floor(Math.random()*($(window).height()-350-100))+100;
				inet.chat.zindex++;
				var y='<div class="bz-chat-box ch-ps-'+id+' uid-on" id="bz-chat-box-'+id+'" style="z-index:'+inet.chat.zindex+';opacity:0.1;left:'+l+'px;top:'+t+'px;width:100px;height:20px" zindex="'+inet.chat.zindex+'"><div class="bz-chat-info uid-'+id+'"><img src="'+inet.chat.info[id].img+'"><i class="ch-status-'+(inet.chat.info[id].status?inet.chat.info[id].status:'offline')+'"></i><span class="emo emo-1" data-dropdown="#dropdown-chat-emo"></span><span class="st">'+inet.chat._status[(inet.chat.info[id].status?inet.chat.info[id].status:'offline')]+'</span> <span class="close">X</span> <a href="'+(inet.chat.info[id].link?inet.chat.info[id].link:'/'+id)+'" class="bz-chat-user h">'+name+'</a></div><div id="bz_box_'+id+'_div" class="bz_box_div"><div class="bz_chat_ch_l" id="bz_box_'+id+'_div_l"></div></div><div class="inp"><input type="text" class="bz_box_input" id="bz_box_'+id+'_input" data-uid="'+id+'"></div></div>';
				$('body').append(y);
				
				$('#bz-chat-box-'+id).animate({opacity: 1,left: w,top: h,width: 300,height: 265,}, 300, 'easeOutExpo', function() {
					 $('#bz-chat-box-'+id).attr('style','z-index:'+inet.chat.zindex+';left:'+w+'px;top:'+h+'px;');
					 $('#bz-chat-box-'+id+' .bz_box_input').keypress(function(e){
						var c=(e.keyCode?e.keyCode:e.which);
						var ms=$.trim($(this).val());
						if(c==13&&ms!='')
						{
							$(this).val('');
							inet.chat.api('send',{'last':inet.chat.lastid,'uid':$(this).data('uid'),'ms':ms});
						}
					}).focus(function(e){}).trigger('focus');
					$('#bz-chat-box-'+id+' .close').click(function(){
						$('#bz-chat-box-'+id).animate({opacity: 0.1,left: $('.ch-cap').offset().left,top: $('.ch-cap').offset().top- $(window).scrollTop(),width: 10,height: 10,}, 300, 'easeInExpo', function(){$('#bz-chat-box-'+id).remove(); });
						inet.chat.api('close',{'last':inet.chat.lastid,'uid':id});
					});
					$('#bz-chat-box-'+id).draggable({handle:'.bz-chat-info',containment: 'parent', scroll: false}).resizable({/*helper:'ui-resizable-helper',*/start:inet.chat.boxresize1,stop:inet.chat.boxresize2}).click(function(){
						if(Math.floor($(this).attr('zindex'))!=inet.chat.zindex)
						{
							inet.chat.zindex++;
							$(this).attr('zindex',inet.chat.zindex).css({'z-index':inet.chat.zindex});
						}
					});
					$('#bz-chat-box-'+id).trigger('resize');
					
					if(id=='0')
					{
						var b={_id:0,n:'ผู้ช่วยเหลือ (Bot)',ms:'ยินดีต้อนรับสู่ http://boxza.com',p:inet.my._id,u:0,l:'',i:'//s1.boxza.com/profile/00/00/00/s.jpg',da:{sec:(new Date).getTime()/1000}};
						inet.chat.message(b);
						b.ms='คุณสามารถโพสข้อความไปยัง facebook (timeline, fanpage) และ twitter ได้พร้อมกันหลังจากทำการผูกบัญชีใช้งานกับ facebook และ twitter (เมนู <a href="/settings" onclick="inet.line.go(\'/settings\',true);return false">ตั้งค่า</a>)';
						inet.chat.message(b);
					}
			  });		
		 	}	
		},
		delay:function()
		{
			inet.chat.index++;
			if(inet.chat.index>12)
			{
				inet.chat.index=0;
				inet.chat.api('list',{'last':inet.chat.lastid});
			}
			else
			{
				inet.chat.api('idle',{'last':inet.chat.lastid});
			}
		},
	},
	render:function()
	{
		var w=$(window).width();
		if(inet.my&&inet.my._id)
		{
			var sc='<div><ul class="sc-list-chat"><li class="sc-list-c">ค้นหาเพื่อนจาก</li><li><a href="/import/facebook"><img src="'+inet.protocol+'s0.boxza.com/static/images/profile/social/fb_login.png"> Facebook</a></li><li><a href="/import/google"><img src="'+inet.protocol+'s0.boxza.com/static/images/profile/social/gg_login.png"> Google / Gmail</a></li><li><a href="/import/twitter"><img src="'+inet.protocol+'s0.boxza.com/static/images/profile/social/tw_login.png"> Twitter</a></li><li><a href="/import/live"><img src="'+inet.protocol+'s0.boxza.com/static/images/profile/social/wl_login.png"> Windows Live</a></li><li><a href="/import/yahoo"><img src="'+inet.protocol+'s0.boxza.com/static/images/profile/social/yh_login.png"> Yahoo</a></li></ul></div>';
			if(w>1200 && !$('.pf-f').length)
			{
				$('body').addClass('sidebar');
				if(!$('.chat').length)
				{
					$('._ct-in').after('<div class="pf-f"><div class="pf-fa"><div class="chat"></div></div></div>');
				}
				else
				{
					$('._ct-in').after('<div class="pf-f"><div class="pf-fa"></div></div>');
					$('.chat').appendTo($('.pf-fa'));
				}
				$('.ul-chat').remove();
				inet.chat.load();
			}
			else if(w<=1200 && !$('.ul-chat').length)
			{
				$('.ul-member').after('<div class="ul-chat"></div>');
				$('body').removeClass('sidebar');			
				if(!$('.chat').length)
				{
					$('.ul-chat').after('<div class="chat"></div>');
				}
				else
				{
					$('.chat').appendTo($('.ul-chat'));
				}
				$('.pf-f').remove();
				inet.chat.load();
			}
			if($('.pf-fa').length)
			{
				$('.pf-fa').height(Math.max(100,$(window).height()-40));
			}
		}
		inet.line.icn(true);
	},
	popup:{
		m:false,x:0,y:0,x2:0,y2:0,z:10000,ie6:false,
		mouse:function(e)
		{
			var posx = 0;
			var posy = 0;
			if (!e) var e = window.event;
			if (e.pageX || e.pageY) {
				posx = e.pageX;
				posy = e.pageY;
			}
			else if (e.clientX || e.clientY) {
				posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
				posy = e.clientY + document.body.scrollTop  + document.documentElement.scrollTop;
			}
			return { 'x': posx, 'y': posy };
		},
		open:function(a,b)
		{
			var c=$('<div>').addClass('puw').mousedown(function(){$(this).css('z-index',inet.popup.z);});
			c.html('<div class="phd"><div class="pda">'+a+'</div><div class="pbt"><img src="http://s0.boxza.com/static/images/profile/popup/close.gif"></div></div><div class="pco">'+b+'</div>');
			$('body').append(c);
			c.find('.pda').mousedown(function(e) {
				e.preventDefault();
				var target=$(this).parent().parent();
				var pos=inet.popup.mouse(e);
				inet.popup.z++;
				target.css('z-index',inet.popup.z);
				inet.popup.x = pos.x;
				inet.popup.y = pos.y;
				inet.popup.x2 = target.offset().left ;
				inet.popup.y2 = target.offset().top;
				inet.popup.m = target;
            //onmousedown="inet.popup.down(event,this)" onmouseup="inet.popup.up(event,this)"
         }).mouseup(function(e){			
			  	inet.popup.m = null;
			}).mousemove(function(e){		
				if(inet.popup.m)
				{
					var pos = inet.popup.mouse(e);
					var l=(inet.popup.x2 + pos.x - inet.popup.x),t=(inet.popup.y2 + pos.y - inet.popup.y),l2=$(document).scrollLeft(),t2=$(document).scrollTop();
					inet.popup.m.css({'left':(l-l2),'top':(t-t2)});
					inet.popup.m.attr({'wl':l-l2,'wt':t-t2});
				}
			}).end().find('.pbt').click(function(e){$(this).parent().parent().remove()});
			return c;
		},
	}
});


$(document).ready(function(){
	if(inet.profile.stop)
	{
		inet.profile.enabled=false;
		return;
	}
	
	if(!$('#dropdown-chat-emo').length)
	{
		var mo=[':)',':D',';)','^_^','>:o',':3','>:(',':(',':\\\'(','-_-',':\\\\','3:)','O:)',':-*','<3',':v',':o','8)','8|',':p','o.O','O.o','(^^^)','(y)','<(&quot;)'],tmp='';
		for(var i=0;i<mo.length;i++)
		{
			tmp+='<span class="emo emo-'+(i+1)+' ptr" onclick="inet.chat.emoticon(\''+mo[i]+'\',\'emo\')"></span> ';
		}
		$('body').append('<div id="dropdown-chat-emo" class="dropdown dropdown-tip dropdown-anchor-right"><div class="dropdown-panel">'+tmp+' &nbsp; <span class="ptr2" onclick="inet.chat.emoticon(\'\',\'emo\')">อื่นๆ</span></div></div>');
	}
	
	inet.line.last=inet.line.lasted=location.pathname;
	if(inet.line.last)
	{
		var s=inet.line.last.split('/');
		if(s.length>1 && s[1] && s[1]!='home' && s[1]!='share')inet.profile.enabled=true;
	}
	if(inet.profile.enabled)
	{
		inet.line.icn();
		inet.render();
		inet.line.update();
		inet.hash.go(window.location.hash);
		
		$(window).resize(inet.render);
	}
});


$(window).bind('popstate', function(event){
	if(!inet.profile.enabled)return;
  	var initialPop = (!inet.hash.popped && location.href == inet.hash.initurl);
  	inet.hash.popped = true;
  	if ( initialPop ) return;
	if(event.state)
	{
		inet.line.go(location.pathname);
	}
	else
	{
		inet.line.go(location.pathname,0,1);
	}
})


$(document).on('click','a.h',function(e){
	if(!e.metaKey)
	{
		var href=$(this).attr('href');
		inet.line.go($(this).attr('href'),!$(this).hasClass('no-top'));
	  return false;
	}
});

$(window).bind('hashchange', inet.hash.hash);

$(window).scroll(function(){
	if(!inet.profile.enabled)return;
			
	var _h=h2=$(window).height(),_t=$(document).scrollTop();
	if(!$('body').hasClass('ios'))
	{
		var ads=$('.ads-box');
		if(ads.length)
		{
			var h=$('.ads-top').offset().top;
			var b=ads.height();
			if(_h-51<b)
			{
				if((_t+_h>h+b))
				{
					if(!ads.hasClass('ads-fix-bottom'))
					{
						ads.addClass('ads-fix-bottom');
					}
				}
				else if(ads.hasClass('ads-fix-bottom'))
				{
					ads.removeClass('ads-fix-bottom');
				}
				if(ads.hasClass('ads-fix-top'))
				{
					ads.removeClass('ads-fix-top');
				}
			}
			else
			{
				if(!ads.hasClass('ads-fix-top'))
				{
					ads.addClass('ads-fix-top');
				}
				if(ads.hasClass('ads-fix-bottom'))
				{
					ads.removeClass('ads-fix-bottom');
				}
			}
		}
		var nav=$('#nav-ln');
		if(nav.length)
		{
			var h=$('#nav-ln-top').offset().top;
			var b=nav.height();
			if(_h-51<b)
			{
				if((_t+_h>h+b))
				{
					if(!nav.hasClass('nav-ln-fix-bottom'))
					{
						nav.addClass('nav-ln-fix-bottom');
					}
				}
				else if(nav.hasClass('nav-ln-fix-bottom'))
				{
					nav.removeClass('nav-ln-fix-bottom');
				}
				if(nav.hasClass('nav-ln-fix-top'))
				{
					nav.removeClass('nav-ln-fix-top');
				}
			}
			else
			{
				if(!nav.hasClass('nav-ln-fix-top'))
				{
					nav.addClass('nav-ln-fix-top');
				}
				if(nav.hasClass('nav-ln-fix-bottom'))
				{
					nav.removeClass('nav-ln-fix-bottom');
				}
			}
		}
		if($('.bl-ct').length)
		{
			var h=$('.bl-tp').offset().top;
			if(_t>h-42)
			{
				$('.bl-ct').addClass('bl-fx');
			}
			else
			{
				$('.bl-ct').removeClass('bl-fx');
			}
		}

	}
	if(!inet.profile.updating)
	{
		var h1=$(document).height();
		if(_t+_h > h1-100)
		{
			inet.profile.updating=true;
			if($('#_line .ln-next span').length)
			{
				$('#_line .ln-next span').trigger('click');
			}
			else if($('.photos .pt-next a').length)
			{
				$('.photos .pt-next a').trigger('click');
			}
			else if($('.blogs .pt-next a').length)
			{
				$('.blogs .pt-next a').trigger('click');
			}
		}
	}
});









 (function($) {
	$.extend($.fn, {
		dropdown: function(method, data) {
			switch( method ) {
				case 'hide':
					hide();
					return $(this);
				case 'attach':
					return $(this).attr('data-dropdown', data);
				case 'detach':
					hide();
					return $(this).removeAttr('data-dropdown');
				case 'disable':
					return $(this).addClass('dropdown-disabled');
				case 'enable':
					hide();
					return $(this).removeClass('dropdown-disabled');
			}
		}
	});
	function show(event) {
		var trigger = $(this),
			dropdown = $(trigger.attr('data-dropdown')),
			isOpen = trigger.hasClass('dropdown-open');
		// In some cases we don't want to show it
		if( trigger !== event.target && $(event.target).hasClass('dropdown-ignore') ) return;
		event.preventDefault();
		event.stopPropagation();
		hide();
		if( isOpen || trigger.hasClass('dropdown-disabled') ) return;
		// Show it
		trigger.addClass('dropdown-open');
		dropdown
			.data('dropdown-trigger', trigger)
			.show();
		// Position it
		position();

		// Trigger the show callback
		dropdown
			.trigger('show', {
				dropdown: dropdown,
				trigger: trigger
			});

	}

	function hide(event) {

		// In some cases we don't hide them
		var targetGroup = event ? $(event.target).parents().andSelf() : null;

		// Are we clicking anywhere in a dropdown?
		if( targetGroup && targetGroup.is('.dropdown') ) {
			// Is it a dropdown menu?
			if( targetGroup.is('.dropdown-menu') ) {
				// Did we click on an option? If so close it.
				if( !targetGroup.is('A') ) return;
			} else {	
				// Nope, it's a panel. Leave it open.
				return;
			}
		}

		// Hide any dropdown that may be showing
		$(document).find('.dropdown:visible').each( function() {
			var dropdown = $(this);
			dropdown
				.hide()
				.removeData('dropdown-trigger')
				.trigger('hide', { dropdown: dropdown });
		});

		// Remove all dropdown-open classes
		$(document).find('.dropdown-open').removeClass('dropdown-open');

	}

	function position() {

		var dropdown = $('.dropdown:visible').eq(0),
			trigger = dropdown.data('dropdown-trigger'),
			hOffset = trigger ? parseInt(trigger.attr('data-horizontal-offset') || 0) : null,
			vOffset = trigger ? parseInt(trigger.attr('data-vertical-offset') || 0) : null;

		if( dropdown.length === 0 || !trigger ) return;

		// Position the dropdown
		dropdown
			.css({
				left: dropdown.hasClass('dropdown-anchor-right') ? 
					trigger.offset().left - (dropdown.outerWidth() - trigger.outerWidth()) + hOffset : trigger.offset().left + hOffset,
				top: trigger.offset().top + trigger.outerHeight() + vOffset
			});

	}

	$(document).on('click.dropdown', '[data-dropdown]', show);
	$(document).on('click.dropdown', hide);
	$(window).on('resize', position);

})(jQuery);

