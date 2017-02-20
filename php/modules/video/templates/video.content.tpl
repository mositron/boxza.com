<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
	<hgroup class="head-logo">
    	<h1><a href="/" title="คลิป วิดีโอ">คลิป วิดีโอ</a></h1>
        <h2>คลิป วิดีโอ ดู คลิปขำๆ ฮาๆ น่ารัก มิวสิควิดีโอ</h2>
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
                    <a class="brand" href="/" title="คลิป วิดีโอ">วิดีโอ</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">                        
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ค้นหาตามหมวด <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <?php foreach($this->cate as $k=>$v):?>
                            <li><a href="/c-<?php echo $k?>" title="<?php echo $v['n']['t']?>"><?php echo $v['n']['t']?></a></li>
                            <?php endforeach?>
                            </ul>
                          	</li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="/post"><i class="icon-plus icon-white"></i> เพิ่มคลิปวิดีโอใหม่</a></li>
                            <li><a href="/manage"><i class="icon-folder-open icon-white"></i> จัดการคลิปวิดีโอ</a></li>
                            <li><a href="/manage/playlist"><i class="icon-list-alt icon-white"></i> จัดการเพลย์ลิส</a></li>
                            <li><a href="/manage/admin"><i class="icon-edit icon-white"></i> ระบบผู้ดูแล</a></li>
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
                <div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-colorscheme="dark" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;background:#333;"></div>
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
                <ul class="nav-cate">
                <?php foreach($this->cate as $k=>$v):?>
                <li class="l<?php echo $k?>">
                	<i></i><h4><a href="/c-<?php echo $k?>"><?php echo $v['n']['t']?></a></h4>
                    <p>
                    <?php $i=0;foreach($v['l'] as $m):?>
                      <?php if($i):?>, <?php endif?><a href="/c-<?php echo $m['n']['_id']?>"><?php echo $m['n']['t']?></a>
                     <?php $i++;endforeach?>
                    </p>
                </li>
                <?php endforeach?>
                <p class="clear"></p>
                </ul>
                <?php echo $this->service?>
           	</aside>
        <?php endif?>
        </div>
        
        
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>
