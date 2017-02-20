 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
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
<div style="overflow:hidden; margin:5px 0px; text-align:center">
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
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลกระทู้: 
<a href="http://feed.boxza.com/forum-<?php echo $this->c?>/rss" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย RSS Feed"></a>
<a href="http://feed.boxza.com/forum-<?php echo $this->c?>/json" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSON"></a>
<a href="http://feed.boxza.com/forum-<?php echo $this->c?>/json/change_callback_function_here" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSONP"></a>
</div>
</div>

<ul class="breadcrumb" style="margin:5px 0px;">
<?php if(defined('FORUM_IN')):?>
<li><a href="/" title="<?php echo FORUM_HOME_TT?>"><i class="icon-home"></i> <?php echo FORUM_HOME?></a></li> <span class="divider">&raquo;</span>
<li><a href="<?PHP echo FORUM_URL?>" title="เว็บบอร์ด"><i class="icon-list"></i> เว็บบอร์ด</a></li>
<?php else:?>
<li><a href="<?PHP echo FORUM_URL?>" title="รูป"><i class="icon-list"></i> รูป</a></li>
<?php endif?>
<?php 
$f = $this->c;
$nav='';
while($f && $n=$this->cate[$f]):
	$nav=' <span class="divider">&raquo;</span> <li><a href="'.FORUM_URL.($n['sl']?$n['sl']:'c-'.$f).'">'.$n['t'].'</a></li>'.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="<?PHP echo FORUM_URL?>setting"><i class="icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
<?php if($this->cate[$this->c]['n']==1 || ($this->cate[$this->c]['n']==2 && _::$my['am'])):?>
<li class="pull-right"><a href="<?PHP echo FORUM_URL?>new-topic/<?php echo $this->c?>"><i class="icon-plus"></i> เพิ่มกระทู้ใหม่</a></li>
<?php endif?>
</ul> 


<?php if(!in_array($this->c,array(542,543,544,545))):?>
<?php require(HANDLERS.'ads/ads.yengo.body3.php');?>
<?php endif?>

<?php if($this->cate[$this->c]['l']):?>
<table cellpadding="1" cellspacing="1" border="0" class="forum table" style="margin-bottom:3px">
<tr><td colspan="6" class="fhead"><h4><a href="<?PHP echo FORUM_URL.($this->cate[$this->c]['sl']?$this->cate[$this->c]['sl']:'c-'.$this->c)?>"><?php echo $this->cate[$this->c]['t']?></a> <small><?php echo $this->cate[$this->c]['d']?></small></h4></td></tr>
<tr class="bar"><th>&nbsp;</th><th>ฟอรั่ม</th><th>หัวข้อ</th><th>ตอบ</th><th>อ่าน</th><th>ล่าสุด</th></tr>
<?php foreach($this->cate[$this->c]['l'] as $s):?>

<tr>
	<td class="ficon"><a href="<?PHP echo FORUM_URL.($this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s)?>"></a></td>
	<td class="ftitle"><h4><a href="<?PHP echo FORUM_URL.($this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s)?>"><?php echo $this->cate[$s]['t']?></a></h4><?php echo $this->cate[$s]['d']?></td>
	<td class="fview"><?php echo number_format(intval($this->cate[$s]['tp']))?></td>
	<td class="fview"><?php echo number_format(intval($this->cate[$s]['rp']))?></td>
	<td class="fview"><?php echo number_format(intval($this->cate[$s]['do']))?></td>
	<td class="ftime">
   <?php if($this->cate[$s]['ls']):?>
   <a href="<?PHP echo FORUM_URL?>topic/<?php echo $this->cate[$s]['ls']['i']?>"><?php echo mb_substr($this->cate[$s]['ls']['f'],0,30,'utf-8')?></a><br>
   <?php echo time::show($this->cate[$s]['ls']['t'],'datetime',true)?>
	<?php else:?>
   -
   <?php endif?>
   </td>
</tr>
<?php endforeach?>
</table>
<?php endif?>


<table width="100%" style="margin-bottom:5px">
<tr>
<?php if($this->cate[$this->c]['n']==1 || ($this->cate[$this->c]['n']==2 && _::$my['am'])):?>
<td><a href="<?PHP echo FORUM_URL?>new-topic/<?php echo $this->c?>"><i class="forum-new-topic-icon"></i></a></td>
<?php endif?>
<td align="right"><?php echo $this->pager?></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="forum_topic">
<tr class="bar"><th colspan="2">&nbsp;</th><th>หัวข้อ</th><th class="tpost">ผู้ตั้ง</th><th class="tview">ตอบ</th><th class="tview">อ่าน</th><th class="ttime">ตอบล่าสุด</th></tr>
<?php if($this->count):?>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<?php $i++;?>
<?php if($last!=$val['sk']):?>
<tr class="mini"><th colspan="7"><?php echo $val['sk']?'กระทู้ปักหมุด':'กระทู้ทั่วไป'?></th></tr>
<?php $last=$val['sk'];?>
<?php endif?>
<tr>
	<td class="ticon l<?php echo $i%2?>">
    <?php if($val['sk']):?>
    	<img src="http://s0.boxza.com/static/images/forum/sticky<?php echo $val['lo']?'_locked':''?>.gif" class="sticky" /> 
	<?php else:?>
    	<img src="http://s0.boxza.com/static/images/forum/topic_read<?php echo $val['lo']?'_locked':''?>.gif" />
	<?php endif?>
    </td>
	<td class="ticon l<?php echo $i%2?>"><img src="http://s0.boxza.com/static/images/forum/posticon/<?php echo $val['ic']?>.gif" /></td>
	<td class="ttitle l<?php echo $i%2?>">
    <a href="<?PHP echo FORUM_URL?>topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a>
    <?php echo topic_page('/'.$val['_id'],$val['reply'])?>
    </td>
    <td class="tpost l<?php echo $i%2?>">
    <?php $p=$this->user->profile($val['u']);?>
	<a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a>
    </td>
	<td class="tview l<?php echo $i%2?>"><?php echo number_format($val['cm']['c'])?></td>
	<td class="tview l<?php echo $i%2?>"><?php echo number_format($val['do'])?></td>
	<td class="ttime l<?php echo $i%2?>">
	<?php 
	if($val['cm']['d']):
	$p=$this->user->profile($val['cm']['d'][0]['u']);
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime')?><br />
        <a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a>
        <a href="<?PHP echo FORUM_URL?>topic/<?php echo $val['_id']?>/last#<?php echo $val['cm']['d'][0]['i']?>"><img src="http://s0.boxza.com/static/images/forum/lastpost.gif" align="absmiddle" alt="ไปหน้าสุดท้าย" /></a>
     <?php else:?>
     ---
    <?php endif?>
	</td>
</tr>
<?php endforeach?>
<?php else:?>
<tr><td colspan="7"><h2 style="text-align:center; margin:50px 0px; color:#999999">ยังไม่มีหัวข้อในหมวดนี้</h2></td></tr>
<?php endif?>
</table>
<table width="100%" style="margin-bottom:5px">
<tr>
<?php if($this->cate[$this->c]['n']==1 || ($this->cate[$this->c]['n']==2 && _::$my['am'])):?>
<td><a href="<?PHP echo FORUM_URL?>new-topic/<?php echo $this->c?>"><i class="forum-new-topic-icon"></i></a></td>
<?php endif?>
<td align="right"><?php echo $this->pager?></td>
</tr>
</table>




<!-- BEGIN - BANNER : F -->
<?php if($this->_banner['f']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['f'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : F -->