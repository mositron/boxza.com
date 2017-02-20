<h3 class="chat-bar">ห้อง<?php echo $this->room['n']?><!-- - <?php echo $_SERVER['HTTP_USER_AGENT']?>--></h3>
<div id="bz_priv"><a href="javascript:;" onclick="_.openb('room');" id="bz_uicon_room" class="room">ออนไลน์ (<span id="room_count">0</span>)</a></div>
<div class="bz_chat">
<div class="bz_chat_popup"></div>
<div class="bz_chat_rl">
<div class="bz_chat_ch"><div class="bz_chat_ch_l_main bz_chat_ch_l on"></div></div>
<div class="bz_chat_nl" id="bz_box_room" style="display:none">
<div class="bz_chat_nl_h"><i></i>ชื่อของคุณ</div>
<div class="bz_chat_nl_l bz_chat_nl_ll"></div>
<div class="bz_chat_nl_h"><i></i>สมาชิกออนไลน์ (<span id="bz_chat_nl_ol">0</span>)</div>
<div class="bz_chat_nl_h2">+ <span id="bz_chat_nl_ol1">0</span> ผู้ดูแล (<a href="javascript:;" onClick="_.api('admin',{last:_.lastid,cmd:'list'});">/admin list</a>)</div>
<div class="bz_chat_nl_l bz_chat_nl_lll"></div>
<div class="bz_chat_nl_h2">+ <span id="bz_chat_nl_ol2">0</span> สมาชิก</div>
<div class="bz_chat_nl_l bz_chat_nl_llll"></div>
<div class="bz_chat_nl_h2">+ <span id="bz_chat_nl_ol3">0</span> บุคคลทั่วไป</div>
<div class="bz_chat_nl_l bz_chat_nl_lllll"></div>
</div>
<p class="clear"></p>
</div>
<div class="bz_chat_box"><div class="bz_chat_inp"><textarea rows="1" name="ms" class="bz_chat_mb" maxlength="150"></textarea></div><div>
</div> 
</div>
</div>

<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/mobile.chat.js?<?php echo APP_VERSION?>"></script>
<script type="text/javascript">
_.room=<?php echo $this->room['_id']?>;
_.load();
</script>