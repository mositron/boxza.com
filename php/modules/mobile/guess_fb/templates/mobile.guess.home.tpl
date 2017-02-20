

<script>
function onlogged()
{
	document.getElementById('menu_fb').innerHTML='<div style="text-align:center;padding:10px">กำลังดึงข้อมูล Facebook</div>';
	FB.api('/me', function(u) {
 		document.getElementById('menu_fb').innerHTML='<img src="http://graph.facebook.com/'+u.id+'/picture?type=square"><div>ชื่อบัญชี: '+u.name+'</div><p><a href="javascript:;" onclick="relogin()">เปลี่ยนบัญชี Facebook</a></p>';
    });
}
</script>



<ul class="home-list">
<li id="menu_fb"><div style="text-align:center;padding:10px">กรุณารอซักครู่...</div></li>
<li>
<a href="/guess/recent">
<i class="icon icon-1"></i>
<h1>ล่าสุด</h1>
<h2>เกมส์ทายใจทั้งหมด <small>เรียงจากใหม่ล่าสุด</small></h2>
</a>
</li>
<li>
<a href="/guess/hit">
<i class="icon icon-2"></i>
<h1>ยอดฮิต</h1>
<h2>เกมส์ทายใจทั้งหมด <small>เรียงจากผู้เล่นมากสุด</small></h2>
</a>
</li>
<?php foreach($this->cate as $k=>$v):?>
<li>
<a href="/guess/category/<?php echo $k?>">
<i class="icon icon-3"></i>
<h1>หมวด<?php echo $v['t']?></h1>
<h2>เกมส์ทายใจเฉพาะหมวด <?php echo $v['t']?> <small></small></h2>
</a>
</li>
<?php endforeach?>
<li>
<a href="/guess/apps">
<i class="icon icon-7"></i>
<h1>แอพแนะนำ</h1>
<h2>แอพแนะนำอื่นๆที่น่าสนใจ</h2>
</a>
</li>
</ul>

