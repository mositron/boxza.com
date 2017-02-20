
<style>
#getcredit .next{clear:both; width:100%; clear:both; padding:5px 0px; text-align:center;}
#getcredit .next a{display:block; height:30px; line-height:30px; text-align:30px; margin:0px auto; width:570px; border:1px solid #f0f0f0; background-color:#f8f8f8; text-align:center;}

#getcredit table td{border-bottom:1px solid #f0f0f0;}
#getcredit table td.t{text-align:center; width:150px;}
#getcredit table td.p{text-align:center; width:100px; font-size:14px; color: #F00}
#getcredit table td.p span{color:#093}
</style>


<div style="margin:10px 5px 5px 10px;">
<h2>บ๊อก <small style="font-size:12px; font-weight:normal; font-style:normal">ข้อมูลการใช้งานบ๊อกของคุณ - คุณมี <span style="font-size:16px; color:#090"><?php echo number_format(intval(_::$my['cd']['p']))?></span> บ๊อก</small></h2>

<?php if($this->getcredit):?>
<div id="getcredit"><?php echo $this->getcredit?></div>

<?php else:?>
<div style="padding:50px; text-align:center; font-size:16px; background-color:#f9f9f9">คุณยังไม่มีประวัติการใช้งานบ๊อก</div>

<?php endif?>
</div>
