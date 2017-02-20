<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/boxza.forum.js"></script>


<?php if(_::$my['am']):?>
<div id="sethome" class="gbox" style="width:400px;">
<form onSubmit="_.ajax.gourl('<?php echo FORUM_URL?>','sethome',this);_.box.close();return false;">
<div class="gbox_header">ปรับแต่งการแสดงผลหน้าแรก</div>
<div class="gbox_content" style="text-align:center">
<div style="margin:5px 0px 5px 100px; text-align:left"><input type="hidden" name="_id" value="<?php echo $this->topic['_id']?>">
<p><label><input type="radio" name="sethome" value="" checked> ไม่แสดงหรือยกเลิกการแสดงผลหน้าแรก</label></p>
<div class="_sethome"></div>
</div>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> 
<input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<?php endif?>

<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="/" title="ผู้หญิง แฟชั่น แต่งตัว"><i class="icon-home"></i> ผู้หญิง</a></li> <span class="divider">&raquo;</span>
<li><a href="<?PHP echo FORUM_URL?>" title="เว็บบอร์ด"><i class="icon-list"></i> เว็บบอร์ด</a></li>
<?php 
$forum = $this->cate[$this->topic['c']];
$nav='';
$f = $this->topic['c'];
while($f && $n=$this->cate[$f]):
	$nav=' <span class="divider">&raquo;</span> <li><a href="'.FORUM_URL.'c-'.$f.'">'.$n['t'].'</a></li> '.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>

<?php if($this->cate[$this->topic['c']]['n']):?>
<li class="pull-right"><a href="<?PHP echo FORUM_URL?>new-topic/<?php echo $this->topic['c']?>"><i class="icon-plus"></i> เพิ่มกระทู้ใหม่</a></li>
<?php endif?>
<?php if(!$this->topic['lo']):?>
<li class="pull-right" style="margin-right:10px;"><a href="<?PHP echo FORUM_URL?>new-reply/<?php echo $this->topic['_id']?>"><i class="icon-edit"></i> ตอบกระทู้นี้</a></li>
<?php endif?>
</ul> 

<?php $cate=getclassbyid($this->cate[$this->topic['c']])?>

<div class="fo-box fo-box-list">
<div class="fo-box-h">
<p class="i"><a href="/forum/c-<?php echo $cate[0]?>" title="<?php echo $this->cate[$cate[0]]['t']?>"><i class="fo-<?php echo $cate[1]?>" title="<?php echo $this->cate[$cate[0]]['t']?>"></i></a></p>
<div><?php echo $this->cate[$cate[0]]['d']?></div>
<ul class="fo-box-b thumbnails row-count-4">
<li class="span3"><span><?php echo intval($this->cate[$cate[0]]['tp'])?></span>หัวข้อ</li>
<li class="span3"><span><?php echo intval($this->cate[$cate[0]]['rp'])?></span>ตอบ</li>
<li class="span3"><span><?php echo intval($this->cate[$cate[0]]['do'])?></span>อ่าน</li>
<li class="span3"><span><?php echo intval($this->cate[$cate[0]]['lk'])?></span><i class="fo-icon-heart"></i></li>
</ul>
<p class="clear"></p>
</div>
</div>


<?php if($this->cate[$cate[0]]['l']):?>
<ul class="fo-box-c">
<?php foreach($this->cate[$cate[0]]['l'] as $o):?>
<li<?php echo $this->topic['c']==$o?' class="active"':''?>>[ <a href="/forum/c-<?php echo $o?>"><?php echo $this->cate[$o]['t']?></a> ]</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
<?php endif?>


