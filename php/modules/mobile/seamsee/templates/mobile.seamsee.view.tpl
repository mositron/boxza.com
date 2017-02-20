<ul class="seamsee-list">
<li>
<a href="/seamsee/view/<?php echo _::$path[1]?>">
<img src="http://s0.boxza.com/static/images/mobile/seamsee/<?php echo _::$path[1]?>.jpg">
<h1><?php echo $this->seamsee[_::$path[1]]['t']?></h1>
<h2><?php echo $this->seamsee[_::$path[1]]['d']?></h2>
</a>
</li>
</ul>
<div class="seamsee-view">
<div class="semasee-img"><img src="http://s0.boxza.com/static/images/mobile/seamsee/seamsee.png"><br><br>
<div id="getresult"><input type="button" class="btn" value="     เขย่า     " onClick="getresult(this)"></div>
</div>

<h4>วิธีการเสี่ยงทาย</h4>
1. ควรตั้งจิตให้เป็นสมาธิ หลับตาหายใจเข้า-ออกลึกๆ สัก ๑ นาที หรือจนรู้สึกว่าใจสงบแล้ว พร้อมแล้ว ค่อยเริ่มเสี่ยงทาย<br> 
2. ให้ตั้งจิตอธิษฐานระลึกเสมือนท่านอยู่ที่ <?php echo $this->seamsee[_::$path[1]]['d']?> แล้วอธิษฐานดังนี้...<br>
<div class="seamsee-master">
ข้าพเจ้า นาย/นาง/นางสาว....(บอกชื่อของท่าน)..... เกิดวันที่........ เดือน.............. พุทธศักราช........... ขอตั้งจิตอธิษฐานต่อสิ่งศักดิ์สิทธิ์ ณ.<?php echo $this->seamsee[_::$path[1]]['d']?> และสิ่งศักดิ์สิทธิ์ทั้งหลายที่ข้าพเจ้าเคารพนับถือ.... ขออาศัยบารมีของท่านทั้งหลาย ช่วยเปิดชะตาทำนายเสี่ยงโชคให้ข้าพเจ้า บอกกล่าวเรื่องราวที่จะเกิดขึ้นผ่านเซียมซีนี้ด้วยเทอญ 
</div>
3. หลังจากนั้น คลิกที่ปุ่ม " เขย่า "... เพื่อดูผลทำนายของท่าน
</div>
<script>
function getresult(e)
{
	$('#getresult').html('กรุณารอซักครู่..');
	setTimeout(function(){
		_.ajax.gourl('<?php echo URL?>','getresult');
	},5000);
}
</script>