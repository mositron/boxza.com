<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="กลิตเตอร์ Glitter">กลิตเตอร์ Glitter</a></h1>
        <h2>Glitter กลิตเตอร์ รูปภาพ กวนๆ กำลังใจ โกรธ ขำขัน ขอบคุณ ขอโทษ ความรัก</h2>
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
                    <a class="brand" href="/" title="Glitter กลิตเตอร์">กลิตเตอร์</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                         <li><a href="/c-1" title="กลิตเตอร์แสดงอารมณ์" class="l1">แสดงอารมณ์</a></li>
                         <li><a href="/c-41" title="กลิตเตอร์ทักทาย" class="l2">ทักทาย</a></li>
                         <li><a href="/c-71" title="กลิตเตอร์เทศกาล" class="l3">เทศกาล</a></li>
                         <li><a href="/c-91" title="กลิตเตอร์อื่นๆ" class="l4">กลิตเตอร์อื่นๆ</a></li>
                        </ul>
                       <ul class="nav pull-right">
                         <li><a href="/post" class="l5"><i class="icon-plus icon-white"></i> เพิ่มกลิตเตอร์ใหม่</a></li>
                         <li><a href="/manage" class="l5"><i class="icon-folder-open icon-white"></i> จัดการกลิตเตอร์ของคุณ</a></li>
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
                
                <ul class="g-c">
				<?php 
                $c = 0; $i=0;
                foreach($this->cate as $k=>$v):
                    if($v['l']):
                        if($c) echo '</div></li>';
                        $i=0;
                        $c=$k;
                ?>
                <li class="g<?php echo $k?>"><h4><a href="/c-<?php echo $k?>"><?php echo $v['t']?></a></h4>
                <div>
                <?php continue;endif?>
                <?php if($i) echo ', ';?><a href="/c-<?php echo $k?>"><?php echo $v['t']?></a><?php $i++;endforeach?>
                </div>
                </li>
                </ul>

               <?php echo $this->service?> 
           	</aside>
        <?php endif?>
        </div>
        
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>

    </div>
</div>