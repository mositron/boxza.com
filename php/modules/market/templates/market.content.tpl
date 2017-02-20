<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
	<hgroup class="head-logo">
        <h1><a href="/" title="ลงประกาศฟรี">ลงประกาศฟรี</a></h1>
        <h2>ลงประกาศฟรี ลงโฆษณาฟรี ประกาศซื้อขายฟรี ซื้อขาย แลกเปลี่ยน</h2>
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
        <div class="bd">
        <div class="left">
        <h2><a href="/">ลงประกาศฟรี</a> <small>ลงประกาศฟรี ลงโฆษณาฟรี ประกาศซื้อขายฟรี ตลอดอายุการใช้งาน</small></h2>
        </div>
        <div class="right">
        <a href="/post" class="btn btn-info"><i class="icon-plus"></i> เพิ่มประกาศใหม่</a>
        <a href="/manage" class="btn"><i class="icon-folder-open"></i> จัดการประกาศของคุณ</a>
        </div>
        <p class="clear"></p>
        </div>
        <div class="row-fluid">
        <?php echo _::$content?>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>
