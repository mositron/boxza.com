<?php 
	for($i=0;$i<count($this->line);$i++):
	$l = $this->line[$i];
	$in=(array)$l['in'];
?>
<div id="_line_ln<?php echo $l['_id']?>" data-ln="<?php echo $l['_id']?>" data-ds="<?php echo $l['ds']?>" data-ty="<?php echo $l['ty']?>" data-uid="<?php echo $l['u']['_id']?>" data-pid="<?php echo $l['p']?$l['p']['_id']:''?>" class="ln ln-<?php echo $l['_id']?>">
<div class="av"><a href="/<?php echo $l['u']['link']?>" class="h" title="<?php echo $l['u']['name']?>"><img src="<?php echo $l['u']['img']?>" class="img-uid-<?php echo $l['u']['_id']?>"></a></div>

<div class="ct-s">
<a href="/<?php echo $l['u']['link']?>" class="sm-a h"><?php echo $l['u']['name']?></a>
</div>
<div class="ct-si">
<?php if(in_array('0',$in)):?>
<span class="inter">สาธารณะ</span>, 
<?php elseif(in_array('-1',$in)):?>
<span class="inter">เฉพาะเพื่อน</span>, 
<?php else:?>
<span class="inter">ส่วนตัว</span>, 
<?php endif?>

<span class="ago" datetime="<?php echo $l['ds']?>"></span>

</div>
<div class="ct">
<?php if($l['p'] && !$l['is_profile']):?>
<div class="ct-pf">
โพสต์บนไลน์ของ <span class="av"><a href="/<?php echo $l['p']['link']?>" class="h" title="<?php echo $l['p']['name']?>"><img src="<?php echo $l['p']['img']?>"></a></span> <a href="/<?php echo $l['p']['link']?>" class="h" title="<?php echo $l['p']['name']?>"><?php echo $l['p']['name']?></a>
</div>
<?php endif?>
<div class="dt">
<?php echo nl2br($l['ms'],false)?>
</div>
<?php if($l['pt']['tmp']):?>
<div class="pt">
<a href="/line/<?php echo $l['_id']?>" data-rel="dialog" data-transition="slidedown"><img src="<?php echo $l['pt']['tmp']?>"></a>
</div>
<?php elseif($l['ty']=='album'):?>
<div class="pt">
<ul class="pt-al">
<?php for($j=0;$j<count($l['pt']['f']);$j++):?>
<li>
<a href="/line/<?php echo $l['pt']['f'][$j]['i']?>" data-rel="dialog" data-transition="slidedown"><img src="<?php echo $l['pt']['f'][$j]['tmp']?>"></a>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>
<?php endif?>

<?php if($l['at']['t']):?>
<div class="vid-tt"><a href="<?php echo $l['at']['l']?>" target="_blank" rel="nofollow"><?php echo $l['at']['t']?></a></div>
<?php endif?>

<?php if($l['at']['i']):?>
<div class="vid-im"><a href="<?php echo $l['at']['l']?>" target="_blank" rel="nofollow"><img src="<?php echo $l['at']['i']?>"></a></div>
<?php endif?>
<?php if($l['at']['d']):?>
<div class="vid-dc"><?php echo $l['at']['d']?></div>
<?php endif?>
<?php if($l['lc']):?>
<div>
<div class="mp">
<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo number_format($l['lc']['l'][0],3,'.','').','.number_format($l['lc']['l'][1],3,'.','')?>&markers=color:blue%7Clabel:A%7C<?php echo number_format($l['lc']['l'][0],3,'.','').','.number_format($l['lc']['l'][1],3,'.','')?>&zoom=15&size=300x150&maptype=roadmap&sensor=false">

<div class="mp-n">
<?php echo $l['lc']['n']?>
</div>
</div>
</div>
<?php endif?>
<div> 

</div>


