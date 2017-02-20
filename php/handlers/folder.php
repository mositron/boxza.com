<?php


class folder
{
	public $folder;
	public function __construct()
	{
		$this->folder=FILES;
	}
	public function save($file,$data)
	{
		if(!is_dir(dirname($this->folder.$file))) 
		{
			$this->_mkdir(dirname($this->folder.$file));
		}
		if($fp=@fopen($this->folder.$file, 'wb'))
		{
			$data=stripslashes($data);
			$len=strlen($data);
			@fwrite($fp, $data, $len);
			@fclose($fp);
			return true;
		}
	}
	
	public function mkdir($dir, $mode = 0777)
	{
		if(!is_dir($this->folder.$dir)) 
		{
			$this->_mkdir($this->folder.$dir);
		}
		return true;
	}
	
	public function delete($file)
	{
		if(file_exists($this->folder.$file)) 
		{
			@unlink($this->folder.$file);
		}
		return true;
	}
	
	private function _mkdir($dir, $mode = 0777)
	{
		if(!is_dir($dir)) 
		{
			$this->_mkdir(dirname($dir));
			@mkdir($dir, $mode);
			@chmod($dir, $mode);
		}
	}
	
	public function clean($type)
	{
		if (!is_dir($this->folder.$type)||!($dh=@opendir($this->folder.$type))) return;
		$result=true;
		while($file=readdir($dh))
		{
			if(!in_array($file,array('.','..')))
			{
				$file2=$type.'/'.$file;
				if(is_dir($this->folder.$file2))
				{
					$this->clean($file2);
				}
				else
				{
					@unlink($this->folder.$file2);
				}
			}
		}
		@rmdir($this->folder.$type);
        return false;
	}
	public function fd($i,$f=false)
	{
		if(!preg_match('/^([0-9]{1,10})$/i',$i,$c))
		{
			die('folder->fd('.$i.'); - invalid number');
		}
		$a = array(
		'0', '1', '2', '3','4', '5', '6', '7', '8', '9',
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
		'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
		'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
		'y', 'z'
		);
		$s = '';
		$c = count($a);
		while($i > 0)
		{
			$s = (string)$a[$i % $c] . $s;
			$i = floor($i / $c);
		}
		$fd = '000000'.strval($s);
		return $f?substr($fd,-6,2).'/'.substr($fd,-4,2).'/'.substr($fd,-2,2):substr($fd,-6);
	}
	
	public function rfd($s)
	{
		$a = array(
		'0', '1', '2', '3','4', '5', '6', '7', '8', '9',
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
		'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
		'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
		'y', 'z'
		);
		$b=array_flip($a);
		$c = count($a);
		$t=mb_strlen($s,'utf-8');
		$l=0;
		for($i=0;$i<$t;$i++)
		{
			$o=mb_substr($s,$i,1,'utf-8');
			$g = ($b[$o]);
			$l = ($l*$c)+$g;
		}
		return $l;
	}
}


?>