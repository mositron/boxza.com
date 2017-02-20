$.extend(_,{
	profile:{
		history:new Object,
		updating:false,
		enabled:false,
		img:{
			up:function()
			{
				$('input[type=file]').unbind();
				_.upload.create('input[type=file]',function(e,g){if(e.status=='OK'){
					if(e.update=='header')
					{
						_.box.close();
						$('._pf-hd').css('background','url('+e.pic+') center top repeat');
					}
					else if(e.update=='avatar-gif')
					{
						$('.img-uid-'+_.my._id).attr('src',e.pics);
						$('.img-uid-my').attr('src',e.picn);
					}
					else
					{
						_.get.js('jquery/jcrop/jquery.Jcrop.min.js').done(function(){_.box.load('/dialog/avatar #avatar_thumb');});
					}
				}else{alert(e.message);}});
			},
			av:{
				boundx:0,boundy:0,
				thumb:function(j,w,h)
				{
					$('#gboxc #gcrop').Jcrop(
						{onChange: _.profile.img.av.coords,onSelect: _.profile.img.av.coords,aspectRatio: 1},
						function()
						{
							_.profile.img.av.jcrop = this;
							if($('#gboxc #pvcrop').css('display')!='block')$('#gboxc #pvcrop').css({'display':'block'})
							$("#gboxc #gpf").attr({src:j});
							$('#gboxc #showsave').css({'display':'block'});
							_.profile.img.av.jcrop.setImage(j);
							_.profile.img.av.jcrop.animateTo([0,0,(w<h?w:h),(w<h?w:h)]);
							_.profile.img.av.boundx = w;
							_.profile.img.av.boundy = h;
						}
					);
				},
				coords:function(c){$('#gboxc #x').val(c.x);$('#gboxc #y').val(c.y);$('#gboxc #w').val(c.w);$('#gboxc #h').val(c.h);_.profile.img.av.preview(c);},
				preview:function(c)
				{
				  if (parseInt(c.w) > 0)
				  {
					 var rx = 150 / c.w;
					 var ry = 150 / c.h;
					 $('#gboxc #gpf').css({
						width: Math.round(rx * _.profile.img.av.boundx) + 'px',
						height: Math.round(ry * _.profile.img.av.boundy) + 'px',
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
					$('.sh-hd-ct,.sh-hd-in,.sh-hd-wr').click(_.profile.sh.close);
					var u='';
					if(a.u && a.u.length)
					{
						for(var i=0;i<a.u.length;i++)
						{
							u+='<div class="n friend-'+a.u[i]._id+'"><span class="av"><a href="/'+a.u[i].link+'" title="'+a.u[i].name+'" class="h"><img src="'+a.u[i].img+'"></a></span><strong><a href="/'+a.u[i].link+'" title="'+a.u[i].name+'" class="h">'+a.u[i].name+'</a></strong>';
							if(_.my)
							{
								if(a.u[i]._id==_.my._id)
								{
									u+='<span class="friend" style="margin:5px 0px 0px 5px">คุณ</span>';
								}
								else if($.inArray(parseInt(a.u[i]._id),_.my.ct.fr)>-1)
								{
									u+='<span class="friend" style="margin:5px 0px 0px 5px">เพื่อน</span>';
								}
								else if($.inArray(parseInt(a.u[i]._id),_.my.ct.fq)>-1)
								{
									u+='<span class="frequest" style="margin:5px 0px 0px 5px">รอตอบกลับ</span>';
								}
								else
								{
									u+='<span class="fnot friend-request-'+a.u[i]._id+'" style="margin:5px 0px 0px 5px" onClick="_.friend.request('+a.u[i]._id+')">เพิ่มเป็นเพื่อน</span>';
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
					_.line.update();
				}
			}
		}
	},
});

