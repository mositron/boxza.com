<?php


class template
{
	public function __construct()
	{
		
	}
	public function assign($s)
	{
		if(is_string($s))
		{
			$this->$s=@func_get_arg(1);
		}
		elseif(is_array($s))
		{
			foreach($s as $k=>$v) $this->$k=$v;
		}
	}
	
	public function display($f=NULL)
	{
		if($f)
		{
			ob_start();
			list($mod,$plug)=explode('.', $f, 2);
			include(ROOT_MODULES.'templates/'._::$type.'.'.$f.'.tpl');
			_::$content = ob_get_clean();
		}
		ob_start();
		include(ROOT_MODULES.'templates/'._::$type.'.tpl');
		echo ob_get_clean();
	}
	public function fetch($f,$r=false)
	{
		ob_start();
		list($mod,$plug)=explode('.', $f, 2);
		include(ROOT_MODULES.($r?'':$mod.'/').'templates/'._::$type.'.'.$f.'.tpl');
		return ob_get_clean();
	}
	public function fetch2($f)
	{
		ob_start();
		list($type,$mod,$plug)=explode('.', $f, 3);
		include(ROOT.'modules/'.$type.'/'.$mod.'/templates/'.$f.'.tpl');
		return ob_get_clean();
	}
	public function fetch3($f)
	{
		ob_start();
		include(ROOT.'modules/'.$f.'.tpl');
		return ob_get_clean();
	}
	
	public function display2($f)
	{
		ob_start();
		list($mod,$plug)=explode('.', $f, 2);
		include(ROOT.'modules/'._::$type.'/'.$mod.'/templates/'._::$type.'.'.$f.'.tpl');
		_::$content = ob_get_clean();
		$this->display();
	}
}
?>