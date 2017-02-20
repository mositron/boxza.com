<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
	<hgroup class="head-logo">
    	<h1><a href="/" title="ดารา">ดารา</a></h1>
        <h2>ดารา ประวัติดารา Instagramดารา ข่าวดารานักร้อง</h2>
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
                    <a class="brand" href="/" title="ดารา ประวัติ บุคคล ประวัติดารา Instagramดารา ซุบซิบดารา ข่าวดารา">ดารา</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="/actor" title="ดารา นักแสดง ประวัติดารา ข้อมูลดารา">นักแสดง</a></li>
                            <li><a href="/artist" title="ศิลปิน นักร้อง ข้อมูลนักร้อง ประวัตินักร้อง นักดนตรี ศิลปิน นักแต่งเพลง">ศิลปิน</a></li>
                            <li><a href="/sport" title="นักกีฬา นักฟุตบอล">นักกีฬา</a></li>
                            <li><a href="/politic" title="นักการเมือง">นักการเมือง</a></li>
                            <li><a href="/business" title="นักธุรกิจ">นักธุรกิจ</a></li>
                            <li><a href="/other" title="บุคคลมีชื่อเสียง">อื่นๆ</a></li>
                        </ul>
                        <?php if(_::$my['am']):?>
                        <ul class="nav pull-right">
                        <li><a href="/admin"><i class="icon-edit"></i> ฝากประวัติ</a></li>
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
