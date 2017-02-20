


<?php if($this->open['ln']):?>
<?php if(_::$my['st']||_::$my['_id']==_::$profile['_id']):?>


<?php else:?>
<div class="_post" style="padding:10px; text-align:center">ไม่สามารถโพสบนไลน์ของ <?php echo _::$profile['name']?> ได้ เนื่องจากคุณยังไม่ยืนยันการสมัครสมาชิก</div>
<?php endif?>
<?php endif?>


<div class="line" id="_line" data-profile="<?php echo _::$profile['_id']?>">
<?php echo $this->line?>
</div>
