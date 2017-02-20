

<?php for($i=0;$i<count($this->photo);$i++):?>

<li class="ln-<?php echo $this->photo[$i]['_id'].($this->album['pt']['cv']['i']==$this->photo[$i]['_id']?' ln-cover':'')?>" data-line="<?php echo $this->photo[$i]['_id']?>" data-share="<?php echo $this->photo[$i]['sh']['f']?$this->photo[$i]['sh']['f']:$this->photo[$i]['_id']?>" data-like="<?php echo in_array(_::$my['_id'],(array)$this->photo[$i]['lk']['u'])?' like':''?>" data-w="<?php echo $this->photo[$i]['pt']['w']?>" data-h="<?php echo $this->photo[$i]['pt']['h']?>" data-lk="<?php echo $this->photo[$i]['lk']['c']?>" data-ss="<?php echo $this->photo[$i]['sh']['c']?>">
<div>
<div class="i">
<a href="/photos/photo-<?php echo $this->photo[$i]['_id']?>"<?php if(_::$my):?> onClick="_.api('/me/photos/photo-<?php echo $this->photo[$i]['_id']?>');return false"<?php endif?>><img src="<?php echo $this->photo[$i]['pt']['tmp']?>"></a>
</div>
<?php if($this->photo[$i]['cm']['d']):?>
<div class="c">
<?php for($j=0;$j<count($this->photo[$i]['cm']['d']);$j++):
	$k=$this->photo[$i]['cm']['d'][$j];
	?>
<div>
<span class="av" av="<?php echo $k['u']['_id']?>">
<a href="/<?php echo $k['u']['name']?>" class="h" title="<?php echo $k['u']['name']?>">
<img src="<?php echo $k['u']['img']?>">
</a>
</span>
<p><?php echo $k['m']?></p>
</div>
<?php endfor?>
</div>
<?php endif?>
<?php if(_::$my['_id']==$this->photo[$i]['u']):?>

<?php if(($this->album['pt']['cv']['i']!=$this->photo[$i]['_id']) && !$this->album['lo']):?>
<p class="cover show-tooltip-s" title="ตั้งเป็นปกอัลบั้ม" onClick="_.ajax.gourl('/photos','setcover',<?php echo $this->album['_id']?>,<?php echo $this->photo[$i]['_id']?>)"></p>
<?php endif?>
<p class="filter show-tooltip-s" title="แก้ไขรูปภาพ" onClick="_.ajax.gourl('/photos','editfilter',<?php echo $this->photo[$i]['_id']?>)"></p>
<p class="del show-tooltip-s" title="ลบรูปภาพ" onClick="_.profile.pt.del(<?php echo $this->photo[$i]['_id']?>)"></p>

<?php endif?>
</div>
</li>
<?php endfor?>


<?php if($this->next):?>
<div class="next"><a href="javascript:;" onClick="_.ajax.gourl('/photos','morephotos',<?php echo $this->next?>); $(this).parent().remove();">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>
