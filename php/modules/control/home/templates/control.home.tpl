<style>
.table thead tr th{text-align:center;}
.table tbody tr td.c{text-align:center;}
.w80{width:80px;}
.w100{width:100px;}
.w130{width:130px;font-size:13px;}
.w200{width:200px; font-size:13px;}
.wimg{width:40px;}
.wimg img{width:40px;}
</style>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
  <li class="pull-right">
<?php if(_::$my['am']==9):?>
   <?php if($_GET['cmd']=='editing'):?>
  <a href="<?php echo URL?>"><i class="icon-ok"></i> แก้ไขเสร็จเรียบร้อย</a>
  <?php $enabled=true;?>
   <?php else:?>
  <a href="?cmd=editing"><i class="icon-edit"></i> แก้ไข</a>
  <?php $enabled=false;?>
   <?php endif?>
<?php else:?>
<i class="icon-question-sign"></i> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้
<?php endif?>
   </li>
</ul>

<form onSubmit="_.ajax.gourl('<?php echo URL?>','setadmin',this);return false">
<table class="table table-hover" width="100%">
 <thead>
<tr>
<th>#</th>
<th>รูป</th>
<th>ชื่อ</th>
<th>สิทธิ์</th>
<th>ใช้งานล่าสุด</th>
</tr>
</thead>
<tbody>
<?php foreach($this->admin as $v):?>
<?php $u=$this->user->get($v['_id'],true);?>
<tr>
<td class="c w80"><?php echo $u['_id']?></td>
<td class="c wimg"><a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><img src="<?php echo $u['img']?>"></a></td>
<td><a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a> - (ระดับ <?php echo $u['am']?>)<br><?php echo $u['em']?>
<?php if($u['google']):?>(<a href="http://plus.google.com/<?php echo $u['google']['id']?>" target="_blank">Google+</a>)<?php endif?>
</td>
<td class="c w200">
<?php if($_GET['cmd']=='editing'):?>
<div style="text-align:left;">
<?php if($v['am']!=9):?>
<?php if(!is_array($v['if']['am']))$v['if']['am']=array();?>
<?php foreach($this->key as $k2=>$v2):?>
<label><input type="checkbox" name="perm_<?php echo $v['_id']?>" value="<?php echo $k2?>"<?php echo in_array($k2,$v['if']['am'])?' checked':''?>> <?php echo $v2['t']?></label>
<?php endforeach?>
<?php endif?>
</div>
<?php else:?>
<?php if($v['am']==9):?>
-ทั้งหมด-
<?php elseif(is_array($v['if']['am'])):?>
<?php $i=0;foreach($v['if']['am'] as $k):?><?php echo ($i>0?', ':'')?><a href="/<?php echo $k?>"><?php echo $this->key[$k]['t']?></a><?php $i++;endforeach?>
<?php else:?>
-
<?php endif?>
<?php endif?>
</td>
<td class="c w130"><?php echo time::ago($v['du'])?> ที่ผ่านมา</td>
</tr>
<?php endforeach?>
<?php if($_GET['cmd']=='editing'):?>
<tr><td colspan="5" class="c">
<input type="submit" value=" บันทึก " class="btn brn-primary">
</td></tr>
<?php endif?>
</tbody>
</table>
</form>