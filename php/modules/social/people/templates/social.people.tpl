
<style>

#getpeople .n{border-radius: 5px;margin: 2px;border: 1px solid #e5e5e5; position:relative}
#getpeople .n .av{margin:5px}
#getpeople .n strong{display:block; background:#f8f8f8; padding:5px; color:#0399BE}
#getpeople .n strong a{color:#0399BE}
#getpeople .n .button{margin-top:5px}
#getpeople .add{display:none; position:absolute; right:10px; bottom:8px;}
#getpeople .d{display:inline-block; padding:8px 0px 0px 5px}
#getpeople .next{clear:both; width:100%; clear:both; padding:5px 0px; text-align:center;}
#getpeople .next a{display:block; height:30px; line-height:30px; text-align:30px; margin:0px auto; width:570px; border:1px solid #f0f0f0; background-color:#f8f8f8; text-align:center;}

.people-rule{border:1px solid #f0f0f0; background:#f9f9f9; padding:5px 0px; position:fixed; top:60px; width:250px;}
.people-rule h4{padding:5px; margin:0px 5px 5px; background-color:#fff;}
.people-rule form > div{margin:15px 5px 3px 5px;}
.people-rule strong{display:block; padding:0px 0px 3px 5px; margin:0px 0px 5px; border-bottom:1px solid #e9e9e9; text-shadow:1px 1px 0px #fff;}
.people-rule label{display:block;}
</style>


<div class="left pf-l">
<div class="imp">
<p>ค้นหาเพื่อนของคุณจาก..</p>
<div class="imp-sc">
<a href="/import/facebook"><img src="http://s0.boxza.com/static/images/profile/social/fb_contact-list.png"></a>
<a href="/import/google"><img src="http://s0.boxza.com/static/images/profile/social/gg_contact-list.png"></a>
<a href="/import/twitter"><img src="http://s0.boxza.com/static/images/profile/social/tw_contact-list.png"></a>
<a href="/import/live"><img src="http://s0.boxza.com/static/images/profile/social/wl_contact-list.png"></a>
<a href="/import/yahoo"><img src="http://s0.boxza.com/static/images/profile/social/yh_contact-list.png"></a>
<div class="clear"></div>
</div>
</div>

<div id="getpeople"><?php echo $this->getpeople?></div>

<br><br><br>
</div>
<div class="right pf-r">
<!--span class="ads-top"></span-->
<!--div class="ads-box"-->
<script>
function getpeople(e)
{
	var l=[],qr='';
	var q=$('input[name=name]',e).val();
	if(q)
	{
		l[l.length]=['q',q];
	}
	var p=$('select[name=province]',e).val();
	if(p!='')
	{
		l[l.length]=['province',p];
	}
	var g=$('input[name=gender]:checked',e),gv='';
	if(g.length)
	{
		g.each(function() {
			if(gv)gv+='-';
         gv+=$(this).val();
      });
		l[l.length]=['gender',gv];
	}
	var f=$('input[name=gender]:checked',e),fv='';
	if(f.length)
	{
		f.each(function() {
			if(fv)fv+='-';
         fv+=$(this).val();
      });
		l[l.length]=['friend',fv];
	}
	if(l.length)
	{
		for(var i=0;i<l.length;i++)
		{
			qr+=((i?'&':'')+l[i][0]+'='+encodeURIComponent(l[i][1]));
		}
	}
	$('#getpeople').html('');
	_.ajax.gourl('/people/?'+qr,'morepeople');
}
</script>
<div class="people-rule">
<form onSubmit="getpeople(this);return false">
<h4>ค้นจากเงื่อนไข</h4>
<div>
<strong>ค้นจากชื่อ</strong>
<input type="text" name="name" class="tbox" style="width:235px; background-color:#fff;" value="<?php echo $_GET['q']?>">
</div>
<div>
<strong>จากจังหวัด</strong>
<select name="province" class="tbox">
<option value="">ทั้งหมด</option>
<?php foreach($this->province as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo (isset($_GET['province'])&&$_GET['province']==$k)?' selected':''?>><?php echo $v['name_th']?></option>
<?php endforeach?>
</select>
</div>
<div>
<strong>เพศ</strong>
<?php foreach(_::$config['gender'] as $k=>$v):?>
<label><input type="checkbox" name="gender" value="<?php echo $k?>"> <?php echo $v?></label>
<?php endforeach?>
</div>
<!--div>
<strong>ประเภท</strong>
<label><input type="checkbox" name="friend" value="1"<?php echo (isset($_GET['friend'])&&$_GET['friend']=='1')?' selected':''?>> เฉพาะเพื่อน</label>
<label><input type="checkbox" name="friend" value="0"<?php echo (isset($_GET['friend'])&&$_GET['friend']==='0')?' selected':''?>> ไม่ใช่เพื่อน</label>
</div-->
<div>
<input type="submit" class="button" value=" ค้นหา ">
</div>
</form>
</div>
</div>
<div class="clear"></div>
