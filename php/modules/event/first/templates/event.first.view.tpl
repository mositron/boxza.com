<div class="navbar">
  <div class="navbar-inner" style="padding-top:3px;">
    <ul class="nav">
      <li><a href="/first"><i class="icon-home"></i> กิจกรรม</a></li>
    	<li class="divider-vertical"></li>
      <li><a href="/first/list"><i class="icon-list"></i> รูปภาพทั้งหมด</a></li>
    	<li class="divider-vertical"></li>
      <li class="active"><a href="/first/<?php echo $this->photo['_id']?>"><i class="icon-th"></i> รายละเอียดรูปภาพ</a></li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="/first/apply"><i class="icon-plus-sign"></i> ลงทะเบียนร่วมกิจกรรม</a></li>
  </ul>
  </div>
</div>

<div class="box-view" title="ร่วมสนุกกับกิจกรรม Boxza แค่เปิดกล่องก็สนุก"><a href="/first"></a></div>
<div class="from-user">ภาพจาก <a href="http://boxza.com/<?php echo $this->u['link']?>" target="_blank"><?php echo $this->u['name']?></a></div>
<div>
<div style="width:620px; float:left; padding:10px 0px; background:#F1F2F2; text-align:center;">
<img src="http://s3.boxza.com/event/first/<?php echo $this->photo['fd']?>/<?php echo $this->photo['n']?>.l.<?php echo $this->photo['ty']?>" alt="<?php echo $this->photo['t']?>">
</div>
<div style="width:350px; float:right">
<span style="display:inline-block; background:#F7941E; padding:5px 10px; color:#fff; font-size:16px">คะแนนปัจจุบัน <strong class="vote-count"><?php echo number_format($this->photo['v'])?></strong> โดน</span> 
<a name="fb_share" type="button_count" share_url="<?php echo URI?>" href="http://www.facebook.com/sharer.php"></a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<br>
<div style="padding:5px;">
<p class="bar-cp">คำบรรยายภาพ</p>
<div><?php echo $this->photo['t']?></div>

<?php if(_::$my&&_::$my['am']>=9):?>
<div class="alert" style="margin:10px 0px">
แบนข้อหา:
<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','setban','ไม่มีกล่องอยู่ภายในรูปภาพ')" class="btn btn-info">ไม่มีกล่อง</a> 
<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','setban','ไม่มีหน้าผู้ส่งเข้าประกวดอยู่ในรูปภาพ')" class="btn btn-info">ไม่มีหน้า</a> 
<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','setban','มีการตัดต่อภาพบุคคลหรือภาพกล่อง')" class="btn btn-info">ตัดต่อ</a> <br>
<div style="margin:10px 0px 0px">
<a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','setban','')" class="">ยกเลิกการแบน</a><?php if(EVENT_ENABLED==1):?>  - <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','incbyadmin')">เพิ่ม 1 คะแนน</a><?php endif?>
</div>
</div>
<?php if($this->pump):?>
<div class="alert alert-info" style="margin:0px 0px 10px">
เยี่ยมชมล่าสุด: <?php echo time::show($this->photo['lv'],'datetime')?>
</div>
<?php endif?>
<?php endif?>

<?php if($this->photo['dl']):?>
<div style="border:1px solid #f00; padding:10px; color:#f00;">
รูปภาพนี้ผิดกติกาเนื่องจาก: <?php echo $this->photo['dl']?>
</div>
<?php elseif(EVENT_ENABLED!=1):?>
<p class="bar-cp">กิจกรรมนี้ปิดรับการโหวตแล้ว</p>
<?php else:?>
<p class="bar-cp">โหวตให้รูปนี้</p>
<input type="button" onClick="_.ajax.gourl('<?php echo URL?>','vote','<?php echo $this->key?>');" class="btn-vote" value="         โดนใจ"> (คุณโหวตได้ 1 <?php #echo (_::$my&&_::$my['st']>0?3:1)?> คะแนน)

<?php endif?>

<?php if($this->photo['pf']):?>
<div class="alert alert-info" style="margin:10px 0px;">
 รูปภาพนี้ได้รับคะแนนพิเศษ ไอเดียสุดเจ๋ง <?php echo $this->photo['pf']?> คะแนน
</div>
<?php endif?>
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/event/first/'.$this->photo['fd'].'/'.$this->photo['n'].'.l.'.$this->photo['ty'])?>&description=" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo urlencode(URI)?>"></g:plusone></div>
<div><fb:like href="<?php echo urlencode(URI)?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<p class="clear"></p>
</div>


<div style="padding:5px; border:1px solid #eee; background:#f7f7f7">
<strong>ระดับคะแนนโหวต</strong><br>
<!--- สมาชิกยืนยันการสมัครแล้ว: 3 คะแนน<br>-->
- สมาชิก: 1 คะแนน<br>
- บุคคลทั่วไป: 1 คะแนน<br>
- สามารถโหวตได้ 1ครั้ง/<?php echo EVENT_HOUR?>ชั่วโมง *<br>
<span style="color:#f00">
หากมีการปั่นไอดีเพื่อมาโหวตหรือการมีโกงอื่นๆ ทีมงานจะทำการปิดการโหวตของรูปภาพนั้นทันที
</span>
</div>

<p class="bar-cp">คะแนนโหวตล่าสุด</p>
<?php if($this->voter):?>
<table cellpadding="5" cellspacing="1" class="tbservice" width="100%">
<?php for($i=0;$i<count($this->voter);$i++):?>
<tr>
<td>
<?php 
if($this->voter[$i]['u']):
	$u=$this->user->profile($this->voter[$i]['u'],true);
	echo '<a href="http://boxza.com/'.$u['link'].'" target="_blank">'.$u['name'].'</a>'.($u['st']<0?' - banned':'');
else:
	echo 'บุคคลทั่วไป';
endif;
?>
</td>
<!--td><?php echo preg_replace('/\.([0-9]+)$/','.xxx',$this->voter[$i]['ip'])?></td-->
<td align="right"><?php echo time::show($this->voter[$i]['da'],'datetime')?></td>
</tr>
<?php endfor?>
</table>
<?php else:?>
- ยังไม่มีผู้โหวต -
<?php endif?>
</div>
</div>
<p class="clear"></p>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a href="javascript:;">ผู้เข้าประกวดอื่นๆ</a></li>
  <li><a href="/first/list">ผู้เข้าประกวดทั้งหมด</a></li>
  <li><a href="/first/apply">สมัครเข้าร่วมกิจกรรม</a></li>
</ul>
<ul class="event-photo">
<?php for($i=0;$i<count($this->last);$i++):?>
<li<?php echo $this->last[$i]['pf']?' class="event-photo-top"':''?>>
<div>
<a href="/first/<?php echo $this->last[$i]['_id']?>"><img src="http://s3.boxza.com/event/first/<?php echo $this->last[$i]['fd']?>/<?php echo $this->last[$i]['n']?>.t.<?php echo $this->last[$i]['ty']?>" alt="<?php echo $this->last[$i]['t']?>"></a>
<p><?php echo $this->last[$i]['t']?></p>
</div>
</li>
<?php if($i%5==4):?><p class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>


<div>
<h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f0f0f0;">แสดงความคิดเห็นด้วย Facebook</h4>
<div class="fb-comments" data-href="http://event.boxza.com/first/<?php echo $this->photo['_id']?>" data-num-posts="30" data-width="980"></div>
</div>