<div>
<div class="fo-view-title">
<div class="a">
<a href="http://boxza.com/<?php echo $this->u['link']?>"><img src="<?php echo $this->u['img']?>"></a>
</div>
<div class="b">
<h2><?php echo $this->topic['t']?></h2>
<p>เขียนเมื่อ <i class="forum-calendar-icon"></i> <?php echo str_replace('-','<i class="forum-time-icon"></i>',time::show($this->topic['da'],'datetime',true))?></p>
<span>โดย <a href="http://boxza.com/<?php echo $this->u['link']?>"><?php echo $this->u['name']?></a></span>
</div>
<div class="c">
<?php if(_::$my['am']):?>
[<a href="javascript:;" onClick="_.ajax.gourl('<?php echo FORUM_URL?>','gethome',<?php echo $this->topic['_id']?>)" style="margin:0px;">แสดงผลหน้าแรก</a>]
<?php endif?>
<?php if(!$this->topic['lo']):?>
    <a href="<?PHP echo FORUM_URL?>new-reply/<?php echo $this->topic['_id']?>/quote" class="forum-nav-link" title="อ้างอิง"><i class="forum-quote-icon"></i></a>
    <?php endif?>
    <?php if(_::$my['_id'] && ((_::$my['_id']==$this->topic['u'] && !$this->topic['lo'])||_::$my['am'])):?>
    <a href="<?PHP echo FORUM_URL?>edit-topic/<?php echo $this->topic['_id']?>" class="forum-nav-link" title="แก้ไข"><i class="forum-edit-icon"></i></a>
    <a href="javascript:;" onClick="deltopic();" class="forum-nav-link" title="ลบ"><i class="forum-delete-icon"></i></a>
    <?php endif?>
</div>
<p class="clear"></p>
</div>
    
<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<div class="fo-view-detail">   
<?php if($this->topic['c']>=321&&$this->topic['c']<=329):?>
 <div class="fo-view-item">
 <div class="a"><img src="http://s3.boxza.com/forum/<?php echo $this->topic['fd']?>/t.jpg" alt="<?php echo $this->topic['t']?>"></div>
 <div class="b">
 <p><strong><?php echo $this->topic['f']['brand']?></strong></p>
 <p><?php echo $this->topic['t']?></p><br>
  <p>ประเภท <?php echo $this->topic['f']['type']?></p>
<?php if($this->topic['f']['price']):?> <p>ราคา <?php echo $this->topic['f']['price']?> บาท</p><?php endif?>
<?php if($this->topic['f']['property']):?> <p><?php echo $this->topic['f']['property']?></p><?php endif?>
 </div>
 <p class="clear"></p>
 </div>
 <?php endif?>
 
	<?php if(count($this->topic['o']) && is_array($this->topic['o'])):?>
   <div style="margin:5px; padding:5px; text-align:center;">
   <?php foreach($this->topic['o'] as $v):?>
   <?php if($v):?>
   <p style="padding:3px; line-height:0px;"><img src="http://s3.boxza.com/forum/<?php echo $this->topic['fd']?>/<?php echo $v?>" alt="<?php echo $this->topic['t']?>"></p>
   <?php endif?>
   <?php endforeach?>
   </div>
   <?php endif?>
   
	
	<?php echo $this->topic['d']?>
   </div>
    <?php if($this->topic['e']):?>
    <?php $e=count($this->topic['e'])-1;
	 $eu=$this->user->profile($this->topic['e'][$e]['u']);
	 ?>
    <div class="fo-view-cedit">แก้ไขล่าสุดโดย <a href="http://boxza.com/<?php echo $eu['link']?>"><?php echo $eu['name']?></a> เมื่อ <?php echo time::show($this->topic['e'][$e]['t'],'datetime',true)?></div>
	 <?php endif?>
 
<?php if(_::$meta['google']):?>
<div style="border:1px solid #ccc; padding:5px; margin:5px;">
<p>โดย <a href="https://plus.google.com/<?php echo _::$meta['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo _::$meta['google']['name']?></a> (Google+)</p>
</div>
<?php endif?>

<?php if($this->topic['tags']):?>
<ul class="tags-relate">
<li class="tags-label">ป้ายกำกับ:</li>
<?php foreach($this->topic['tags'] as $v):?>
<li>#<a href="http://boxza.com/tag/<?php echo urlencode($v)?>" target="_blank"><?php echo $v?></a></li>
<?php endforeach?>
</ul>
<?php endif?>
 
 <?php if($this->relate):?>
