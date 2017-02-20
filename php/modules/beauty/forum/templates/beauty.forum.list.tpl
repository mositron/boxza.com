<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลกระทู้: 
<a href="http://feed.boxza.com/forum-<?php echo $this->c?>/rss" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย RSS Feed"></a>
<a href="http://feed.boxza.com/forum-<?php echo $this->c?>/json" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSON"></a>
<a href="http://feed.boxza.com/forum-<?php echo $this->c?>/json/change_callback_function_here" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลกระทู้<?php echo $this->cate[$this->c]['t']?>โดย JSONP"></a>
</div>
</div>

<ul class="breadcrumb" style="margin-bottom:0px;">
<li><a href="/" title="ผู้หญิง"><i class="icon-home"></i> ผู้หญิง</a></li><span class="divider">&raquo;</span>
<li><a href="<?PHP echo FORUM_URL?>" title="เว็บบอร์ด"><i class="icon-list"></i> เว็บบอร์ด</a></li>
<?php 
$f = $this->c;
$nav='';
while($f && $n=$this->cate[$f]):
	$nav='<span class="divider">&raquo;</span><li><a href="'.FORUM_URL.'c-'.$f.'">'.$n['t'].'</a></li>'.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>
<?php if($this->cate[$this->c]['n']):?>
<li class="pull-right"><a href="<?PHP echo FORUM_URL?>new-topic/<?php echo $this->c?>"><i class="icon-plus"></i> เพิ่มกระทู้ใหม่</a></li>
<?php endif?>
</ul> 

<?php $cate=getclassbyid($this->cate[$this->c])?>

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
<li<?php echo $this->c==$o?' class="active"':''?>>[ <a href="/forum/c-<?php echo $o?>"><?php echo $this->cate[$o]['t']?></a> ]</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
<?php endif?>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<?php if($this->cate[$this->c]['l']):?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>ห้อง</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="tcate"><p>[<a href="/forum/c-<?php echo $val['c']?>"><?php echo $this->cate[$val['c']]['t']?></a>]</p></td>
	<td class="ttitle ttitle2"><p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php if($val['cm']['d']):?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime',true)?>
     <?php else:?>
     <?php echo time::show($val['da'],'datetime',true)?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
<?php else:?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php if($val['cm']['d']):?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime',true)?>
     <?php else:?>
     <?php echo time::show($val['da'],'datetime',true)?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
<?php endif?>
<div align="center"><?php echo $this->pager?></div>