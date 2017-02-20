<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="เกย์">เกย์</a></h1>
        <h2>เกย์ สังคมชาวเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน เกย์รุก เกย์รับ ชายรักชาย</h2>
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
                    <a class="brand" href="/" title="เกย์ สังคมชาวเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน ชายรักชาย">เกย์</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="/friend" title="หาเพื่อนเกย์"><i class="ic-friend"></i> หาเพื่อนเกย์</a></li>
                            <li><a href="/forum" title="กระดานสนทนาสังคมชาวเกย์"><i class="ic-forum"></i> เว็บบอร์ดเกย์</a></li>
                            <li><a href="/chat" title="ห้องแชทเกย์"><i class="ic-chat"></i> ห้องแชทเกย์</a></li>
                        </ul>
                        <?php if(_::$my && _::$my['am']):?>
                        <ul class="nav pull-right">
                            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">ระบบจัดการ <b class="caret"></b></a>
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
                <li><a href="/forum/c-72" title="พูดคุยเรื่องทั่วไป">พูดคุยเรื่องทั่วไป</a></li>
                <li><a href="/forum/c-73" title="แนะนำตัว">แนะนำตัว</a></li>
                <li><a href="/forum/c-74" title="แฟชั่น การแต่งตัว อัพเดทเทรนใหม่">แฟชั่น การแต่งตัว อัพเดทเทรนใหม่</a></li>
                <li><a href="/forum/c-75" title="สุขภาพ ศัลกรรม ความงาม">สุขภาพ ศัลกรรม ความงาม</a></li>
                <li><a href="/forum/c-91" title="กิจกรรมนอกบ้าน">กิจกรรมนอกบ้าน</a></li>
                <li><a href="/forum/c-76" title="วีดีโอ">วีดีโอ</a></li>
                <li><a href="/forum/c-77" title="อัลบั้มรูปภาพ">อัลบั้มรูปภาพ</a></li>
                <li><a href="/forum/c-81" title="ซื้อขายแลกเปลี่ยน">ซื้อขายแลกเปลี่ยน</a></li>
            </ul>
        </nav>
        <div class="row-fluid">
        <?php echo _::$content?>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>

