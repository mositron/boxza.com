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


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<ul class="breadcrumb" style="margin:5px 0px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li> <span class="divider">&raquo;</span>
<li><a href="<?PHP echo FORUM_URL?>" title="เว็บบอร์ด"><i class="icon-list"></i> เว็บบอร์ด</a></li>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="<?PHP echo FORUM_URL?>setting"><i class="icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
</ul>

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

<iframe frameborder="0" width="100%" height="450" src="http://s0.boxza.com/static/chat/?r=1&sound=0&radio=0"></iframe>


<?php if(count($this->cate)):?>
<?php $_i=0;foreach($this->cate as $k=>$v):?>
<?php if(!isset($v['l']) || !count($v['l'])) continue;?>
<div class="forum-home">
<h3 class="l<?php echo $_i%2?>"><i class="icon-forum-<?php echo $k?>"></i><a href="/forum/<?php echo $v['sl']?$v['sl']:'c-'.$k?>"><?php echo $v['t']?></a> <small><?php echo $v['d']?></small></h3>
<ul class="forum-home-list">
<?php $_j=0;foreach($v['l'] as $s):?>
<li>
<span>
<a href="/forum/<?php echo $this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s?>"><img src="http://s0.boxza.com/static/images/forum/thumb/<?php echo $s?>.png" alt="<?php echo $this->cate[$s]['t']?>"></i></a>
</span>
<div>
<h4><a href="/forum/<?php echo $this->cate[$s]['sl']?$this->cate[$s]['sl']:'c-'.$s?>"><?php echo $this->cate[$s]['t']?></a></h4>
<div><?php echo $this->cate[$s]['d']?></div>
<p>กระทู้: <?php echo number_format(intval($this->cate[$s]['tp']))?> | ตอบ: <?php echo number_format(intval($this->cate[$s]['rp']))?> | อ่าน: <?php echo number_format(intval($this->cate[$s]['do']))?></p>
<p><?php if($this->cate[$s]['ls']):?>ล่าสุด: <?php echo time::show($this->cate[$s]['ls']['t'],'datetime',true)?><?php endif?></p>
</div>
<p></p>
</li>
<?php if($_j%2==1):?><p class="clear"></p><?php endif?>
<?php $_j++;endforeach?>
<p class="clear"></p>
</ul>
</div>
<?php $_i++;endforeach?>
<?php endif?>

