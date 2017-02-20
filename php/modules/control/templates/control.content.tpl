<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="container">
    <div class="lg"><a href="http://control.boxza.com/" title="ระบบจัดการ"></a></div>
    <div class="_ct _ct-<?php echo MODULE?>">
        <div class="row-fluid">
            <aside class="span2 col-side">
	            <div class="mmenu">
                <h3>เมนูหลัก</h3>
                <ul class="nav">
                <li><a href="/"><i class="icon-home"></i> หน้าหลัก</a></li>
                <?php foreach($this->key as $k=>$v):?>
                <li><a href="/<?php echo $k?>"><i class="icon-<?php echo $v['i']?>"></i> <?php echo $v['t']?></a></li>
                <?php endforeach?>
                </ul>
                </div>
			</aside>
            <article class="span10 col-content"> <?php echo _::$content?> </article>
        </div>
        <?php require(ROOT.'modules/www/system/www.system.footer.php')?>
    </div>
</div>


