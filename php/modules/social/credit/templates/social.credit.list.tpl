<?php if(count($this->point)):?>
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<?php
	for($i=0;$i<count($this->point);$i++):
?>
<tr>
<td class="t"><?php echo time::show($this->point[$i]['da'],'datetime',true)?></td>
<td class="p"><?php echo ($this->point[$i]['p']>0?'<span>+'.$this->point[$i]['p'].'</span>':$this->point[$i]['p'])?></td>
<td><?php echo $this->point[$i]['m']?></td>
</tr>
<?php endfor?>
</table>
<?php if($this->next):?>
<div class="next"><a href="javascript:;" onClick="_.ajax.gourl('/credit/?start=<?php echo $this->next?>','morecredit');$(this).html('กรุณารอซํกครู่..').attr('onclick','')">โหลดข้อมูลเพิ่มเติม</a></div>
<?php endif?>

<?php endif?>