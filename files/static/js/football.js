
var _={
	version:'1.2.0',http:'',js:'',protocol:'http://',static:'http://static.teededball.com/',url:window.location.pathname,host:window.location.hostname,
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
		open:function(){$('#gbox').remove();_.box.init();_.box.width=$(arguments[0]).width();_.box.height=$(arguments[0]).height();$('#gboxa').css({opacity:0.5});$('#gbox').show();_.box.update(true);var html=$(arguments[0]).html().replace(/_tmp_/gi,'_box_');$('#gboxc').html('<img src="'+_.static+'images/global/close.gif" style="position:absolute;top:10px;right:10px;cursor:pointer" onclick="_.box.close()">'+html);_.box.onopen=$(arguments[0]).attr('onopen');_.box.onclose=$(arguments[0]).attr('onclose');if(_.box.fast){$('#gboxb').css({width:_.box.width,height:'auto'});_.box.opened();}else{$('#gboxb').css({width:_.box.width,height:0});$('#gboxb').animate({height: _.box.height},1000,'easeOutBounce',function(){_.box.opened();});}},
		opened:function(){if(_.box.onopen)eval(_.box.onopen);$('#gboxb').css({height:'auto'});if(_.box.focus)$('.gbox_footer .button.blue').focus();},
		close:function(){if(_.box.fast){_.box._close();}else{$('#gboxb').animate({height:0},1000,'easeOutBounce',function(){_.box._close();});}},
		_close:function(){$('#gbox').remove();if(arguments[0])_.box.open(arguments[0]);if(_.box.onclose)eval(_.box.onclose);_.box.fast=false;_.box.focus=false;},
		update:function(move){if(!$('#gbox')[0])return;if($('#gbox').css('display')!='none'){var w=Math.max($(window).width(),$(document).width()),h=Math.max($(window).height(),$(document).height());$('#gbox').css({top:0,left:0,height:h,width:w});$('#gboxa').css({height:h,width:w});if(move)$('#gboxb').css({top:Math.max(0,$(document).scrollTop()+(($(window).height()-_.box.height)/2)),left:$(document).scrollLeft()+(($(window).width()-_.box.width)/2)});};if($('#loading').css('display')=='block'){$('#loading').css({top:($(document).scrollTop()+(($(window).height()-$('#loading').height())/2)),left:($(document).scrollLeft()+(($(window).width()-$('#loading').width())/2))});}},	
		alert:function(s){_.box.init();clearTimeout(_.box.timer);$('#loading').css({display:'block',opacity:0}).html('<div><a href="javascript:;" onclick="_.box.hide()" class="loading_close"><img src="'+_.static+'images/global/close.gif"></a><span>'+s+'</span></div>').fadeTo("slow",1);_.box.update(true);_.box.timer=setTimeout('_.box.hide()',arguments.length>1?arguments[1]:5000)},
		hide:function(){$('#loading').fadeOut('slow')},
	},
	edit:
	{
		profile:new Array(),
		mouseclear:function(){if(_.edit.curedit){$('.editting').removeClass('editting');_.edit.curedit='';}},
		mouseover:function(e){var j=e;e=_.edit.find(e.target,'edit2');if(e){if(e!=_.edit.cur){if(e.innerHTML.indexOf('update_')<0){if(!$('#edit2-click')[0]){var c=$('<img>').attr('src',_.static+'images/global/edit.gif').attr('id','edit2-click').css({'position':'absolute','left':0,'top':0,'cursor':'pointer','display':'none','z-index':99});$('body').append(c);};$('#edit2-click').css({top:$(e).offset().top+2,left:$(e).offset().left+$(e).width()-10,'display':'inline'});$('#edit2-click').unbind('click');$('#edit2-click').click(function(e1){_.edit.click(j,true);$('#edit2-click').css({'display':'none'});})};_.edit.cur=e;}}},
		click:function(e){e=_.edit.find(e.target,'edit'+(arguments.length>1?'2':''));if(e){var div=$(e).find('span.ed')[0],p=$(e).find('strong.ed')[0],em=$(e).find('em.ed');if(div.innerHTML.toLowerCase().indexOf(p.innerHTML.toLowerCase().substr(0,5))<0){_.edit.profile[div.id]=$(div).html();if(_.edit.curedit!=div&&_.edit.curedit){$(_.edit.curedit).html(_.edit.profile[_.edit.curedit.id]);$(_.edit.curedit).parent().removeClass('editting');};$(div).html($(p).html().replace(/tmp_/gi, "update_")+"");$(div).find('input:text,textarea,select').keypress(function(e){var c=(e.keyCode?e.keyCode:e.which);if(c==13&&!e.shiftKey)_.edit.submit(div.id);});$(div).find('input:text,input:checkbox,textarea,select').keyup(function(e){var c=(e.keyCode?e.keyCode:e.which);if(c==27)_.edit.cancel(div.id);});if(em.length>0)$(em[0]).css({display:'none'});_.edit.curedit=div;_.edit.resize();if(!$('#edit-tooltip')[0]&&!$(e).attr('nb')){$('body').append($('<div>').attr({id:'edit-tooltip'}))};if(!$(e).attr('nb')){$('#edit-tooltip').html("<a href='javascript:;' onclick='_.edit.submit(\""+div.id+"\")'><img src='"+_.static+"images/global/save.gif' style='vertical-align:text-bottom'></a> <a href='javascript:;' onclick='_.edit.cancel(\""+div.id+"\")'><img src='"+_.static+"images/global/reload.gif' style='vertical-align:text-bottom'></a>"+(!$(e).attr('nt')&&$(div).attr('ref')!='checkbox'?' ('+($(div).attr('ref')=='textarea'?_.lang.edittxt1:'')+_.lang.edittxt2+')':''));$('#edit-tooltip').css({display:'inline',top:$(e).offset().top-$('#edit-tooltip').height()-7,left:$(e).offset().left+2});};$(e).addClass('editting');}}},
		find:function(e,c){var i=0;while(e&&i<3){if($(e).hasClass(c))return e;e=e.parentNode;i++;};return false;},
		submit:function(a){$('#edit-tooltip').css({display:'none'});var c='#'+a,p=$(c).attr('id'),z=$(c).attr('ref'),s=$(c).attr('sp'),f=$(c).attr('func'),v='';switch(z){case 'datetime':v=$('#update'+p+'_year').val()+'-'+$('#update'+p+'_month').val()+'-'+$('#update'+p+'_day').val()+' '+$('#update'+p+'_hh').val()+':'+$('#update'+p+'_nn').val()+':00';break;case 'date':case 'birth':v=$('#update'+p+'_year').val()+'-'+$('#update'+p+'_month').val()+'-'+$('#update'+p+'_day').val();break;case 'time':v=$('#update'+p+'_hh').val()+':'+$('#update'+p+'_nn').val()+':00';break;case 'checkbox':$('.update'+p+':checked').each(function(i,e){v+=(i?', ':'')+$(this).val();});break;default:v=$('#update'+p).val();};if($.trim(v)!=''||s){if(f){f=','+f;var t=f.split(',');}else{var t=p.split('_');};switch(t.length){case 4:_.ajax.gourl(_.url,'update',t[1],t[2],t[3],v,z);break;case 3:_.ajax.gourl(_.url,'service',t[1],t[2],v,z);break;case 2:_.ajax.gourl(_.url,'save',t[1],v,z);break;};$('#'+p).html('<img src="'+_.static+'images/global/saving.gif" class="icon"> '+_.lang.saving);_.edit.curedit='';}else{_.edit.cancel(p);};$('.editting').removeClass('editting');},
		resize:function(){if(_.edit.curedit){var a=_.edit.curedit,b=$(a).parent()[0];if($(b).attr('full')!=''){/*alert($(b).attr('full')+'zz-'+$(a).attr('id'));*/$('#update'+$(a).attr('id')).css({width:$(b).width()-5-parseInt($(b).attr('full'))});};$('#update'+$(a).attr('id')).focus();}},
		cancel:function(p){if(!p){if(!_.edit.curedit)return;p=_.edit.curedit.id};$('#'+p).html(_.edit.profile[p]);$('.editting').removeClass('editting');/*$(p).style.textIndent='5px';*/var em=$('#'+p).parent().find('EM');if(em.length>0)em[0].style.display='inline';$('#edit-tooltip').css({display:'none'});}
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
	cookie:{
		get:function(n){var i,x,y,c=document.cookie.split(";");for(i=0;i<c.length;i++){x=c[i].substr(0,c[i].indexOf("="));y=c[i].substr(c[i].indexOf("=")+1);x=x.replace(/^\s+|\s+$/g,"");if (x==n)return unescape(y);}return false;},
		set:function(n,v,d){var x=new Date();x.setDate(x.getDate()+d);var c_v=escape(v) + ((d==null) ? "" : "; expires="+x.toUTCString())+'; domain=teededball.com; path=/;';document.cookie=n + "=" + c_v;}
	},
	tooltop:function(){if($.fn.tipsy){$(['n','s','w','e','we','ns']).each(function(i,d){$('.show-tooltip-'+d).tipsy({html:true,gravity:(d=='ns'?$.fn.tipsy.autoNS:(d=='we'?$.fn.tipsy.autoWE:(d))),fade:true})});}},
	update:function(){_.box.update(false)},
	api:function(a){
		var dt=(arguments.length>1?arguments[1]:[]);
		$.ajax({url:'http://api.teededball.com'+a,type:'GET',crossDomain:true,data:dt,dataType:'jsonp',jsonpCallback:'_'+new Date().getTime(),success:function(d){
			for(var i=0;i<d.length;i++)
			{
				switch(d[i].method)
				{
					case 'login': window.location.href='http://oauth.teededball.com/login/?redirect_uri='+encodeURIComponent(window.location.href);break;
					case 'team': _.search.parse(d[i].data,d[i].method,d[i].path?d[i].path:d[i].method);break;
				}
			}
		},
		error:function (xhr, ajaxOptions, thrownError){
		 } 
		});
	},
	search:
	{
		data:{},
		parse:function(a,t,p)
		{
			var tmp='';
			if(a&&a.length)
			{
				tmp='<table width="400" class="table table-striped table-condensed" style="margin:0px">';
				for(var i in a)
				{
					_.search.data[p][a[i]._id]=a[i];
					tmp+='<tr><td><a href="'+a[i].link+'" target="_blank">'+a[i].name+'</a></td><td style="text-align:right"><a href="javascript:;" class="btn btn-xs btn-default" onclick="_.search.insert('+a[i]._id+',\''+p+'\')"><i class="glyphicon glyphicon-plus"></i> เพิ่ม</a></td></tr>';	
				}
				tmp+='</table>';
			}
			$('.api-search.'+p).html(tmp);
		},
		insert:function(i,t)
		{
			if(!$('#api-search-'+t+'_'+i).length)
			{
				$('.api-search-have.'+t).append('<div id="api-search-'+t+'_'+i+'"><input type="hidden" name="'+t+'[]" value="'+i+'"><a href="'+_.search.data[t][i].link+'" target="_blank">'+_.search.data[t][i].name+'</a><a href="javascript:;" class="btn btn-xs btn-warning pull-right" onclick="$(this).parent().remove()"><i class="glyphicon glyphicon-trash"></i> ลบ</a></div>');
			}
			$('.api-search-input').val('');
			$('.api-search.'+t).html('');
		},
		load:function()
		{
			$('.api-search-input:not(.ev)').addClass('ev').keypress(function(e)
			{
				var c=e.which;
				var t=$(this).data('type'),l=$(this).data('last'),q=$.trim($(this).val());
				if(t=='tag')
				{
					$('.api-search-input.tag').css('width',((q.length+1)* 8)+10);
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
	navbar:function()
	{
		var h=$('.rc-navbar-top').css('display')!='none'?28:0,w=$(window).width();
         if ($(window).scrollTop() > h || h==0 || w<992)
		 {
             $('.rc-navbar-fixed').addClass('navbar-fixed-top');
			 $('._bg').css('margin-top',75);
         }
         else
		 {
             $('.rc-navbar-fixed').removeClass('navbar-fixed-top');
			 $('._bg').css('margin-top',0);
         }
    }
};

//tooltip
(function($){$.fn.tipsy=function(g){$('.tipsy').remove();g=$.extend({},$.fn.tipsy.defaults,g);return this.each(function(){var f=$.fn.tipsy.elementOptions(this,g);$(this).hover(function(){$.data(this,'cancel.tipsy',true);var a=$.data(this,'active.tipsy');if(!a){a=$('<div class="tipsy"><div class="tipsy-inner"/></div>');a.css({position:'absolute',zIndex:100000});$.data(this,'active.tipsy',a)}if($(this).attr('title')||typeof($(this).attr('original-title'))!='string'){$(this).attr('original-title',$(this).attr('title')||'').removeAttr('title')}var b;if(typeof f.title=='string'){b=$(this).attr(f.title=='title'?'original-title':f.title)}else if(typeof f.title=='function'){b=f.title.call(this)}a.find('.tipsy-inner')[f.html?'html':'text'](b||f.fallback);var c=$.extend({},$(this).offset(),{width:this.offsetWidth,height:this.offsetHeight});a.get(0).className='tipsy';a.remove().css({top:0,left:0,visibility:'hidden',display:'block'}).appendTo(document.body);var d=a[0].offsetWidth,actualHeight=a[0].offsetHeight;var e=(typeof f.gravity=='function')?f.gravity.call(this):f.gravity;switch(e.charAt(0)){case'n':a.css({top:c.top+c.height,left:c.left+c.width/2-d/2}).addClass('tipsy-north');break;case's':a.css({top:c.top-actualHeight,left:c.left+c.width/2-d/2}).addClass('tipsy-south');break;case'e':a.css({top:c.top+c.height/2-actualHeight/2,left:c.left-d}).addClass('tipsy-east');break;case'w':a.css({top:c.top+c.height/2-actualHeight/2,left:c.left+c.width}).addClass('tipsy-west');break}if(f.fade){a.css({opacity:0,display:'block',visibility:'visible'}).animate({opacity:0.8})}else{a.css({visibility:'visible'})}},function(){$.data(this,'cancel.tipsy',false);var b=this;setTimeout(function(){if($.data(this,'cancel.tipsy'))return;var a=$.data(b,'active.tipsy');if(f.fade){a.stop().fadeOut(function(){$(this).remove()})}else{a.remove()}},100)})})};$.fn.tipsy.elementOptions=function(a,b){return $.metadata?$.extend({},b,$(a).metadata()):b};$.fn.tipsy.defaults={fade:false,fallback:'',gravity:'n',html:false,title:'title'};$.fn.tipsy.autoNS=function(){return $(this).offset().top>($(document).scrollTop()+$(window).height()/2)?'s':'n'};$.fn.tipsy.autoWE=function(){return $(this).offset().left>($(document).scrollLeft()+$(window).width()/2)?'e':'w'}})(jQuery);

//easing
jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return jQuery.easing[jQuery.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;if(!g)g=e*.3*1.5;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;if((b/=e/2)<1)return d/2*b*b*(((f*=1.525)+1)*b-f)+c;return d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-jQuery.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){if((b/=e)<1/2.75){return d*7.5625*b*b+c}else if(b<2/2.75){return d*(7.5625*(b-=1.5/2.75)*b+.75)+c}else if(b<2.5/2.75){return d*(7.5625*(b-=2.25/2.75)*b+.9375)+c}else{return d*(7.5625*(b-=2.625/2.75)*b+.984375)+c}},easeInOutBounce:function(a,b,c,d,e){if(b<e/2)return jQuery.easing.easeInBounce(a,b*2,0,d,e)*.5+c;return jQuery.easing.easeOutBounce(a,b*2-e,0,d,e)*.5+d*.5+c}})


window.tinyMCEPreInit = {suffix:'',base:'/_static/js/tiny_mce'};


$(document).click(_.edit.click);
$(document).mouseover(function(e){_.ajax.loading(e);_.edit.mouseover(e);});
$(document).ready(function(){
	if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod')
	{
		$('body').addClass('ios');
	}
	_.tooltop();
	_.search.load();
	//_.search.load();
	_.navbar();
	$(window).bind('scroll', _.navbar);
	$(window).bind('resize', _.navbar);
});

function _newgame(a)
{
	_.box.load('/match/game/'+a+' #newgame');	
}


