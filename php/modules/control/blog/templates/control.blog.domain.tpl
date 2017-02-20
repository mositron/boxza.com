<style>
.table thead th{text-align:center !important;}
.table .label-success a{color:#fff !important;}
</style>
<ul class="nav nav-tabs" style="margin-bottom:5px">
  <li><a href="/blog">โพส</a></li>
  <li><a href="/blog/recent">ใช้งานล่าสุด</a></li>
  <li class="active"><a href="/blog/domain">โดเมนทั้งหมด</a></li>
</ul>
<h3>โดนเมนทั้งหมด</h3>
<div style="margin:5px 0px 50px;">
<table width="100%" class="table table-striped table-bordered">
<thead><tr><th>โดเมน</th><th width="150">ใช้ล่าสุด</th></tr></thead>
<tbody>
<?php for($i=0;$i<count($this->domain);$i++):?>
<tr>
<td align="center"><a href="http://<?php echo $this->domain[$i]['d']?>" target="_blank"><?php echo $this->domain[$i]['d']?></a></td>
<td align="center"><?php echo $ls=time::show($this->domain[$i]['ds'],'datetime',1)?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</div>

