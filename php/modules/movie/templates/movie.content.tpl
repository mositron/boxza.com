
<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="หนัง หนังใหม่">หนัง</a></h1>
        <h2>หนัง หนังใหม่ ตัวอย่างหนัง โปรแกรมหนัง หนังโปรแกรมหน้า</h2>
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
                    <a class="brand" href="/" title="หนัง หนังใหม่">หนัง</a>
                    <div class="nav-collapse collapse">                    
                        <ul class="nav">
                        	<li><a href="/news" title="ข่าวหนัง ข่าวหนังใหม่ แวดวงหนัง">ข่าวหนัง</a></li>
                        <?php foreach($this->zone as $k=>$v):?>
                             <li><a href="/z-<?php echo $k?>" title="<?php echo $v?>"><?php echo $v?></a></li>
                             <?php endforeach?>
                             <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown">ค้นหาตามประเภท <b class="caret"></b></a>
                               <ul class="dropdown-menu">
                                <?php foreach($this->cate as $k=>$v):?>
                                <li><a href="/c-<?php echo $k?>" title="<?php echo $v?>"><?php echo $v?></a></li>
                                <?php endforeach?>
                             </ul>
                             </li>
                             <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown">ค้นหาตามชนิด <b class="caret"></b></a>
                               <ul class="dropdown-menu">
                                <?php foreach($this->type as $k=>$v):?>
                                <li><a href="/t-<?php echo $k?>" title="<?php echo $v?>"><?php echo $v?></a></li>
                                <?php endforeach?>
                               </ul>
                             </li>
                           </ul>
                           <?php if(_::$my && _::$my['am']):?>
                           <ul class="nav pull-right">
                             <li><a href="/admin"><i class="icon-folder-open icon-white"></i> ระบบจัดการข้อมูล(Admin)</a></li>
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
