<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
	<hgroup class="head-logo">
    	<h1><a href="/" title="เกมทายใจ">เกมทายใจ</a></h1>
        <h2>เกมทายใจ เกมส์วัดดวง เกมเฟสบุ๊ค เกมทายนิสัย เกมตลก เกมฮาฮา</h2>
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
                    <a class="brand" href="/" title="เกมทายใจ เกมส์วัดดวง เกมทายนิสัย เกมตลก เกมฮาฮา">เกมทายใจ</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                        <li><a href="/recent" title="เกมทายใจมาใหม่ เกมส์ทายใจทั้งหมด"> เกมส์ทายใจทั้งหมด</a></li>
                        <li><a href="/hit" title="เกมส์ทายใจยอดฮิต"> เกมส์ทายใจยอดฮิต</a></li>
                        </ul>
                        <ul class="nav pull-right">
                        <li><a href="/manage/new" rel="nofollow"><i class="icon-plus"></i> สร้างเกมใหม่</a></li>
                        <li><a href="/manage" rel="nofollow">เกมส์ทายใจของฉัน</a></li>
                        <li><a href="http://tech.boxza.com/tips/6011" target="_blank">วิธีสร้างเกมทายใจ</a></li>
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
            
            <div style="text-align:center">
<span class='st_facebook_vcount' displayText='Facebook'></span>
<span class='st_twitter_vcount' displayText='Tweet'></span>
<span class='st_email_vcount' displayText='Email'></span>
</div>

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

