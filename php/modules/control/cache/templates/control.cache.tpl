<style>
.table thead tr th{text-align:center;}
.table tbody tr td.c{text-align:center;}
.w100{width:100px;}
.w150{width:150px;}
.wimg{width:30px;}
.wimg img{width:30px;}
</style>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
  <li class="pull-right">
<?php if($this->access):?>
  <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','clearcache')"><i class="icon-refresh"></i> ล้างแคชของระบบ</a>
<?php else:?>
<i class="icon-question-sign"></i> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้
<?php endif?>
   </li>
</ul>
<h3 style="padding:5px 5px 5px 10px; border-bottom:1px solid #ccc; background:#f5f5f5; text-shadow:1px 1px 0px #fff;">Logs การล้างแคชล่าสุด</h3>
<table class="table table-hover" width="100%">
 <thead>
<tr>
<th>โดย</th>
<th>เวลา</th>
</tr>
</thead>
<tbody>
<?php if($this->logs):?>
<?php foreach($this->logs as $v):?>
<?php $u=$this->user->get($v['u'],true);?>
<tr>
<td><a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td>
<td class="c w150"><?php echo time::ago($v['da'])?> ที่ผ่านมา</td>
</tr>
<?php endforeach?>
<?php endif?>
</tbody>
</table>