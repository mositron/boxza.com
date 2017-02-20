/*
+ ----------------------------------------------------------------------------+
|     BoxZa
|
|     © 2012 iNet Revolutions Co.,Ltd.
|     http://boxza.com, http://www.inet-rev.co.th
|     positron@boxza.com
|
|     $Revision: 1.0.0 $
|     $Date: 2012/04/16 15:56:57 $
|     $Author: Positron $
+ ----------------------------------------------------------------------------+
*/
var _={
	version:'1.2.0',http:'',js:'',protocol:'http://',static:'http://s0.boxza.com/static/',url:window.location.pathname,host:window.location.hostname,
	get:{
		tmp:[],
		js:function(a){var u=(a.indexOf('://')>-1?a:_.static+'js/'+a);return $.ajax({dataType: 'script',cache: true,url:u});},
		css:function(a){if(!_.get.tmp[a]){var u=(a.indexOf('://')>-1?a:_.static+'css/'+a),css = $('<link>');css.attr({rel:'stylesheet',type: 'text/css',href:u});$('head').append(css);_.get.tmp[a]=1;}}
	},
	lang:{saving:'กำลังบันทึกข้อมูล...',edittxt1:'กด Shift + Enter เพื่อขึ้นบรรทัดใหม่, ',edittxt2:'กด Enter เพื่อบันทึก, กด Esc เพื่อยกเลิก',},
	box:{
		onopen:'',onclose:'',fast:false,
		init:function(){if($('#gbox').length==0){var g=$('<div>').attr({id:'gbox'}),a=$('<div>').attr({id:'gboxa'}),b=$('<div>').attr({id:'gboxb'}),c=$('<div>').attr({id:'gboxc'});$('body').prepend(g.append(a).append(b.append(c)));};if(!$('#loading')[0]){$('body').prepend($('<div>').attr({id:'loading'}));};},
		load:function(url){var a=url.split(' '),b=(a.length>1?a.slice(1).join(' '):'#gbox_tmp');$('#gbox_tmp').remove();$('body').append($('<div>').attr({id:'gbox_tmp'}));$('#gbox_tmp').load(url,function(html){_.box.open(b)});},
		confirm:function(ops){var g = $.extend({title:'ยืนยัน',detail:'',yes:'ใช่',no:'ไม่ใช่',click:function(){}},ops);$('#gbox_confirm').remove();$('body').append($('<div>').attr({id:'gbox_confirm'}).addClass('gbox').css('width',300));_.box.onconfirm=(typeof(_.box.click)=='string'?function(){eval(g.click)}:g.click);$('#gbox_confirm').html('<div class="gbox_header">'+g.title+'</div><div class="gbox_content"><div style="padding:10px">'+g.detail+'</div></div><div class="gbox_footer"><input type="button" class="button blue" value=" '+g.yes+' " onclick="_.box.onconfirm();_.box.close()"> <input type="button" class="button" value=" '+g.no+' " onclick="_.box.close()">');_.box.fast=true;_.box.focus=true;_.box.open('#gbox_confirm');},
		open:function(){_.edit.cancel();$('#gbox').remove();_.box.init();_.box.width=$(arguments[0]).width();_.box.height=$(arguments[0]).height();$('#gboxa').css({opacity:0.5});$('#gbox').show();_.box.update(true);var html=$(arguments[0]).html().replace(/_tmp_/gi,'_box_');$('#gboxc').html('<img src="'+_.static+'images/global/close.gif" style="position:absolute;top:10px;right:10px;cursor:pointer" onclick="_.box.close()">'+html);_.box.onopen=$(arguments[0]).attr('onopen');_.box.onclose=$(arguments[0]).attr('onclose');if(_.box.fast){$('#gboxb').css({width:_.box.width,height:'auto'});_.box.opened();}else{$('#gboxb').css({width:_.box.width,height:0});$('#gboxb').animate({height: _.box.height},1000,'easeOutBounce',function(){_.box.opened();});}},
		opened:function(){if(_.box.onopen)eval(_.box.onopen);$('#gboxb').css({height:'auto'});if(_.box.focus)$('.gbox_footer .button.blue').focus();},
		close:function(){_.edit.cancel();if(_.box.fast){_.box._close();}else{$('#gboxb').animate({height:0},1000,'easeOutBounce',function(){_.box._close();});}},
		_close:function(){$('#gbox').remove();if(arguments[0])_.box.open(arguments[0]);if(_.box.onclose)eval(_.box.onclose);_.box.fast=false;_.box.focus=false;},
		update:function(move){if(!$('#gbox')[0])return;if($('#gbox').css('display')!='none'){var w=Math.max($(window).width(),$(document).width()),h=Math.max($(window).height(),$(document).height());$('#gbox').css({top:0,left:0,height:h,width:w});$('#gboxa').css({height:h,width:w});if(move)$('#gboxb').css({top:Math.max(0,$(document).scrollTop()+(($(window).height()-_.box.height)/2)),left:$(document).scrollLeft()+(($(window).width()-_.box.width)/2)});};if($('#loading').css('display')=='block'){$('#loading').css({top:($(document).scrollTop()+(($(window).height()-$('#loading').height())/2)),left:($(document).scrollLeft()+(($(window).width()-$('#loading').width())/2))});}},	
		alert:function(s){_.box.init();clearTimeout(_.box.timer);$('#loading').css({display:'block',opacity:0}).html('<div><a href="javascript:;" onclick="_.box.hide()" class="loading_close"><img src="'+_.static+'images/global/close.gif"></a><span>'+s+'</span></div>').fadeTo("slow",1);_.box.update(true);_.box.timer=setTimeout('_.box.hide()',arguments.length>1?arguments[1]:5000)},
		hide:function(){$('#loading').fadeOut('slow')},
	},
	ajax:{
		cursor:true,
		init:function(){if(_.ajax.cursor&&!$('#ajax_load')[0]){$('body').prepend($('<img>').attr({id:'ajax_load',src:_.static+'images/global/load.gif'}).css({'position':'absolute','z-index':999,'top':0,'left':0,'display':'none'}));}},
		gourl:function(a,s){var arg=new Array(),i;for(i=2;i<arguments.length;i++)arg[i-2]=arguments[i];return this.go(s,arg,'',a);},
		form:function(s){if($(s)[0].nodeName=='FORM'){var o={};var a=$(s).serializeArray();$.each(a,function(){if(o[this.name]){if (!o[this.name].push){o[this.name]=[o[this.name]];};o[this.name].push(this.value||'');}else{o[this.name]=this.value||'';}});return o;};return s},
		go:function(f,p){
			_.ajax.init();
			if(_.ajax.cursor)$('#ajax_load').css({display:'inline'});
			if(arguments.length>2){var loader= 'loading_'+arguments[2];if((targetObj=document.getElementById(arguments[2]))&&!document.getElementById(loader)){targetObj.style.position='relative';$('<div id="'+loader+'"></div>').css({left:0,top:0,padding:0,width:'100%',height:'100%',background:'#000000',zIndex:1000,opacity:0.5,position:'absolute'}).html('<table width="100%" height="100%"><tr><td align="right" height="16" valign="top"><img src="'+_.static+'images/global/close.gif" style="cursor:pointer" border="0" alt="close" onclick="_.ajax.remove(\''+loader+'\');"></td></tr><tr><td align="center" valign="middle"><img src="'+_.static+'images/global/loading.gif" border="0" alt="Loading..."></td></tr></table>').appendTo(targetObj);}};
			var params={'ajax':f,'ajaxargs':new Array()};
			if(p){for(i=0;i<p.length;i++){value=p[i];if(typeof(value)=="object")value=this.form(value);params['ajaxargs'][i]=value;}};
			var _s = {url:(arguments.length>=4?arguments[3]:_.url),type:'POST',data:params,dataType:'json',
			success:function(data){if(_.ajax.cursor)$('#ajax_load').css({display:'none'});if(!data)return;var i,j,e;
			for(i=0;i<data['f'].length;i++){e=data['f'][i];switch(e['a']){
				case 'al':_.box.alert(e['v']);break;
				case 'ht':$('#_'+e['s']).html(e['v']);break;
				case 'ml':$('#_'+e['s']+'_input').html(e['v']);break;
				case 'js':eval(e['v']);break;
				case '$':jQuery(e['s'])[e['p']](e['v']);break;}};
				_.tooltop();}};
			if(_s.url.substr(0,1)!='/'){_s.type='GET';_s.crossDomain=true;_s.dataType='jsonp';}; return $.ajax(_s);},
		loading:function(e){if(!$('#ajax_load')[0])return;/*if($('#ajax_load').css('display')!='none'){*/if(!e)e=event;$('#ajax_load').css({left:Math.floor($(document).scrollLeft()+e.clientX+16),top:Math.floor($(document).scrollTop()+e.clientY+16)})/*};*/},
		remove:function(sId){$('#'+sId).fadeOut('slow',function(){$(this).remove();})}	
	},
	edit:
	{
		profile:new Array(),
		mouseclear:function(){if(_.edit.curedit){$('.editting').removeClass('editting');_.edit.curedit='';}},
		mouseover:function(e){var j=e;e=_.edit.find(e.target,'edit2');if(e){if(e!=_.edit.cur){if(e.innerHTML.indexOf('update_')<0){if(!$('#edit2-click')[0]){var c=$('<img>').attr('src',_.static+'images/global/edit.gif').attr('id','edit2-click').css({'position':'absolute','left':0,'top':0,'cursor':'pointer','display':'none','z-index':99});$('body').append(c);};$('#edit2-click').css({top:$(e).offset().top+2,left:$(e).offset().left+$(e).width()-10,'display':'inline'});$('#edit2-click').unbind('click');$('#edit2-click').click(function(e1){_.edit.click(j,true);$('#edit2-click').css({'display':'none'});})};_.edit.cur=e;}}},
		click:function(e){	
		if($('#sresult').length)
		{
			if(!$(e.target).hasClass('find-people'))
			{
				$('#sresult').remove();
				$(e.target).data('last','').val('');
			}
		}
		if(_.notify.last){
			if(!$(e.target).parents('.notify_'+_.notify.last+' ul').length)
			{
				$('.notify_'+_.notify.last+' ul:first').hide(0);
				$('.notify_'+_.notify.last+' > a:first').removeClass('over');
				_.notify.opened[_.notify.last]=2;
				_.notify.last='';
			}
		};
		if(_.line && _.line.act && _.line.act.last && (!$(e.target).is('i')))
		{
			$(_.line.act.last).css('display','none');
			_.line.act.last='';
		}
		_.title.clear();
		if($('#menulist').css('display')=='block'){$('#menulist').css('display','none');};e=_.edit.find(e.target,'edit'+(arguments.length>1?'2':''));if(e){var div=$(e).find('span.ed')[0],p=$(e).find('strong.ed')[0],em=$(e).find('em.ed');if(div.innerHTML.toLowerCase().indexOf(p.innerHTML.toLowerCase().substr(0,5))<0){_.edit.profile[div.id]=$(div).html();if(_.edit.curedit!=div&&_.edit.curedit){$(_.edit.curedit).html(_.edit.profile[_.edit.curedit.id]);$(_.edit.curedit).parent().removeClass('editting');};$(div).html($(p).html().replace(/tmp_/gi, "update_")+"");$(div).find('input:text,textarea,select').keypress(function(e){var c=(e.keyCode?e.keyCode:e.which);if(c==13&&!e.shiftKey)_.edit.submit(div.id);});$(div).find('input:text,input:checkbox,textarea,select').keyup(function(e){var c=(e.keyCode?e.keyCode:e.which);if(c==27)_.edit.cancel(div.id);});if(em.length>0)$(em[0]).css({display:'none'});_.edit.curedit=div;_.edit.resize();if(!$('#edit-tooltip')[0]&&!$(e).attr('nb')){$('body').append($('<div>').attr({id:'edit-tooltip'}))};if(!$(e).attr('nb')){$('#edit-tooltip').html("<a href='javascript:;' onclick='_.edit.submit(\""+div.id+"\")'><img src='"+_.static+"images/global/save.gif' style='vertical-align:text-bottom'></a> <a href='javascript:;' onclick='_.edit.cancel(\""+div.id+"\")'><img src='"+_.static+"images/global/reload.gif' style='vertical-align:text-bottom'></a>"+(!$(e).attr('nt')&&$(div).attr('ref')!='checkbox'?' ('+($(div).attr('ref')=='textarea'?_.lang.edittxt1:'')+_.lang.edittxt2+')':''));$('#edit-tooltip').css({display:'inline',top:$(e).offset().top-$('#edit-tooltip').height()-7,left:$(e).offset().left+2});};$(e).addClass('editting');}}},
		find:function(e,c){var i=0;while(e&&i<3){if($(e).hasClass(c))return e;e=e.parentNode;i++;};return false;},
		submit:function(a){$('#edit-tooltip').css({display:'none'});var c='#'+a,p=$(c).attr('id'),z=$(c).attr('ref'),s=$(c).attr('sp'),f=$(c).attr('func'),v='';switch(z){case 'datetime':v=$('#update'+p+'_year').val()+'-'+$('#update'+p+'_month').val()+'-'+$('#update'+p+'_day').val()+' '+$('#update'+p+'_hh').val()+':'+$('#update'+p+'_nn').val()+':00';break;case 'date':case 'birth':v=$('#update'+p+'_year').val()+'-'+$('#update'+p+'_month').val()+'-'+$('#update'+p+'_day').val();break;case 'time':v=$('#update'+p+'_hh').val()+':'+$('#update'+p+'_nn').val()+':00';break;case 'checkbox':$('.update'+p+':checked').each(function(i,e){v+=(i?', ':'')+$(this).val();});break;default:v=$('#update'+p).val();};if($.trim(v)!=''||s){if(f){f=','+f;var t=f.split(',');}else{var t=p.split('_');};switch(t.length){case 4:_.ajax.gourl(_.url,'update',t[1],t[2],t[3],v,z);break;case 3:_.ajax.gourl(_.url,'service',t[1],t[2],v,z);break;case 2:_.ajax.gourl(_.url,'save',t[1],v,z);break;};$('#'+p).html('<img src="'+_.static+'images/global/saving.gif" class="icon"> '+_.lang.saving);_.edit.curedit='';}else{_.edit.cancel(p);};$('.editting').removeClass('editting');},
		resize:function(){if(_.edit.curedit){var a=_.edit.curedit,b=$(a).parent()[0];if($(b).attr('full')!=''){/*alert($(b).attr('full')+'zz-'+$(a).attr('id'));*/$('#update'+$(a).attr('id')).css({width:$(b).width()-5-parseInt($(b).attr('full'))});};$('#update'+$(a).attr('id')).focus();}},
		cancel:function(p){if(!p){if(!_.edit.curedit)return;p=_.edit.curedit.id};$('#'+p).html(_.edit.profile[p]);$('.editting').removeClass('editting');/*$(p).style.textIndent='5px';*/var em=$('#'+p).parent().find('EM');if(em.length>0)em[0].style.display='inline';$('#edit-tooltip').css({display:'none'});}
	},
	validate:{
		submit:function(s){var mi,ma,vl,err=false,er=false;$('.input_error').removeClass('input_error');$('.msg_error').hide();$('.validate',s).each(function (i, e){vl=$.trim($(e).val()).length;er=false;if($(e).hasClass('required')&&vl<1)er=true;if($(e).hasClass('email')){var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);er=!pattern.test($(e).val());};if(mi=$(e).attr('min')){if(vl<parseFloat(mi))er=true;};if(mi=$(e).attr('minlength')){if(vl<parseFloat(mi))er=true;};if(ma=$(e).attr('max')){if(vl>parseFloat(ma))er=true;};if(ma=$(e).attr('maxlength')){if(vl>parseFloat(ma))er=true;};if(er){if(!err)$(e).focus();err=true;$(e).addClass('input_error');}else{$(e).removeClass('input_error');}});return !err;}
	},
	cookie:{
		get:function(n){var i,x,y,c=document.cookie.split(";");for(i=0;i<c.length;i++){x=c[i].substr(0,c[i].indexOf("="));y=c[i].substr(c[i].indexOf("=")+1);x=x.replace(/^\s+|\s+$/g,"");if (x==n)return unescape(y);}return false;},
		set:function(n,v,d){var x=new Date();x.setDate(x.getDate()+d);var c_v=escape(v) + ((d==null) ? "" : "; expires="+x.toUTCString())+'; domain=boxza.com; path=/;';document.cookie=n + "=" + c_v;}
	},
	storage:{
		set:function(k,v)
		{
			if(typeof(window.localStorage) == 'undefined')
			{
				return false;
			}
    		window.localStorage.setItem(k, JSON.stringify(v));
			return true;
		},
		get:function(k)
		{
			if(typeof(window.localStorage) == 'undefined')
			{
				return false;
			}
			var v = window.localStorage.getItem(k);
    		return v?JSON.parse(v):false;
		}
	},
	upload:{
		aiframe:function(id){var a='jUploadFrame'+id;if(!$('#'+a)[0]){$('<iframe id="'+a+'" name="'+a+'" style="position:absolute; top:-9999px; left:-9999px"'+(window.ActiveXObject?' src="javascript:false"':'')+ ' />').appendTo(document.body);}return $('#'+a)[0];},
		cform:function(id, fel, _1,_2){var a = 'jUploadForm'+id;var form = $('<form action="" method="POST" name="'+a+'" id="'+a+'" enctype="multipart/form-data" style="position:absolute; top:-1200px; left: -1200px"></form>');var n = $(fel).clone();_.upload.create(n,_1,_2);$(n).addClass('jUploadFile'+id).css('display','none');$(fel).attr('id', 'jUploadFile'+id);$(fel).before(n);$(n).after('<span class="jUploadWait'+id+'"><img src="'+_.static+'images/global/load.gif" class="icon"> กรุณารอซักครู่...</span>');$(fel).appendTo(form);$(form).appendTo('body');return form;},
		create:function(i){var _1,_2;if(arguments.length>2){_2=arguments[2];_1=arguments[1];}else if(arguments.length>1){_2=arguments[1];};$(i).change(function(e){if($(this).val())_.upload.start(this,_1,_2);});},
		choose:function(a,b,c){
			var d=$('#_tmpup');
			if(!d.length)
			{
				d=$('<div>').css({'position':'absolute','left':0,'top':0,'opacity':0,'width':1,'height':1,'overflow':'hidden'}).attr('id','_tmpup');
				$('body').append(d);
			}
			$('#_tmpup').html('<input type="file" value="" name="'+a+'" multiple>');
			$('#_tmpup input').change(function(e){if($(this).val()){
				_.upload.start(this,function(f){
					if(b)
					{
						var s='';
						for(var e in b)s+='<input type="hidden" name="'+e+'" value="'+b[e]+'">';
						f.append(s);
					}
				},c);
			}});
			$('#_tmpup input').focus().click();
		},
		start:function(s,_1,_2) {
			var id = new Date().getTime();
			var form = _.upload.cform(id, s,_1, _2);
			var io = _.upload.aiframe(id);
			var frameId = 'jUploadFrame'+id;
			var formId = 'jUploadForm'+id;
			var xml;
			if(_1)_1($('#'+formId));
			var uploadCallback = function(isTimeout){
				var io = $('#'+frameId)[0];
				try{
					if(io.contentWindow){
						xml = io.contentWindow.document.body?io.contentWindow.document.body.innerHTML:null;
					}else if(io.contentDocument){
						xml = io.contentDocument.document.body?io.contentDocument.document.body.innerHTML:null;
					}
				}catch(e){alert(e)};
				if ( xml || isTimeout == "timeout"){
					var status;
					$('.jUploadFile'+id).css('display','inline');
					$('.jUploadWait'+id).remove();
					try {
						status = (isTimeout != "timeout" ? "success" : "error");
						if ( status != "error" ) {
							if(_2)_2(eval('('+xml+')'),$('.jUploadFile'+id)[0]);
						}
					} catch(e) {
						alert(xml+' '+status+' '+e);
					};
					$(io).unbind();
					setTimeout(function(){try{$(io).remove();$(form).remove();} catch(e){}},100);
					xml = null;
				}
			};
			try {
				var form = $('#'+formId);
				$(form).attr('action', _.url);
				$(form).attr('method', 'POST');
				$(form).attr('target', frameId);
				$(form).attr('enctype', 'multipart/form-data');
				$(form).submit();
			} catch(e){alert('+=+ '+e)};
			$('#'+frameId).load(uploadCallback);
			return {abort: function(){}};
		},
	},
	time:{
		timer:null,
		ago:function(){clearTimeout(_.time.timer);$('.ago').each(function(){$(this).html(_.time.cal($(this).attr("datetime")));});_.time.timer=setInterval(function() { _.time.ago();}, 60000);},
		word:function(a,n){return a.replace(/%d/i, n);},
		cal:function(t){var date = new Date(parseInt(t)*1000),d = new Date().getTime() - date.getTime();var _s = Math.abs(d) / 1000, _m = _s / 60,_h = _m / 60,_d = _h / 24,_y = _d / 365;var words = _s < 45 && _.time.word('< 1 นาที', Math.round(_s)) || _s < 90 && _.time.word('1 นาที', 1) || _m < 45 && _.time.word('%d นาที', Math.round(_m)) || _m < 90 && _.time.word('1 ชั่วโมง', 1) || _h < 24 && _.time.word('%d ชั่วโมง', Math.round(_h)) || _h < 42 && _.time.word('1 วัน', 1) || _d < 30 && _.time.word('%d วัน', Math.round(_d)) || _d < 45 && _.time.word('1 เดือน', 1) || _d < 365 && _.time.word('%d เดือน', Math.round(_d / 30)) || _y < 1.5 && _.time.word('%d ปี', 1) || _.time.word('%d ปี', Math.round(_y)); return words+' ที่แล้ว';}
	},
	notify:
	{
		last:'',ds:0,
		opened:{'friend':0,'other':0,'setting':0},
		alert:function(m) {
			var b=this;
			var n=null;
			b.i=function(){return b.r();};
			b.r=function()
			{
				var c=$('body');
				if ($('ul.noty_cont').length==0)c.prepend($('<ul>').addClass('noty_cont'));
				c=$('ul.noty_cont');
				b.c=c;
				b.bar=$('<div class="noty_bar">');
				n=b.bar;
				n.append('<div class="noty_message"><div class="noty_text"><img src="'+m.u.img+'"> <div><strong>'+m.u.name+'</strong>'+m.ms+'</div></div><div class="noty_close"></div></div>');	
				n.find('.noty_close').bind('click', function() { n.trigger('noty.close'); });
				if(m.l)n.bind('click',function(){if(_.profile&&_.profile.enabled&&m.l.substr(0,1)=='/')_.line.go(m.l,true,true);else{window.location.href=m.l;}}).css('cursor', 'pointer');		
				return b.s();
			};
			b.s=function() {
				n.close=function(){return this.trigger('noty.close');};
				b.c.prepend($('<li>').append(n));
				n.one('noty.close', function(event){n.clearQueue().stop().animate({height: 'toggle'},500,'swing').promise().done(function(){n.parent().remove();});});
				n.animate({height: 'toggle'}, 500, 'swing');
				n.delay(10000).promise().done(function() { n.trigger('noty.close'); });
			};
			return b.i();
		},
		open:function(e){
			if(!e)e = window.event;
			e=e.target;
			var type=$(e).attr('rel');
			if(!type)type=$(e).parent().attr('rel');
			if(type)
			{
				if(type!=_.notify.last && _.notify.last){
					$('.notify_'+_.notify.last+' ul:first').hide(0);
					$('.notify_'+_.notify.last+' > a:first').removeClass('over');
					_.notify.opened[_.notify.last]=2;
				};
				if(_.notify.opened[type]==0||_.notify.opened[type]==2){
					$('.notify_'+type+' ul:first').show(0);
					if(type!='setting'){_.api('/me/notifications/'+type+(_.profile&&_.profile.enabled?'/hash':''));};
					$('.notify_'+type+' > a:first').addClass('over').find('p').css('display','none');
					_.notify.opened[type]=1;
					_.notify.last=type;
				}else{
					$('.notify_'+type+' ul:first').hide(0);
					$('.notify_'+type+' > a:first').removeClass('over');
					_.notify.opened[type]=2;
					_.notify.last='';
				};
			}
			return false;
		}
	},
	tooltop:function(){if($.fn.tipsy){$(['n','s','w','e','we','ns']).each(function(i,d){$('.show-tooltip-'+d).tipsy({html:true,gravity:(d=='ns'?$.fn.tipsy.autoNS:(d=='we'?$.fn.tipsy.autoWE:(d))),fade:true})});}},
	update:function(){_.box.update(false);_.edit.resize();if(_.profile && _.profile.pt)_.profile.pt.update()},
	api:function(a){
		var dt=(arguments.length>1?arguments[1]:[]);dt.ntf=_.notify.ds;
		$.ajax({url:_.protocol+'api.boxza.com'+a,type:'GET',crossDomain:true,data:dt,dataType:'jsonp',jsonpCallback:'_'+new Date().getTime(),success:function(d){
			for(var i=0;i<d.length;i++)
			{
				switch(d[i].method)
				{
					case 'login': window.location.href=_.protocol+'oauth.boxza.com/login/?redirect_uri='+encodeURIComponent(window.location.href);break;
					case 'line': _.line.parse(d[i].data,d[i].type);break;
					case 'search': _.parse.search(d[i].data);break;
					case 'notify': _.parse.notify(d[i].data);break;
					case 'pt': _.profile.pt.parse(d[i].data,d[i].type);break;
					case 'lk': _.profile.lk.parse(d[i].data);break;
					case 'cm': _.profile.cm.parse(d[i].data);break;
					case 'sh': _.profile.sh.parse(d[i].data);break;
					case 'chat': _.chat.parse(d[i].data,d[i].type);break;
					case 'chatbox': _.chatbox.parse(d[i].data,d[i].type);break;
					case 'notifications': _.parse.notifications(d[i].data,d[i].type);break;
					case 'friend': _.friend.parse(d[i].data);break;
					case 'poll': _.profile.po.parse(d[i].data);break;
					case 'reload': _.parse.reload();break;
					case 'people':case 'place':case 'tag':case 'team': _.search.parse(d[i].data,d[i].method);break;
				}
			}
		},
		error:function (xhr, ajaxOptions, thrownError){
				_.chat.ide=300;
				clearTimeout(_.chat.tmr);
				if($('.chat').length)_.chat.tmr=setTimeout(function(){_.chat.delay()},60000);
		 } 
		});
	},
	title:
	{
		obj:{},idx:0,timer:null,count:0,
		insert:function(a,b)
		{
			if(!_.title.obj['default'])
			{
				_.title.obj['default']=document.title;
				_.title.count++;
			}
			document.title=b;
			if(!_.title.obj[a])
			{
				_.title.obj[a]=b
				_.title.count++;
			}
			else
			{
				_.title.obj[a]=b
			}
			_.title.run();
		},
		remove:function(a)
		{
			if(_.title.obj[a])
			{
				delete _.title.obj[a];
				if(_.title.obj['default'])document.title=_.title.obj['default'];
				_.title.count=_.title._count();
			}
			_.title.run();
		},
		run:function()
		{
			if(!_.title.obj['default'])
			{
				_.title.obj['default']=document.title;
				_.title.count++;
			}
			//_.title.count=_.title._count();
			if(_.title.idx>_.title.count)_.title.idx=0;
			clearTimeout(_.title.timer)
			var k,c=0,o=_.title.obj;
			for(k in o){
				if(o.hasOwnProperty(k)){
					if(c==_.title.idx)
					{
						var o=$('.notify_other > a p').html(),o=Math.floor(o&&o!='0'?o:0);
						var f=$('.notify_friend > a p').html(),f=Math.floor(f&&f!='0'?f:0);
						var l=o+f;
						document.title=(l>0?'('+l+') ':'')+_.title.obj[k];
						break;
					}
					c++;
				}
			}
			if(_.title.count>1)
			{
				_.title.idx++;
				_.title.timer=setTimeout(function(){_.title.run()},1000);
			}
		},
		_count:function(){var c=0,k,o=_.title.obj;for(k in o){if(o.hasOwnProperty(k))c++;}return c;},
		clear:function()
		{
			if(_.title.count>1)
			{
				if(_.title.obj['default'])document.title=_.title.obj['default'];
				_.title.obj={'default':document.title};
				_.title.idx=1;
				_.title.run();
			}
		}
	},
	parse:
	{
		reload:function()
		{
			window.location.href=_.url;
		},
		notify:function(a){
			$('.notify_other > a p').html(a.ot).css('display',a.ot?'block':'none');
			$('.notify_friend > a p').html(a.fr).css('display',a.fr?'block':'none');
			if(a.ds)_.notify.ds=a.ds.sec;
			if(a.ntf)
			{
				for(var i=0;i<a.ntf.length;i++)_.notify.alert(a.ntf[i]);
				//for(var i=0;i<a.ntf.length;i++)_.notify.alert(a.ntf[i].u.name+' '+a.ntf[i].ms,a.ntf[i].l);
			}
			_.title.run();
		},
		notifications:function(a,b)
		{
			var d='',u;
			if(a)
			{
				for(var j=0;j<a.length;j++)
				{
					var c=a[j];
					if(c.ty=='friend-accept')
					{
						var t=parseInt(c.u._id);
						var r=$.inArray(t,_.my.ct.fq);
						if(r>-1)
						{
							_.my.ct.fq.splice(r,1);					
						}
						r=$.inArray(t,_.my.ct.fr);
						if(r==-1)
						{
							_.my.ct.fr.push(t);					
						}
					}
					u=_.protocol+'boxza.com/'+c.u.link;
					if(_.profile&&_.profile.enabled)
					{
						u+='" onclick="_.line.go(\'/'+c.u.link+'\',true);return false;';
					}
					if(c.ty=='friend' && $.inArray(c.u._id,_.my.ct.fr)>-1)continue;
					d += '<li class="'+(!c.dr?' ur':'')+'"><span class="av"><a href="'+u+'"><img src="'+c.u.img+'"></a></span> <a href="'+u+'"><strong>'+c.u.name+'</strong></a> '+c.ms+'<div><div class="left"><span class="ago" datetime="'+c.da+'">'+_.time.cal(c.da)+'</span></div>';
					if(c.ty=='friend')
					{
						d+='<div class="right"><span class="button friend-request-'+c.u._id+'" onclick="_.friend.accept('+c.u._id+');return false;">ตอบรับ</span> <span class="button friend-cancel-'+c.u._id+'" onclick="_.friend.cancel('+c.u._id+');return false;">ปฏิเสธ</span></div>';
					}
					else if(c.bt)
					{
						d+='<div class="right"><span class="button" onclick="window.location.href=\''+c.l+'\'">'+c.bt+'</span></div>';
					}
					d+='<p></p></div><p></p></li>';
				}
			}
			if(d)
			{
				d='<div style="max-height:'+($(window).height()-150)+'px;overflow: hidden;overflow-y: scroll;">'+d+'</div><li class="mr"><a href="'+_.protocol+'boxza.com/notifications/'+b+'">ดูการแจ้งเตือนทั้งหมด</a></li>';
			}
			else
			{
				d+='<li style="text-align:center; padding:20px">ไม่มีข้อความแจ้งเตือนใหม่</li>';
			}
			$('.notify_'+b+' > ul').html(d);
			$('.notify_'+b+' > a p').html('0').css('display','none');
			_.title.run();
		},
		search:function(a)
		{
			var t='',p=(_.profile&&_.profile.enabled),func=$(_.people.last).data('func'),friend=Math.floor('0'+$(_.people.last).data('friend')),uid;
			$('#sresult a.selected').removeClass('selected');
			 if(func==='go')
			 {
				for(var i=0;i<a.length;i++)
				{
					t+='<a'+(!i?' class="selected"':'')+' href="http://boxza.com/'+a[i].link+'"'+(p?' onclick="_.line.go(\'/'+a[i].link+'\',true);return false"':'')+' data-uid="'+a[i]._id+'"><div><span><img src="'+a[i].img+'"></span>'+a[i].name+'</div></a>';
				}
			 }
			 else
			 {
				for(var i=0;i<a.length;i++)
				{
					uid=(friend==2?a[i].link:a[i]._id);
					t+='<a'+(!i?' class="selected"':'')+' href="javascript:;" onclick="'+func+'(\''+uid+'\');return false" data-uid="'+uid+'"><div><span><img src="'+a[i].img+'"></span>'+a[i].name+'</div></a>';
				}
			 }
			if(!$('#sresult').length)
			{
				$('<div>').attr('id','sresult').appendTo($(_.people.last).parent().parent());
			}
			if(!t)
			{
				t='<div style="padding:20px; text-align:center">ไม่พบบุคคลที่ต้องการค้นหา</div>';
			}
			else if(!friend)
			{
				t+='<a href="http://boxza.com/people/?q='+decodeURIComponent($(_.people.last).val())+'"'+(p?' onclick="_.line.go(\'/people/?q='+decodeURIComponent($(_.people.last).val())+'\',true);return false"':'')+' class="a">ค้นหาเพิ่มเติม</a>';
			}
			$('#sresult').html(t);
			$('#sresult a').hover(function(){$('#sresult a.selected').removeClass('selected');$(this).addClass('selected')},function(){$(this).removeClass('selected')});
		}
	},
	itag:function(a) {
		if( !a ) return a; 
		a = ' '+$.trim(a)+' ';
		a = a.replace(/<br>\n/ig,"\n").replace(/\r\n/ig,"\n").replace(/\n\r/ig,"\n").replace(/\n\n\n/ig,"\n\n");
		
		var _t='',_expand=false;
		
		if(arguments.length>2 && arguments[2])
		{
			_expand=true;
		}
		if(!_expand)
		{
			if(a.split(' ').length >42)
			{
				_t=$.trim(a.split(' ').slice(0,40).join(' ')).replace(/\n/g," <br> ");
			}
			if(a.split(/\n/).length >6)
			{
				_t=$.trim(a.split(/\n/).slice(0,5).join("\n")).replace(/\n/g," <br> ");
			}
		}
		
		//[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig
		a = a.replace(/\n/g," <br> ").replace(/([^"|^\'|^>|^=|^\]|^&quot;|^&gt;]+)(http:\/\/|https:\/\/|ftp:\/\/)([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,
	//	a = a.replace(/\n/g," <br> ").replace(/([^"|^\'|^>|^=|^\]|^&quot;|^&gt;]+)(http:\/\/|https:\/\/|ftp:\/\/)([^\s,]*)/gi,
									function(url,i1,i2,i3){
										return i1+'<a href="'+i2+i3+'" target="_blank" rel="nofollow">'+ decodeURIComponent(i2+i3) +'</a>';
								}
					);
		
		if(arguments.length>1 && arguments[1])
		{
			var h=arguments[1];
			for(var i=0;i<h.length;i++)
			{
				var rp=new RegExp('@'+h[i]+'', "gi");
				a = a.replace(rp,
											function(url,i1){
												return '<a href="/'+decodeURIComponent(h[i])+'" class="h">'+url+'</a>';
										}
							);
				if(!_expand)
				{
					_t = _t.replace(rp,
												function(url,i1){
													return '<a href="/'+decodeURIComponent(h[i])+'" class="h">'+url+'</a>';
											}
							);
				}
			}
		}
		//a = a.replace(/\[code\](.*)\[\/code\]/gi,function(t){return '<pre>'+$.trim(t.replace(/\[code\](.*)\[\/code\]/gi,'$1').replace(/<br>/ig,"\n"))+'</pre>'});
			
			var em=[
									['(\\:\\)|\\:\\-\\)|\\:\\]|\\=\\))',0,-221],
									['(\\:D|\\:\\-D|\\=D)',-68,-374],
									['(;\\)|;\\-\\))',-17,-289],
									['\\^_\\^',-51,-187],
									['(&gt;\\:o|&gt;\\:O|&gt;&lt;)',0,-238],
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
									['(&lt;\\(&quot;\\)|&lt;\\("\\))',-17,-204]
							];
			
			for(var j=0;j<em.length;j++)
			{
				var rp=new RegExp('(\\s|\>)'+em[j][0]+'', "g");
				a=a.replace(rp,'$1<span class="emo" style="background-position:'+em[j][1]+'px '+em[j][2]+'px "></span>');
				if(!_expand)
				{
					_t=_t.replace(rp,'$1<span class="emo" style="background-position:'+em[j][1]+'px '+em[j][2]+'px "></span>');
				}
			}
			var curemo=0;
			a=a.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,function(t2,i1,i2){
				curemo++;
				return (curemo>3)?'':t2.replace(/\[emoticon=([a-z]{1})([0-9]{1,3})\]/ig,'<img src="http://s0.boxza.com/static/chat/emoticon/$1/$2.gif" class="bz-chat-click-emo">');
			})
			return $.trim(a);
	},
	friend:
	{
		del:function(id,n)
		{
			_.box.confirm({
				title:'ลบเพื่อน',
				detail:'คุณต้องการลบ "'+n+'" ออกจากการเป็นเพื่อนหรือไม่',
				click:function()
				{
					$('.friend-'+id).remove();
					var r=$.inArray(id,_.my.ct.fr);
					if(r>-1)
					{
						_.my.ct.fr.splice(r,1);
					}
					var cn=$('.connect-'+id),rl=false;
					if(cn.length)
					{
						cn.find('.connect-btn').remove();
						rl=true;
					}
					_.api('/me/friend/delete-'+id+(rl?'/reload':''));
				}
			});
		},
		drequest:function(id)
		{
			_.box.confirm({
				title:'ลบเพื่อน',
				detail:'คุณต้องการยกเลิกคำขอเป็นเพื่อนนี้หรือไม่',
				click:function()
				{
					$('.friend-'+id).remove();
					var r=$.inArray(id,_.my.ct.fq);
					if(r>-1)
					{
						_.my.ct.fq.splice(r,1);
					}
					var cn=$('.connect-'+id),rl=false;
					if(cn.length)
					{
						cn.find('.connect-btn').remove();
						rl=true;
					}
					_.api('/me/friend/delete-'+id+(rl?'/reload':''));
				}
			});
		},
		accept:function(id)
		{
			$('.friend-cancel-'+id).remove();
			$('.friend-request-'+id).unbind().addClass('friend').removeClass('button').removeAttr('onclick').html('เพื่อน');
			var cn=$('.connect-'+id);
			if(cn.length)
			{
				cn.find('.connect-btn').remove();
				cn.prepend('<span class="button blue connect-btn" data-dropdown="#dropdown-profile-'+id+'>">เพื่อน <span class="caret"></span></span>');
			}
			var r=$.inArray(id,_.my.ct.fq);if(r>-1)_.my.ct.fq.splice(r,1);r=$.inArray(id,_.my.ct.fr);if(r==-1)_.my.ct.fr.push(id);_.api('/me/friend/accept-'+id);
			return false;
		},
		cancel:function(id)
		{
			$('.friend-cancel-'+id).hide();
			$('.friend-request-'+id).hide();
			var cn=$('.connect-'+id),rl=false;
			if(cn.length)
			{
				cn.find('.connect-btn').remove();
				rl=true;
			}
			var r=$.inArray(id,_.my.ct.fq);
			if(r>-1)
			{
				_.my.ct.fq.splice(r,1);
			}
			_.api('/me/friend/cancel-'+id+(rl?'/reload':''));
			return false;
		},
		request:function(id)
		{
			var r=$.inArray(id,_.my.ct.fq);
			if(r==-1)
			{
				_.my.ct.fq.push(id);
			}
			$('.friend-request-'+id).replaceWith('<span class="frequest">รอตอบกลับ</span>');
			_.api('/me/friend/request-'+id);
			var cn=$('.connect-'+id);
			if(cn.length)
			{
				cn.find('.connect-btn').remove();
				cn.prepend('<span class="frequest connect-btn">ส่งคำร้องขอเป็นเพื่อนแล้ว</span> <span class="button connect-btn" onClick="_.friend.drequest('+id+')">ยกเลิกคำขอ</span>');
			}
		},
		follow:function(id)
		{
			var r=$.inArray(id,_.my.ct.fl);
			if(r==-1)
			{
				_.my.ct.fl.push(id);
			}
			$('.follow-request-'+id).replaceWith('<span class="button">ติดตามแล้ว</span>');
			var cn=$('.connect-'+id),rl=false;
			if(cn.length)
			{
				cn.find('.connect-btn').remove();
				cn.prepend('<span class="button blue connect-btn">กรุณารอซักครู่...</span>');
				rl=true;
			}
			_.api('/me/friend/follow-'+id+(rl?'/reload':''));
		},
		unfollow:function(id)
		{
			var r=$.inArray(id,_.my.ct.fl);
			if(r>-1)
			{
				_.my.ct.fl.splice(r,1);
			}
			var cn=$('.connect-'+id),rl=false;
			if(cn.length)
			{
				cn.find('.connect-btn').remove();
				cn.prepend('<span class="button blue connect-btn">กรุณารอซักครู่...</span>');
				rl=true;
			}
			_.api('/me/friend/unfollow-'+id+(rl?'/reload':''));
		},
		parse:function(a)
		{
			if(a.type=='error')
			{
				_.box.alert(a.msg);
			}
			else if(a.type=='accept')
			{
				var r=$.inArray(a.uid,_.my.ct.fq);
				if(r>-1)
				{
					_.my.ct.fq.splice(r,1);
				}
				if($.inArray(a.uid,_.my.ct.fr)==-1)
				{
					_.my.ct.fr.push(a.uid);		
				}
			}
			else if(a.type=='request')
			{
				if($.inArray(a.uid,_.my.ct.fq)==-1)
				{
					_.my.ct.fq.push(a.uid);	
				}
			}
			else if(a.type=='delete')
			{
				var r=$.inArray(a.uid,_.my.ct.fq);
				if(r>-1)
				{
					_.my.ct.fq.splice(r,1);
				}
				var r=$.inArray(a.uid,_.my.ct.fr);
				if(r>-1)
				{
					_.my.ct.fr.splice(r,1);
				}
			}
			else if(a.type=='follow')
			{
				var cn=$('.connect-'+a.uid);
				if(cn.length)
				{
					cn.find('.connect-btn').remove();
					cn.prepend('<span class="button blue connect-btn" data-dropdown="#dropdown-profile-'+a.uid+'">ติดตามแล้ว <span class="caret"></span></span>');
				}
			}
			else if(a.type=='unfollow')
			{
				var cn=$('.connect-'+a.uid);
				if(cn.length)
				{
					
				}
			}
		}
	},
	people:{
		load:function()
		{
			$('.find-people:not(.ev)').addClass('ev').keyup(function(e){
				_.people.last=this;
				var l=$(this).data('last'),q=$.trim($(this).val());
				if(q!=l)
				{
					$(this).data('last',q);
					if(q)
					{
						_.api('/me/search/',{'q':q,'friend':$(this).data('friend')});
					}
					else
					{
						$('#sresult').remove();
					}
				}
			}).keydown(function(e) {
				var k=$('#sresult a').length;
				if(k>0)
				{
					var s=$('#sresult a.selected'),i=$('#sresult a').index(s),c=0;
					s.removeClass('selected');
					if(!s.length)i=0;
					 e = e||window.event
					 var c = e.keyCode;
					 if(c==38)//up
					 {
						 c=i-1;
					 }
					 else if(c==40)//down
					 {
						 c=i+1;
					 }
					 else if(c==13)//enter
					 {
						 if($(this).data('func')==='go')
						 {
							 if(_.profile&&_.profile.enabled)
							 {
								 s.trigger('click');
							 }
							 else
							 {
								 window.location.href=s.attr('href');
							 }
						 }
						 else
						 {
							eval($(this).data('func')+'("'+s.data('uid')+'")'); 
						 }
						$('#sresult').remove();
						$(this).data('last','').val('');
					 }
					 if(c<0)c=k-1;
					 else if(c>k-1)c=0;
					 $('#sresult a:eq('+c+')').addClass('selected');
				}
			});
		}
	},
	game:
	{
		bet:{
			room:1,path:'/game',
			sendg:function()
			{
				var numtoa = new Array("ไก่","น้ำเต้า","กุ้ง","กบ","ปลา","ปู");
				var m=Math.floor($('#gmoney').val());
				if(m<1)
				{
					alert('คะแนนขั้นต่ำในการแทงคือ 1 บ๊อก');
				}
				else if(m>1000)
				{
					alert('คะแนนสูงสุดในการแทงคือ 1,000 บ๊อก');
				}
				else if(confirm('คุณต้องการแทง '+numtoa[Math.floor($('#number').val())-1]+' จำนวน '+m+' คะแนน หรือไม่'))
				{
					_.ajax.gourl(_.game.bet.path+'/namtoa/'+_.game.bet.room,'doit',$('#number').val(),$('#gmoney').val());
					$('#number').val('');
					$('#gmoney').val('');
				};
			},
			sends:function()
			{
				var m=Math.floor($('#gmoney').val()),a=Math.floor('0'+$('#amount').val());
				if(a<1)
				{
					alert('กรุณาเลือกจำนวนวงไพ่ที่จะตั้ง');
				}
				else if(m<1)
				{
					alert('กรุณาตั้งตั้งค่าต๋งอย่างน้อย 1 บ๊อก');
				}
				else if(confirm('คุณต้องตั้งวงไพ่ วงละ '+m+' บ๊อก จำนวน '+a+' วง หรือไม่'))
				{
					_.ajax.gourl(_.game.bet.path+'/slave/'+_.game.bet.room,'createslave',m,a);
					$('#amount').val('');
					$('#gmoney').val('');
				};
			},
			sendp:function(i,p){_.ajax.gourl(_.game.bet.path+'/slave/'+_.game.bet.room,'doit',i,p);},
			sendc2:function()
			{
				var m=Math.floor($('#gmoney2').val());
				 if(confirm('คุณต้องแลกคะแนนจำนวน '+m+' คะแนน  หรือไม่'))
				{
					_.ajax.gourl(_.game.bet.path+'/bank/'+_.game.bet.room,'doit2',m);
					$('#gmoney2').val('');
					_.box.close();
				}
			},
			sendc:function(){var m=Math.floor($('#gmoney').val());if(confirm('คุณต้องแลกบ๊อกจำนวน '+m+' บ๊อก  หรือไม่')){_.ajax.gourl(_.game.bet.path+'/bank/'+_.game.bet.room,'doit',m);$('#gmoney').val('');_.box.close();}},
			_buyit:function(a,b){if(confirm('คุณต้องซื้อไอเท็มชิ้นนี้ในราคา '+b+' คะแนน หรือไม่')){_.ajax.gourl(_.game.bet.path+'/item/'+_.game.bet.room,'buyit',a);};},
			_sellit:function(a,b){if(confirm('คุณต้องขายไอเท็มชิ้นนี้ในราคา '+b+' คะแนน หรือไม่')){_.ajax.gourl(_.game.bet.path+'/item/'+_.game.bet.room,'sellit',a);};},
			_useit:function(a,b){if(confirm('คุณต้อง'+(b?'สวม':'ถอด')+'ไอเท็มชิ้นนี้หรือไม่ หรือไม่')){_.ajax.gourl(_.game.bet.path+'/item/'+_.game.bet.room,'useit',a,b);};},
			_buylotto:function(e,n,l,u){_.game.bet._replacelotto();$(e).replaceWith('<div class="buylotto" data-num="'+n+'" data-click="_buylotto(this,'+n+','+l+','+u+')">เลข <input type="text" style="width:25px;text-align:center" id="lnumber"> จำนวน <input type="text" style="width:60px;text-align:center" id="lmoney"> <input type="button" class="btn" value="ซื้อ" style="width:150px" onclick="_buylot('+n+','+l+','+u+')"></div>');},
			buylot:function()
			{
				var m=Math.floor($('#lmoney').val()),a=$.trim($('#lnumber').val()),t=$.trim($('#ltype').val());
				if(m<1)
				{
					alert('กรุณาตั้งตั้งค่าต๋งอย่างน้อย 1 บ๊อก');
				}
				else if(a.length!=t)
				{
					alert('กรุณากรอกตัวเลขให้ถูกต้อง ตามประเภทรางวัล ('+t+'ตัว)');
				}
				else if(confirm('คุณต้องซื้อ รางวัลเลข'+(t<3?'ท้าย':'')+' '+t+' ตัว คือ '+a+' จำนวน '+m+' บ๊อก หรือไม่'))
				{
					_.ajax.gourl(_.game.bet.path+'/lottery/'+_.game.bet.room,'doit',a,m);
					//_replacelotto();
				};
			},
			_buylot:function(n,l,u)
			{
				var m=Math.floor($('#lmoney').val()),a=$.trim($('#lnumber').val());
				if(m<1)
				{
					alert('กรุณาตั้งตั้งค่าต๋งอย่างน้อย 1 บ๊อก');
				}
				else if(a.length!=n)
				{
					alert('กรุณากรอกตัวเลขให้ถูกต้อง ตามประเภทรางวัล ('+n+'ตัว)');
				}
				else if(confirm('คุณต้องซื้อ รางวัลเลข'+(n<3?'ท้าย':'')+' '+n+' ตัว คือ '+a+' จำนวน '+m+' บ๊อก หรือไม่'))
				{
					_.ajax.gourl(_.game.bet.path+'/lottery/'+_.game.bet.room,'doit',a,m,u);
					_.game.bet._replacelotto();
				};
			},
			_replacelotto:function(){$('.buylotto').each(function(){var d=$(this);d.replaceWith('<a href="javascript:;" onclick="'+d.data('click')+'" class="btn">ซื้อเลข '+d.data('num')+' ตัวกับเจ้ามือนี้</a>');});}
		}
	},
	search:
	{
		data:{},
		parse:function(a,t)
		{
			var tmp='';
			if(t=='tag')
			{
				if(a&&a.length)
				{
					tmp='<table width="400" class="table table-condensed" style="margin:0px">';
					for(var i in a)
					{
						_.search.data[t][a[i]._id]=a[i];
						tmp+='<tr><td>'+a[i].n+' - ใช้ '+a[i].amount+' ครั้ง</td><td style="text-align:right"><a href="javascript:;" class="btn btn-mini" onclick="_.search.insert(\''+a[i]._id+'\',\''+t+'\')"><i class="icon-plus"></i> เพิ่ม</a></td></tr>';	
					}
					tmp+='</table>';
				}
				$('.api-search.'+t).html(tmp);
			}
			else
			{
				if(a&&a.length)
				{
					tmp='<table width="400" class="table table-condensed" style="margin:0px">';
					for(var i in a)
					{
						_.search.data[t][a[i]._id]=a[i];
						tmp+='<tr><td><a href="'+a[i].link+'" target="_blank">'+a[i].name+'</a></td><td style="text-align:right"><a href="javascript:;" class="btn btn-mini" onclick="_.search.insert('+a[i]._id+',\''+t+'\')"><i class="icon-plus"></i> เพิ่ม</a></td></tr>';	
					}
					tmp+='</table>';
				}
				tmp+='<div style="text-align:center;background:#f0f0f0"><a href="http://'+t+'.boxza.com/admin" target="_blank">เพิ่มข้อมูลใหม่</a></div>';
				$('.api-search.'+t).html(tmp);
			}
		},
		insert:function(i,t)
		{
			if(t=='tag')
			{
				$('.api-search-tag').before('<li class="tag-box"><input type="hidden" name="tags[]" value="'+i+'">'+i+'<a href="javascript:;" onclick="$(this).parent().remove()">x</a></li>');
				$('.api-search-input.tag').css('width',20);
			}
			else
			{
				if(!$('#api-search-'+t+'_'+i).length)
				{
					$('.api-search-have.'+t).append('<div id="api-search-'+t+'_'+i+'"><input type="hidden" name="'+t+'[]" value="'+i+'"><a href="'+_.search.data[t][i].link+'" target="_blank">'+_.search.data[t][i].name+'</a><a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a></div>');
				}
			}
			$('.api-search-input').val('');
			$('.api-search.'+t).html('');
		},
		load:function()
		{		
			$('.api-search-have.tag').click(function()
			{
				$('.api-search-input.tag',this).focus();
			});
			$('.api-search-input:not(.ev)').addClass('ev').keypress(function(e)
			{
				var c=e.which;
				var t=$(this).data('type'),l=$(this).data('last'),q=$.trim($(this).val());
				if(t=='tag')
				{
					$('.api-search-input.tag').css('width',((q.length+1)* 8)+10);
				}
				if((c==13||c==44)&&t=='tag')
				{
					q=$.trim(q.replace(',',''));
					$('.api-search-input.tag').val(q);
					if(q)
					{
						_.search.insert(q,'tag');
					}
				}
				
				 if(c == 13)
				 {
					return false;
				 }
			}).keyup(function(e)
			{
				var c=e.which;
				var t=$(this).data('type'),l=$(this).data('last'),q=$.trim($(this).val());
				
				 if(c == 13)
				 {
					return false;
				 }
				if(q!=l)
				{
					_.search.data[t]={};
					$(this).data('last',q);
					if(q)
					{
						_.api('/me/'+t,{'q':q});
					}
					else
					{
						$('.api-search.'+t).html('');
					}
				}
			});
		}
	},
	share:function(d)
	{
		var count={facebook:0,google:0,twitter:0};
		var data={title:encodeURIComponent(d.title),url:encodeURIComponent(d.url),img:encodeURIComponent(d.img)}
		var w=520,h=350,t=(screen.height/2)-(h/2),l=(screen.width/2)-(w/2);
		$('._share .facebook a').click(function(){window.open('http://www.facebook.com/sharer.php?s=100&u='+data.url+'&p[title]='+data.title+'&p[images][0]='+data.img,'sharer','top='+t+',left='+l+',toolbar=0,status=0,width='+w+',height='+h);});
		$('._share .twitter a').click(function(){window.open('https://twitter.com/intent/tweet?text='+data.title+'&url='+data.url,'sharer','top='+t+',left='+l+',toolbar=0,status=0,width='+w+',height='+h);});
		$('._share .google a').click(function(){window.open('https://plus.google.com/share?title='+data.title+'&url='+data.url,'sharer','top='+t+',left='+l+',toolbar=0,status=0,width='+w+',height='+h);});
		if (!window.services) window.services={};
		window.services.gplus={cb: function(number){_val('google',number);}};
		var _val=function(a,b){count[a]=b;$('._share .'+a+' p').html(b);$('._share .count').html(count.facebook+count.twitter+count.google);}
		$.getJSON('https://graph.facebook.com/fql?q=SELECT+total_count+FROM+link_stat+WHERE+url%3D%22'+data.url+'%22&callback=?').done(function(d){try {_val('facebook',d.data[0].total_count);}catch(e){}});
		$.getJSON('https://cdn.api.twitter.com/1/urls/count.json?url='+data.url+'&callback=?').done(function(d){try {_val('twitter',d.count);}catch(e){}});
		$.getScript('http://share.yandex.ru/gpp.xml?url='+data.url);
	}
};

