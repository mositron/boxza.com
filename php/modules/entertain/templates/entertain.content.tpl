<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
    	<h1><a href="/" title="ข่าวบันเทิง">ข่าวบันเทิง</a></h1>
        <h2>ข่าวบันเทิงวันนี้ ข่าวบันเทิงล่าสุด บันเทิง ดารา นักร้อง ซุบซิบดารา คลิปหลุดดารา</h2>
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
        <div class="ent-nav visible-desktop">
            <h4>อัพเดทข่าวฮอต ประเด็นฮิตของวงการบันเทิง</h4>
            <ul>
                <li><a href="/forum">เว็บบอร์ดบันเทิง</a></li>
                <li><a href="/forum/star">เว็บบอร์ดดารานักร้อง</a></li>
                <li><a href="/forum/movie">เว็บบอร์ดหนัง ภาพยนตร์</a></li>
                <li><a href="/forum/music">เว็บบอร์ด เพลง ดนตรี</a></li>
                <li><a href="/forum/star-photo">รูปภาพดารา</a></li>
            </ul>
        </div>
        
		<nav class="navbar navbar-inverse hbar">
            <div class="navbar-inner">
                <div class="container"> 
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="brand" href="/" title="BoxZa Entertain">ข่าวบันเทิง</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                            <li><a href="/gossip" title="ซุบซิบดารา">ซุบซิบดารา</a></li>
                            <li><a href="/news" title="เกาะกระแส บันเทิง ดารา">กระแสดารา</a></li>
                            <li><a href="/video" title="คลิปดารา วิดีโอดารา">คลิปดารา</a></li>
                            <li><a href="/hollywood" title="บันเทิงฮอลลีวู้ด บันเทิงอินเตอร์">บันเทิงฮอลลีวู้ด</a></li>
                            <li><a href="/asian" title="บันเทิงเอเชีย บันเทิงเกาหลี บันเทิงญี่ปุ่น">บันเทิงเอเชีย</a></li>
                            <li><a href="http://music.boxza.com" title="เพลง เพลงใหม่ เนื้อเพลง" target="_blank">เพลง</a></li>
                            <li><a href="http://movie.boxza.com" title="หนัง หนังใหม่" target="_blank">หนัง</a></li>
                            <li><a href="http://drama.boxza.com" title="เรื่องย่อ เรื่องย่อละคร" target="_blank">ละคร</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row-fluid">
        <?php if(defined('HIDE_SIDEBAR')):?>
        <?php echo _::$content?>
        <?php else:?>
            <article class="span8 col-content"> <?php echo _::$content?> </article>
            <aside class="span4 col-side">
            	<div class="text-center"><!--nipa--></div>
                <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>
                
                <!-- BEGIN - BANNER : C -->
                <?php if($this->_banner['c']):?>
                <div style="overflow:hidden; margin:5px 0px; text-align:center;">
                    <ul class="_banner _banner-once">
                        <?php foreach($this->_banner['c'] as $_bn):?>
                        <li><?php echo $_bn?></li>
                        <?php endforeach?>
                    </ul>
                </div>
                <?php endif?>
                <!-- END - BANNER : C -->
                
               <?php echo $this->service?>             
            </aside>
        <?php endif?>
        </div>
        
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>

