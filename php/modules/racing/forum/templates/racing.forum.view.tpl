<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/boxza.forum.js"></script>

 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
 <!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->
 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->



<style>
.sdc_rpgbar{margin:3px 0px;padding:3px;border:1px solid #CCCCCC; background:#FFF;}
.sdc_rpgbar table{width: auto !important;table-layout: auto !important; padding:0px; margin:0px;}
.sdc_rpgbar table tr td{margin:0px; padding:0px}
</style>
<ul class="breadcrumb" style="margin:5px 0px;">
<li><a href="/" title="รถแต่ง"><i class="icon-white icon-home"></i> รถแต่ง</a></li> <span class="divider">&raquo;</span>
<li><a href="/forum" title="เว็บบอร์ดรถแต่ง"><i class="icon-white icon-list"></i> เว็บบอร์ด</a></li>
<?php 
$forum = $this->cate[$this->topic['c']];
$nav='';
$f = $this->topic['c'];
while($f && $n=$this->cate[$f]):
	$nav=' <span class="divider">&raquo;</span> <li><a href="/forum/'.($n['sl']?$n['sl']:'c-'.$f).'">'.$n['t'].'</a></li>'.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="/forum/setting"><i class="icon-white icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
<?php if($this->cate[$this->topic['c']]['n']==1 || ($this->cate[$this->topic['c']]['n']==2 && _::$my['am'])):?>
<li class="pull-right"><a href="/forum/new-topic/<?php echo $this->topic['c']?>"><i class="icon-white icon-plus"></i> เพิ่มกระทู้ใหม่</a></li>
<?php endif?>
<?php if(!$this->topic['lo']):?>
<li class="pull-right" style="margin-right:10px;"><a href="/forum/new-reply/<?php echo $this->topic['_id']?>"><i class="icon-white icon-edit"></i> ตอบกระทู้นี้</a></li>
<?php endif?>
</ul>

<div style="background:#fff;">
<table cellpadding="0" cellspacing="3" border="0" width="100%">
<tbody>
<tr><td width="300" valign="bottom">
<?php if($this->cate[$this->topic['c']]['n']==1 || ($this->cate[$this->topic['c']]['n']==2 && _::$my['am'])):?> <a href="/forum/new-topic/<?php echo $this->topic['c']?>"><i class="forum-new-topic-icon"></i></a> <?php endif?>
<?php if(!$this->topic['lo']):?> <a href="/forum/new-reply/<?php echo $this->topic['_id']?>"><i class="forum-new-reply-icon"></i></a> <?php endif?>
</td>
<td align="right" valign="middle"><?php echo $this->pager?></td>
</tr>
</tbody>
</table>
<h3 class="forum-tt"><i></i> <!--img src="http://s0.boxza.com/static/images/forum/posticon/<?php echo $this->topic['ic']?>.gif" /--> <a href="/forum/topic/<?php echo $this->topic['_id']?>"><?php echo $this->topic['t']?></a></h3>
<table cellpadding="0" cellspacing="1" border="0" width="100%" class="forum_view">
<thead>
<tr><th class="col1" align="center">ผู้เขียน</th><th class="col2">ข้อความ</th></tr>
</thead>
<tbody>
<?php if($this->page==1):?>
<tr>
	<td class="col1">
    <?php if($this->u):?>
    <?php
	 					$tk=intval($this->u['fr']['tk']);
						$cd=intval($this->u['cd']['p']);
						$rp=intval($this->u['fr']['rp']);
						$tp=intval($this->u['fr']['tp']);
	 ?>
    <h3><a href="http://boxza.com/<?php echo $this->u['link']?>" class="forum_level_<?php echo $rank?>"><?php echo $this->u['name']?></a></h3>
    <a href="http://boxza.com/<?php echo $this->u['link']?>"><img src="<?php echo $this->u['nimg']?>"></a>
    <div style="text-align:center"><img src="http://s0.boxza.com/static/images/forum/class/<?php echo $this->u['class']?>.png" alt="<?php echo $this->u['class']?>"></div>
    <div class="profile">
    เขียนกระทู้: <?php echo number_format($tp)?><br />
    ตอบกระทู้: <?php echo number_format($rp)?><br />
   	บ๊อก: <?php echo number_format($cd)?>
    </div>
    <div class="profile">
    พลังน้ำใจ: <span style="color:#F00; font-size:24px;" class="thank-<?php echo $this->u['_id']?>"><?php echo $tk?></span>
    <?php if($this->u['st']<1):?>
    <div style="text-align:center; margin:3px 0px 0px; background:#f0f0f0; padding:3px;"><em>ยังไม่ยืนยันการสมัครสมาชิก</em></div>
    <?php else:?>
    (<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','thank',<?php echo $this->u['_id']?>)">ขอบคุณ</a>)
    <?php endif?>
    </div>

    <?php else:?>
    	ไม่มีสมาชิกดังกล่าว
    <?php endif?>
    </td>
	<td class="col2">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="vtime">
    <tr><td><a href="/forum/topic/<?php echo $this->topic['_id']?>" rel="nofollow" class="forum-nav-link">เขียนเมื่อ <i class="forum-calendar-icon"></i> <?php echo str_replace('-','<i class="forum-time-icon"></i>',time::show($this->topic['da'],'datetime',true))?></a><?php if(_::$my['am']):?> - IP: <?php echo $this->topic['ip']?> <?php endif?>
     - อ่าน: <?php echo number_format(intval($this->topic['do']))?> - ตอบ: <?php echo number_format(intval($this->topic['cm']['c']))?>
    </td>
    <td align="right">
    <?php if(!$this->topic['lo']):?>
    <a href="/forum/new-reply/<?php echo $this->topic['_id']?>/quote" class="forum-nav-link" title="อ้างอิง"><i class="forum-quote-icon"></i></a>
    <?php endif?>
    <?php if(_::$my['_id'] && ((_::$my['_id']==$this->topic['u'] && !$this->topic['lo'])||_::$my['am'])):?>
    <a href="/forum/edit-topic/<?php echo $this->topic['_id']?>" class="forum-nav-link" title="แก้ไข"><i class="forum-edit-icon"></i></a>
    <a href="javascript:;" onClick="deltopic();" class="forum-nav-link" title="ลบ"><i class="forum-delete-icon"></i></a>
    <?php endif?>
    </td></tr></table>
   <?php if(count($this->topic['o']) && is_array($this->topic['o']) && $this->cate[$this->topic['c']]['t']):?>
   <div style="margin:5px; padding:5px; text-align:center">
   <?php foreach($this->topic['o'] as $v):?>
   <?php if($v):?>
   <p style="padding:3px; line-height:0px;">
   <img src="http://s3.boxza.com/forum/<?php echo $this->topic['fd']?>/<?php echo $v?>">
   </p>
   <?php endif?>
   <?php endforeach?>
   </div>
   <?php endif?>


	<div class="detail"><?php echo $this->topic['d']?></div>
   <?php if(count($this->topic['o']) && is_array($this->topic['o']) && !$this->cate[$this->topic['c']]['t']):?>
   <div style="margin:5px; padding:5px;">
   <h4 style="background:#f0f0f0; text-shadow:1px 1px 0px #fff; padding:5px 5px 5px 10px; text-align:left; color:#000;">ไฟล์แนบรูปภาพ</h4>
   <?php foreach($this->topic['o'] as $v):?>
   <?php if($v):?>
   <p style="padding:3px; line-height:0px;">
   <img src="http://s3.boxza.com/forum/<?php echo $this->topic['fd']?>/<?php echo $v?>">
   </p>
   <?php endif?>
   <?php endforeach?>
   </div>
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



    <?php if($this->topic['e']):?>
    <?php $e=count($this->topic['e'])-1;
	 $eu=$this->user->profile($this->topic['e'][$e]['u']);
	 ?>
    <div class="cedit">แก้ไขล่าสุดโดย <a href="http://boxza.com/<?php echo $eu['link']?>"><?php echo $eu['name']?></a> เมื่อ <?php echo time::show($this->topic['e'][$e]['t'],'datetime',true)?></div>
	 <?php endif?>
    
<?php if($this->relate):?>
<?php if(in_array($this->topic['c'],array(38,412,413,414,415,416,417,418))):?>
<?php define('TH_PAGE','forum_picpost')?>
<div class="fo-view-relate">
<h4>รูปภาพอื่นๆที่เกี่ยวข้อง</h4>
</div>
<ul class="forum-list-picpost-relate">
<?php for($i=0;$i<count($this->relate);$i++):?>
<li>
<div class="l"><a href="/forum/topic/<?php echo $this->relate[$i]['_id']?>"><?php if($this->relate[$i]['s']):?><img src="http://s3.boxza.com/forum/<?php echo $this->relate[$i]['fd']?>/t.jpg" alt="<?php echo $this->relate[$i]['t']?>"><?php endif?></a></div>
<div class="r">
<p><a href="/forum/topic/<?php echo $this->relate[$i]['_id']?>"><?php echo $this->relate[$i]['t']?></a></p>
</div>
<p class="clear"></p>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
<?php else:?>
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
<?php endif?>  
 <div class="fo-view-love">
	 <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','loveit')"><i class="fo-icon-heart"></i> LOVE IT</a> <span class="badge love-<?php echo $this->topic['_id']?>"><?php echo intval($this->topic['lk']['c'])?></span>
      <div class="socialshare">
      <div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
      <div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
      <!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
      <p></p>
   </div>
   <p class="clear"></p>
 </div>
 
  <div class="forum-banner-service">
 <a href="http://album.boxza.com/" target="_blank" title="รูปภาพ แบ่งปันรูปภาพ"><img src="http://s0.boxza.com/static/images/banner/service/album-banner.gif" alt="รูปภาพ แบ่งปันรูปภาพ"></a>
 <a href="http://beauty.boxza.com/" target="_blank" title="ผู้หญิง เสริมสวย แต่งหน้า แฟชั่น ความงาม สุขภาพ"><img src="http://s0.boxza.com/static/images/banner/service/beauty-banner.gif" alt="ผู้หญิง เสริมสวย แต่งหน้า แฟชั่น ความงาม สุขภาพ"></a>
 <a href="http://chat.boxza.com/" target="_blank" title="แชท หาเพื่อนคุย"><img src="http://s0.boxza.com/static/images/banner/service/chat-banner.gif" alt="แชท หาเพื่อนคุย"></a>
 <a href="http://football.boxza.com/" target="_blank" title="ผลบอล วิเคราะห์ ทายผล ตารางคะแนน"><img src="http://s0.boxza.com/static/images/banner/service/football-banner.gif" alt="ผลบอล วิเคราะห์ ทายผล ตารางคะแนน"></a>
 <a href="http://forum.boxza.com/" target="_blank" title="เว็บบอร์ด กระดานสนทนา ฟอรั่ม"><img src="http://s0.boxza.com/static/images/banner/service/forum-banner.gif" alt="เว็บบอร์ด กระดานสนทนา ฟอรั่ม"></a>
 <a href="http://friend.boxza.com/" target="_blank" title="หาเพื่อน หาแฟน หากิ๊ก หาคู่"><img src="http://s0.boxza.com/static/images/banner/service/friend-banner.gif" alt="หาเพื่อน หาแฟน หากิ๊ก หาคู่"></a>
 <a href="http://game.boxza.com/" target="_blank" title="รูปภาพ แบ่งปันรูปภาพ"><img src="http://s0.boxza.com/static/images/banner/service/game-banner.gif" alt="รูปภาพ แบ่งปันรูปภาพ"></a>
 <a href="http://social.boxza.com/" target="_blank" title="สังคมออนไลน์ โซเชียลคนไทย"><img src="http://s0.boxza.com/static/images/banner/service/line-banner.gif" alt="สังคมออนไลน์ โซเชียลคนไทย"></a>
 <a href="http://movie.boxza.com/" target="_blank" title="ดูหนังออนไลน์ ตัวอย่างหนังใหม่"><img src="http://s0.boxza.com/static/images/banner/service/movie-banner.gif" alt="ดูหนังออนไลน์ ตัวอย่างหนังใหม่"></a>
 <a href="http://forum.boxza.com/image" target="_blank" title="รูปภาพ สาวสวย น่ารัก พริตตี้ นางแบบ"><img src="http://s0.boxza.com/static/images/banner/service/picpost-banner.gif" alt="รูปภาพ สาวสวย น่ารัก พริตตี้ นางแบบ"></a>
 </div>   
 
    <hr class="hr">
    <div class="sig"><?php echo str_ireplace(array('<iframe','/iframe>'),array('<!--iframe','/iframe-->'),$this->u['sg'])?></div>
    </td>
</tr>
<?php endif?>
<?php if(count($this->topic['cm']['d'])):?>
<?php for($i=0;$i<count($this->topic['cm']['d']);$i++):
	$u=$this->user->profile($this->topic['cm']['d'][$i]['u']);
?>
<tr><td colspan="2" class="forum-hr"></td></tr>
<tr>
	<td class="col1"><a name="<?php echo $this->topic['cm']['d'][$i]['i']?>"></a>
    <?php if($u):?>
    <?php
	 					$tk=intval($u['fr']['tk']);
						$cd=intval($u['cd']['p']);
						$rp=intval($u['fr']['rp']);
						$tp=intval($u['fr']['tp']);
	 ?>
    <h3><a href="http://boxza.com/<?php echo $u['link']?>"><?php echo $u['name']?></a></h3>
    <a href="http://boxza.com/<?php echo $u['link']?>"><img src="<?php echo $u['nimg']?>"></a>
    <div style="text-align:center"><img src="http://s0.boxza.com/static/images/forum/class/<?php echo $u['class']?>.png" alt="<?php echo $u['class']?>"></div>
    <div class="profile">
    เขียนกระทู้: <?php echo number_format($tp)?><br />
   	ตอบกระทู้: <?php echo number_format($rp)?><br />
   	บ๊อก: <?php echo number_format($cd)?>
    </div>
    <div class="profile">
    พลังน้ำใจ: <span style="color:#F00; font-size:24px;" class="thank-<?php echo $u['_id']?>"><?php echo $tk?></span>
    <?php if($u['st']<1):?>
    <div style="text-align:center; margin:3px 0px 0px; background:#f0f0f0; padding:3px;"><em>ยังไม่ยืนยันการสมัครสมาชิก</em></div>
    <?php else:?>
    (<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','thank',<?php echo $u['_id']?>)">ขอบคุณ</a>)
    <?php endif?>
    </div>

    <?php else:?>
    	ไม่มีสมาชิกดังกล่าว
    <?php endif?>
    </td>
	<td class="col2">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="vtime">
    <tr><td><a href="/forum/topic/<?php echo $this->topic['_id'].($this->page>1?'/page-'.$this->page:'').'#'.$this->topic['cm']['d'][$i]['i']?>" rel="nofollow" class="forum-nav-link">เขียนเมื่อ <i class="forum-calendar-icon"></i> <?php echo str_replace('-','<i class="forum-time-icon"></i>',time::show($this->topic['cm']['d'][$i]['t'],'datetime',true))?></a><?php if(_::$my['am']):?> - IP: <?php echo $this->topic['cm']['d'][$i]['p']?> <?php endif?></td>
    <td align="right">
    <?php if(!$this->topic['lo'] && $u):?>
    <a href="/forum/new-reply/<?php echo $this->topic['_id']?>/quote/<?php echo $this->topic['cm']['d'][$i]['i']?>" class="forum-nav-link" title="อ้างอิง"><i class="forum-quote-icon"></i></a>
    <?php endif?>
    <?php if(_::$my['_id']&&((_::$my['_id']==$this->topic['cm']['d'][$i]['u'] && !$this->topic['lo'])||_::$my['am'])):?>
    <a href="/forum/edit-reply/<?php echo $this->topic['_id']?>/<?php echo $this->topic['cm']['d'][$i]['i']?>" class="forum-nav-link" title="แก้ไข"><i class="forum-edit-icon"></i></a>
    <a href="javascript:;" onClick="delreply(<?php echo $this->topic['cm']['d'][$i]['i']?>)" class="forum-nav-link" title="ลบ"><i class="forum-delete-icon"></i></a>
    <?php endif?>
    </td></tr></table>
    <?php if($u):?>
	<div class="detail"><?php echo $this->topic['cm']['d'][$i]['m']?></div>
    <?php if($this->topic['cm']['d'][$i]['e']):?>
    <?php $e=count($this->topic['cm']['d'][$i]['e'])-1;
	 $eu=$this->user->profile($this->topic['cm']['d'][$i]['e'][$e]['u']);
	 ?>
    <div class="cedit">แก้ไขโดย <a href="http://boxza.com/<?php echo $eu['link']?>"><?php echo $eu['name']?></a> เมื่อ <?php echo time::show($this->topic['cm']['d'][$i]['e'][$e]['t'],'datetime',true)?></div>
	 <?php endif?>
    <hr class="hr">
	<div class="sig"><?php echo str_ireplace(array('<iframe','/iframe>'),array('<!--iframe','/iframe-->'),$u['sg'])?></div>
   <?php else:?>
   ข้อความถูกซ่อน เนื่องจากสมาชิกดังกล่าวโดนแบนไปแล้ว.
   <?php endif?>
   </td>
</tr>
<?php endfor?>
<?php endif?>
<tr><td colspan="2" class="forum-hr"></td></tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="3" border="0" width="100%">
<tbody>
<tr><td width="300" valign="bottom">
<?php if($this->cate[$this->topic['c']]['n']==1 || ($this->cate[$this->topic['c']]['n']==2 && _::$my['am'])):?> <a href="/forum/new-topic/<?php echo $this->topic['c']?>"><i class="forum-new-topic-icon"></i></a> <?php endif?>
<?php if(!$this->topic['lo']):?> <a href="/forum/new-reply/<?php echo $this->topic['_id']?>"><i class="forum-new-reply-icon"></i></a> <?php endif?>
</td>
<td align="right" valign="middle"><?php echo $this->pager?></td>
</tr>
</tbody>
</table>

<style>
.acm{padding:5px; margin:15px 0px 5px; border:1px solid #f0f0f0; background:#fcfcfc; color:#555}
.acm h4{background:#f9f9f9; padding:5px; text-align:center; color:#555; margin-bottom:5px;}
</style>
<?php if(!$this->topic['lo']):?>
<div style="height:1px; overflow:hidden; margin:15px 5px; border-bottom:1px solid #e9e9e9;"></div>
<div class="acm">
<form onSubmit="tinyMCE.triggerSave();_.ajax.gourl('<?php echo URL?>','newreply',this);return false">
<h4>ตอบกระทู้ด่วน</h4>
<?php if(_::$my):?>
<div>
<div style="float:left; width:230px; text-align:center">
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
      </div>
      [<a href="javascript:void(0);" onClick="window.open('/forum/emoticon', '_onion', 'resizable=yes,width=620,height=450');return false;">ดูเพิ่มเติม</a>]
</div>

<div style="margin:0px 0px 10px 240px;">
<textarea name="detail" style="width:100%; height:100px;" placeholder="กรอกข้อความของคุณที่นี่" class="mceEditor"></textarea>
</div>
<p class="clear"></p>
</div>
<div style="text-align:center">
<input type="submit" class="btn btn-primary" value=" บันทึก "> <input type="reset" class="btn" value=" ยกเลิก "> 
หรือ ตอบกระทู้แบบเต็มรูปแบบ <a href="/forum/new-reply/<?php echo $this->topic['_id']?>">คลิกที่นี่</a>
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