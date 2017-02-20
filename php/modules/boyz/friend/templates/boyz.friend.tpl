<?php if($this->page == 1):?>
<div class="row-fluid">
<div class="span8">
<style>
.hr ul li{margin:5px 0px 0px 0px;}
</style>
 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; margin:5px 0px 0px;overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
 <!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="text-align:center; margin:5px 0px 0px;overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->
 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="text-align:center; margin:5px 0px 0px;overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<iframe frameborder="0" width="100%" height="500" src="http://s0.boxza.com/static/chat/?f=0&r=2&radio=0" style="margin-top:5px;"></iframe>

<div class="hr">
<h3><i></i> หาเพื่อน แชท พูดคุย</h3>
<div>
<ul class="thumbnails row-count-4">
<?php foreach($this->rec as $v):?>
<li class="span3">
<a href="msnim:add?contact=<?php echo $v['em']?>"><img src="http://s3.boxza.com/msn/rec/<?php echo $v['fd'].'/'.$v['pt']?>" alt="<?php echo $v['em']?>">
<span class="<?php  echo $v['ty2']?>"><?php echo $this->type[strval($v['ty2'])]?><i></i></span>
</a>
<p><i></i><a href="msnim:add?contact=<?php echo $v['em']?>"><?php echo $v['em']?></a></p>
<span><i></i><?php echo $this->province[$v['pr']]['name_th']?></span>
</li>
<?php endforeach?>
</ul>
</div>
</div>
</div>
<div class="span4">

<!--nipa-->

<div class="hfb">
<h3><i></i>FOLLOW US ON FACEBOOK</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/pages/BoxZa-Boyz/157051084438090" data-width="320" data-height="540" data-show-faces="true" data-border-color="#fff" data-stream="false" data-header="false"></div>
</div>

<div class="f-ins">
<h3><i></i>ฝากประวัติของคุณ</h3>
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
$(function(){var q=window.location.search;if(q=='?completed'){$('.al-completed').show(0)}else if(q=='?deleted'){$('.al-deleted').show(0)}});
</script>
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>">
<table class="ins">
<tr><td colspan="2">
<strong>อีเมล์ <span>*</span></strong>
<input type="email" class="span3" name="email" style="width:257px" required>
<?php if($this->error['email']):?><div class="error"><?php echo $this->error['email']?></div><?php endif?>
<p style="color:#BE1E2D">ควรใช้อีเมล์สำรองแทนการใช้อีเมล์หลัก เพื่อหลีกเลี่ยงการสแปม</p>
</td></tr>
<tr><td>
<strong>เพศ <span>*</span></strong>
<select name="gender" style="width:130px" required>
<option value="">กรุณาเลือก</option>
<?php foreach($this->type as $k=>$v):?>
<option value="<?php echo $k?>"><?php echo $v?></option>
<?php endforeach?>
</select> <span class="h"> * บังคับเลือก</span>
<?php if($this->error['gender']):?><div class="error"><?php echo $this->error['gender']?></div><?php endif?>
</td>
<td>
<strong>อายุ</strong>
<select name="age" style="width:130px">
<option value="">กรุณาเลือก</option>
<?php for($i=18;$i<=60;$i++):?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php endfor?>
</select>
</td></tr>
<tr><td colspan="2">
<strong>จังหวัด <span>*</span></strong>
<select name="province" style="width:267px" required>
<option value="">กรุณาเลือก</option>
<?php foreach($this->province as $k=>$v):?>
<?php if($k):?>
<option value="<?php echo $k?>"><?php echo $v['name_th']?></option>
<?php endif?>
<?php endforeach?>
</select>
<?php if($this->error['province']):?><div class="error"><?php echo $this->error['province']?></div><?php endif?>
</td>
</tr>
<tr><td colspan="2">
<strong>Facebook</strong>
<div class="input-prepend input-append"><span class="add-on">facebook.com/</span><input type="text" name="facebook" style="width:118px;" readonly><input type="hidden" name="facebook_id" id="facebook_id"><input type="hidden" name="facebook_name" id="facebook_name"><button class="btn" type="button" onClick="addfb()">เพิ่ม!</button></div>
</td>
</tr>
<tr><td colspan="2">
<strong>BoxZa</strong>
<div class="input-prepend input-append"><span class="add-on">boxza.com/</span><input type="text" name="inettown" style="width:137px;" readonly><button class="btn" type="button" onClick="addin()">เพิ่ม!</button></div>
</td></tr>
<tr><td colspan="2">
<strong>Line</strong>
<input type="text" name="line" style="width:257px;">
</td></tr>
<tr><td colspan="2">
<strong>Twitter</strong>
<div class="input-prepend"><span class="add-on">@</span><input type="text" name="twitter" style="width:230px"></div>
</td></tr>
<tr><td colspan="2">
<strong>ข้อความทักทาย <span>*</span></strong>
<textarea class="span3" name="message" minlength="3" maxlength="100" style="height:50px; width:257px;" required></textarea>
<?php if($this->error['message']):?><div class="error"><?php echo $this->error['message']?></div><?php endif?>

