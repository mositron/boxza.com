<?php 
	$count=count($this->line);
	for($i=0;$i<$count;$i++):
	$l = $this->line[$i];
	$in=(array)$l['inm'];
?>
<div id="_line_ln<?php echo $l['_id']?>" data-ln="<?php echo $l['_id']?>" data-ha="<?php echo $l['ha']?1:0?>" data-ds="<?php echo $l['ds']?>" data-dc="<?php echo $l['dc']?>" data-ty="<?php echo $l['ty']?>" data-uid="<?php echo $l['u']['_id']?>" data-pid="<?php echo $l['p']?$l['p']['_id']:''?>" class="ln ln-<?php echo $l['_id']?>" data-expand="<?php echo $l['is_profile']||$count==1?1:''?>">
<?php if($l['md']=='spam'):?>
<div class="sp-b">แจ้งรายงานเมื่อ: <span class="ago" datetime="<?php echo $l['sp']&&$l['sp']['ds']?$l['sp']['ds']->sec:'0'?>"></span>, แจ้งล่าสุดโดย: <?php echo $l['sp']['un']?>, ข้อหา: <?php echo $l['sp']['rn']?> - <input type="button" class="button" value="ยกเลิกการแจ้งสแปม" onClick="_.ajax.gourl('/line','unsetspam',<?php echo $l['_id']?>)"></div>
<?php endif?>
<div class="av"<?php echo $l['u']['_id']?' av="'.$l['u']['_id'].'"':''?>>
<a href="/<?php echo $l['u']['link']?>" class="h" title="<?php echo $l['u']['name']?>"><img src="<?php echo $l['u']['himg']?>" class="img-uid-<?php echo $l['u']['_id']?>"></a>
</div>
<div class="ct-s">
<?php if(in_array('0',$in)):?>
<span class="inter" data-ref="0">สาธารณะ</span>, 
<?php elseif(in_array('-1',$in)):?>
<span class="inter" data-ref="-1">เฉพาะเพื่อน</span>, 
<?php else:?>
<span class="inter" data-ref="-2">ส่วนตัว</span>, 
<?php endif?>
<a href="<?php echo $l['is_profile']?'/'.$l['is_profile']:''?>/line/<?php echo $l['_id']?>" class="h"><span class="ago" datetime="<?php echo $l['de']?$l['de']:$l['ds']?>"></span></a><?php if($l['de']):?> <span class="ln-ed">(แก้ไข)</span><?php endif?>
<span class="sm-a"><a href="/<?php echo $l['u']['link']?>" class="h"><?php echo $l['u']['name']?></a></span>
</div>
<div class="ct">
<?php if($l['p'] && !$this->is_profile):?>
<div class="ct-pf">
โพสต์บนไลน์ของ <span class="av" av="<?php echo $l['p']['_id']?>"><a href="/<?php echo $l['p']['link']?>" class="h" title="<?php echo $l['p']['name']?>"><img src="<?php echo $l['p']['himg']?>"></a></span> <a href="/<?php echo $l['p']['link']?>" class="h" title="<?php echo $l['p']['name']?>"><?php echo $l['p']['name']?></a>
</div>
<?php endif?>
<?php if($l['ty']=='gift'):?>
<div>
<div style="width:125px; margin:5px 5px 0px; padding:5px 0px; float:left"><img src="http://s1.boxza.com/gift/128/<?php echo $l['tt']?>.png"></div>
<div class="dt" style="width:350px; float:left" data-user='<?php echo json_encode((array)$l['uk'])?>'><?php echo nl2br($l['ms'],false)?></div>
<p class="clear"></p>
</div>
<?php elseif($l['ty']=='quiz'):?>
<div>
<div style="width:138px; margin:5px 5px 0px; padding:5px 0px; border:1px solid #f5f5f5; float:left"><img src="http://s0.boxza.com/static/images/profile/quiz.png"></div>
<div class="dt" style="width:350px; float:left" data-hash='<?php echo json_encode((array)$l['hs'])?>' data-user='<?php echo json_encode((array)$l['uk'])?>'><?php echo nl2br($l['ms'],false)?></div>
<p class="clear"></p>
<div>*** เฉพาะสมาชิกที่สมัครด้วย Facebook หรือยืนยันการสมัครสมาชิกผ่านอีเมล์แล้วเท่านั้น ***</div>
</div>
<?php else:?>
<div class="dt" data-hash='<?php echo json_encode((array)$l['hs'])?>' data-user='<?php echo json_encode((array)$l['uk'])?>'><?php echo nl2br($l['ms'],false)?></div>
<?php endif?>
<?php if($l['ty']=='poll'):?>
<div class="ln-poll ln-poll-<?php echo $l['_id']?>">
<div class="l">สร้างเมื่อ <span class="ago" datetime="<?php echo $l['da']?>"></span>, จำนวนผู้ร่วมโหวตทั้งหมด <?php echo $l['po']['c']?> คน</div>
<?php for($b=0;$b<count($l['po']['d']);$b++):?>
<div>
<label style="background-position:<?php echo intval(($l['po']['d'][$b]['c']/max(1,$l['po']['c']))*560)?>px -143px">
<input type="radio" name="poll-<?php echo $l['_id']?>" value="<?php echo $l['po']['d'][$b]['i']?>" onClick="_.api('/me/poll/<?php echo $l['_id']?>-<?php echo $l['po']['d'][$b]['i']?>')"<?php echo in_array(_::$my['_id'],$l['po']['d'][$b]['u'])?' checked':''?>> 
<?php echo $l['po']['d'][$b]['m']?><i><?php echo $l['po']['d'][$b]['c']?> โหวต</i>
</label>
<p></p>
</div>
<?php endfor?>
</div>
<?php endif?>
<?php if($l['pt']['tmp']):?>
<div class="pt">
<?php if($l['ty']=='cover'):?>
<a href="/<?php echo $l['u']['link']?>" class="h">
<img src="<?php echo $l['pt']['tmp']?>">
</a>
<?php else:?>
<a href="/photos/photo-<?php echo $l['_id']?>" onClick="_.api('/me/photos/photo-<?php echo $l['_id']?>');return false;">
<img src="<?php echo $l['pt']['tmp']?>">
</a>
<?php endif?>
</div>
<?php elseif($l['ty']=='album'):?>
<div class="pt">
<ul class="pt-al">
<?php for($j=0;$j<count($l['pt']['f']);$j++):?>
<li>
<a href="/photos/photo-<?php echo $l['pt']['f'][$j]['i']?>" onClick="_.api('/me/photos/photo-<?php echo $l['pt']['f'][$j]['i']?>');return false;">
<img src="<?php echo $l['pt']['f'][$j]['tmp']?>" data-img2="<?php echo $l['pt']['f'][$j]['tmp2']?>">
</a>
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
<div class="vid-im"><a href="<?php echo $l['at']['l']?>" target="_blank" rel="nofollow"<?php if($l['at']['v']):?> class="v" onClick="_.line.embed(this,'<?php echo $l['at']['v']['l']?>',<?php echo $l['at']['v']['w']?>,<?php echo $l['at']['v']['h']?>);return false;"<?php endif?>><img src="<?php echo $l['at']['i']?>" style="max-width:500px; max-height:375px;"><i></i></a></div>
<?php elseif($l['at']['v']):?>
<div class="vid-eb">
<object width="<?php echo $l['at']['v']['h']?>" height="<?php echo $l['at']['v']['h']?>">
    <param name="movie" value="<?php echo $l['at']['v']['l']?>">
    <param name="wmode" value="opaque">
    <embed src="<?php echo $l['at']['v']['l']?>" wmode="opaque" width="<?php echo $l['at']['v']['w']?>" height="<?php echo $l['at']['v']['h']?>"></embed>
