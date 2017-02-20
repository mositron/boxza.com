<div style="background: #F6F6F6;margin: 5px 5px 10px 5px;">

<h3 style="float: left;padding: 5px 10px 0px;color: #999;font-size: 13px;height: 22px;line-height: 22px;font-weight: normal;">
<a href="/<?php echo $this->album['u']['link']?>" class="h"><?php echo $this->album['u']['name']?></a>  &raquo;  
<a href="/<?php echo $this->album['u']['link']?>/photos" class="h">อัลบั้มทั้งหมด</a> &raquo;  
<a href="/photos/album-<?php echo $this->album['_id']?>" class="h"><?php echo $this->album['tt']?></a></h3>
<?php if($this->album['u']['_id']==_::$my['_id'] && !$this->album['lo']):?>
<input type="button" class="button" value=" ลบอัลบั้ม " style="float:right; margin:2px; padding:0px 10px; height:25px; line-height:25px;" onClick="_.box.confirm({title:'ลบอัลบั้ม',detail:'คุณต้องการลบอัลบั้มและรูปภาพทั้งหมดภายในอัลบั้มนี้หรือไม่',click:function(){_.ajax.gourl('/line','delline',<?php echo $this->album['_id']?>);}});">
<input type="button" class="button" value=" แก้ไขอัลบั้ม " style="float:right; margin:2px; padding:0px 10px; height:25px; line-height:25px;" onClick="_.box.load('/dialog/album/<?php echo $this->album['_id']?> #album_line');">
<span style="float:right; margin:2px 0px 0px 0px"><span id="file_select_top"></span></span>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<script>_.profile.pt.swf('<?php echo htmlspecialchars($this->album['tt'], ENT_QUOTES,'utf-8');?>','<?php echo _::upload()->getkey('line/photos',$this->album['_id'])?>');</script>
<?php endif?>
<?php endif?>
<p class="clear"></p>
</div>

<?php if(!empty($this->getphotos)):?>
<ul class="photos" id="getphotos"><?php echo $this->getphotos?></ul>
<?php else:?>
<?php #elseif($this->album['u']['_id']==_::$my['_id'] && !$this->album['lo']):?>

<div style="padding:50px; text-align:center; box-shadow:5px 5px 0px #f0f0f0;margin:10px 20px 10px 10px;border:1px solid #f0f0f0">ยังไม่มีรูปภาพภายในอัลบั้มนี้</div>

<?php endif?>




<div style="margin-top:<?php echo empty($this->getphotos)?0:-30;?>px">
<div>


<div ln="<?php echo $this->album['_id']?>" uid="<?php echo $this->album['u']['_id']?>" class="ln ln-<?php echo $this->album['_id']?>">
<div class="av" av="<?php echo $this->album['u']['_id']?>"><a href="/<?php echo $this->album['u']['link']?>" class="h" title="<?php echo $this->album['u']['name']?>"><img src="<?php echo $this->album['u']['img']?>" class="img-uid-<?php echo $this->album['u']['_id']?>"></a></div>


<div class="ct-s">
<?php if(in_array('0',(array)$this->album['in'])):?>
<span class="inter">สาธารณะ</span>, 
<?php elseif(in_array('-1',(array)$this->album['in'])):?>
<span class="inter">เฉพาะเพื่อน</span>, 
<?php else:?>
<span class="inter">ส่วนตัว</span>, 
<?php endif?>
<a href="<?php echo $this->album['is_profile']?'/'.$this->album['is_profile']:''?>/line/<?php echo $this->album['_id']?>" class="h"><span class="ago" datetime="<?php echo $this->album['ds']?>"></span></a>
<a href="/<?php echo $this->album['u']['link']?>" class="sm-a h"><?php echo $this->album['u']['name']?></a>
</div>
<div class="ct">
<div class="dt">
<?php echo $this->album['ms']?>
</div>



