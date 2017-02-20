
<h3 class="hh"><div>เกมส์ยอดฮิต</div></h3>
<ul class="gh">
<?php foreach($this->hit as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>

<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<div style="background:#fff;border-radius: 5px;padding-bottom: 5px;">
<h3 class="hn"><div>เกมส์มาใหม่</div></h3>
<ul class="gh">
<?php $i=0;foreach($this->new as $k=>$v):?>
<li<?php echo $i>3?' class="t"':''?>>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/<?php echo $i>3?'t':'l'?>.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
</div>
<div style="background:#fff;border-radius: 5px;padding-bottom: 5px;">
<h3 class="hc"><div>เกมส์แนะนำ</div></h3>
<ul class="gh">
<?php $i=0;foreach($this->rec as $k=>$v):?>
<li<?php echo $i>3?' class="t"':''?>>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/<?php echo $i>3?'t':'l'?>.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
</div>
<div style="background:#fff;border-radius: 5px;padding-bottom: 5px; margin-top:8px;">
<div>
<div class="bc1">
<h3 class="ha"><a href="/flash/c-27"><i class="c27"></i><span class="cufon">เกมส์ทําอาหาร</span></a></h3>
<ul class="gc">
<?php foreach($this->c27 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<div class="bc2">
<h3 class="ha"><a href="/flash/c-95"><i class="c95"></i><span class="cufon">เกมส์แต่งตัว</span></a></h3>
<ul class="gc">
<?php foreach($this->c95 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<p class="clear"></p>
<div class="bc1">
<h3 class="ha"><a href="/flash/c-5"><i class="c5"></i><span class="cufon">เกมส์จับคู่</span></a></h3>
<ul class="gc">
<?php foreach($this->c5 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<div class="bc2">
<h3 class="ha"><a href="/flash/c-20"><i class="c20"></i><span class="cufon">เกมส์ต่อสู้</span></a></h3>
<ul class="gc">
<?php foreach($this->c20 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<p class="clear"></p>
<div class="bc1">
<h3 class="ha"><a href="/flash/c-37"><i class="c37"></i><span class="cufon">เกมส์ปลูกผัก</span></a></h3>
<ul class="gc">
<?php foreach($this->c37 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<div class="bc2">
<h3 class="ha"><a href="/flash/c-52"><i class="c52"></i><span class="cufon">เกมส์รถแข่ง</span></a></h3>
<ul class="gc">
<?php foreach($this->c52 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<p class="clear"></p>
<h3 class="ha"><a href="/flash/c-82"><i class="c82"></i><span class="cufon">เกมส์เต้น</span></a></h3>
<ul class="gc">
<?php foreach($this->c82 as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/t.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>

</div>


<?php if($this->topic):?>
<h3 class="hb" style="margin:-5px 0px 0px">อัพเดทกระทู้ล่าสุด</h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php 
	if($val['cm']['d']):
	?>
    	<?php echo time::show($val['cm']['d'][0]['t'],'datetime')?>
     <?php else:?>
     <?php echo time::show($val['ds'],'datetime')?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
<?php endif?>


<div style="margin: 5px 0px 0px 0px;background: #eee;padding: 2px 5px;"><h3>เกมส์ flash</h3></div>
<ul class="nav-cate">
<?php foreach($this->cate as $k=>$v): if($k>50)break;?>
<li><a href="/flash/c-<?php echo $k?>" title="เกมส์<?php echo $v['t']?>">เกมส์<?php echo $v['t']?></a></li>
<?php endforeach?>
<p class="clear"></p>
</ul>
