<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="แชท chat คุยสด">แชท</a></h1>
        <h2>chat แชท คุยสด แชทรูม ดูกล้อง ส่องเว็บแคม พูดคุยหาเพื่อน โชว์กล้อง</h2>
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
                    <a class="brand" href="/" title="แชท chat คุยสด">แชท</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                        	<li><a href="/list" title="ห้องแชททั้งหมด"><i class="icon-th-list icon-white"></i> ห้องแชททั้งหมด</a></li>
                        </ul>                        
                         <ul class="nav pull-right">
                         <li class="dropdown"><a href="/manage"><i class="icon-plus icon-white"></i>  สร้างห้องแชท</a></li>
                         <li class="dropdown"><a href="/manage"><i class="icon-edit icon-white"></i>  จัดการห้องแชทของฉัน</a></li>
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
                
               <?php echo $this->service?> 
           	</aside>
        <?php endif?>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>


