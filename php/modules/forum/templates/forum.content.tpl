<?php require(ROOT.'modules/www/system/www.system.header.php')?>
<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="รูป รูปภาพ รูปถ่าย">รูป</a></h1>
        <h2>รูป รูปภาพ รูปโป๊ รูปสาวสวย รูปน่ารัก รูปการ์ตูน รูปตลกขำขัน รูปรถ รูปภาพดารา</h2>
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
     <nav class="navbar navbar-inverse hbar">
            <div class="navbar-inner">
                <div class="container"> 
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="brand" href="/" title="รูป รูปภาพ รูปถ่าย">รูป</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                            <li><a href="/image" title="รูปภาพ สาวน่ารัก สาวไทยน่ารัก สาวเซ็กส์ซี่ สาวไทยเซ็กส์ซี่ หนุ่มหล่อ เอเชีย อินเตอร์">รูปภาพ</a></li>
                            <li><a href="/c-412" title="รูปสาวไทย รูปสาวสวย รูปสาวน่ารัก">รูปสาวไทย</a></li>
                            <li><a href="/c-38" title="รูปเซ็กซี่ รูปแอบถ่าย รูปสาวเซ็กซี่">รูปเซ็กซี่</a></li>
                            <li><a href="/c-414" title="รูปโป๊ รูป18+">รูปโป๊</a></li>
                            <li><a href="/c-417" title="รูปน่ารัก">รูปน่ารัก</a></li>
                            <li><a href="/c-416" title="รูปตลก รูปขำขัน">รูปตลก</a></li>
                            <li><a href="/c-419" title="รูปการ์ตูน">รูปการ์ตูน</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row-fluid">
        <?php echo _::$content?>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>

    </div>
</div>
