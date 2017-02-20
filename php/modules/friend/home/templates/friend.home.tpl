<div class="row-fluid">
<div class="span8 col-content">

<h3 class="hn" style="background:#FFCFD9; margin-top:5px;">แชท สนทนา พูดคุย หาเพื่อนคุย</h3>
<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin-bottom:5px;">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<iframe frameborder="0" width="100%" height="450" src="http://s0.boxza.com/static/chat/?r=1&sound=0&radio=0"></iframe>



<!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<div class="hr">
<h3><i></i> เพื่อนแนะนำ</h3>
<div>
<ul class="thumbnails row-count-4">
<?php foreach($this->rec as $v):?>
<li class="span3">
<a href="msnim:add?contact=<?php echo $v['em']?>"><img src="http://s3.boxza.com/msn/rec/<?php echo $v['fd'].'/'.$v['pt']?>" alt="<?php echo $v['em']?>">
<span class="<?php echo $v['ty']?>"><?php echo $this->type[$v['ty']]?><i></i></span>
</a>
<p><i></i><a href="msnim:add?contact=<?php echo $v['em']?>"><?php echo $v['em']?></a></p>
<span><i></i><?php echo $this->province[$v['pr']]['name_th']?></span>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
</div>


<!-- BEGIN - BANNER : F -->
<?php if($this->_banner['f']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['f'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : F -->

</div>
<div class="span4 col-side">


<!--div class="top-p">
<h4 class="cufon">สมาชิก BoxZa</h4>
<div class="t">
<div>
<p class="cufon"> สมาชิกแนะนำ</p>
<div>
<?php $v=$this->topp[0]?>
<a href="http://boxza.com/<?php echo $v['if']['lk']?>" class="h"><img src="http://s1.boxza.com/profile/<?php echo $v['if']['fd']?>/n.jpg" alt="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>" title="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>"></a>
<p><a href="http://boxza.com/<?php echo $v['if']['lk']?>" class="h"><?php echo $v['if']['fn']?></a></p>
</div>
</div>
</div>
<ul>
<?php for($i=1;$i<count($this->topp);$i++): $v=$this->topp[$i];?>
<li>
<div>
<a href="http://boxza.com/<?php echo $v['if']['lk']?>" class="h"><img src="http://s1.boxza.com/profile/<?php echo $v['if']['fd']?>/s.jpg" alt="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>" title="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>"></a>
<p><a href="http://boxza.com/<?php echo $v['if']['lk']?>" class="h"><?php echo $v['if']['fn']?></a></p>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div!-->

<!--nipa-->

<?php echo $this->service?>
</div>
</div>


<h3 class="hz"><i></i> หาเพื่อนตามจังหวัด หรือตามภูมิภาค</h3>
<ul class="nav-zone thumbnails row-count-3">

<?php foreach($this->pc as $k=>$n):?>
<li class="span4">
<h4><a href="/z-<?php echo $k?>"><i class="icon-map-marker"></i>เพื่อน<?php echo $this->zone[$k]['n']?></a></h4>
<ul>
<?php 
foreach($n as $v):?>
<li><a href="/p-<?php echo $v['_id']?>"><?php echo $v['t']?></a> <span class="badge"><?php echo number_format($v['c'])?></span></li>
<?php endforeach?>
<li><a href="/z-<?php echo $k?>">เพื่อน<?php echo $this->zone[$k]['n']?> ทั้งหมด</a></li>
</ul>
</li>
<?php endforeach?>
</ul>
<a name="post"></a>

<h3 class="hp"><i></i> ฝากข้อมูลของคุณ</h3>

<div class="alert alert-success al-completed">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลประกาศของคุณเรียบร้อยแล้ว
</div>
<div class="alert alert-success  al-deleted">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการลบข้อความของคุณเรียบร้อยแล้ว
</div>
<script>
$(function(){
var q=window.location.search;
if(q=='?completed')
{
	$('.al-completed').show(0)
}
else if(q=='?deleted')
{
	$('.al-deleted').show(0)
}
});
</script>
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>">
<div style="padding:10px; text-align:center; font-size:16px; background:#000; margin:0px 0px 5px 0px; font-weight:bold;">
<a href="http://boyz.boxza.com/friend" style="color:#fff;">หาเพื่อน<strong style="color:#F60">เกย์</strong> สังคมชาวเกย์ เกย์คิง เกย์ควีน คลิกที่นี่</a>
</div>
<div style="padding:10px; text-align:center; font-size:16px; background:#000; margin:5px 0px 5px 0px; font-weight:bold;">
<a href="http://lesbian.boxza.com/friend" style="color:#fff;">หาเพื่อน<strong style="color:#F60">เลสเบี้ยน</strong> สังคมชาวเลสเบี้ยน ทอม ดี้ เลสคิง เลสควีน คลิกที่นี่</a>
</div>
<table class="ins">
<tr><td class="colum">อีเมล์</td><td colspan="3"><input type="email" class="span10" name="email" required> <span class="h"> * บังคับกรอก</span><?php if($this->error['email']):?><div class="error"><?php echo $this->error['email']?></div><?php endif?></td></tr>
<tr><td class="colum">เพศ</td><td><select name="gender" required>
<option value="">กรุณาเลือก</option>
<?php foreach($this->type as $k=>$v):if($k=='gay'||$k=='lesbian')continue;?>
<option value="<?php echo $k?>"><?php echo $v?></option>
<?php endforeach?>
</select> <span class="h"> * บังคับเลือก</span>
<?php if($this->error['gender']):?><div class="error"><?php echo $this->error['gender']?></div><?php endif?>
</td>
<td class="colum">อายุ</td><td><select name="age">
<option value="">กรุณาเลือก</option>
<?php for($i=18;$i<=60;$i++):?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php endfor?>
</select>
</td></tr>
<tr><td class="colum">จังหวัด</td><td>
<select name="province" required>
<option value="">กรุณาเลือก</option>
<?php foreach($this->province as $k=>$v):?>
<?php if($k):?>
<option value="<?php echo $k?>"><?php echo $v['name_th']?></option>
<?php endif?>
<?php endforeach?>
</select>
<span class="h"> * บังคับกรอก</span>
<?php if($this->error['province']):?><div class="error"><?php echo $this->error['province']?></div><?php endif?>
</td>
<td class="colum">รูปภาพ</td><td><input type="file" name="photo"></td></tr>
<tr>
<td class="colum">Facebook</td><td class="input-prepend input-append"><span class="add-on">facebook.com/</span><input type="text" name="facebook" readonly><input type="hidden" name="facebook_id" id="facebook_id"><input type="hidden" name="facebook_name" id="facebook_name"><button class="btn" type="button" onClick="addfb()">เพิ่ม!</button></td>
<td class="colum">Line</td><td><input type="text" name="line"></td>
</tr>
<tr>
<td class="colum">BoxZa</td><td class="input-prepend input-append"><span class="add-on">boxza.com/</span><input type="text"  name="inettown" readonly><button class="btn" type="button" onClick="addin()">เพิ่ม!</button></td>
<td class="colum">Twitter</td><td class="input-prepend"><span class="add-on">@</span><input type="text" class="span2" name="twitter"></td>
</tr>
<tr><td class="colum">ข้อความทักทาย</td><td colspan="3"><input type="text" class="span5" name="message" minlength="3" maxlength="100" required> <span class="h"> * บังคับกรอก</span><?php if($this->error['message']):?><div class="error"><?php echo $this->error['message']?></div><?php endif?></td></tr>
<tr><td class="colum"></td><td colspan="3"><label style="display:inline"><input type="checkbox" name="cam" value="1"> มีกล้อง</label> <span style="display:inline-block; margin:0px 0px 0px 10px; padding:5px; color:#c00"> ควรใช้อีเมล์สำรองแทนการใช้อีเมล์หลัก เพื่อหลีกเลี่ยงการสแปม</span></td></tr>
<tr><td class="colum"></td><td colspan="3"><input type="submit" value=" เพิ่มข้อมูล " class="btn btn-small">  <a href="http://boyz.boxza.com/friend" style="color:#ff0000;">หาเพื่อนเกย์ สังคมชาวเกย์ เกย์คิง เกย์ควีน คลิกที่นี่</a> <br>(*** ห้ามอัพโหลดรูปภาพอนาจาร หรือใช้ข้อความหยาบคาย โดยเด็ดขาด ***)<br>*** ข้อมูล IP และเวลาในการโพสจะแสดงในหน้าต่างแจ้งลบโดยอัตโนมัติ ***</td></tr>
</table>
</form>

<div style="margin:0px;">
<h3 class="hn"><i></i> เพื่อนมาใหม่</h3>
<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="หาเพื่อน"><i class="icon-home"></i> หาเพื่อน</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="<?php echo $purl?>">ทุกภูมิภาค</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <li><a href="/z-1<?php echo $purl?>">เพื่อนกรุงเทพและปริมณฑล</a></li>
   <li><a href="/z-2<?php echo $purl?>">เพื่อนภาคเหนือ</a></li>
   <li><a href="/z-3<?php echo $purl?>">เพื่อนภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/z-4<?php echo $purl?>">เพื่อนภาคตะวันตก</a></li>
   <li><a href="/z-5<?php echo $purl?>">เพื่อนภาคตะวันออก</a></li>
   <li><a href="/z-6<?php echo $purl?>">เพื่อนภาคกลาง</a></li>
   <li><a href="/z-7<?php echo $purl?>">เพื่อนภาคใต้</a></li>
  </ul>
 </li>
<?php if($this->z):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->p?$this->province[$this->p]['name_th']:'ทุกจังหวัด'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/z-<?php echo $this->z?><?php echo $purl?>">ทุกจังหวัด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->zone[$this->z]['l']);$i++):?>
 <?php $j=$this->zone[$this->z]['l'][$i];?>
   <li><a href="/p-<?php echo $j.$purl?>"><?php echo $this->province[$j]['name_th']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
 
 <?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>

</ul> 

<?php $turl=$curl.($this->c?'c-'.$this->c.'/':'')?>
<ul class="nav nav-tabs" style="margin-bottom:5px;">
  <li<?php echo !$this->t?' class="active"':''?>><a href="<?php echo $turl?>">ทั้งหมด</a></li>
  <?php foreach($this->type as $k=>$v):?>
  <li<?php echo $this->t==$k?' class="active"':''?>><a href="<?php echo $turl?>t-<?php echo $k?>"><?php echo $v?></a></li>
  <?php endforeach?>
</ul>

<table class="table table-striped">
<thead><tr><th>วันที่โพส</th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
<?php if($this->msn):?>
<?php foreach($this->msn as $v):?>
<?php
if($v['ty']=='boy')
{
	$t='info';
}
elseif($v['ty']=='girl')
{
	$t='important';
}
elseif($v['ty']=='gay')
{
	$t='inverse';
}
elseif($v['ty']=='lesbian')
{
	$t='warning';
}
else
{
	$t='ladyboy';
}
?>
<tr class="<?php echo $v['ty']?>">
<td class="ti"><?php echo time::show($v['da'],'date',true)?></td>
<td class="ty"><span class="label label-<?php echo $t?>"><?php echo $this->type[$v['ty']]?></span></td>
<td class="em"><a href="msnim:add?contact=<?php echo $v['em']?>" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>
<?php if($v['fd']&&$v['pt']):?> <a href="http://s3.boxza.com/msn/<?php echo $v['fd']?>/<?php echo $v['pt']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['em']?>"><span class="label">รูป</span></a><?php endif?> 
<?php if($v['cm']):?> <img src="http://s0.boxza.com/static/images/friend/cm.png" alt="มีกล้อง"><?php endif?> 
<?php if($v['fb']):?> <a href="https://www.facebook.com/<?php echo $v['fb']?>" rel="nofollow"><img src="http://s0.boxza.com/static/images/friend/fb.png" alt="Facebook"></a> <?php endif?> 
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" rel="nofollow"><img src="http://s0.boxza.com/static/images/friend/tw.png" alt="Twitter"></a> <?php endif?>
<?php if($v['ln']):?><span class="label">Line: <?php echo $v['ln']?></span><?php endif?>
<?php if($v['in']):?><a href="http://boxza.com/<?php echo $v['in']?>" rel="nofollow"><span class="label">โปรไฟล์</span></a><?php endif?>
</td>
<td class="pr"><?php echo $this->province[$v['pr']]['name_th']?></td>
<td class="ag"><?php echo $v['ag']?'<span class="badge badge-'.$t.'">'.$v['ag'].'</span>':''?></td>
<td class="d"><button class="btn btn-mini" onClick="_.box.load('/report/<?php echo $v['_id']?> #report')">แจ้งลบ</button></td>
</tr>
<?php endforeach?>
<?php else:?>
<tr><td colspan="6" style="height:100px; text-align:center; vertical-align:middle">ไม่มีข้อมูล</td></tr>
<?php endif?>
</tbody>
</table>
<div style="text-align:center"><?php echo $this->pager?></div>
</div>


<div class="fb-comments" data-href="http://friend.boxza.com/" data-num-posts="100" data-width="945"></div>
<script>
var NotUseFBGlobal=true,uid=0,fb_id='',fb_name='';
function addfb()
{
	if(uid)
	{
		$('input[name=facebook]').val(uid);
		$('#facebook_id').val(fb_id);
		$('#facebook_name').val(fb_name);
		
		//facebook_name
	}
	else
	{
		_.box.confirm({title:'ไปยัง Facebook',detail:'ระบบจะทำการ redirect ไปยัง facebook เพื่อรับค่า facebook url ของคุณ<br>ต้องการให้ระบบทำงานต่อไปหรือไม่',click:function(){top.location='https://graph.facebook.com/oauth/authorize?client_id=<?php echo _::$config['social']['facebook']['appid']?>&redirect_uri=<?php echo urlencode(URI)?>';}});		
	}
}
function addin()
{
	if(_.my)
	{
		$('input[name=inettown]').val(_.my.link);
	}
	else
	{
		_.box.alert('คุณยังไม่ได้ล็อคอิน');
	}
}
window.fbAsyncInit = function() {
  FB.init({appId:<?php echo _::$config['social']['facebook']['appid']?>,status:true,cookie:true,xfbml:true});
  FB.getLoginStatus(function(r){
	  if(r.status=='connected')
	  {
		  uid=r.authResponse.userID;
		  FB.api('/me', function(r) {uid=(r.username?r.username:r.id);fb_name=r.name,fb_id=r.id});
		}
	});
};
</script>
