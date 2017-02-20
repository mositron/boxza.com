



<h3 class="fo-bar" title="เว็บบอร์ด"></h3>


<div class="row-fluid">

<?php $i=0;foreach($this->fo as $k=>$v):?>
<div class="fo-box fo-box-<?php echo $i%2?> fo-box-<?php echo $k?>">
<div class="fo-box-h">
<p class="i"><a href="/forum/c-<?php echo $v['_id']?>" title="<?php echo $v['t']?>"><i class="fo-<?php echo $k?>" title="<?php echo $v['t']?>"></i></a></p>
<div><?php echo $v['d']?></div>
<p class="clear"></p>
</div>
<ul class="fo-box-b thumbnails row-count-4">
<li class="span3"><span><?php echo $v['tp']?></span>หัวข้อ</li>
<li class="span3"><span><?php echo $v['rp']?></span>ตอบ</li>
<li class="span3"><span><?php echo $v['do']?></span>อ่าน</li>
<li class="span3"><span><?php echo $v['lk']?></span><i class="fo-icon-heart"></i></li>
</ul>
<?php if($v['l']):?>
<ul class="fo-box-c">
<?php foreach($v['l'] as $o):?>
<li>[ <a href="/forum/c-<?php echo $o?>"><?php echo $this->cate[$o]['t']?></a> ]</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
<?php endif?>

<ul class="fo-box-topic nav">
<?php for($j=0;$j<count($v['topic']);$j++):?>
<li><a href="/forum/topic/<?php echo $v['topic'][$j]['_id']?>"><?php echo $v['topic'][$j]['t']?></a></li>
<?php endfor?>
</ul>
</div>
<?php $i++;endforeach?>
</div>

