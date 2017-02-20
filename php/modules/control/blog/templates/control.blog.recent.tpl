<style>
.table thead th{text-align:center !important;}
.table .label-success a{color:#fff !important;}
</style>
<ul class="nav nav-tabs" style="margin-bottom:5px">
  <li><a href="/blog">โพส</a></li>
  <li class="active"><a href="/blog/recent">ใช้งานล่าสุด</a></li>
  <li><a href="/blog/domain">โดเมนทั้งหมด</a></li>
</ul>

<h3>การใช้งานล่าสุด</h3>
<div style="margin:5px 0px 50px;">
<table width="100%" class="table table-striped table-bordered">
<thead><tr><th>เวลา</th><th>Keyword</th><th>Title</th><th>Status</th><th>By</th></tr></thead>
<tbody>
<?php for($i=0;$i<count($this->lastseo);$i++):?>
<tr>
<td align="center"><?php echo $ls=time::show($this->lastseo[$i]['da'],'datetime',1)?></td>
<td align="center"><?php echo $this->lastseo[$i]['kw']?></td>
<td><?php echo $this->lastseo[$i]['t']?></td>
<td>
<?php if($this->lastseo[$i]['st']):?>
<span class="label label-success"><a href="<?php echo $this->lastseo[$i]['l']?>" target="_blank">สำเร็จ</a></span>
<?php else:?>
<span class="label label-important"><?php echo $this->lastseo[$i]['l']?></span>
<?php endif?>
</td>
<td align="center"><?php $u=$this->user->profile($this->lastseo[$i]['u']);?> <a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td>
</tr>
<?php endfor?>
</tbody>
</table>
<div class="text-center"><?php echo $this->pager?></div>
</div>

