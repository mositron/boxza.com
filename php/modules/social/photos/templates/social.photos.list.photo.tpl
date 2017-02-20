

<?php for($i=0;$i<count($this->photo);$i++):?>

<li class="ln-<?php echo $this->photo[$i]['_id']?>" data-line="<?php echo $this->photo[$i]['_id']?>" data-share="<?php echo $this->photo[$i]['sh']['f']?$this->photo[$i]['sh']['f']:$this->photo[$i]['_id']?>" data-like="<?php echo in_array(_::$my['_id'],(array)$this->photo[$i]['lk']['u'])?' like':''?>" data-w="<?php echo $this->photo[$i]['pt']['w']?>" data-h="<?php echo $this->photo[$i]['pt']['h']?>" data-lk="<?php echo $this->photo[$i]['lk']['c']?>" data-ss="<?php echo $this->photo[$i]['sh']['c']?>">
<div>
<div class="i">
<a href="/photos/photo-<?php echo $this->photo[$i]['_id']?>"<?php if(_::$my):?> onClick="_.api('/me/photos/photo-<?php echo $this->photo[$i]['_id']?>');return false"<?php else:?> class="h"<?php endif?>><img src="<?php echo $this->photo[$i]['pt']['tmp']?>"></a>
</div>
<div class="t">
<span><?php echo intval($this->photo[$i]['lk']['c'])?> โดน</span>
<span><?php echo intval($this->photo[$i]['sh']['c'])?> แบ่งปัน</span>
<span><?php echo intval($this->photo[$i]['cm']['c'])?> ความเห็น</span>
</div>
<div class="d">
<span class="av" av="<?php echo $this->photo[$i]['u']['_id']?>">
<a href="/<?php echo $this->photo[$i]['u']['link']?>" class="h" title="<?php echo $this->photo[$i]['u']['name']?>">
<img src="<?php echo $this->photo[$i]['u']['img']?>">
</a>
</span>
<h4><?php echo $this->photo[$i]['u']['name']?></h4>
<div class="clear"></div>
</div>
<?php if($this->photo[$i]['cm']['d']):?>
<div class="c">
<?php for($j=0;$j<count($this->photo[$i]['cm']['d']);$j++):
	$k=$this->photo[$i]['cm']['d'][$j];
?>
<div>
<span class="av" av="<?php echo $k['u']['_id']?>">
<a href="/<?php echo $k['u']['link']?>" class="h" title="<?php echo $k['u']['name']?>">
<img src="<?php echo $k['u']['img']?>">
</a>
</span>
<p><?php echo $k['m']?></p>
</div>
<?php endfor?>
</div>
<?php endif?>
</div>
</li>
<?php endfor?>



<?php if($this->next):?>
<div class="pt-next"><a href="javascript:;" onClick="_.ajax.gourl('/photos','morephotos',<?php echo $this->next?>); $(this).parent().remove();">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>
