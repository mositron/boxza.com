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


<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลกระทู้: 
<a href="http://feed.boxza.com/forum/rss" title="บริการข้อมูลกระทู้โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลกระทู้โดย RSS Feed"></a>
<a href="http://feed.boxza.com/forum/json" title="บริการข้อมูลกระทู้โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลกระทู้โดย JSON"></a>
<a href="http://feed.boxza.com/forum/json/change_callback_function_here" title="บริการข้อมูลกระทู้โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลกระทู้โดย JSONP"></a>
</div>
</div>

<ul class="breadcrumb" style="margin:5px 0px;">
<?php if(defined('FORUM_IN')):?>
<li><a href="/" title="<?php echo FORUM_HOME_TT?>"><i class="icon-home"></i> <?php echo FORUM_HOME?></a></li><span class="divider">&raquo;</span>
<?php endif?>
<li><a href="<?PHP echo FORUM_URL?>" title="รูป"><i class="icon-list"></i> รูป</a></li>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="<?PHP echo FORUM_URL?>setting"><i class="icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
</ul>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<?php if($this->topic):?>
<h3 class="hb" style="margin:0px 0px 0px">อัพเดทกระทู้ล่าสุด</h3>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หมวด</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="tcate"><p><a href="<?php echo FORUM_URL.($this->cate[$val['c']]['sl']?$this->cate[$val['c']]['sl']:'c-'.$val['c'])?>"><?php echo $this->cate[$val['c']]['t']?></a></p></td>
	<td class="ttitle"><p><a href="<?php echo FORUM_URL?>topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php 
	if($val['cm']['d']):
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime')?>
     <?php else:?>
     <?php echo time::show($val['ds'],'datetime')?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>


<?php endif?>

<table cellpadding="1" cellspacing="1" border="0" width="100%" class="forum">
<?php if(count($this->cate)):?>
<?php foreach($this->cate as $k=>$v):?>
<?php if(!isset($v['l']) || !count($v['l']) || isset($v['p'])) continue;?>
<?php if(!defined('FORUM_IN')&&$v['s']) continue;?>
<?php $url=($v['s']?'http://'.$v['s'].'.boxza.com/forum/':'/');?>
<tr><td colspan="6" class="fhead"><h4><i></i><a href="<?php echo $url.($v['sl']?$v['sl']:'c-'.$k)?>"><?php echo $v['t']?></a> <small><?php echo $v['d']?></small></h4></td></tr>
<tr class="bar"><th class="ficon">&nbsp;</th><th class="ftitle">ฟอรั่ม</th><th align="center">หัวข้อ</th><th align="center" class="fview">ตอบ</th><th align="center" class="fview">อ่าน</th><th align="center" class="ftime">ล่าสุด</th></tr>
<?php foreach($v['l'] as $s):?>
<tr>
	<td class="ficon"><a href="<?php echo $url.($this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s)?>"></a></td>
	<td class="ftitle">
   <h4><a href="<?php echo $url.($this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s)?>"><?php echo $this->cate[$s]['t']?></a></h4>
   <p><?php echo $this->cate[$s]['d']?></p>
   <?php if($this->cate[$s]['l']):?>
   ห้องย่อย: <?php for($j=0;$j<count($this->cate[$s]['l']);$j++):?><?php if($i>0):?>, <?php endif?> <a href="<?php echo $url.($this->cate[$this->cate[$s]['l'][$j]]['sl']?$this->cate[$this->cate[$s]['l'][$j]]['sl']:'c-'.$this->cate[$s]['l'][$j])?>"><?php echo $this->cate[$this->cate[$s]['l'][$j]]['t']?></a><?php endfor?>
   <?php endif?>
   </td>
	<td class="fview"><?php echo number_format(intval($this->cate[$s]['tp']))?></td>
	<td class="fview"><?php echo number_format(intval($this->cate[$s]['rp']))?></td>
	<td class="fview"><?php echo number_format(intval($this->cate[$s]['do']))?></td>
	<td class="ftime">
   <?php if($this->cate[$s]['ls']):?>
   <a href="<?php echo $url?>topic/<?php echo $this->cate[$s]['ls']['i']?>"><?php echo mb_substr($this->cate[$s]['ls']['f'],0,20,'utf-8')?>...</a><br>
   <?php echo time::show($this->cate[$s]['ls']['t'],'datetime',true)?>
	<?php else:?>
   -
   <?php endif?>
   </td>
</tr>
<?php endforeach?>
<?php endforeach?>
<?php endif?>
</table>
