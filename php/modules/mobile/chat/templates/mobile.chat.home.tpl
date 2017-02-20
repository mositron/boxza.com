
<ul class="home-list">
<li>
<a href="/chat/room/1">
<i class="icon icon-1"></i>
<h1>ห้องทั่วไป</h1>
<h2>พูดคุยเรื่องทั่วไป <small>- http://chat.boxza.com/lobby</small></h2>
</a>
</li>
<li>
<a href="/chat/room/2">
<i class="icon icon-2"></i>
<h1>ห้องเกย์</h1>
<h2>เรื่องราวเกี่ยวกับเกย์ <small>- http://chat.boxza.com/boyz</small></h2>
</a>
</li>
<li>
<a href="/chat/room/3">
<i class="icon icon-3"></i>
<h1>ห้องเลสเบี้ยน</h1>
<h2>เรื่องราวเกี่ยวกับเลสเบี้ยน <small>- http://chat.boxza.com/lesbian</small></h2>
</a>
</li>
<li>
<a href="/chat/room/4">
<i class="icon icon-4"></i>
<h1>ห้องผู้หญิง</h1>
<h2>เรื่องราวเกี่ยวกับผู้หญิง <small>- http://chat.boxza.com/beauty</small></h2>
</a>
</li>
<li>
<a href="/chat/room/5">
<i class="icon icon-5"></i>
<h1>ห้องฟุตบอล</h1>
<h2>เรื่องราวเกี่ยวกับฟุตบอล <small>- http://chat.boxza.com/football</small></h2>
</a>
</li>
<li>
<a href="/chat/room/6">
<i class="icon icon-6"></i>
<h1>ห้องรถแต่ง</h1>
<h2>เรื่องราวเกี่ยวกับรถแต่ง <small>- http://chat.boxza.com/racing</small></h2>
</a>
</li>
<li>
<a href="/chat/apps">
<i class="icon icon-7"></i>
<h1>แอพแนะนำ</h1>
<h2>แอพแนะนำอื่นๆที่น่าสนใจ</h2>
</a>
</li>
<?php if(_::$my):?>
<li>
<a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/logout/?redirect_uri='.urlencode(URI)))?>">
<i class="icon icon-9"></i>
<h1>เปลี่ยนบัญชีสมาชิก</h1>
<h2>สลับบัญชี / ออกจากระบบ</h2>
</a>
</li>
<?php endif?>
</ul>

