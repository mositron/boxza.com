<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="เพลง เนื้อเพลง">เพลง</a></h1>
        <h2>เพลง เพลงใหม่ เนื้อเพลง เพลงใหม่ๆ เพลงใหม่ล่าสุด ค้นหาเนื้อเพลง</h2>
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
                    <a class="brand" href="/" title="เพลง เนื้อเพลง">เพลง</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                        	<li><a href="/list" title="เพลงใหม่ เนื้อเพลงใหม่ เพลงใหม่ล่าสุด">เพลงใหม่</a></li>
                        	<li><a href="/news" title="ข่าวเพลง ข่าวเพลงใหม่ ข่าวนักร้อง">ข่าวเพลง</a></li>
                        </ul>
                          <ul class="nav pull-right">
                          <li><form method="post" onSubmit="window.location.href='/list/q-'+encodeURIComponent(this.q.value); return false;" style="margin: 3px 0px 0px 0px;color: white;padding: 0px;"><span style="display:inline-block;vertical-align:middle">ค้นหาเพลงหรือเนื้อเพลง</span> <input type="text" name="q" class="tbox" placeholder="กรอกชื่อเพลง หรือ ศิลปิน" style="width:150px; text-indent:5px" value="<?php echo $this->q?>"> <input type="submit" class="btn" style="margin:0px" value=" ค้นหา "></form></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row-fluid">
            <div class="span8 col-content"> <?php echo _::$content?> </div>
            <div class="span4 col-side">
            <!--nipa-->
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
            </div>
        </div>
        
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>