<div class="fo-view-relate">
<h4>กระทู้อื่นๆที่เกี่ยวข้อง</h4>
<ul>
<?php for($i=0;$i<count($this->relate);$i++):?>
<li><a href="<?php echo FORUM_URL.'topic/'.$this->relate[$i]['_id']?>"><?php echo $this->relate[$i]['t']?></a></li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>
<?php endif?> 

 <div class="fo-view-love">
 <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','loveit')"><i class="fo-icon-heart"></i> LOVE IT</a> <span class="badge love-<?php echo $this->topic['_id']?>"><?php echo intval($this->topic['lk']['c'])?></span>
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/forum/'.$this->topic['fd'].'/t-1.jpg')?>&description=<?php echo urlencode($this->topic['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>
<p class="clear"></p>
 </div>  
 
<div class="fo-view-comment">
<?php if(count($this->topic['cm']['d'])):?>
<?php for($i=0;$i<count($this->topic['cm']['d']);$i++):
	$u=$this->user->profile($this->topic['cm']['d'][$i]['u']);
?>
<div class="l">
	<div class="a"><?php if($u):?><a href="http://boxza.com/<?php echo $u['link']?>"><img src="<?php echo $u['img']?>"></a><?php endif?></div>
   <div class="b">
   <div>ความคิดเห็นที่ <?php echo $this->topic['cm']['d'][$i]['i']?>, โดย <a href="http://boxza.com/<?php echo $u['link']?>"><?php echo $u['name']?></a>, เขียนเมื่อ <i class="forum-calendar-icon"></i> <?php echo str_replace('-','<i class="forum-time-icon"></i>',time::show($this->topic['cm']['d'][$i]['t'],'datetime',true))?>
   
   <p class="r">
    <?php if(!$this->topic['lo']):?>
    <a href="<?PHP echo FORUM_URL?>new-reply/<?php echo $this->topic['_id']?>/quote/<?php echo $this->topic['cm']['d'][$i]['i']?>" class="forum-nav-link" title="อ้างอิง"><i class="forum-quote-icon"></i></a>
    <?php endif?>
    <?php if(_::$my['_id']&&((_::$my['_id']==$this->topic['cm']['d'][$i]['u'] && !$this->topic['lo'])||_::$my['am'])):?>
    <a href="<?PHP echo FORUM_URL?>edit-reply/<?php echo $this->topic['_id']?>/<?php echo $this->topic['cm']['d'][$i]['i']?>" class="forum-nav-link" title="แก้ไข"><i class="forum-edit-icon"></i></a>
    <a href="javascript:;" onClick="delreply(<?php echo $this->topic['cm']['d'][$i]['i']?>)" class="forum-nav-link" title="ลบ"><i class="forum-delete-icon"></i></a>
    <?php endif?>
    </p>
    <p class="clear"></p>
</div>
<div class="d"><?php echo $this->topic['cm']['d'][$i]['m']?></div>
    <?php if($this->topic['cm']['d'][$i]['e']):?>
    <?php $e=count($this->topic['cm']['d'][$i]['e'])-1;
	 $eu=$this->user->profile($this->topic['cm']['d'][$i]['e'][$e]['u']);
	 ?>
    <div class="fo-view-cedit">แก้ไขโดย <a href="http://boxza.com/<?php echo $eu['link']?>"><?php echo $eu['name']?></a> เมื่อ <?php echo time::show($this->topic['cm']['d'][$i]['e'][$e]['t'],'datetime',true)?></div>
	 <?php endif?>
</div>
<p class="clear"></p>
</div>
<?php endfor?>
<?php endif?>
</div>


