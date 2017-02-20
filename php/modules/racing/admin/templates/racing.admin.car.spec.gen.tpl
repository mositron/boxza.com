

<table width="100%" class="table">
<thead>
<tr>
<th></th>
<th>ชื่อรุ่น/ตัวถัง</th>
<th>ชื่อรุ่น/ตัวถัง (ไทย)</th>
<th>เริ่มขาย</th>
<th>ถึง</th>
<th></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->spec);$i++):?>
<tr>
<td><img src="http://s3.boxza.com/racing/brand/<?php echo $this->brand['link']?>/<?php echo $this->spec['link']?>/<?php echo $this->gen[$i]['_id']?>.png"></td>
<?php echo $this->html->td('gen_en_'.$this->gen[$i]['_id'],$this->gen[$i]['en'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
<?php echo $this->html->td('gen_th_'.$this->gen[$i]['_id'],$this->gen[$i]['th'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
<?php echo $this->html->td('gen_from_'.$this->gen[$i]['_id'],$this->gen[$i]['from'],'select',array('full'=>10,'enabled'=>$this->canedit),$this->year)?>
<?php echo $this->html->td('gen_to_'.$this->gen[$i]['_id'],$this->gen[$i]['to'],'select',array('full'=>10,'enabled'=>$this->canedit),$this->year)?>
<td><a href="/admin/car/<?php echo $this->brand['link']?>/<?php echo $this->spec[$i]['link']?>/<?php echo $this->gen[$i]['_id']?>"><i class="icon-edit"></i></a></td>
</tr>
<?php endfor?>
</tbody>
</table>
