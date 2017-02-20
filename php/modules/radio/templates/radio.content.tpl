<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
	<hgroup class="head-logo">
    	<h1><a href="/" title="ฟังเพลง">ฟังเพลง</a></h1>
        <h2>ฟังเพลงออนไลน์ ฟังเพลง ฟังวิทยุออนไลน์ ทุกคลื่นทั่วไทย ฟังเพลงรัก ฟังเพลงอกหัก ฟังเพลงใหม่</h2>
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
        <nav class="navbar hbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container"> 
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="brand" href="/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์">ฟังเพลง</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                            <li><a href="/89.0" title="89.0 Chill FM">89.0 Chill FM</a></li>
                            <li><a href="/91.5" title="91.5 HotWave">91.5 HotWave</a></li>
                            <li><a href="/93.0" title="93.0 Cool FM">93.0 Cool FM</a></li>
                            <li><a href="/94.0" title="94.0 EFM">94.0 EFM</a></li>
                            <li><a href="/96.0" title="96.0 Sport Radio">96.0 Sport Radio</a></li>
                            <li><a href="/105.5" title="105.5 Eazy FM">105.5 Eazy FM</a></li>
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
            <!--nipa-->
                <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>
                
                <!-- BEGIN - BANNER : C -->
                <?php if($this->_banner['c']):?>
                <div style="overflow:hidden; margin:5px 0px; text-align:center">
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
