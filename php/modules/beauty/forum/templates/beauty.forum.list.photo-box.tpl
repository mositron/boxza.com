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


<ul class="forum-album">
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>">
<span><?php if($val['s']):?><img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/t.jpg" alt="<?php echo $val['t']?>"><?php endif?></span>
<p><?php echo $val['t']?></p>
</a></li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>


<div align="center"><?php echo $this->pager?></div>