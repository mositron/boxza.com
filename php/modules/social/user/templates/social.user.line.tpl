


<?php if($this->open['ln']):?>
<?php if(_::$my['st']||_::$my['_id']==_::$profile['_id']):?>
<div class="_post">
<div>
<form id="spost" onSubmit="return false">
<input type="hidden" name="profile" value="<?php echo _::$profile['_id']?>">
<div>
<div class="av ps-a" av="<?php echo _::$my['_id']?>"><a href="/<?php echo _::$my['link']?>" class="h" title="<?php echo _::$my['name']?>"><img src="<?php echo _::$my['img']?>" class="img-uid-<?php echo _::$my['_id']?>"></a></div>
<div class="post-wrap"><span class="emo emo-1" data-dropdown="#dropdown-chat-emo"></span><textarea name="msg" id="post-msg" tabindex="" onClick="_.post.expand('')">แบ่งปันเรื่องราวกับ  <?php echo _::$profile['name']?></textarea></div>
<a href="javascript:;" onClick="_.post.expand('pin')" class="ln-icon-exp ln-icon-nav ln-icon-pin show-tooltip-s" title="เพิ่มตำแหน่ง"></a>
<a href="javascript:;" onClick="_.post.expand('link')" class="ln-icon-exp ln-icon-nav ln-icon-link show-tooltip-s" title="เพิ่มลิ้งค์หรือวิดีโอ"></a>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<a href="javascript:;" onClick="_.post.expand('photo')" class="ln-icon-exp ln-icon-nav ln-icon-photo show-tooltip-s" title="เพิ่มรูปภาพ"></a>
<?php endif?>
<p class="clear"></p>
</div>
<div class="post-bar">
<input type="button" class="button blue" id="post-bt" value=" โพสต์ " onClick="_.post.send($('#spost')[0]);">

<a href="javascript:;" onClick="_.post.expand('pin')" class="ln-icon-nav ln-icon-pin show-tooltip-s" title="เพิ่มตำแหน่ง"></a>
<a href="javascript:;" onClick="_.post.expand('link')" class="ln-icon-nav ln-icon-link show-tooltip-s" title="เพิ่มลิ้งค์หรือวิดีโอ"></a>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<a href="javascript:;" onClick="_.post.expand('photo')" class="ln-icon-nav ln-icon-photo show-tooltip-s" title="เพิ่มรูปภาพ"></a>
<?php endif?>
<div style="float:left">
<span data-dropdown="#dropdown-to" class="button" style="vertical-align:top">ถึง</span>
<div id="lto">
<span class="lto-0"><p></p><input type="hidden" name="to" value="0"> สาธารณะ <i onClick="_.post.delto(this)"></i></span>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="lalink"><div><input type="text" class="tbox" id="addlink" style="width:490px"><input type="button" value=" เพิ่ม " class="button" onClick="_.ajax.gourl('/line','getvar','link',$('#addlink').val())"></div></div>
<div id="llink"></div>
<div id="lloc"></div>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<div id="lphoto"></div>
<?php endif?>
</form>
</div>
</div>

<div id="dropdown-to" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
   <li><div class="find-people-panel"><span><input type="text" name="q"  placeholder="ค้นหาเพื่อน" class="find-people tbox" style="width:100%;" data-friend="2" data-func="insert_to_post"></span></div></li>
   <li class="dropdown-divider"></li>
  <li><a href="javascript:;" onClick="_.post.group(this,'0')">สาธารณะ</a></li>
   <li><a href="javascript:;" onClick="_.post.group(this,'-1')">เฉพาะเพื่อน</a></li>
    </ul>
</div>
<?php else:?>
<div class="_post" style="padding:10px; text-align:center">ไม่สามารถโพสบนไลน์ของ <?php echo _::$profile['name']?> ได้ เนื่องจากคุณยังไม่ยืนยันการสมัครสมาชิก</div>
<?php endif?>
<?php endif?>


<div class="line" id="_line" data-profile="<?php echo _::$profile['_id']?>">
<?php echo $this->line?>
</div>
<script>
function insert_to_post(uid){tinyMCE.execCommand('mceInsertContent', false, ' @'+uid);}
</script>