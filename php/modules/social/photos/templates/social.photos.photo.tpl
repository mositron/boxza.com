


<h3 style="margin:5px; padding:3px 10px; background-color:#f5f5f5; color:#000; text-shadow:1px 1px 0px #fff">รูปภาพ</h3>
<div class="getphoto">

<div align="center">
<img src="http://s1.boxza.com/line/<?php echo $this->photo['pt']['f']?>/o.<?php echo $this->photo['pt']['e']?>" width="<?php echo $this->photo['pt']['w']>900?900:$this->photo['pt']['w']?>">
</div>
</div>



<div class="left pf-l">


<div ln="<?php echo $this->photo['_id']?>" uid="<?php echo $this->photo['u']['_id']?>" class="ln ln-<?php echo $this->photo['_id']?>">
<div class="av" av="<?php echo $this->photo['u']['_id']?>"><a href="/<?php echo $this->photo['u']['link']?>" class="h" title="<?php echo $this->photo['u']['name']?>"><img src="<?php echo $this->photo['u']['img']?>" class="img-uid-<?php echo $this->photo['u']['_id']?>"></a></div>


<div class="ct-s">
<?php if(in_array('0',(array)$this->photo['in'])):?>
<span class="inter">สาธารณะ</span>, 
<?php else:?>
<span class="inter">ส่วนตัว</span>, 
<?php endif?>

<a href="<?php echo $this->photo['is_profile']?'/'.$this->photo['is_profile']:''?>/line/<?php echo $this->photo['_id']?>" class="h"><span class="ago" datetime="<?php echo $this->photo['ds']?>"></span></a>
<a href="/<?php echo $this->photo['u']['link']?>" class="sm-a h"><?php echo $this->photo['u']['name']?></a>
</div>
<div class="ct">
<?php if($this->photo['p'] && !$this->photo['is_profile']):?>
<div class="ct-pf">
โพสต์บนไลน์ของ <span class="av" av="<?php echo $this->photo['p']['_id']?>"><a href="/<?php echo $this->photo['p']['link']?>" class="h" title="<?php echo $this->photo['p']['name']?>"><img src="<?php echo $this->photo['p']['img']?>"></a></span> <a href="/<?php echo $this->photo['p']['link']?>" class="h" title="<?php echo $this->photo['p']['name']?>"><?php echo $this->photo['p']['name']?></a>
</div>
<?php endif?>
<div class="dt">
<?php echo $this->photo['ms']?>
</div>
<?php if($this->photo['pt']['tmp']):?>
<div class="pt">
<a href="/photos/photo-<?php echo $this->photo['_id']?>" onClick="_.api('/me/photos/photo-<?php echo $this->photo['_id']?>');return false;">
<img src="<?php echo $this->photo['pt']['tmp']?>">
</a>
</div>
<?php endif?>

<?php if($this->photo['at']['t']):?>
<div class="vid-tt"><a href="<?php echo $this->photo['at']['l']?>" target="_blank" rel="nofollow"><?php echo $this->photo['at']['t']?></a></div>
<?php endif?>

<?php if($this->photo['at']['i']):?>
<div class="vid-im"><a href="<?php echo $this->photo['at']['l']?>" target="_blank" rel="nofollow"<?php if($this->photo['at']['v']):?> onClick="_.line.embed(this,'<?php echo $this->photo['at']['v']['l']?>',<?php echo $this->photo['at']['v']['w']?>,<?php echo $this->photo['at']['v']['h']?>);return false;"<?php endif?>><img src="http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url=<?php echo urlencode($this->photo['at']['i'])?>&container=focus&gadget=a&rewriteMime=image/*&refresh=31536000&resize_w=500&resize_h=400&no_expand=1"></a></div>
<?php elseif($this->photo['at']['v']):?>
<div class="vid-eb">
<object width="<?php echo $this->photo['at']['v']['h']?>" height="<?php echo $this->photo['at']['v']['h']?>">
    <param name="movie" value="<?php echo $this->photo['at']['v']['l']?>">
    <param name="wmode" value="opaque">
    <embed src="<?php echo $this->photo['at']['v']['l']?>" wmode="opaque" width="<?php echo $this->photo['at']['v']['w']?>" height="<?php echo $this->photo['at']['v']['h']?>"></embed>
