<?php require(ROOT.'modules/www/system/www.system.header.php')?>
<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="รถ รถยนต์ รถใหม่ รถป้ายแดง">รถ</a></h1>
        <h2>ราคารถใหม่ รถใหม่ป้ายแดง รถยนต์ ราคา ผ่อน ดาวน์ โปรโมชั่น ดอกเบี้ย</h2>
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
                    <a class="brand" href="/" title="ราคารถใหม่ รถใหม่">ราคารถใหม่</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                            <li><a href="/motorexpo" title="Motor Expo 2013 มอเตอร์เอ็กซ์โป 2013">Motor Expo 2013</a></li>
                            <li><a href="/honda" title="ราคา Honda">Honda</a></li>
                            <li><a href="/toyota" title="ราคา Toyota">Toyota</a></li>
                            <li><a href="/nissan" title="ราคา Nissan">Nissan</a></li>
                            <li><a href="/mazda" title="ราคา Mazda">Mazda</a></li>
                            <li><a href="/chevrolet" title="ราคา Chevrolet">Chevrolet</a></li>
                            <li><a href="/mitsubishi" title="ราคา Mitsubishi">Mitsubishi</a></li>
                            <li><a href="/isuzu" title="ราคา Isuzu">Isuzu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php if(defined('HIDE_SIDEBAR')):?>
        <?php echo _::$content?>
        <?php else:?>
        <div class="row-fluid">
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
        </div>
        <?php endif?>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>

