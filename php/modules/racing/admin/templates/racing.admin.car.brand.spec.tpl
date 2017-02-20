

<table width="100%" class="table">
<thead>
<tr>
<th>ชื่อรุ่น</th>
<th>ชื่อรุ่น (ไทย)</th>
<th>ประเภท</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->spec);$i++):?>
<tr>
<?php echo $this->html->td('spec_en_'.$this->spec[$i]['_id'],$this->spec[$i]['en'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
<?php echo $this->html->td('spec_th_'.$this->spec[$i]['_id'],$this->spec[$i]['th'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
<?php echo $this->html->td('spec_type_'.$this->spec[$i]['_id'],$this->spec[$i]['type'],'select',array('full'=>10,'enabled'=>$this->canedit),$this->spectype)?>
<td></td>
<td><a href="/admin/car/<?php echo $this->brand['link']?>/<?php echo $this->spec[$i]['link']?>"><i class="icon-edit"></i></a></td>
</tr>
<?php endfor?>
</tbody>
</table>