//tooltip
(function($){$.fn.tipsy=function(g){$('.tipsy').remove();g=$.extend({},$.fn.tipsy.defaults,g);return this.each(function(){var f=$.fn.tipsy.elementOptions(this,g);$(this).hover(function(){$.data(this,'cancel.tipsy',true);var a=$.data(this,'active.tipsy');if(!a){a=$('<div class="tipsy"><div class="tipsy-inner"/></div>');a.css({position:'absolute',zIndex:100000});$.data(this,'active.tipsy',a)}if($(this).attr('title')||typeof($(this).attr('original-title'))!='string'){$(this).attr('original-title',$(this).attr('title')||'').removeAttr('title')}var b;if(typeof f.title=='string'){b=$(this).attr(f.title=='title'?'original-title':f.title)}else if(typeof f.title=='function'){b=f.title.call(this)}a.find('.tipsy-inner')[f.html?'html':'text'](b||f.fallback);var c=$.extend({},$(this).offset(),{width:this.offsetWidth,height:this.offsetHeight});a.get(0).className='tipsy';a.remove().css({top:0,left:0,visibility:'hidden',display:'block'}).appendTo(document.body);var d=a[0].offsetWidth,actualHeight=a[0].offsetHeight;var e=(typeof f.gravity=='function')?f.gravity.call(this):f.gravity;switch(e.charAt(0)){case'n':a.css({top:c.top+c.height,left:c.left+c.width/2-d/2}).addClass('tipsy-north');break;case's':a.css({top:c.top-actualHeight,left:c.left+c.width/2-d/2}).addClass('tipsy-south');break;case'e':a.css({top:c.top+c.height/2-actualHeight/2,left:c.left-d}).addClass('tipsy-east');break;case'w':a.css({top:c.top+c.height/2-actualHeight/2,left:c.left+c.width}).addClass('tipsy-west');break}if(f.fade){a.css({opacity:0,display:'block',visibility:'visible'}).animate({opacity:0.8})}else{a.css({visibility:'visible'})}},function(){$.data(this,'cancel.tipsy',false);var b=this;setTimeout(function(){if($.data(this,'cancel.tipsy'))return;var a=$.data(b,'active.tipsy');if(f.fade){a.stop().fadeOut(function(){$(this).remove()})}else{a.remove()}},100)})})};$.fn.tipsy.elementOptions=function(a,b){return $.metadata?$.extend({},b,$(a).metadata()):b};$.fn.tipsy.defaults={fade:false,fallback:'',gravity:'n',html:false,title:'title'};$.fn.tipsy.autoNS=function(){return $(this).offset().top>($(document).scrollTop()+$(window).height()/2)?'s':'n'};$.fn.tipsy.autoWE=function(){return $(this).offset().left>($(document).scrollLeft()+$(window).width()/2)?'e':'w'}})(jQuery);