</object>
</div>
<?php endif?>
<?php if($l['at']['d']):?>
<div class="vid-dc"><?php echo $l['at']['d']?></div>
<?php endif?>
<?php if($l['lc']):?>
<div>
<div class="mp">
<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo number_format($l['lc']['l'][0],3,'.','').','.number_format($l['lc']['l'][1],3,'.','')?>&markers=color:blue%7Clabel:A%7C<?php echo number_format($l['lc']['l'][0],3,'.','').','.number_format($l['lc']['l'][1],3,'.','')?>&zoom=15&size=490x150&maptype=roadmap&sensor=false" style="margin:5px 0px 5px 5px">

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
<div class="av" av="<?php echo $sh['u']['_id']?>"><a href="/<?php echo $sh['u']['link']?>" class="h" title="<?php echo $sh['u']['name']?>"><img src="<?php echo $sh['u']['img']?>" class="img-uid-<?php echo $sh['u']['_id']?>"></a></div>
<div class="sh-hd-ur"><a href="/<?php echo $sh['u']['link']?>" class="h u"><?php echo $sh['u']['name']?></a> แบ่งปัน<a href="<?php echo $l['is_profile']?'/'.$l['is_profile']:''?>/line/<?php echo $sh['_id']?>" class="h">โพสต์นี้</a>เป็นคนแรก </div>
<div class="ct">
<div class="dt"><?php echo $sh['ms']?></div>
<?php if($sh['pt']&&$sh['pt']['tmp']):?>
<div class="pt"><a href="/photos/photo-<?php echo $sh['_id']?>" onClick="_.api('/me/photos/photo-<?php echo $sh['_id']?>');return false;"><img src="<?php echo $sh['pt']['tmp']?>"></a></div>
<?php endif?>
<?php if($sh['at']):?>
<div class="vid-tt"><a href="<?php echo $sh['at']['l']?>" target="_blank" rel="nofollow"><?php echo $sh['at']['t']?></a></div>
<?php if($sh['at']['i']):?>
<div class="vid-im"><a href="<?php echo $sh['at']['l']?>" target="_blank" rel="nofollow"<?php if($sh['at']['v']):?> onClick="_.line.embed(this,'<?php echo $sh['at']['v']['l']?>','<?php echo $sh['at']['v']['w']?>','<?php echo $sh['at']['v']['h']?>');return false;"<?php endif?>><img src="<?php echo $sh['at']['i']?>"  style="max-width:500px; max-height:375px;"></a></div>
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
<span class="lk lk-<?php echo $l['_id']?> <?php echo in_array(_::$my['_id'],(array)$l['lk']['u'])?'like':''?>">
<span onClick="_.api('/me/like/<?php echo $l['_id']?>')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span>
<span onClick="_.api('/me/like/<?php echo $l['_id']?>/unlike')" class="unlike ptr"><i class="show-tooltip-s ptr" title="เฉยๆ"></i></span>

