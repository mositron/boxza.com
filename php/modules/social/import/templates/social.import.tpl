<div style="padding:10px;">
<h2>ค้นหาเพื่อน</h2>
<div style="padding:5px 0px">ค้นหาเพื่อนของคุณจากเว็บต่างๆ</div>




<?php if(count($this->exists)):?>
<div class="contact-exists">
<?php for($i=0;$i<count($this->exists);$i++):?>
<div>
<div class="av" av="<?php echo $this->exists[$i]['_id']?>"><a href="<?php echo $this->exists[$i]['link']?>" class="h" title="<?php echo $this->exists[$i]['name']?>"><img src="<?php echo $this->exists[$i]['img']?>"></a></div>
<h4><?php echo $this->exists[$i]['name']?></h4>
<p><span class="fnot friend-request-<?php echo $this->exists[$i]['_id']?>" onClick="_.friend.request(<?php echo $this->exists[$i]['_id']?>)">เพิ่มเป็นเพื่อน</span></p>
<p class="clear"></p>
</div>
<?php endfor?>

<p class="clear"></p>
</div>
<?php endif?>

<?php if(count($this->contact)):?>
<div class="show-contact">
<form method="post" onSubmit="_.ajax.gourl('/import/','email2invite',this);return false;">
<h3 style="background-color:#f0f0f0; color:#000; text-shadow:1px 1px 0px #fff;">
<p style="float:right"><input type="submit" value=" เชิญเพื่อน " class="button blue"></p>
<p style="padding:7px 0px 0px 10px">เชิญชวนเพื่อนเข้าสู่ BoxZa</p>
<p class="clear"></p>
</h3>
<div class="contact-in">
<div class="contact-in">
<div class="contact-in">
<div class="contact-form">
<?php for($i=0;$i<count($this->contact);$i++):?>
<label><input type="checkbox" name="email" value="<?php echo $this->contact[$i]?>" checked> <?php echo $this->contact[$i]?></label>
<?php endfor?>
<p class="clear"></p>
</div>
</div>
</div>
</div>
<div style="margin:0px 0px 10px 0px; text-align:right"><input type="submit" value=" เชิญเพื่อน " class="button blue"></div>
</form>
</div>
<div class="show-contact-success">
ได้รับอีเมล์สำหรับการเชิญชวนเข้าสู่ BoxZa แล้ว ระบบจะทำการส่งอีเมลถึงเพื่อนของคุณในเร็วๆนี้
</div>

<?php endif?>
<?php if(_::$path[0]=='facebook'):?>
<div style="margin:10px 0px">
<!--fb:serverFbml class="fbFriendContainer" width="870" style="width:870px">
      <script type="text/fbml">
          <fb:fbml>
                <fb:request-form content="มาเป็นเพื่อนกันใน boxza.com เครือข่ายสังคมออนไลน์สัญชาติไทย. &lt;fb:req-choice url='http://oauth.boxza.com/signup/facebook/?ref=<?php echo _::$my['_id']?>' label='สมัครสมาชิก BoxZa!' /&gt;" type="inettown" invite="true" method="POST" action="<?php echo PROTOCOL?>boxza.com/import/facebook/?<?php echo $_SERVER['QUERY_STRING']?>">
                    <fb:multi-friend-selector cols="6" showborder="false" exclude_ids="<?php $this->fbout?implode(',',$this->fbout):''?>" rows="4" actiontext="เชิญชวนเพื่อนเข้าสู่ BoxZa."></fb:multi-friend-selector>
                </fb:request-form>
          </fb:fbml>
       </script>
    </fb:serverFbml-->
</div>
<?php endif?>

<?php if(_::$path[0]=='email'):?>
<div style="margin:10px 0px">
<h4 class="cp">เพิ่ม Email ที่ต้องการเชิญชวน</h4>
<form method="post" action="<?php echo URL?>">
<textarea name="emails" class="tbox" style="width:100%; height:200px"></textarea>
<input type="submit" class="button blue" value="  ถัดไป  "> &nbsp; * สามารถใช้ ช่องว่าง หรือ , หรือ ; หรือเว้นบรรทัด สำหรับคั่นอีเมล์แต่ละอีเมล์ได้
</form>
</div>
<?php endif?>

<?php if(!count($this->exists) && !count($this->contact) && _::$path[0] && _::$path[0]!='email'):?>
<div style="padding:50px 0px; text-align:center; color:#ff0000">ไม่สามารถค้นหาเพื่อนของคุณได้ในขณะนี้ กรุณาลองค้นหาเพื่อนจากวิธีอื่น</div>
<?php endif?>

<div>
<ul class="provider-list">
<li><a href="/import/google/"><img src="http://s0.boxza.com/static/images/profile/social/gg_contact-list.png" alt="Google"></a></li>
<li><a href="/import/facebook/"><img src="http://s0.boxza.com/static/images/profile/social/fb_contact-list.png" alt="Facebook"></a></li>
<li><a href="/import/twitter/"><img src="http://s0.boxza.com/static/images/profile/social/tw_contact-list.png" alt="Twitter"></a></li>
<li><a href="/import/live/"><img src="http://s0.boxza.com/static/images/profile/social/wl_contact-list.png" alt="Windows Live"></a></li>
<li><a href="/import/yahoo/"><img src="http://s0.boxza.com/static/images/profile/social/yh_contact-list.png" alt="Yahoo"></a></li>
<li><a href="/import/email/"><img src="http://s0.boxza.com/static/images/profile/social/em_contact-list.png" alt="Email"></a></li>
<p class="clear"></p>
</ul>
</div>


</div>

<style>
.provider-list{border:1px solid #e7e7e7; background-color:#f7f7f7; padding-bottom:17px; line-height:0px}
.provider-list li a{float: left; margin:17px 0px 0px 17px; display: block; width: 270px; background:#fff;border: 1px solid #E7E7E7; text-align: center; border-radius:3px;line-height:0px}
.provider-list li a img{width:200px;}
.contact-form label{width:215px; overflow:hidden; float:left;text-overflow: ellipsis;white-space: nowrap; display:block; margin:7px 0px 0px 5px;}
.contact-form{max-height:300px; overflow:auto;}
.contact-in{max-height:300px; overflow:hidden;}
.show-contact-success{display:none;border:1px solid #e8e8e8; padding:70px 0px; text-align:center; background-color:#f8f8f8; text-shadow:1px 1px 0px #fff; font-size:16px; color:#000; margin:10px 0px}
.contact-exists > div{ float:left; width:210px; margin:3px 0px 3px 10px}
.contact-exists .av{margin-right:10px}
.contact-exists  h4{background-color:#f7f7f7; color:#0399BE; margin:0px 0px 5px 30px; height:24px; line-height:24px; }

</style>