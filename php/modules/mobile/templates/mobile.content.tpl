<div data-role="page" class="ui-responsive-panel" id="panel-main">

<div data-role="header" data-theme="a" data-position="fixed" class="bz-header">
<h1>BoxZa
<script type="text/javascript"> __th_page="<?php echo _::$type?>";</script>
<script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script>
</h1>
<?php if(!defined('HIDE_PANEL')):?>
<a href="#bz-menu" data-icon="bars" data-iconpos="notext" data-theme="b">Menu</a>
<a href="#bz-chat" data-icon="search" data-iconpos="notext" data-theme="b">Chat</a>
<?php endif?>
</div><!-- /header -->
<!--- data-scrollz="pull"-->
<div data-role="content" class="bz-content bz-module-<?php echo MODULE?>">
<div>
<div id="bz-content-in" class="bz-content-in"  data-scrollz="pull">
<?php echo _::$content?>
</div>
</div>
</div><!-- /content -->

<?php if(!defined('HIDE_PANEL')):?>
<div data-role="panel" data-position-fixed="true" data-display="reveal" data-theme="a" id="bz-menu">
<ul data-role="listview" data-theme="a" class="nav-search" data-divider-theme="a">
<li data-icon="home"><a href="/line">ไลน์</a></li>
<li class="sub" data-icon="star"><a href="/line/connect">เพื่อน/ติดตาม</a></li>
<li class="sub" data-icon="star"><a href="/line/album">อัลบั้ม</a></li>
<li class="sub" data-icon="star"><a href="/line/gif">ภาพเคลื่อนไหว</a></li>
<li class="sub" data-icon="star"><a href="/line/signup">สมาชิกใหม่</a></li>
<li class="sub" data-icon="star"><a href="/line/me">โดยฉัน</a></li>
<li data-role="list-divider">มุมสมาชิก</li>
<li><a href="/<?php echo _::$my['link']?_::$my['link']:_::$profile['link']?>">โปรไฟล์</a></li>
<!--li><a href="/messages">ข้อความ</a></li>
<li><a href="/friends">เพื่อน</a></li>
<li><a href="/credit">บ๊อก</a></li>
<li><a href="/settings">ตั้งค่า</a></li>
<li><a href="/notifications">แจ้งเตือน</a></li-->
<li><a href="/oauth/logout">ออกจากระบบ</a></li>
</ul>
</div><!-- /panel -->
<div data-role="panel" data-position="right" data-position-fixed="true" data-display="reveal" data-theme="a" id="bz-chat">
<ul data-role="listview" data-theme="a" class="nav-chat" data-filter="true" data-filter-theme="a" data-filter-placeholder="ค้นหาเพื่อน...">
</ul>
</div><!-- /panel -->
<?php endif?>

</div><!-- /page -->

<?php if(!defined('HIDE_PANEL')):?>
<div data-role="page" id="panel-new-post">
    <div data-role="header" data-theme="a" class="bz-header">
    <a href="#panel-main" data-icon="delete"  data-theme="b">ยกเลิก</a>
    <h1>แบ่งปันเรื่องใหม่</h1>
    <a href="#" data-ajax="false" data-icon="check" data-theme="b" onClick="$('#spost').submit();$.mobile.loading('show',{text: 'กำลังโพสต์',textVisible: true,theme: 'a',html: ''});">โพสต์</a>
    </div><!-- /header -->
    <div data-role="content" class="bz-content">

<div id="_post">
<div>
<form id="spost" method="post" enctype="multipart/form-data" action="<?php echo URL?>" data-ajax="false">
<div>
<div class="post-wrap"><textarea name="msg" id="post-msg" tabindex="" placeholder="แบ่งปันเรื่องใหม่ๆ"></textarea></div>
<p class="clear"></p>
</div>
<div class="post-bar">
<a href="javascript:;" onClick="_.post.expand('photo')" class="ln-icon-nav ln-icon-photo"></a>
<a href="javascript:;" onClick="_.post.expand('geo')" class="ln-icon-nav ln-icon-pin"></a>
<div class="clear"></div>
</div>

<div id="lloc"></div>
<div id="lphoto"></div>
<div id="lto">
ถึง: 
<?php 
	$to=array('0'=>'สาธารณะ','-1'=>'เฉพาะเพื่อน','fb-me'=>'ของฉัน','tw'=>'ของฉัน');
	$opto=(is_array(_::$my['op']['to'])&&count(_::$my['op']['to']))?_::$my['op']['to']:array('0','fb-me','tw');
	foreach($opto as $v):
		$f = explode('-',$v);
		if($f[0]=='fb'||$f[0]=='tw')
		{
			if(!_::$my['sc'][$f[0]])continue;
		}
		$c = ($f[1]?'lto-'.$f[0]:'').' lto-'.$v;
		if(!isset($to[$v]))continue;
?>
<span id="lto-l-<?php echo $v?>" class="<?php echo $c?>"><p></p><input type="hidden" name="to[]" value="<?php echo $v?>"> <?php echo $to[$v]?> <i onClick="return _.post.delto(this)"></i></span>
<?php
	endforeach;
?>
</div>

<div id="lto-sl">
<ul class="lto">
<li><a href="javascript:;" onClick="_.post.group(this,'0')">สาธารณะ</a></li>
<li><a href="javascript:;" onClick="_.post.group(this,'-1')">เฉพาะเพื่อน</a></li>
<?php for($i=0;$i<count($this->group);$i++):?>
<li><a href="javascript:;" onClick="_.post.group(this,<?php echo $this->group[$i]['_id']?>)"><?php echo $this->group[$i]['name']?></a></li>
<?php endfor?>


<?php if(_::$my['sc']['tw']):?>
<li><a href="javascript:;" onClick="_.post.group(this,'tw')"> Twitter ของฉัน</a></li>
<?php else:?>
<!--li><a href="/settings/twitter">ผูกบัญชีกับ  Twitter</a></li-->
<?php endif?>

<?php if(_::$my['sc']['fb']):?>
<li><a href="javascript:;">Facebook</a>
<ul class="lfacebook">
<li><a href="javascript:;" onClick="_.post.group(this,'fb-me')">ของฉัน</a></li>
<?php if(is_array(_::$my['sc']['fb']['page'])):?>
<?php foreach(_::$my['sc']['fb']['page'] as $k=>$v):?>
<li><a href="javascript:;" onClick="_.post.group(this,'fb-<?php echo $v['id']?>')"><?php echo $v['name']?></a></li>
<?php endforeach?>
<?php endif?>
</ul>
</li>
<?php else:?>
<!--li><a href="/settings/facebook">ผูกบัญชีกับ  Facebook</a></li-->
<?php endif?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</form>
</div>
</div>

</div><!-- /content -->
</div><!-- /page -->
<?php endif?>