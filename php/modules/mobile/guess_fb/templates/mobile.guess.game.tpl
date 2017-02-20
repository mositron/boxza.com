
<div class="ans-head">
<?php if($this->app['img']):?><img src="http://s3.boxza.com/guess/<?php echo $this->app['fd']?>/s.jpg" style="float:left; margin:0px 15px 3px 10px; width:100px; height:100px;"><?php endif?>
<h1><?php echo $this->app['t']?></h1>
<div><?php echo $this->app['d']?></div>
<div>ประเภท: <a href="/guess/category/<?php echo $this->app['c']?>"><?php echo $this->cate[$this->app['c']]['t']?></a> - เล่นแล้ว <?php echo number_format(intval($this->app['do']))?> ครั้ง</div>
</div>
<div align="center" style="margin-top:10px"> 
  <div>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FBoxzaNetwork&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=<?php echo _::$config['social']['facebook']['appid']?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowtransparency="true"></iframe>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FIntrend365-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%25A2%25E0%25B8%25B7%25E0%25B8%2594-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%2581%25E0%25B8%25A3%25E0%25B8%25B5%25E0%25B8%2599-%25E0%25B8%2581%25E0%25B8%25B2%25E0%25B8%2587%25E0%25B9%2580%25E0%25B8%2581%25E0%25B8%2587-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%259C%25E0%25B9%2589%25E0%25B8%25B2%25E0%25B9%2581%25E0%25B8%259F%25E0%25B8%258A%25E0%25B8%25B1%25E0%25B9%2588%25E0%25B8%2599%2F786402811370068&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=<?php echo _::$config['social']['facebook']['appid']?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowTransparency="true"></iframe>
</div>
</div>


<form id="frmans">
<input type="hidden" name="uid" id="uid">
<?php for($i=0;$i<count($this->app['quest']);$i++):$v=$this->app['quest'][$i];shuffle($v['a']);?>
<div class="ans-list">
<h3>ข้อที่ <?php echo $i+1?>. <?php echo $v['t']?></h3>
<ul class="nav">
<?php for($j=0;$j<count($v['a']);$j++):?>
<li><label><input type="radio" class="rdans" name="ans<?php echo $i?>" value="<?php echo $v['a'][$j]['id']?>"> <?php echo $v['a'][$j]['t']?></label></li>
<?php endfor?>
</ul>
</div>
<?php endfor?>
</form>

<div style="text-align:center; margin:5px"><span class="cplaya btn btn-info btn-large" onClick="playapp()">ดูคำตอบ</span></div>
<div class="sharefb"><div style="text-align:center">... กรุณาคลิกที่.. ดูคำตอบ. ...</div></div>


<div style="margin:10px; padding:5px; border:5px solid #F69; background:#fff; border-radius:5px;">
    <div style="float:left; width:50px;"> <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a> </div>
    <div style="margin:0px 0px 0px 55px;"> ตั้งคำถามโดย: <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
        เมื่อ: <?php echo time::show($this->app['da'],'datetime')?> </div>
    <p style="clear:both"></p>
    <?php if($this->apps):?>
    <div>คำถามอื่นๆของ <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a></div>
<ul class="otherapp">
<?php for($i=0;$i<count($this->apps);$i++):?>
<li><a href="/guess/game/<?php echo $this->apps[$i]['_id']?>/?parent=<?php echo urlencode(URL)?>"><?php echo $this->apps[$i]['t']?></a></li>
<?php endfor?>
</ul>
<?php endif?>
</div>


<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/boxza.js"></script>
<script>
var repeatsend=0,postnow=false,checkbox=false,res=false,liked=false,ws={};
function playapp()
{
	if($('.rdans:checked').length!=<?php echo count($this->app['quest'])?>)
	{
		alert('กรุณาเลือกคำตอบให้ครบทุกข้อ');	
	}
	else
	{
		$('#uid').val(uid);
		$('.sharefb').html('<div style="text-align:center"><img src="http://s0.boxza.com/static/images/global/load.gif"></div>');
		$('.cplaya').prop('disabled','disabled').html('กรุณารอซักครู่...');
		_.ajax.gourl('<?php echo URL?>','playapp',$('#frmans').get(0));
	}
};

function showresult(r)
{
	ws=r;
	$('.cplaya').removeProp('disabled').html('เล่นอีกครั้ง');
	var tmp='<div style="padding:"10px; text-align:center">'+
	'<strong>คำตอบคือ</strong>: '+ws.name+'<br>'+
	ws.description+
	'<br><a href="javascript:;" class="btn btn-fb" onclick="posttoshare()">โพสไปยัง Facebook</a></div>';
	$('#frmans').get(0).reset();
	$('.sharefb').html(tmp);
	//posttoshare();
};
function posttoshare()
{
	$('.cplaya').prop('disabled','disabled').html('กรุณารอซักครู่...');
	$('.sharefb').html('<div style="padding:10px; text-align:center">กรุณารอซักครู่ เพื่อโพสข้อมูลไปยัง Facebook</div>');
	FB.api('/me/feed', 'post',ws,function(r)
	{
		var j='<br><br><a class="button" href="http://boxza.com/" target="_blank" onClick="closelike()">ปิดหน้าต่างนี้</a>';
		if(!r||r.error)
		{
			repeatsend++;
			if(repeatsend<5)
			{
				console.log(r.error);
				$('.sharefb').html('<div style="padding:10px; text-align:center">กรุณารอซักครู่ เพื่อโพสข้อมูลไปยัง Facebook ('+repeatsend+') - '+r.error+'</div>');
				setTimeout(function(){posttoshare();},100);
			}
			else
			{
				$('.sharefb').html('<div style="padding:10px; text-align:center">ไม่สามารถโพสข้อมูลไปยัง Facebook ได้เนื่องจากมีผู้ใชงานจำนวนมากในขณะนี้ <strong>กรุณาลองใหม่อีกครั้ง</strong>'+j+'</div>');
				repeatsend=0;
			}
		}
		else
		{
			var l='https://www.facebook.com/'+r.id;
			l=l.replace('_','/posts/');
			$('.cplaya').removeProp('disabled').html('เล่นอีกครั้ง');
			var tmp='<div style="padding:"10px; text-align:center">โพสไปยัง Facebook เรียบร้อยแล้ว<br>ลิ้งค์บนเฟสบุ๊คคือ <a href="'+l+'" target="_blank">'+l+'</a><br><br>'+
			'<strong>คำตอบคือ</strong>: '+ws.name+'<br>'+
			ws.description+
			'</div>';
			$('#frmans').get(0).reset();
			$('.sharefb').html(tmp);
			repeatsend=0;
		};
	});
}


</script>





