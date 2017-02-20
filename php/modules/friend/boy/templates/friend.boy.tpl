<div class="row-fluid">
<div class="span8">

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
<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div class="hr">
<h3><i></i> เพื่อน<?php echo $this->type[F_TYPE]?>แนะนำ</h3>
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
</ul>
</div>
</div>

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

</div>
<div class="span4">


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
</div-->

<!--nipa-->

<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="550" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
</div>
</div>

<div style="margin:0px;">
<h3 class="hn"><i></i> เพื่อน<?php echo $this->type[F_TYPE]?>มาใหม่ (<a href="/t-<?php echo F_TYPE?>">หาเพื่อน<?php echo $this->type[F_TYPE]?>ทั้งหมด</a>)</h3>
<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="หาเพื่อน"><i class="icon-home"></i> หาเพื่อน</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo F_TYPE?>" title="หาเพื่อน<?php echo $this->type[F_TYPE]?>"><i class="icon-home"></i> หาเพื่อน<?php echo $this->type[F_TYPE]?></a></li>
 </ul> 

<table class="table table-striped">
<thead><tr><th>วันที่โพส</th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
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
</tbody>
</table>
<div style="text-align:center"><?php echo $this->pager?></div>
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

<script>
var NotUseFBGlobal=true,uid=0;
function addfb()
{
	if(uid)
	{
		$('input[name=facebook]').val(uid)
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
		  FB.api('/me', function(r) {uid=(r.username?r.username:r.id);});
		}
	});
};
</script>
