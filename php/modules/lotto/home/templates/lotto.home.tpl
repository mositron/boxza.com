<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<?php if($this->lotto_last['_id']!=$this->lotto[0]['_id']):?>
<h2 style="padding:5px; margin:5px 0px 5px 0px;color:#6D6E70; text-align:center">ตรวจหวย ตรวจสลากกินแบ่งรัฐบาลงวดที่ <?php echo time::show($this->lotto_last['tm'],'date')?></h2>
<div style="padding:10px; text-align:center; border:1px solid #f0f0f0; background:#f9f9f9; font-size:14px">กำลังรออัพเดทข้อมูลสำหรับ หวย สลากกินแบ่งรัฐบาลงวดที่ <?php echo time::show($this->lotto_last['tm'],'date')?></div>

<?php endif?>


<div class="hidden-phone" style="text-align:right; padding:2px 5px; margin-bottom:5px; background:#f5f5f5;">
        <form method="post" action="http://lotto.boxza.com/search" style="margin: 3px 0px 0px 0px;color: white;padding: 0px;">
            <span style="color:#333;">ตรวจสลาก</span>
            <input type="text" name="lotto" class="tbox" placeholder="กรอกเลขสลากของคุณ" style="width:150px; text-indent:5px;">
            <select name="lotto_date" class="tbox" style="width:170px;">
                <?php foreach($this->lotto_all as $v):?>
                <option value="<?php echo $v['_id']?>"><?php echo time::show($v['tm'],'date')?> </option>
                <?php endforeach?>
            </select>
            <input type="submit" class="btn" style="margin:0px" value=" ค้นหา ">
        </form>
</div>

<!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="margin:0px 0px 5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->

<h2 style="padding:5px; margin:5px 0px 5px 0px;color:#6D6E70; text-align:center">ตรวจหวย ตรวจสลากกินแบ่งรัฐบาลงวดที่ <?php echo time::show($this->lotto[0]['tm'],'date')?></h2>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<table class="table lotto">
<tbody>
<tr>
<td>
<strong>ตรวจหวย รางวัลที่ 1</strong>
<div class="n1"><span><?php echo $this->lotto[0]['a1']?$this->lotto[0]['a1']:'รอประกาศผล'?></span></div>
</td>
<td>
<strong>ตรวจหวย เลขท้าย 3 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[0]['l3']?implode('</span><span>',$this->lotto[0]['l3']):'รอประกาศผล'?></span></div>
</td>
<td>
<strong>ตรวจหวย เลขท้าย 2 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[0]['l2']?$this->lotto[0]['l2']:'รอประกาศผล'?></span></div>
</td>
</tr>
<tr>
<td><p>รางวัลละ 2,000,000 บาท</p></td>
<td><p>รางวัลละ 2,000 บาท</p></td>
<td><p>รางวัลละ 1,000 บาท</p></td>
</tr>
<tr>
<td>
<strong>ข้างเคียงรางวัลที่ 1</strong>
<div class="n2"><span><?php if($this->lotto[0]['a1']):?><?php echo $this->lotto[0]['a1']-1?></span><span><?php echo $this->lotto[0]['a1']+1?><?php else:?>รอประกาศผล<?php endif?></span></div>
</td>
<td colspan="2">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 2</strong>
<div class="n2"><span><?php echo $this->lotto[0]['a2']?implode('</span><span>',$this->lotto[0]['a2']):'รอประกาศผล'?></span></div>
</td>
</tr>
<tr>
<td><p>รางวัลละ 50,000 บาท</p></td>
<td colspan="2"><p>รางวัลละ 100,000 บาท</p></td>
</tr>
<tr><td colspan="3"><?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?></td></tr>
<tr>
<td colspan="3">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 3</strong>
<p>รางวัลละ 40,000 บาท</p>
<div class="n3"><span><?php echo $this->lotto[0]['a3']?implode('</span><span>',$this->lotto[0]['a3']):'รอประกาศผล'?></span></div>
</td>
</tr>
<tr>
<td colspan="3">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 4</strong>
<p>รางวัลละ 20,000 บาท</p>
<div class="n3">
<?php for($i=0;$i<count($this->lotto[0]['a4']);$i++):?><span><?php echo $this->lotto[0]['a4'][$i]?></span><?php echo ($i%10==9)?'<br>':''?><?php endfor?>
</div>
</td>
</tr>
<tr>
<td colspan="3">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 5</strong>
<p>รางวัลละ 10,000 บาท</p>
<div class="n3">
<?php for($i=0;$i<count($this->lotto[0]['a5']);$i++):?><span><?php echo $this->lotto[0]['a5'][$i]?></span><?php echo ($i%10==9)?'<br>':''?><?php endfor?>
</div>
</td>
</tr>
</tbody>
</table>

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

<h3 style="padding:5px; margin:5px 0px 5px 0px;color:#6D6E70; text-align:center"><a href="/set">หวยหุ้น หวยหุ้นวันนี้ หวยหุ้นวันที่ <?php echo time::show($this->set[0]['tm'],'date')?></a></h3>
<table class="table table-bordered lotto2">
<thead>
<tr>
<th colspan="2" class="s">เปิดเช้า</th>
<th colspan="2" class="s">ปิดเที่ยง</th>
<th colspan="2" class="s">เปิดบ่าย</th>
<th colspan="2" class="s">ปิดเย็น</th>
</tr>
<tr>
<th class="p">บน</th>
<th class="p">ล่าง</th>
<th class="p">บน</th>
<th class="p">ล่าง</th>
<th class="p">บน</th>
<th class="p">ล่าง</th>
<th class="p">บน</th>
<th class="p">ล่าง</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $this->set[0]['t11']?></td>
<td><?php echo $this->set[0]['t12']?></td>
<td><?php echo $this->set[0]['t21']?></td>
<td><?php echo $this->set[0]['t22']?></td>
<td><?php echo $this->set[0]['t31']?></td>
<td><?php echo $this->set[0]['t32']?></td>
<td><?php echo $this->set[0]['t41']?></td>
<td><?php echo $this->set[0]['t42']?></td>
</tr>
</tbody>
</table>

<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลข่าวหวย เลขเด็ดหวย: 
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>/rss" title="บริการข้อมูลข่าวหวย เลขเด็ดหวย โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลข่าวหวย เลขเด็ดหวย โดย RSS Feed"></a>
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>/json" title="บริการข้อมูลข่าวหวย เลขเด็ดหวย โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลข่าวหวย เลขเด็ดหวย โดย JSON"></a>
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>/json/change_callback_function_here" title="บริการข้อมูลข่าวหวย เลขเด็ดหวย โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลข่าวหวย เลขเด็ดหวย โดย JSONP"></a>
</div>
</div>

<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; background:#f9f9f9"><a href="/news" title="ข่าวหวย เลขเด็ดหวย">เลขเด็ด หวย สลากกินแบ่งรัฐบาล</a></h3>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>
<?php if($this->topic):?>
<h3 class="forum_cp" style="margin:5px 0px"><a href="/forum" target="_blank">กระทู้หวย</a></h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>" target="_blank"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>" target="_blank"><?php echo $p['name']?></a></p></td>
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
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
<?php endif?>

<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; background:#f9f9f9">ความคิดเห็น</h3>
<div class="fb-comments" data-href="http://lotto.boxza.com/" data-num-posts="10" data-width="710"></div>