<?php


class split
{
	public $f=array();
	public function __construct()
	{
		
	}
	public function get($url,$start,$all,$allorder=false,$allby=false)
	{
		$this->f=array();
		for($i=$start;$i<count(_::$path);$i++)
		{
			if(in_array(_::$path[$i],$all))
			{
				if($this->f[_::$path[$i]]=_::$path[$i+1])
				{
					if(_::$path[$i]!='page')$url.=_::$path[$i].'/'._::$path[$i+1].'/';
				}
				$i++;
			}
			elseif(preg_match('/^(['.implode('|',$all).']+)\-(.*)$/i',_::$path[$i],$p))
			{
				$this->f[$p[1]]=$p[2];
				if($p[1]!='page')$url.=$p[1].'-'.$p[2].'/';
			}
		}
		if($allorder)
		{
			$keyorder=array_keys($allorder);
			if(($this->f['order']&&!array_key_exists($this->f['order'],$allorder))||!$this->f['order']) $this->f['order']=$keyorder[0];
		}
		if($allby)
		{
			$keyby=array_keys($allby);
			if(($this->f['by']&&!array_key_exists($this->f['by'],$allby))||!$this->f['by']) $this->f['by']=$keyby[0];
		}
		if(array_key_exists('page',$this->f)&&$this->f['page']<1) $this->f['page']=1;
		$this->f['url']=$url;
		return $this->f;
	}
}
?>