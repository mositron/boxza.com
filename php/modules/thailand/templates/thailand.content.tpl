<?php require(ROOT.'modules/www/system/www.system.header.php')?>
<div class="container">
	<hgroup class="head-logo">
    	<h1><a href="/" title="ประเทศไทย">ประเทศไทย</a></h1>
        <h2>สถานที่ โรงแรม ร้านอาหาร ห้างสรรพสินค้า โรงพยาบาล ปั๊มน้ำมัน</h2>
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
                    <a class="brand" href="/" title="สถานที่ โรงแรม ร้านอาหาร ห้างสรรพสินค้า โรงพยาบาล ปั๊มน้ำมัน">สถานที่</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="/(ทั้งหมด)" title="รายชื่อสถานที่ทั้งหมด">รายชื่อสถานที่</a></li>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">แบ่งตามประเภท</a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<?php foreach($this->cate as $k=>$v):?>
                            <li><a href="<?php echo '/('.$v['l'].')'?>"><?php echo $v['t']?></a></li>
                            <?php endforeach?>
                          </ul>
                          </li>
                        </ul>
                        <?php if(_::$my['am']):?>
                        <ul class="nav pull-right">
                        <li><a href="/admin"><i class="icon-edit"></i> จัดการสถานที่</a></li>
                        </ul>
                        <?php endif?>
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
