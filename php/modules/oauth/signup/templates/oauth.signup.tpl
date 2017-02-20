
<div class="row-fluid olg">
<div class="olg-l span7 col-side">
<h3>BoxZa.com เครือข่ายสังคมออนไลน์สัญชาติไทย ที่มาพร้อมกับบริการต่างๆมากมาย</h3>


<?php
$key='oauth_signup_service';
$cache=_::cache();
if(!$content=$cache->get('ca1',$key))
{
	//_::time();
	$db=_::db();
	$template=_::template();
	
	$tm = strtotime(date('Y-m-d'))+(3600*24*14);
	$movie=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'v'=>1,'t2'=>1,'tm'=>1,'d'=>1),array('sort'=>array('cs'=>-1,'tm'=>-1),'limit'=>12));
	shuffle($movie);
	$movie=array_slice(array_values($movie),0,1);
	$template->assign('movie',$movie[0]);

	$game=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>48));
	shuffle($game);
	$game=array_slice(array_values($game),0,4);
	$template->assign('game',$game);

	$sexy=$db->find('forum',array('c'=>array('$in'=>array(38,412,413,414,415,416,417,418,419,420)),'dd'=>array('$exists'=>false),'s'=>array('$ne'=>''),'fd'=>array('$ne'=>''),'rc'=>1),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>30));
	shuffle($sexy);
	$sexy=array_slice(array_values($sexy),0,6);
	$template->assign('sexy',$sexy);

	$template->assign('is_line',$arg['line']);
	$content=$template->fetch('signup.service');
	
	
	$cache->set('ca1',$key,$content,false,300);
}

echo $content;
?>

</div>
<div class="olg-r span5 col-content">
<?php echo $this->content?>
</div>
</div>


