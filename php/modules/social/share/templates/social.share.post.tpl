<header class="_hd">
<nav>
	<ul>
    	<li class="logo"><a href="http://boxza.com/" title="BoxZa ข่าว เกมส์ ตรวจหวย ดูดวง เพลง หนัง รูปภาพ ฝากรูป ผลบอล ดูหนังออนไลน์ วิดีโอ เนื้อเพลง ดูดวง เกมส์ กลิตเตอร์ ลงประกาศฟรี  หาเพื่อน ผู้หญิง เลสเบี้ยน เกย์"></a></li>
        <?php if(_::$my):?>
     <li class="notify notify_setting"><a href="/line" rel="setting"><img src="<?php echo _::$my['img']?>" class="img-uid-<?php echo _::$my['_id']?>"> <?php echo _::$my['name']?></a>
     <ul>
     <li><a href="/line">หน้าโปรไฟล์</a></li>
     <li><a href="/<?php echo _::$my['link']?>">หน้าโปรไฟล์ส่วนตัว</a></li>
     <li><a href="http://oauth.boxza.com/logout">ออกจากระบบ</a></li>
     </ul>
     </li>
      <li class="notify_split"></li>
    	<li class="notify notify_friend"><a href="/notifications/friend/" rel="friend"><i></i><p style="display:<?php echo _::$my['nf']['fr']?'block':'none'?>"><?php echo intval(_::$my['nf']['fr'])?></p></a>
      <ul><li style="text-align:center; padding:20px">กรุณารอซักครู่...</li></ul>
      </li>
    	<li class="notify notify_other"><a href="/notifications/other/" rel="other"><i></i><p style="display:<?php echo _::$my['nf']['ot']?'block':'none'?>"><?php echo intval(_::$my['nf']['ot'])?></p></a>
      <ul><li style="text-align:center; padding:20px">กรุณารอซักครู่...</li></ul>
      </li>
        <?php else:?>
        <li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/signup/'))?>">สมัครสมาชิก</a></li>
        <li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)))?>">ล็อคอิน</a></li>
        <?php endif?>
        </li>
    </ul>
</nav>
</header>
<div class="_hd-bt"></div>

<div class="_ct-share" style="text-align:center; padding:10px;">
    <div style="margin:0px auto; width:575px; text-align:left">



<div class="_post">
<div>
<form id="spost" onSubmit="return false">
<input type="hidden" name="share" value="<?php echo $this->url?>">
<div>
<div class="av ps-a" av="<?php echo _::$my['_id']?>"><a href="/<?php echo _::$my['link']?>" class="h" title="<?php echo _::$my['name']?>"><img src="http://s1.boxza.com/profile/<?php echo _::$my['if']['fd']?>/s.jpg"></a></div>
<div class="post-wrap"><textarea name="msg" id="post-msg" tabindex="" onClick="_.post.expand('')">แบ่งปันเรื่องใหม่ๆ</textarea></div>
<div class="post-tags show-tooltip-s" title="Tags (ป้ายกำกับ): คือคำสั้นๆ สองสามคำ ที่เอาไว้อธิบายเนื้อหาของโพสนี้ เช่น ท่องเที่ยว, ภูเขา, น้ำตก, นครนายก">
<div><i></i> 
<?php if($this->tags):?>
<?php for($i=0;$i<count($this->tags);$i++):?>
 <span onclick="$(this).remove()" class="post-tags-span">#<?php echo $this->tags[$i]?><input type="hidden" name="hash" value="<?php echo $this->tags[$i]?>"></span>
<?php endfor?>
<?php endif?>
 <input type="text" name="tagged" id="post-tagged" style="width:200px;">
 </div>
</div>
<p class="clear"></p>
</div>
<div class="post-bar">
<input type="button" id="post-bt" class="button blue" value=" โพสต์ " onClick="_.post.send($('#spost')[0]);" disabled>

<div style="float:left; text-align:left">
<span data-dropdown="#dropdown-to" class="button" style="vertical-align:top">ถึง</span>

<div id="lto">
<span class="lto-0"><p></p><input type="hidden" name="to" value="0"> สาธารณะ <i onClick="_.post.delto(this)"></i></span>
<?php if(_::$my['sc']['fb']):?>
<span class="lto-fb-me lto-fb"><p></p><input type="hidden" name="to" value="fb-me"> ของฉัน  <i onClick="_.post.delto(this)"></i></span>
<?php endif?>
<?php if(_::$my['sc']['tw']):?>
<span class="lto-tw"><p></p><input type="hidden" name="to" value="tw"> ของฉัน  <i onClick="_.post.delto(this)"></i></span>
<?php endif?>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="llink"></div>
</form>
</div>
</div>


<div id="dropdown-to" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
   <li><div class="find-people-panel"><span><input type="text" name="q"  placeholder="ค้นหาเพื่อน" class="find-people tbox" style="width:100%;" data-friend="2" data-func="insert_to_post"></span></div></li>
   <li class="dropdown-divider"></li>
   <li><a href="javascript:;" onClick="_.post.group(this,'0')">สาธารณะ</a></li>
   <li><a href="javascript:;" onClick="_.post.group(this,'-1')">เฉพาะเพื่อน</a></li>
   <li class="dropdown-divider"></li>
   <?php if(_::$my['sc']['tw']):?>
   <li><a href="javascript:;" onClick="_.post.group(this,'tw')"> Twitter ของฉัน</a></li>
   <?php else:?>
   <li><a href="/settings/twitter" class="h">ผูกบัญชีกับ  Twitter</a></li>
   <?php endif?>
   <li class="dropdown-divider"></li>
   <?php if(_::$my['sc']['fb']&&(_::$my['sc']['fb']['v']==2)):?>
   <li><a href="javascript:;" onClick="_.post.group(this,'fb-me')">Facebook - ของฉัน</a></li>
   	<?php if(is_array(_::$my['sc']['fb']['page'])):?>
   		<?php foreach(_::$my['sc']['fb']['page'] as $k=>$v):?>
   <li><a href="javascript:;" onClick="_.post.group(this,'fb-<?php echo $v['id']?>')">Facebook - <?php echo $v['name']?></a></li>
   		<?php endforeach?>
   	<?php endif?>
	<?php else:?>
   <li><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','new')">ผูกบัญชีกับ Facebook</a></li>
   <?php endif?>
    </ul>
</div>
<style>
#llink .del{display:none}
._hd nav { width:600px !important}
</style>
<script>
var _v=<?php echo json_encode(array('url'=>$this->url,'title'=>$this->title))?>;
_.post.expand('');
_.ajax.gourl('/line','getvar','link',_v.url);
$('#post-msg').val(_v.title);
</script>

    </div>
</div>