</td></tr>
<tr><td colspan="2">
<strong>รูปภาพ</strong>
<input type="file" name="photo" class="span3"></td></tr>
<tr><td colspan="2"><label style="display:inline"><input type="checkbox" name="cam" value="1"> มีกล้อง</label></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" เพิ่มข้อมูล " class="btn btn-small"><br>(*** ห้ามอัพโหลดรูปภาพอนาจาร หรือใช้ข้อความหยาบคาย โดยเด็ดขาด ***)</td></tr>
</table>
</form>
</div>
</div>
</div>




<div style="border-top:1px solid #000;">
<h3 style="height: 30px;line-height: 30px;padding: 0px 10px;background: black;color: #fff;border-top: 1px solid #fff;"><a href="/forum" style="color:#fff;">เว็บบอร์ด - กระทู้เด่น  กระทู้ล่าสุด</a></h3>
</div>
<div class="row-fluid">
<div class="hfs span4">
<h3>HOT TOPIC</h3>
<ul class="flist1">
<?php foreach($this->hot as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></li>
<?php endforeach?>
</ul>
</div>
<div class="hht span4">
<h3><a href="/forum/c-74" title="สุขภาพ ศัลกรรม ความงาม"><i></i>HEALTHY</a></h3>
<ul class="flist1">
<?php foreach($this->health as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></li>
<?php endforeach?>
</ul>
</div>
<div class="hfs span4">
<h3><a href="/forum/c-74" title="แฟชั่น การแต่งตัว อัพเดทเทรนใหม่"><i></i>FASHION</a></h3>
<ul class="flist1">
<?php foreach($this->fashion as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></li>
<?php endforeach?>
</ul>
</div>
</div>




<div class="zone-box">
<h3 class="hz"><i></i> หาเพื่อนเกย์ตามจังหวัด หาเพื่อนเกย์ตามภูมิภาค</h3>
<ul class="nav-zone thumbnails row-count-6">
<?php foreach($this->pc as $k=>$n):?>
<li class="span2">
<h4><a href="/friend/z-<?php echo $k?>" title="หาเพื่อนเกย์ <?php echo $this->zone[$k]['n']?>"><i class="icon-map-marker"></i><?php echo $this->zone[$k]['n']?></a></h4>
<ul>
<?php 
foreach($n as $v):?>
<li><a href="/friend/p-<?php echo $v['_id']?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<li><a href="/friend/z-<?php echo $k?>" title="หาเพื่อนเกย์<?php echo $this->zone[$k]['n']?> ทั้งหมด">ทั้งหมด</a></li>
</ul>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<?php endif?>

<div>
<h3 class="hn"><i></i> เพื่อนเกย์มาใหม่</h3>
<ul class="breadcrumb">
<li><a href="/" title="เกย์ ชายรักชาย"><i class="icon-home"></i> เกย์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/friend" title="หาเพื่อนเกย์"><i class="icon-list"></i> หาเพื่อนเกย์</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="/friend<?php echo $purl?>">ทุกภูมิภาค</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <li><a href="/friend/z-1<?php echo $purl?>">กรุงเทพและปริมณฑล</a></li>
   <li><a href="/friend/z-2<?php echo $purl?>">ภาคเหนือ</a></li>
   <li><a href="/friend/z-3<?php echo $purl?>">ภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/friend/z-4<?php echo $purl?>">ภาคตะวันตก</a></li>
   <li><a href="/friend/z-5<?php echo $purl?>">ภาคตะวันออก</a></li>
   <li><a href="/friend/z-6<?php echo $purl?>">ภาคกลาง</a></li>
   <li><a href="/friend/z-7<?php echo $purl?>">ภาคใต้</a></li>
  </ul>
 </li>
<?php if($this->z):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->p?$this->province[$this->p]['name_th']:'ทุกจังหวัด'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/friend/z-<?php echo $this->z?><?php echo $purl?>">ทุกจังหวัด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->zone[$this->z]['l']);$i++):?>
 <?php $j=$this->zone[$this->z]['l'][$i];?>
   <li><a href="/friend/p-<?php echo $j.$purl?>"><?php echo $this->province[$j]['name_th']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
<?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>
</ul> 
<?php if($this->page > 1):?>
<div style="text-align:center"><?php echo $this->pager?></div>
<?php endif?>
<table class="table table-striped tbfr">
<thead><tr><th>วันที่โพส</th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
<?php foreach($this->msn as $v):?>
<tr class="<?php echo $v['ty']?>">
<td class="ti"><?php echo time::show($v['da'],'date',true)?></td>
<td class="ty"><span class="label label2 <?php echo $v['ty2']?>"><?php echo $this->type[strval($v['ty2'])]?></span></td>
<td class="em"><a href="msnim:add?contact=<?php echo $v['em']?>" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>
<?php if($v['fd']&&$v['pt']):?> <a href="http://s3.boxza.com/msn/<?php echo $v['fd']?>/<?php echo $v['pt']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['em']?>"><i class="icon-pic"></i></a><?php endif?> 
<?php if($v['cm']):?> <i class="icon-cam"></i><?php endif?> 
<?php if($v['fb']):?> <a href="https://www.facebook.com/<?php echo $v['fb']?>" rel="nofollow"><i class="icon-fb"></i></a> <?php endif?> 
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" rel="nofollow"><img src="http://s0.boxza.com/static/images/friend/tw.png" alt="Twitter"></a> <?php endif?>
<?php if($v['ln']):?><span class="label">Line: <?php echo $v['ln']?></span><?php endif?>
<?php if($v['in']):?><a href="http://boxza.com/<?php echo $v['in']?>" rel="nofollow"><span class="label">โปรไฟล์</span></a><?php endif?>
</td>
<td class="pr"><?php echo $this->province[$v['pr']]['name_th']?></td>
<td class="ag"><?php echo $v['ag']?'<span class="badge badge-'.$t.'">'.$v['ag'].'</span>':''?></td>
<td class="d"><button class="btn btn-mini" onClick="_.box.load('/report/<?php echo $v['_id']?> #report')">แจ้งลบ</button></td>
</tr>
<?php endforeach?>
</tbody>
</table>
<div style="text-align:center"><?php echo $this->pager?></div>
</div>

<script>
var NotUseFBGlobal=true,uid=0,fb_id='',fb_name='';
function addfb()
{
	if(uid)
	{
		$('input[name=facebook]').val(uid);
		$('#facebook_id').val(fb_id);
		$('#facebook_name').val(fb_name);
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
