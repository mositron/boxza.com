<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="หาเพื่อน">หาเพื่อน</a></h1>
        <h2>หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย แชท msn กล้อง เว็บแคม</h2>
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
                    <a class="brand" href="/" title="หาเพื่อน หาแฟน หากิ๊ก หาคู่">หาเพื่อน</a>
                    <div class="nav-collapse collapse">                    
                        <ul class="nav">
                            <li><a href="/girl" title="หาเพื่อนหญิง">หาเพื่อนหญิง</a></li>
                            <li><a href="/boy" title="หาเพื่อนชาย">หาเพื่อนชาย</a></li>
                            <li><a href="http://boyz.boxza.com/friend" title="หาเพื่อนเกย์">หาเพื่อนเกย์</a></li>
                            <li><a href="http://lesbian.boxza.com/friend" title="หาเพื่อนเลสเบี้ยน">หาเพื่อนเลสเบี้ยน</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="/#post"><i class="ic4"></i> ฝากข้อมูลของคุณ</a></li>
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