<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-<?php echo $l['_id']?> ptr2" onClick="_.api('/me/like/<?php echo $l['_id']?>/list')"><?php echo intval($l['lk']['c'])?></span></span>
</span>

<span onClick="_.api('/me/share/<?php echo ($l['ty']=='share'&&$l['sh']['f']&&$l['sh']['d'])?$l['sh']['f']:$l['_id']?>')" class="ptr2"> แบ่งปัน</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sh-c-<?php echo $l['_id']?>"><?php echo intval($l['sh']['c'])?></span></span>

<span onClick="_.profile.cm.pop(<?php echo $l['_id']?>)" class="ptr2"> แสดงความเห็น</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b cm-c-<?php echo $l['_id']?>"><?php echo intval($l['cm']['c'])?></span></span>

<?php if($l['sp']):?>
<span> สแปม</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sp-c-<?php echo $l['_id']?>"><?php echo intval($l['sp'])?></span></span>
<?php endif?>
<?php if($l['s']):?>
<span> ผ่าน<a href="<?php echo $l['via']['l']?>" target="_blank"><?php echo $l['via']['t']?></a></span>
<?php endif?>

<span class="ptr2"> หมดอายุ</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b ex-c-<?php echo $l['_id']?>"><?php echo $l['ex']?></span></span>
</div>


