<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.css">
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.js"></script>



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/adsense"><i class="icon-tags"></i> จำนวนคลิก Adsense</a></li>
</ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">Adsense วันที่ <?php echo time::show(new mongodate(strtotime($this->date)),'date')?></h2>

<style>
.table th{text-align:center;}
.table .r{text-align:center; width:100px;}
.table div{ white-space:nowrap; height:16px; line-height:16px;text-overflow:ellipsis; overflow:hidden; width:600px}
.table div a{color:#555;}
</style>
<div style="padding:5px; background:#f0f0f0; color:#000;">สถิติ 100 หน้าแรกที่มีจำนวนการคลิกโฆษณามากที่สุด</div>
<table class="table" width="100%">
<thead>
<th>หน้าเว็บ</th><th>จำนวนคลิก</th>
</thead>
<tbody>
<?php for($i=0;$i<count($this->stats);$i++):$v=$this->stats[$i];?>
<tr>
<td><div><a href="<?php echo $v['u']?>" target="_blank"><?php echo $v['t']?></a></div></td>
<td class="r"><?php echo $v['c']?></td>
</tr>
<?php endfor?>
</tbody>
</table>

<?php /*
<style>
.tblast tr th{ text-align:center;}
.tblast .t{width:100px; text-align:center}
.tblast .s{width:50px; text-align:center}
.tblast .b{ text-align:left; font-size:11px}
</style>

<h4 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">การคลิก 100 ครั้งล่าสุด</h4>

<table class="table table-striped table-bordered tblast" width="100%">
<thead>
<tr>
<th class="t">Time</th>
<th class="t">IP</th>
<th>User-Agent</th>
<th>Service</th>
<th>Position</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->last);$i++):?>
<tr>
<td class="t"><?php echo time::show($this->last[$i]['da'],'datetime',true)?></td>
<td class="t"><?php echo $this->last[$i]['ip']?></td>
<td class="b"><?php echo $this->last[$i]['ua']?></td>
<td class="s"><?php echo $this->last[$i]['p']?></td>
<td class="s"><?php echo strtoupper($this->last[$i]['s'])?></td>
</tr>
<?php endfor?>
</tbody>
</table>


*/
?>






