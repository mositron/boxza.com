<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="เลสเบี้ยน ทอมดี้">เลสเบี้ยน ทอมดี้</a></h1>
        <h2>เลสเบี้ยน ทอมดี้ เลสไบ เลสคิง เลสควีน เลสรุก เลสรับ ทอม ดี้ หญิงรักหญิง</h2>
        <!-- BEGIN - BANNER : A -->
        <?php if($this->_banner['a']):?>
        <div>
            <ul class="_banner _banner-once">
                <?php foreach($this->_banner['a'] as $v):?>
                <li><?php echo $v?></li>
                <?php endforeach?>
            </ul>
        </div>
        <?php endif?>
        <!-- END - BANNER : A --> 
    </hgroup>
    <div class="_ct _ct-<?php echo MODULE?>">
		<nav class="navbar hbar">
            <div class="navbar-inner">
                <div class="container"> 
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="brand" href="/" title="เลสเบี้ยน ทอมดี้ สังคมชาวเลสเบี้ยน สังคมชาวทอมดี้ เลสไบ เลสคิง เลสควีน เลสรุก เลสรับ ทอม ดี้ หญิงรักหญิง"><i class="ic-home"></i> เลสเบี้ยน ทอมดี้</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                          <li><a href="/friend" title="หาเพื่อนเลสเบี้ยน หาเพื่อนทอมดี้"><i class="ic-friend"></i> หาเพื่อนเลสเบี้ยน ทอมดี้</a></li>
                          <li><a href="/forum" title="กระดานสนทนาสังคมชาวเลสเบี้ยน ชาวทอมดี้"><i class="ic-forum"></i> เว็บบอร์ดเลสเบี้ยน ทอมดี้</a></li>
                          <li><a href="/chat" title="ห้องแชทเลสเบี้ยน ห้องแชททอมดี้"><i class="ic-chat"></i> ห้องแชทเลสเบี้ยน ทอมดี้</a></li>
                       </ul>
                       
                          <?php if(_::$my && _::$my['am']):?>
                          <ul class="nav pull-right">
                          <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">ระบบจัดการ <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                          <li><a href="/admin/banner">แบนเนอร์</a></li>
                          </ul>
                          </li>
                          </ul>
                          <?php endif?>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="mn">
            <ul>
            <li><a href="/forum/c-452" title="พูดคุยเรื่องทั่วไปเกี่ยวกับเลสเบี้ยน ทอมดี้">พูดคุยเรื่องทั่วไป</a></li>
            <li><a href="/forum/c-453" title="แนะนำตัว เลสเบี้ยน ทอมดี้">แนะนำตัว</a></li>
            <li><a href="/forum/c-454" title="แฟชั่น การแต่งตัว อัพเดทเทรนใหม่">แฟชั่น การแต่งตัว อัพเดทเทรนใหม่</a></li>
            <li><a href="/forum/c-455" title="สุขภาพ ศัลกรรม ความงาม">สุขภาพ ศัลกรรม ความงาม</a></li>
            <li><a href="/forum/c-471" title="กิจกรรมนอกบ้าน">กิจกรรมนอกบ้าน</a></li>
            <li><a href="/forum/c-456" title="วีดีโอ">วีดีโอ</a></li>
            <li><a href="/forum/c-457" title="อัลบั้มรูปภาพ">อัลบั้มรูปภาพ</a></li>
            <li><a href="/forum/c-461" title="ซื้อขายแลกเปลี่ยน">ซื้อขายแลกเปลี่ยน</a></li>
            </ul>
        </nav>
        <div class="row-fluid">
        <?php echo _::$content?>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>