//easing
jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return jQuery.easing[jQuery.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;if(!g)g=e*.3*1.5;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;if((b/=e/2)<1)return d/2*b*b*(((f*=1.525)+1)*b-f)+c;return d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-jQuery.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){if((b/=e)<1/2.75){return d*7.5625*b*b+c}else if(b<2/2.75){return d*(7.5625*(b-=1.5/2.75)*b+.75)+c}else if(b<2.5/2.75){return d*(7.5625*(b-=2.25/2.75)*b+.9375)+c}else{return d*(7.5625*(b-=2.625/2.75)*b+.984375)+c}},easeInOutBounce:function(a,b,c,d,e){if(b<e/2)return jQuery.easing.easeInBounce(a,b*2,0,d,e)*.5+c;return jQuery.easing.easeOutBounce(a,b*2-e,0,d,e)*.5+d*.5+c}})


window.tinyMCEPreInit = {suffix:'',base:'/_static/js/tiny_mce'};

$(window).scroll(_.update);
$(window).resize(function(){clearTimeout(_.resize);_.resize=setTimeout(function(){_.update()},1000);});
$(document).click(_.edit.click);
$(document).mouseover(function(e){_.ajax.loading(e);_.edit.mouseover(e);});
$(document).ready(function(){
	if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod')
	{
		$('body').addClass('ios');
	}
	_.tooltop();
	$('li.notify_friend > a,li.notify_other > a').click(_.notify.open);
	$('li.notify_setting').hover(function(){$(this).find('a:first').addClass('over');$(this).find('ul:first').css('display','block')},function(){$(this).find('a:first').removeClass('over');$(this).find('ul:first').css('display','none')});
	_.people.load();
	_.search.load();
	
	/*
	var adsenseclick=false,isOverGoogleAd=false;
	
	
	$("iframe:not([src])")
	.mouseover(function(){isOverGoogleAd=true;})
	.mouseout(function(){isOverGoogleAd=false;}
	);
	
	$( window ).blur(
		function(){
			if (isOverGoogleAd)
			{
				if(!adsenseclick)
				{
					adsenseclick=true;	
					var img = new Image();
					img.crossOrigin = "Anonymous";
					img.src = 'http://boxza.com/ads/adsense?u=' + encodeURIComponent(document.location)+'&t='+encodeURIComponent(document.title)+'&r='+encodeURIComponent(document.referrer);
				}		
			}
		}
	);
	*/
});