<?php 
if($l['ty']=='share'):
if($l['sh']['d']):
$sh = $l['sh']['d'];
?>
<div class="sh-z">
<div class="av"><a href="/<?php echo $sh['u']['link']?>" class="h" title="<?php echo $sh['u']['name']?>"><img src="<?php echo $sh['u']['img']?>" class="img-uid-<?php echo $sh['u']['_id']?>"></a></div>
<div class="sh-hd-ur"><a href="/<?php echo $sh['u']['link']?>" class="h u"><?php echo $sh['u']['name']?></a> แบ่งปัน<a href="/line/<?php echo $sh['_id']?>" class="h">โพสต์นี้</a>เป็นคนแรก </div>
<div class="ct">
<div class="dt"><?php echo $sh['ms']?></div>
<?php if($sh['pt']&&$sh['pt']['tmp']):?>
<div class="pt"><!--a href="/photos/photo-<?php echo $sh['_id']?>" onClick="_.api('/me/photos/photo-<?php echo $sh['_id']?>');return false;"--><img src="<?php echo $sh['pt']['tmp']?>"><!--/a--></div>
<?php endif?>
<?php if($sh['at']):?>
<div class="vid-tt"><a href="<?php echo $sh['at']['l']?>" target="_blank" rel="nofollow"><?php echo $sh['at']['t']?></a></div>
<?php if($sh['at']['i']):?>
<div class="vid-im"><a href="<?php echo $sh['at']['l']?>" target="_blank" rel="nofollow"<?php if($sh['at']['v']):?> onClick="_.line.embed(this,'<?php echo $sh['at']['v']['l']?>','<?php echo $sh['at']['v']['w']?>','<?php echo $sh['at']['v']['h']?>');return false;"<?php endif?>><img src="<?php echo $sh['at']['i']?>"></a></div>
<?php elseif($sh['at']['v']):?>
<div class="vid-eb">
<object width="<?php echo $sh['at']['v']['w']?>" height="<?php echo $sh['at']['v']['h']?>">
<param name="movie" value="<?php echo $sh['at']['v']['l']?>"><param name="wmode" value="opaque">
<embed src="<?php echo $sh['at']['v']['l']?>" wmode="opaque" width="<?php echo $sh['at']['v']['w']?>" height="<?php echo $sh['at']['v']['h']?>"></embed>
</object>
</div>
<?php endif?>
<?php if($sh['at']['d']):?><div class="vid-dc"><?php echo $sh['at']['d']?></div><?php endif?>
<?php endif?>
<?php 
if($l['lc']):
?>
<div>
<div class="mp">
<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $sh['lc']['l'][0]?>,<?php echo $sh['lc']['l'][1]?>&markers=color:blue%7Clabel:A%7C<?php echo $sh['lc']['l'][0]?>,<?php echo $sh['lc']['l'][1]?>&zoom=15&size=490x150&maptype=roadmap&sensor=false" style="margin:5px 0px 5px 5px">
<div class="mp-n"><?php echo $sh['lc']['n']?></div>
</div>
</div>
<?php endif?>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<?php endif?>
<?php endif?>

<div class="bk">
<span class="bk-ca-b lk-c-<?php echo $l['_id']?>"><?php echo intval($l['lk']['c'])?></span> โดน &#8226; 
<span class="cm-c-<?php echo $l['_id']?>"><?php echo intval($l['cm']['c'])?></span> ความคิดเห็น
</div>
</div>
<p class="clear"></p>
<div class="nav-bk">
<div data-role="navbar" data-theme="d" data-iconpos="left">
  <ul>
      <li><a href="#"  onClick="_.api('/me/like/<?php echo $l['_id']?>'+($(this).hasClass('like')?'/unlike':'')); $(this).toggleClass('like')" class="<?php echo in_array(_::$my['_id'],(array)$l['lk']['u'])?'like':''?>">โดน</a></li>
      <li><a href="/line/<?php echo $l['_id']?>" data-rel="dialog" data-transition="slidedown">แสดงความเห็น</a></li>
  </ul>
</div>
</div>
</div>
<?php endfor?>

<?php if(count($this->line)==30):?>
<div class="ln-next"><span onClick="_.line.next()" class="ptr2">โหลดข้อมูลเพิ่มเติม</span></div>
<?php endif?>

