

<?php for($i=0;$i<count($this->photo);$i++):?>

<li>
<div>
<div class="i"><img src="http://s1.boxza.com/line/<?php echo $this->photo[$i]['pt']['f']?>/s.<?php echo $this->photo[$i]['pt']['e']?>"></div>

<?php if(($this->album['pt']['cv']['i']!=$this->photo[$i]['_id']) && !$this->album['lo']):?>
<p class="cover show-tooltip-s" title="ตั้งเป็นปกอัลบั้ม" onClick="_.ajax.gourl('<?php echo URL?>','setcover',<?php echo $this->photo[$i]['_id']?>)"></p>
<?php endif?>
<p class="detail show-tooltip-s" title="แก้ไขข้อมูลรูปภาพ" onClick="_.ajax.gourl('<?php echo URL?>','getdetail',<?php echo $this->photo[$i]['_id']?>)"></p>
<p class="del show-tooltip-s" title="ลบรูปภาพ" onClick="pt_del(<?php echo $this->photo[$i]['_id']?>)"></p>
</div>
</li>
<?php if($i%4==3):?> <p class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>