$(document).on({
    mouseenter: function() 
    {
		$('.av-bubble').remove();
		clearTimeout(_.av);
		var t=$(this).attr('av');
		if(!t)return;
		var w=$(document).width()-$(this).offset().left;
		var l=(w < 310?$(this).offset().left+w-310 : $(this).offset().left-6);
		var g=($(this).offset().left+parseInt($(this).width()/2))-l-10;
		var v=$('<div></div>').addClass('av-bubble').css({'position':'absolute','top':$(this).offset().top+$(this).height()+10,'left':l});
		var $a=$(this).find('a'),$i=$(this).find('img');
		var j='<div><div class="ang" style="left:'+g+'px"></div><div class="left"><span class="a"><a href="'+$a.attr('href')+'" class="h" title="'+$a.attr('title')+'"><img src="'+$i.attr('src')+'"></a></span></div><div class="right"><h3>'+$a.attr('title')+'</h3>';
		if(_.my)
		{
			var b=$(this).data('button');
			if(b)
			{
				for(var i=0;i<b.length;i++)
				{
					j+=' <span class="button" onclick="'+b[i].click+'">'+b[i].text+'</span>';
				}
			}
			else
			{
				if(t==_.my._id)
				{
					return;
				}
				/*
				else if($.inArray(parseInt(t),_.my.ct.fr)>-1)
				{
					j+='<span class="friend">เพื่อน</span>';
					*/
					j+=' <span class="button" onclick="_.chat.add(\''+t+'\')">ส่งข้อความ</span>';
				/*
				}
				else if($.inArray(parseInt(t),_.my.ct.fq)>-1)
				{
					j+='<span class="frequest">รอตอบกลับ</span>';
				}
				else
				{
					j+='<span class="fnot friend-request-'+t+'" onClick="_.friend.request('+t+')">เพิ่มเป็นเพื่อน</span>';
				}
				*/
			}
		}
		j+='</div><p></p></div>';
		$('body').append(v.html(j));
		$('.av-bubble').focus().hover(function(){clearTimeout(_.av);},function() {
			$(this).remove();
			clearTimeout(_.av);
		}).bind('blur',function(e) {
      	$(this).remove();
			clearTimeout(_.av);
		});
    },
    mouseleave: function()
    {
		 clearTimeout(_.av);
		 _.av=setTimeout(function(){$('.av-bubble').remove();},2000);
    }
},'.av:not(.ev)');		

