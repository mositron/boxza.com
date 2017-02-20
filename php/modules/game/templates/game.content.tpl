<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <hgroup class="head-logo">
        <h1><a href="/" title="เกมส์">เกมส์</a></h1>
        <h2>เกม เกมส์ออนไลน์ เกมส์แฟลช เกมส์เฟสบุ๊ค เล่นเกมส์ เกมส์PC</h2>
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
                    <a class="brand" href="/" title="เกม เกมส์ เกมส์ออนไลน์ เกมส์แฟลช เกมส์เฟสบุ๊ค เล่นเกมส์">เกมส์</a>
                    <div class="nav-collapse collapse">
                    	<ul class="nav">
                           <li><a href="/lionica" title="Lionica - เกมเก็บเลเวลบนเว็บบราวเซอร์">Lionica - เกมเก็บเลเวลบนเว็บ</a></li>
                           <li><a href="/flash" title="เกมส์แฟลช">เกมส์แฟลช</a></li>
                           <li><a href="/forum" title="เว็บบอร์ดเกมส์">เว็บบอร์ดเกมส์</a></li>
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
        <nav class="navbar">
            <div class="navbar-inner navbar-inner2">
                <div class="container"> 
                    <div class="nav-collapse" style="height: 0px;">
                    	<ul class="nav">
                             <li><a href="/online" title="เกมส์ออนไลน์">เกมส์ออนไลน์</a></li>
                             <li><a href="/web" title="เกมส์บนเว็บ">เกมส์บนเว็บ</a></li>
                             <li><a href="/pc" title="เกมส์ PC">เกมส์ PC</a></li>
                             <li><a href="/console" title="เกมส์ Console PlatStation XBOX Wii">เกมส์ Console</a></li>
                             <li><a href="/mobile" title="เกมส์มือถือ แท็บเล็ต">เกมส์มือถือ แท็บเล็ต</a></li>
                             <li><a href="/forum/cookie-run" title="Cookie Run เกมคุกกี้รัน">Cookie Run</a></li>
                             <li><a href="/forum/line-rangers" title="Line Rangers ไลน์แรนเจอร์">Line Rangers</a></li>
                             <li><a href="/forum/farmville2" title="FarmVille2 ฟาร์มวิลล์2">FarmVille2</a></li>
                             <!--li><a href="/forum/cityville2" title="CityVille2 ซิตี้วิลล์2">CityVille2</a></li-->
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
                
                <div class="guildrank">
                <h4>อันดับกิลด์</h4>
                <ul>
                <?php for($i=0;$i<count($this->_guild);$i++):?>
                <li class="<?php echo $i%2?>">
                <p class="l1"><?php echo $i+1?>. <strong><?php echo $this->_guild[$i]['n']?></strong><span class="pull-right">Lv.  <?php echo $this->_guild[$i]['lv']?> (<?php echo number_format(intval($this->_guild[$i]['xp'])).'/'.number_format(intval($this->_guild[$i]['mxp']))?>)</span></p>
                <p>หัวหน้า: <?php echo $this->_guild[$i]['pn']?> <span class="pull-right">สมาชิก: <?php echo $this->_guild[$i]['c']?>/<?php echo $this->_guild[$i]['mx']?></span> </p>
                </li>
                <?php endfor?>
                </ul>
                </div>
                
                <div class="petrank">
                <h4><a href="/lionica/rank">อันดับผู้เล่น Lionica</a> <small>(<a href="/lionica/rank">ทั้งหมด</a>)</small></h4>
                <ul>
                <?php for($i=0;$i<count($this->_lionica);$i++):?>
                <li>
                <i class="char char-class-<?php echo $this->_lionica[$i]['job']?>-<?php echo $this->_lionica[$i]['gender']?> char-head-<?php echo $this->_lionica[$i]['gender']?>-<?php echo $this->_lionica[$i]['hair']?>-<?php echo $this->_lionica[$i]['color']?> char-d"><div></div></i>
                <p><?php echo $i+1?>. <?php echo $this->_lionica[$i]['n']?></p>
                <p>Lv. <?php echo $this->_lionica[$i]['lv']?> - <?php echo $this->_job[$this->_lionica[$i]['job']]['name']?> - กิลด์: <?php echo $this->_lionica[$i]['g']['n']?$this->_lionica[$i]['g']['n']:'-'?></p>
                </li>
                <?php endfor?>
                </ul>
                </div>
                
                <?php echo $this->service?>
            </aside>
        <?php endif?>
        </div>
        
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>

