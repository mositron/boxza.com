


<div class="left pf-l">
<h3><a href="/messages" class="h">ข้อความ</a> - <a href="/<?php echo $this->p['link']?>" class="h"><?php echo $this->p['name']?></a></h3>
<div class="messages ch-ms-<?php echo $this->p['_id']?>">
<?php echo $this->ms?>
</div>
<?php if($this->chat):?>
<div class="send">
<img src="<?php echo _::$my['img']?>">
<input type="text" class="tbox chat_send">
<p class="clear"></p>
</div>
<?php else:?>
<div style="padding:30px 0px; margin:10px; text-align:center; border:1px solid #f0f0f0; box-shadow:3px 3px 0px #f8f8f8"><?php echo $this->p['name']?> ได้ทำการปิดการส่งข้อความจากคุณ</div>
<?php endif?>
<br><br><br>
<br><br><br>
</div>
<script>
<?php if($this->chat):?>
$('.chat_send').keypress(function(e) {
var c=(e.keyCode?e.keyCode:e.which);
var ms=$.trim($(this).val());
if(c==13&&ms!=''){$(this).val('');_.chat.api('send',{'last':_.chat.lastid,'uid':<?php echo $this->p['_id']?>,'ms':ms});}
});
<?php endif?>
$('.messages .ch-id:not(.ev)').addClass('ev').each(function(){$(this).html(_.itag($(this).html()));}).hover(function(){$(this).addClass('hover')},function(){$(this).removeClass('hover')});
</script>
<div class="right pf-r">


<span class="ads-top"></span>
<div class="ads-box"><?php echo $this->service?></div>



</div>
<div class="clear"></div>


<style>
.messages > div{padding: 2px 0px;border-bottom: 1px solid #f5f5f5;}
.messages .ch-time{padding: 1px 5px !important; font-size:11px;background:#F8F8F8;display: block;font-weight: bold;}
.messages .ch-id {width: 530px;text-align: left;}
.messages .av{width:44px;}
.messages .av a{width:44px; height:44px; /*border-radius:22px;*/}
.messages .av a img{width:40px; margin:2px; /*border-radius:20px;*/}
.send{padding:5px 0px 5px 5px; border:1px solid #f5f5f5; border-radius:5px; background-color:#fcfcfc; margin:5px 0px;}
.chat_send{ width:535px; margin:0px 0px 0px 5px;}
.send img{float:left; width:26px; height:26px; /*border-radius:13px;*/}
</style>