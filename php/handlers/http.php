<?php


class http
{
	public function __construct()
	{
		
	}
	public function curl($url,$arg) 
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,$arg['post']);
		if($arg['postfields'])
		{
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
			curl_setopt($ch,CURLOPT_POSTFIELDS,$arg['postfields']);
		}
		if($arg['header'])curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arg['returntransfer']);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $arg['verifypeer']);
		if($arg['useragent'])curl_setopt($ch, CURLOPT_USERAGENT, $arg['useragent']);
		curl_setopt($ch, CURLOPT_TIMEOUT, $arg['timeout']);
		if($arg['forbid_reuse'])curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
		if(count($arg['httpheader']))curl_setopt($ch, CURLOPT_HTTPHEADER, $arg['httpheader']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	
	public function get($url,$post=false,$option=array())
	{
		$arg=array(
			'post'=>false,
			'postfields'=>'',
			'header'=>false,
			'returntransfer'=>true,
			'verifypeer'=>false,
			'useragent'=>'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1',
			'timeout'=>60,
			'forbid_reuse'=>true,
			'httpheader'=>array(
											 'Connection: Keep-Alive',
											 'Keep-Alive: 60'
									)
		);
		array_merge($arg,(array)$option);
		if($post)
		{
			#$_p='';
			$arg['post']=true;
			
			if(is_array($post))
			{
				$_p=$post;
				#$_p=http_build_query($post);
				//foreach($post as $key=>$value)$_p.= ($_p?'&':'').rawurlencode($key).'='.rawurlencode($value);
			}
			elseif(is_string($post))
			{
				$_p=$post;
			}
			if($_p)$arg['postfields']=$_p;
		}
		return $this->curl($url,$arg);
	}
}





?>