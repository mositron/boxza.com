<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <div class="lg hidden-phone"> <a href="http://weather.boxza.com/" title="พยากรณ์อากาศ"></a> 
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
    </div>
    <div class="_ct _ct-<?php echo MODULE?>">
		<nav class="navbar navbar-inverse hbar">
            <div class="navbar-inner">
                <div class="container"> 
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="brand" href="/" title="BoxZa Feed">บริการข้อมูล</a>
                    <div class="nav-collapse collapse">
                    	<!--ul class="nav">
                            <li><a href="/today" title="พยากรณ์อากาศวันนี้"><i class="ic ic-1"></i> พยากรณ์อากาศวันนี้</a></li>
                            <li><a href="/tomorrow" title="พยากรณ์อากาศพรุ่งนี้"><i class="ic ic-2"></i> พยากรณ์อากาศพรุ่งนี้</a></li>
                        </ul-->
                    </div>
                </div>
            </div>
        </nav>
        <div class="row-fluid">
        <?php echo _::$content?>
        
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>

    </div>
</div>

