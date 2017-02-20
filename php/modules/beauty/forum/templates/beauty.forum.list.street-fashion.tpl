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


<div class="forum-street-fashion">
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<div>
<h4><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></h4>

<div>
<div class="a">
<a href="/forum/topic/<?php echo $val['_id']?>"><img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/t.jpg" alt="<?php echo $val['t']?>"></a>
</div>
<div class="b">
<div class="fo-view-love"><a href="javascript:;" onClick="_.ajax.gourl('/forum/topic/<?php echo $val['_id']?>','loveit')"><i class="fo-icon-heart"></i> LOVE IT</a> <span class="badge love-<?php echo $val['_id']?>"><?php echo intval($val['lk']['c'])?></span></div>  

 
<div class="s">
<div><g:plusone size="medium" count="true" href="http://beauty.boxza.com/forum/topic/<?php echo $val['_id']?>"></g:plusone></div>
<div style="margin-bottom:5px;"><fb:like href="http://beauty.boxza.com/forum/topic/<?php echo $val['_id']?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://beauty.boxza.com/forum/topic/<?php echo $val['_id']?>" data-count="horizontal" target="_blank">Tweet</a></div-->
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode('http://beauty.boxza.com/forum/topic/'.$val['_id'])?>&media=<?php echo urlencode('http://s3.boxza.com/forum/'.$val['fd'].'/t-1.jpg')?>&description=<?php echo urlencode($val['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<p></p>
</div>

 <?php if(count($val['o'])>1):?>
 <div class="c">
 <ul>
 <?php for($j=2;$j<min(count($val['o']),4);$j++):?>
 <li class="l<?php echo $i?>"><img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/<?php echo $val['o'][$j]?>"></li>
 <?php endfor?>
 <p class="clear"></p>
 </ul>
 </div>
 <?php endif?>



<?php if(count($val['cm']['d'])):?>
<div class="d">
<strong>ความคิดเห็นล่าสุด</strong>
<ul>
<?php for($i=0;$i<count($val['cm']['d']);$i++):
?>
<li><?php echo trim(strip_tags($val['cm']['d'][$i]['m']))?></li>
<?php endfor?>
</ul>
</div>
<?php endif?>

</div>
<p class="clear"></p>
</div>

</div>
<?php $i++;endforeach?>
</div>


<div align="center" style="padding:10px"><?php echo $this->pager?></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