<?php echo $this->pager?>
<style>
.acm{padding:5px; margin:5px 0px 5px; border:1px solid #f0f0f0; background:#fcfcfc; color:#555}
.acm h4{background:#f9f9f9; padding:5px; text-align:center; color:#555; margin-bottom:5px;}
</style>
<?php if(!$this->topic['lo']):?>
<div class="acm">
<form onSubmit="tinyMCE.triggerSave();_.ajax.gourl('<?php echo URL?>','newreply',this);return false">
<h4>ตอบกระทู้ด่วน</h4>
<?php if(_::$my):?>
<div>
<div>
<textarea name="detail" style="width:100%; height:130px;" placeholder="กรอกข้อความของคุณที่นี่" class="mceEditor"></textarea>
</div>
<div style="text-align:center">
<h4 style=" background:#F0F0F0; color:#FF9900; text-align:center">Onion</h4>
      <div style="padding:5px; text-align:center;" class="emo-onion">
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/1.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/4.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/9.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/10.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/13.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/14.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/16.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/27.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/53.gif" /></a>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/onion/57.gif" /></a>
      [<a href="javascript:void(0);" onClick="window.open('<?php echo FORUM_URL?>emoticon', '_onion', 'resizable=yes,width=620,height=450');return false;">ดูเพิ่มเติม</a>]
      </div>
      
</div>
<p class="clear"></p>
</div>
<div style="text-align:center; padding:10px 0px 0px">
<input type="submit" class="btn btn-primary" value=" บันทึก "> <input type="reset" class="btn" value=" ยกเลิก "> 
หรือ ตอบกระทู้แบบเต็มรูปแบบ <a href="<?PHP echo FORUM_URL?>new-reply/<?php echo $this->topic['_id']?>">คลิกที่นี่</a>
<div style="padding:10px; text-align:left; margin:5px 0px; color:#c00; border:1px solid #f00">
           <strong>กฏการใช้งานเว็บบอร์ด</strong><br>
           1. ห้ามโพสข้อมูลในเชิงสแปม หรือเพื่อการทำ SEO โดยเด็ดขาด<br>
           2. ห้ามโพสเกี่ยวกับงาน Part-time หรือธุระกิจขายตรงทุกชนิด ทุกค่าย<br>
3. ห้ามโปรโมทเว็บภายนอกที่มีเนื้อหาหรือบริการที่ใกล้เคียงกับเว็บ boxza.com<br>
หากฝ่าฝืน เจ้าหน้าที่จะทำการแบนไอดีสมาชิกท่านทันที โดยไม่ต้องแจ้งให้ทราบล่วงหน้า<br>
           </div>
</div>
<?php else:?>
<div style="padding:20px; line-height:2.2em; text-align:center;">
กรุณาล็อคอินก่อนทำการตอบกระทู้นี้<br>
<a href="http://oauth.boxza.com/signup/?redirect_uri=<?php echo urlencode(URI)?>" rel="nofollow">สมัครสมาชิก</a> หรือ <a href="http://oauth.boxza.com/login/?redirect_uri=<?php echo urlencode(URI)?>" rel="nofollow">ล็อคอิน</a>
 </div>
<?php endif?>
</form>

<div>
<h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f0f0f0;">แสดงความคิดเห็นด้วย Facebook</h4>
<div class="fb-comments" data-href="http://beauty.boxza.com/forum/topic/<?php echo $this->topic['_id']?>" data-num-posts="30" data-width="703"></div>
</div>

</div>
<?php endif?>

</div>
<script type="text/javascript">
function addemo(a)
{
	var t=document.getElementsByTagName('TEXTAREA');
	for(var i=0;i<t.length;i++)
	{
		t[i].value=t[i].value+'[onion='+a+']';
	}
}
function deltopic()
{
	_.box.confirm({title:'ลบกระทู้นี้',detail:'คุณต้องการลบกระทู้นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','deltopic')}});
}
function delreply(i)
{
	_.box.confirm({title:'ลบข้อความ',detail:'คุณต้องการลบข้อความนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delreply',i)}});
}
</script>