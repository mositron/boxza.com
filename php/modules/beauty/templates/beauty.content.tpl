<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
	<hgroup class="head-logo">
    	<h1><a href="/" title="ผู้หญิง แฟชั่น ความงาม เสริมสวย">ผู้หญิง</a></h1>
        <!--h2>ผู้หญิง แฟชั่น ความงาม เสริมสวย</h2-->
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
                    <a class="brand" href="/" title="ผู้หญิง แฟชั่น ความงาม เสริมสวย">ผู้หญิง</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                        	<li><a href="/review" title="รีวิว Review"><i class="bic bic1"></i><strong>Review</strong><span>รีวิว</span></a></li>
                        	<li><a href="/wedding" title="แต่งงาน Wedding"><i class="bic bic2"></i><strong>Wedding</strong><span>แต่งงาน</span></a></li>
                        	<li><a href="/healthy" title="สุขภาพ Healthy"><i class="bic bic3"></i><strong>Healthy</strong><span>สุขภาพ</span></a></li>
                        	<li><a href="/howto" title="สาธิต How to"><i class="bic bic4"></i><strong>How to</strong><span>สาธิต</span></a></li>
                        	<li><a href="/fashion" title="แฟชั่น Fashion"><i class="bic bic5"></i><strong>Fashion</strong><span>แฟชั่น</span></a></li>
                        	<li><a href="/news" title="รู้หรือไม่ Did U Know?"><i class="bic bic6"></i><strong>Did U Know?</strong><span>รู้หรือไม่</span></a></li>
                        	<li><a href="/forum" title="กระทู้ Webboard"><i class="bic bic7"></i><strong>Webboard</strong><span>กระทู้</span></a></li>
                            <!--li><a href="/forum" title="เว็บบอร์ดผู้หญิง">Webboard</a></li>
                            <li><a href="/forum/c-341" title="รูปภาพผู้หญิง">Photo Box</a></li>
                            <li><a href="/forum/c-342" title="สุขภาพผู้หญฺง">Healthy</a></li>
                            <li><a href="/forum/c-343" title="ข่าวผู้หญิง">News</a></li>
                            <li><a href="/forum/c-344" title="กินเที่ยวสไตล์ผู้หญฺง">Eat &amp; Travel</a></li>
                            <li><a href="/chat" title="แชท พูดคุยแบบผู้หญิง" style="border:none;">Chat Room</a></li-->
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row-fluid">
            <?php if(defined('HIDE_SIDEBAR')):?>
            <?php echo _::$content?>
            <?php else:?>
            <article class="span8 col-content">
            <?php /*
                <ul class="fo-cate">
                    <li><a href="/forum/c-311" title="รีวิว วิจารณ์"><i class="fo-review" title="Review"></i></a></li>
                    <li><a href="/forum/c-321" title="ไอเท็มยอดฮิต"><i class="fo-hot-item" title="Hot Item"></i></a></li>
                    <li><a href="/forum/c-331" title="สตรีทแฟชั่น"><i class="fo-street-fashion" title="Street Fashion"></i></a></li>
                    <li><a href="/forum/c-332" title="วิธีใช้งาน"><i class="fo-how-to" title="How to"></i></a></li>
                    <li><a href="/forum/c-333" title="เปิดกล่อง"><i class="fo-open-box" title="Open Box"></i></a></li>
                    <li><a href="/forum/c-334" title="แฟชั่น"><i class="fo-fashion" title="Fashion"></i></a></li>
                    <li><a href="/forum/c-335" title="คุณรู้หรือไม่?"><i class="fo-did-u" title="Did you know?"></i></a></li>
                    <li><a href="/forum/c-336" title="ข่าวประชาสัมพันธ์"><i class="fo-pr-news" title="PR News"></i></a></li>
                    <li><a href="/forum/c-337" title="เมาท์ทูเมาท์"><i class="fo-mouth-2-mouth" title="Mouth 2 Mouth"></i></a></li>
                    <p class="clear"></p>
                </ul>
				*/ ?>
                <?php echo _::$content?> 
            </article>
            <aside class="span4 col-side">
                <div class="text-center"><!--nipa--></div>
                <div class="h-follow-us">
                    <p><i title="Follow us on Facebook"></i></p>
                    <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>
                </div>                
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
                <div>
                    <div class="h-how-to">
                        <p><a href="/forum/c-332" title="How to"><i title="How to"></i></a> <strong>ผู้หญิง</strong>แบ่งปั่นความรู้ วิธีการต่างๆ</p>
                         <ul>
                            <?php $i=0;foreach($this->data['h4'] as $v):?>
                            <li class="l<?php echo $i?>"> <a href="/forum/topic/<?php echo $v['_id']?>"> <img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                                <p><strong><?php echo $v['t']?></strong></p>
                                <span>โดย <?php echo $v['un']['name']?></span> </a> </li>
                            <?php $i++;endforeach?>
                            <p class="clear"></p>
                        </ul>
                    </div>
                    
                    <div class="h-street-fashion">
                        <p><a href="/forum/c-331" title="Street Fashion"><i title="Street Fashion"></i></a></p>
                        <p>อัพเดทแฟชั่น ไอเท็มสไตล์ของ<strong>ผู้หญิง</strong></p>
                        <ul class="thumbnails row-count-2">
                            <?php $i=0;foreach($this->data['h3'] as $v):?>
                            <li class="span6 l<?php echo $i?>"> <a href="/forum/topic/<?php echo $v['_id']?>"> <img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>"> </a> </li>
                            <?php $i++;endforeach?>
                        </ul>
                    </div>
                    <div class="h-hot-item">
                        <h3><a href="/forum/c-321" title="Hot Item"><i title="Hot Item"></i></a></h3>
                         <ul>
                            <?php $i=0;foreach($this->data['h2'] as $v):?>
                            <li class="l<?php echo $i?>"> <a href="/forum/topic/<?php echo $v['_id']?>"> <img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>"> <strong><?php echo $v['f']['brand']?></strong>
                                <p><?php echo $v['t']?></p>
                                </a> </li>
                            <?php $i++;endforeach?>
                            <p class="clear"></p>
                        </ul>
                    </div>
                    <div class="h-pr-news">
                        <p><a href="/forum/c-336" title="PR News"><i title="PR News"></i></a></p>
                        <ul class="thumbnails row-count-2">
                            <?php $i=0;foreach($this->data['h8'] as $v):?>
                            <li class="span6 l<?php echo $i?>"> <a href="/forum/topic/<?php echo $v['_id']?>"> <img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
                                <p><?php echo $v['t']?></p>
                                </a> </li>
                            <?php $i++;endforeach?>
                        </ul>
                    </div>
                    <?php if(isset($this->service)):?>
                    <?php echo $this->service?>
                    <?php endif?>
                </div>
            </aside>
            <?php endif?>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>
