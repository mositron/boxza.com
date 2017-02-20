


<div class="left pf-l">
<h3>แจ้งเตือน</h3>
<div class="notifications">
<?php 
	foreach($this->notify as $n):
		$uid = $this->user->profile($n['u']);
		
		switch($n['ty'])
		{
			case 'line':
				$n['ms']='โพสข้อความถึงคุณ "<a href="/line/'.$n['rl'].'" class="h">'.$n['tt'].'</a>"';
				break;
			case 'gift':
				$n['ms']='ส่งของขวัญถึงคุณ "<a href="/line/'.$n['rl'].'" class="h">'.$n['tt'].'</a>"';
				break;
			case 'pet':
				$n['ms']='<a href="/line/'.$n['rl'].'" class="h">ซื้อคุณเป็น Collection ในราคา '.number_format($n['tt']).' บ๊อก</a>"';
				break;
			case 'friend':
				$n['ms']='ส่งคำร้องขอเป็นเพื่อนถึงคุณ <span class="faccept friend-request-'.$n['u'].'" onclick="_.friend.accept('.$n['u'].');$(this).remove();" style="cursor:pointer">ตอบรับเป็นเพื่อน</span>';
				break;
			case 'friend-accept':
				$n['ms']='ตอบรับการเป็นเพื่อนของคุณแล้ว';
				break;
			case 'follow':
				$n['ms']='กำลังติดตามคุณ';
				break;
			case 'cm':
			case 'comment':
				$n['ms']='แสดงความคิดเห็น "<a href="/line/'.$n['rl'].'" class="h">'.$n['tt'].'</a>"';
				break;
			case 'po':
				$n['ms']='ตอบคำถามของคุณ "<a href="/line/'.$n['rl'].'" class="h">'.$n['tt'].'</a>"';
				break;
			case 'lk':
			case 'like':
				$n['ms']='"<a href="/line/'.$n['rl'].'" class="h">โดนข้อความของคุณ</a>"';
				break;
			case 'vt':
				$n['ms']='"<a href="/'._::$my['link'].'" class="h">โหวตโปรไฟล์ของคุณ</a>"';
				break;
			case 'sp':
			case 'spam':
				$n['ms']='"<a href="/line/'.$n['rl'].'" class="h">มีการแจ้งสแปมภายในข้อความของคุณ</a>"';
				$uid = $this->user->profile(0);
				break;
			case 'lk-cm':
				$n['ms']='โดนความคิดเห็นของคุณ "<a href="/line/'.$n['rl'].'" class="h">'.$n['tt'].'</a>"';
				break;
		}
?>
<div>
<span class="av" av="<?php echo $uid['_id']?>"><a href="/<?php echo $uid['link']?>" class="h" title="<?php echo $uid['name']?>"><img src="<?php echo $uid['img']?>"></a></span>
<div class="d"><a href="/<?php echo $uid['link']?>" class="h"><?php echo $uid['name']?></a> <?php echo $n['ms']?> 
(เมื่อ <span class="ago" datetime="<?php echo $n['da']->sec?>"></span>)

</div>

<div class="clear"></div>
</div>
<?php 
	endforeach;
?>
</div>
<br><br><br>
<br><br><br>
</div>
<div class="right pf-r">


<span class="ads-top"></span>
<div class="ads-box"><?php echo $this->service?></div>



</div>
<div class="clear"></div>


<style>
.notifications > div{margin:0px 0px; padding:5px 0px; border-bottom:1px solid #f0f0f0;}
.notifications .av a img{ width:30px; height:30px; margin:2px; /*border-radius:15px;*/}
.notifications .av a { width:34px; height:34px; /*border-radius:17px;*/}
.notifications .av{width:34px;}
.notifications .d{margin:0px 0px 0px 40px; padding:8px 0px 0px 0px}
.notifications .d a{ display:inline-block; padding:2px 5px; background-color:#f5f5f5; text-shadow:1px 1px 0px #fff;}
</style>