</object>
</div>
<?php endif?>
<?php if($this->photo['at']['d']):?>
<div class="vid-dc"><?php echo $this->photo['at']['d']?></div>
<?php endif?>
<?php if($this->photo['lc']):?>
<div>
<div class="mp">
<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo number_format($this->photo['lc']['l'][0],3,'.','').','.number_format($this->photo['lc']['l'][1],3,'.','')?>&markers=color:blue%7Clabel:A%7C<?php echo number_format($this->photo['lc']['l'][0],3,'.','').','.number_format($this->photo['lc']['l'][1],3,'.','')?>&zoom=15&size=490x150&maptype=roadmap&sensor=false" style="margin:5px 0px 5px 5px">

<div class="mp-n">
<?php echo $this->photo['lc']['l']?>
</div>
</div>
</div>
<?php endif?>
<div> 

</div>


<?php 
if($this->photo['sh']['d']):
$sh = $this->photo['sh']['d'];
?>
<div class="sh-z">
<div class="av" av="<?php echo $sh['u']['_id']?>"><a href="/<?php echo $sh['u']['link']?>" class="h" title="<?php echo $sh['u']['name']?>"><img src="<?php echo $sh['u']['img']?>" class="img-uid-<?php echo $sh['u']['_id']?>"></a></div>
<div class="sh-hd-ur"><a href="/<?php echo $sh['u']['link']?>" class="h u"><?php echo $sh['u']['name']?></a> แบ่งปัน<a href="<?php echo $this->photo['is_profile']?'/'.$sh['u']['link']:''?>/line/<?php echo $sh['_id']?>" class="h">โพสต์นี้</a>เป็นคนแรก </div>
<div class="ct">
<div class="dt"><?php echo $sh['ms']?></div>
<?php if($sh['pt']&&$sh['pt']['tmp']):?>
<div class="pt"><a href="/photos/photo-<?php echo $sh['_id']?>" onClick="_.api('/me/photos/photo-<?php echo $sh['_id']?>');return false;"><img src="<?php echo $sh['pt']['tmp']?>"></a></div>
<?php endif?>
<?php if($sh['at']):?>
<div class="vid-tt"><a href="<?php echo $sh['at']['l']?>" target="_blank" rel="nofollow"><?php echo $sh['at']['t']?></a></div>
<?php if($sh['at']['i']):?>
<div class="vid-im"><a href="<?php echo $sh['at']['l']?>" target="_blank" rel="nofollow"<?php if($sh['at']['v']):?> onClick="_.line.embed(this,'<?php echo $sh['at']['v']['l']?>','<?php echo $sh['at']['v']['w']?>','<?php echo $sh['at']['v']['h']?>');return false;"<?php endif?>><img src="http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url=<?php echo urlencode($sh['at']['i'])?>&container=focus&gadget=a&rewriteMime=image/*&refresh=31536000&resize_w=400&resize_h=400&no_expand=1"></a></div>
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
if($this->photo['lc']):
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


<div class="bk">
<span class="lk lk-<?php echo $this->photo['_id']?> <?php echo in_array(_::$my['_id'],(array)$this->photo['lk']['u'])?'like':''?>">
<span onClick="_.api('/me/like/<?php echo $this->photo['_id']?>')" class="like ptr"><i class="show-tooltip-s ptr" title="โดน"></i></span>
<span onClick="_.api('/me/like/<?php echo $this->photo['_id']?>/unlike')" class="unlike ptr"><i class="show-tooltip-s ptr" title="เฉยๆ"></i></span>