<div class="cm-g">

<div class="cm-d-<?php echo $l['_id']?>">
<?php if($l['cm']['c'] >3):?>
<div class="cm-c cm-l-<?php echo $l['_id']?>"><span onClick="_.api('/me/comment/<?php echo $l['_id']?>/list/clear')" class="txt ptr2">ดูทุกความคิดเห็น (<span class="cm-c-<?php echo $l['_id']?>"><?php echo $l['cm']['c']?></span>)</span></div>
<?php endif?>


<?php 
if(is_array($l['cm']['d'])):
foreach($l['cm']['d'] as $c):
?>
<div class="cm-s cm-s-<?php echo $c['i']?>" data-uid="<?php echo $c['u']['_id']?>">
<div class="av" av="<?php echo $c['u']['_id']?>"><a href="/<?php echo $c['u']['link']?>" class="h" title="<?php echo $c['u']['name']?>"><img src="<?php echo $c['u']['himg']?>" class="img-uid-<?php echo $c['u']['_id']?>"></a></div>
<div class="cm-d">
<div class="cm-r">
<span class="cm-de" onClick="_.profile.cm.act(<?php echo $l['_id']?>,<?php echo $c['i']?>);"></span>


<span class="bk">
<span class="lk lk-<?php echo $l['_id']?>-<?php echo $c['i']?> <?php echo $c['lm']?'like':''?>">
<span onClick="_.api('/me/like/<?php echo $l['_id']?>-<?php echo $c['i']?>')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span>
<span onClick="_.api('/me/like/<?php echo $l['_id']?>-<?php echo $c['i']?>/unlike')" class="unlike ptr"><i class="show-tooltip-s ptr" original-title="เฉยๆ"></i></span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-<?php echo $l['_id']?>-<?php echo $c['i']?>"><?php echo $c['lc']?></span></span>
</span>
</span>

<span class="ago" datetime="<?php echo $c['t']?>"></span>

<span class="cm-u"><a href="/<?php echo $c['u']['link']?>" class="h"><?php echo $c['u']['name']?></a></span>
<div class="clear"></div>
</div>
<div class="cm-dt"><?php echo $c['m']?></div>
</div>
<p class="clear"></p>
</div>
<?php 
endforeach;
endif;
?>

</div>
<div class="cm-p cm-p-<?php echo $l['_id']?>" id="_cm-p-<?php echo $l['_id']?>"><?php if($l['cm']['c'] && _::$my):?>
<div class="cm-p-i"><div class="av"><a href="/<?php echo _::$my['link']?>"><img src="<?php echo _::$my['himg']?>" class="img-uid-<?php echo _::$my['_id']?>"></a></div>
<div class="cm-p-a"><textarea class="tbox" data-cm="<?php echo $l['_id']?>" style="width:100%; height:40px" onKeyPress="return _.profile.cm.post(event,this)" placeholder="แสดงความคิดเห็น"></textarea></div><p class="clear"></p></div>
<?php endif?></div>
</div>

</div>
<ul class="ac"><li><i onClick="_.line.act(<?php echo $l['_id']?>);return false;"></i><ul></ul></li></ul>
<p class="clear"></p>
</div>
<?php endfor?>

<?php if(count($this->line)==30):?>
<div class="ln-next"><span onClick="_.line.next()" class="ptr2" style="display:block">โหลดข้อมูลเพิ่มเติม</span></div>
<?php elseif(count($this->line)==1):?>
<script>$(function(){_.profile.cm.pop(<?php echo $this->line[0]['_id']?>,1);})</script>
<?php endif?>