<div class="bk">
<span class="lk lk-<?php echo $this->album['_id']?> <?php echo in_array(_::$my['_id'],(array)$this->album['lk']['u'])?'like':''?>">
<span onClick="_.api('/me/like/<?php echo $this->album['_id']?>')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span>
<span onClick="_.api('/me/like/<?php echo $this->album['_id']?>/unlike')" class="unlike ptr"><i class="show-tooltip-s ptr" title="เฉยๆ"></i></span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-<?php echo $this->album['_id']?> ptr2" onClick="_.api('/me/like/<?php echo $this->album['_id']?>/list')"><?php echo intval($this->album['lk']['c'])?></span></span>
</span>
<span onClick="_.api('/me/share/<?php echo ($this->album['ty']=='share'&&$this->album['sh']['f']&&$this->album['sh']['d'])?$this->album['sh']['f']:$this->album['_id']?>')" class="ptr2"> แบ่งปัน</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sh-c-<?php echo $this->album['_id']?>"><?php echo intval($this->album['sh']['c'])?></span></span>
<span onClick="_.profile.cm.pop(<?php echo $this->album['_id']?>)" class="ptr2"> แสดงความเห็น</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b cm-c-<?php echo $this->album['_id']?>"><?php echo intval($this->album['cm']['c'])?></span></span>
<?php if($this->album['sp']):?>
<span> สแปม</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sp-c-<?php echo $this->album['_id']?>"><?php echo intval($this->album['sp'])?></span></span>
<?php endif?>
</div>

<div class="cm-g">

<div class="cm-d-<?php echo $this->album['_id']?>">
<?php if($this->album['cm']['c'] >3):?>
<div class="cm-c cm-l-<?php echo $this->album['_id']?>"><a href="javascript:;" onClick="_.api('/me/comment/<?php echo $this->album['_id']?>/list/clear')" class="txt">ดูทุกความคิดเห็น (<span class="cm-c-<?php echo $this->album['_id']?>"><?php echo $this->album['cm']['c']?></span>)</a></div>
<?php endif?>


<?php 
if(is_array($this->album['cm']['d'])):
foreach($this->album['cm']['d'] as $c):
?>
<div class="cm-s cm-s-<?php echo $c['i']?>">
<div class="av" av="<?php echo $c['u']['_id']?>"><a href="/<?php echo $c['u']['link']?>" class="h" title="<?php echo $c['u']['name']?>"><img src="<?php echo $c['u']['img']?>" class="img-uid-<?php echo $c['u']['_id']?>"></a></div>
<div class="cm-d">
<div class="cm-r"><span class="ago" datetime="<?php echo $c['t']?>"></span> <span class="cm-u"><a href="/<?php echo $c['u']['link']?>" class="h"><?php echo $c['u']['name']?></a></span></div>
<div class="cm-dt"><?php echo $c['m']?></div>
</div>
<p class="clear"></p>
</div>
<?php 
endforeach;
endif;
?>

</div>
<div class="cm-p cm-p-<?php echo $this->album['_id']?>" id="_cm-p-<?php echo $this->album['_id']?>"></div>
</div>

</div>
<ul class="ac"><li><i onClick="_.line.act(<?php echo $this->album['_id']?>)"></i><ul></ul></li></ul>
<p class="clear"></p>
</div>

<script>_.profile.cm.pop(<?php echo $this->album['_id']?>);</script>

<br><br><br>
<br><br><br>
</div>
</div>

<style>
#getphoto .n{width: 283px;float: left;border-radius: 5px;margin: 2px;border: 1px solid #e5e5e5;}
#getphoto .n .av{margin:5px}
#getphoto .n strong{display:block; background:#f8f8f8; padding:5px; color:#0399BE}
#getphoto .n strong a{color:#0399BE}
#getphoto .next{clear:both; width:100%; clear:both; padding:5px 0px; text-align:center;}
#getphoto .next a{display:block; height:30px; line-height:30px; text-align:30px; margin:0px auto; width:570px; border:1px solid #f0f0f0; background-color:#f8f8f8; text-align:center;}

.ln .ct {width: 770px;}
</style>