<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b lk-c-<?php echo $this->photo['_id']?> ptr2" onClick="_.api('/me/like/<?php echo $this->photo['_id']?>/list')"><?php echo intval($this->photo['lk']['c'])?></span></span>
</span>

<span onClick="_.api('/me/share/<?php echo ($this->photo['ty']=='share'&&$this->photo['sh']['f']&&$this->photo['sh']['d'])?$this->photo['sh']['f']:$this->photo['_id']?>')" class="ptr2"> แบ่งปัน</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sh-c-<?php echo $this->photo['_id']?>"><?php echo intval($this->photo['sh']['c'])?></span></span>

<span onClick="_.profile.cm.pop(<?php echo $this->photo['_id']?>)" class="ptr2"> แสดงความเห็น</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b cm-c-<?php echo $this->photo['_id']?>"><?php echo intval($this->photo['cm']['c'])?></span></span>

<?php if($this->photo['sp']):?>
<span> สแปม</span>
<span class="bk-c"><span class="bk-ca"></span><span class="bk-ca-b sp-c-<?php echo $this->photo['_id']?>"><?php echo intval($this->photo['sp'])?></span></span>
<?php endif?>

</div>

<div class="cm-g">

<div class="cm-d-<?php echo $this->photo['_id']?>">
<?php if($this->photo['cm']['c'] >3):?>
<div class="cm-c cm-l-<?php echo $this->photo['_id']?>"><a href="javascript:;" onClick="_.api('/me/comment/<?php echo $this->photo['_id']?>/list/clear')" class="txt">ดูทุกความคิดเห็น (<span class="cm-c-<?php echo $this->photo['_id']?>"><?php echo $this->photo['cm']['c']?></span>)</a></div>
<?php endif?>


<?php 
if(is_array($this->photo['cm']['d'])):
foreach($this->photo['cm']['d'] as $c):
?>
<div class="cm-s cm-s-<?php echo $c['i']?>">
<div class="av" av="<?php echo $c['u']['_id']?>"><a href="/<?php echo $c['u']['link']?>" class="h" title="<?php echo $c['u']['name']?>"><img src="<?php echo $c['u']['img']?>" class="img-uid-<?php echo $c['u']['_id']?>"></a></div>
<div class="cm-d">
<div class="cm-r"><span class="ago" datetime="<?php echo $c['t']?>"></span> <span class="cm-u"><a href="/<?php echo $c['u']['link']?>" class="h"><?php echo $c['u']['name']?></a></span></div>
<div class="cm-dt"><?php echo $c['m']?></div>
</div>
<p class="clear"></p>
</div>
<?php 
endforeach;
endif;
?>

</div>
<div class="cm-p cm-p-<?php echo $this->photo['_id']?>"></div>
</div>

</div>
<ul class="ac"><li><i onClick="_.line.act(<?php echo $this->photo['_id']?>)"></i><ul></ul></li></ul>
<p class="clear"></p>
</div>



<br><br><br>
<br><br><br>
</div>
<div class="right pf-r">

<div class="ads-box">
<h4 class="cp">สนับสนุนโดย<span><a href="/ads/campaign/" class="h">โฆษณาของคุณ</a></span><p></p></h4>
<span class="ads-top"></span>
<div class="_box"><div class="ads"></div></div>
</div>

</div>
<div class="clear"></div>

<style>
#getphoto .n{width: 283px;float: left;border-radius: 5px;margin: 2px;border: 1px solid #e5e5e5;}
#getphoto .n .av{margin:5px}
#getphoto .n strong{display:block; background:#f8f8f8; padding:5px; color:#0399BE}
#getphoto .n strong a{color:#0399BE}
#getphoto .next{clear:both; width:100%; clear:both; padding:5px 0px; text-align:center;}
#getphoto .next a{display:block; height:30px; line-height:30px; text-align:30px; margin:0px auto; width:570px; border:1px solid #f0f0f0; background-color:#f8f8f8; text-align:center;}
</style>