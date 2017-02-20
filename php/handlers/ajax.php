<?php
class ajax
{
	protected static $x=array('f'=>array());
	public static $func=array();
	public $jsonp=false;
	public $arg=array();
	public function __construct()
	{
		$this->jsonp=(isset($_GET['callback'])&&isset($_GET['ajax']))?$_GET['callback']:'';
		$this->arg=($this->jsonp?$_GET:$_POST);
	}
	public function register($func,$file='',$inner='')
	{
		if(!isset($this->arg['ajax']))return;
		if(is_array($func)) 
		{
			foreach($func as $f)
			{
				$this->register($f,$file,$inner);
			}
		}
		else
		{
			self::$func[$func]=array('inner'=>$inner);
			
			if(isset($this->arg['ajax']) && $this->arg['ajax']==$func)
			{
				$arg=$this->arg["ajaxargs"];
				if(!is_array($arg))$arg=array();
				if(!empty($file))
				{
					if(strpos($file,'/')===false)
					{
						$c=explode('.',$file);
						$file=ROOT_MODULES.$c[0].'/'._::$type.'.'.$file.'.ajax.php';
					}
					if(file_exists($file))
					{
						ob_start();
						include_once($file);
						ob_end_clean();
					}
					else $this->alert("file not found: ".$file);
				}
				if(function_exists($func))
				{
					call_user_func_array($func,$arg);
				}
				else 
				{
					$this->alert("Function not Found: ". $func);
				}
				while (@ob_end_clean());
				echo $this->get();
				exit;
			}
		}
	}
	public function alert($v)
	{
		self::$x['f'][]=array("a"=>"al",'v'=>$v);
	}
	public function redirect($u)
	{
		self::$x['f'][]=array("a"=>"js",'v' => 'window.location.href="'.$u.'";');
	}
	public function html($t,$k,$v)
	{
		self::$x['f'][]=array("a"=>"ht","s"=>$t,'v'=>$k);
		self::$x['f'][]=array("a"=>"ml","s"=>$t,'v'=>$v);
	}
	public function script($v)
	{
		self::$x['f'][]=array("a"=>"js",'v'=>$v);
	}
	public function jquery($s,$p,$v='')
	{
		self::$x['f'][]=array('a'=>'$','s'=>$s,'p'=>$p,'v'=>$v);
	}
	public static function getjs()
	{
		$tmp='<script type="text/javascript">';
		foreach(self::$func as $f=>$b) $tmp.="function ajax_".$f."(){return _.ajax.go(\"".$f."\",arguments".(self::$func[$f]['inner']?",'".self::$func[$f]['inner']."'":"").");};";
		echo $tmp.'</script>';
	}
	public function get()
	{
		while(@ob_end_clean());
		header('Content-type: application/json');
   		echo ($this->jsonp?$this->jsonp.'('.json_encode(self::$x).')':json_encode(self::$x));
		exit;
	}
}
?>