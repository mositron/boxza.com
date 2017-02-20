<style>


.hforum thead tr{background:#f0f0f0; height:30px; line-height:30px; font-weight:bold;}
.hforum tr.l0{background:#fff}
.hforum tr.l1{background:#f9f9f9}
.hforum i.i0{ width:17px; height:15px; display:inline-block;background:url(http://s0.boxza.com/static/images/football/icon.png) -440px -150px no-repeat;}
.hforum i.i1{ width:17px; height:17px; display:inline-block;background:url(http://s0.boxza.com/static/images/football/icon.png) -420px -150px no-repeat;}
.hforum a{color:#333;}
.hforum td{color:#555}
.hforum .ticon{width:17px; vertical-align:middle; text-align:center;}

.hforum .tcate,.hforum .tcate p{width:100px;}
.hforum .ttitle,.hforum .ttitle p{width:240px;}
.hforum .ttitle2,.hforum .ttitle2 p{width:200px;}
.hforum .tpost,.hforum .tpost p{width:100px; text-align:center;}
.hforum .tview{width:50px; text-align:center; vertical-align:middle; color:#74C7FA;}
.hforum .treply{width:50px; text-align:center; vertical-align:middle; color:#F6921E;}
.hforum .ttime,.hforum .ttime p{width:150px; text-align:center;}
.hforum p{overflow:hidden; white-space:nowrap; height:16px; line-height:16px;text-overflow:ellipsis;}

</style>
<div class="row-fluid">



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/forum"><i class="icon-comment"></i> กระทู้ล่าสุด</a></li>
</ul>

<ul class="nav nav-tabs" style="margin-bottom:5px">
  <li<?php echo $this->o=='_id'?' class="active"':''?>><a href="/forum">กระทู้ล่าสุด</a></li>
  <li<?php echo $this->o!='_id'?' class="active"':''?>><a href="/forum/o-ds">ตอบล่าสุด</a></li>
</ul>


<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th><th>Adsense</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="http://forum.boxza.com/topic/<?php echo $val['_id']?>" target="_blank"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php 
	if($val['cm']['d']):
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime',true)?>
     <?php else:?>
    	<?php echo time::show($val['ds'],'datetime',true)?>
    <?php endif?></p>
	</td>
    <td class="treply"><?php if($val['ads']):?><i class="icon-ok"></i><?php endif?></td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>

<div style="text-align:center"><?php echo $this->pager?></div>
</div>
