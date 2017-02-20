<?php
class db 
{
	private $config;
	public $mongo=array();
	public $db=array();
	public $collection=array();
	public static $count=0;
	public static $query = array();
	private $debug=false;
	public function __construct($key="default")
	{
		$this->config=_::$config['db'][$key];
		if(isset($_GET['debug']))$this->debug=true;
	}
	
	public function __call($func,$param)
	{
		if(mb_strtolower($func,'utf-8')=='findone' && $this->config['find_logs'])
		{
			$this->_command('find_logs','update',array(array('_id'=>$param[0]),array('$inc'=>array($func.'_'.str_replace('.','_',HOST).'_'=>1,$func.'_'.str_replace('.','_',HOST).'.'.str_replace('.','_',URL)=>1,'do'=>1)),array('upsert'=>true)));
			//$this->_command($collection,'update',array($query,$new,$options));
		}
		return $this->_command($param[0],$func,array_slice($param,1));
	}
	
	public function _command($collection,$func,$param)
	{
		try
		{
			$_ = call_user_func_array(array($this->getCollection($collection),$func),$param);
			if($this->debug)self::$query[] = $func.' - '.$collection.'  - (time: '.time().') - '.print_r($param,true);
			return $_;
		} 
		catch (MongoCursorException $e) 
		{
		  $this->error = $e->getMessage();
		}
		catch (MongoCursorTimeoutException $e) 
		{
		  $this->error = $e->getMessage();
		}
		catch (MongoConnectionException $e) 
		{
		  $this->error = $e->getMessage();
		}
		catch (MongoException $e) 
		{
		  $this->error = $e->getMessage();
		}
		return false;
	}
	
	public function drop()
	{
		return false;
	}
	
	public function connect($host)
	{
		try
		{
			$this->mongo[$host] = new Mongo('mongodb://'.$this->config['host'][$host]['user'].':'.$this->config['host'][$host]['pass'].'@'.$this->config['host'][$host]['host'].'/'.$this->config['host'][$host]['db']);
			$this->db[$host] = $this->mongo[$host]->selectDB($this->config['host'][$host]['db']);
		   if($this->debug)self::$query[] = 'selectdb - '.$this->config['host'][$host]['db'];
		} 
		catch (MongoConnectionException $e) 
		{
		  die('Error connecting to DB server ('.$e->getMessage().') - '.$this->config['host'][$host]['host']);
		}
		catch (MongoException $e) 
		{
		  die('Error: ' . $e->getMessage());
		}
		return true;
	}

	public function getCollection($collection,$count=1,$allow=false)
	{
		if(!isset($this->collection[$collection]))
		{
			if(!$allow)
			{
				$h = $this->config['collection'][$collection];
				if(is_null($h) || !$h)
				{
					die('Not allow this collection - '.$collection);
				}
			}
			if(!$this->mongo[$h]) $this->connect($h);
			if(!$this->mongo[$h]->connected) $this->mongo[$h]->connect();
			if(!$this->db[$h])
			{
				$this->db[$h] = $this->mongo[$h]->selectDB($this->config['host'][$h]['db']);
				self::$count++;
				if($this->debug)self::$query[] = 'selectdb - '.$this->config['host'][$h]['db'].' - (time: '.time().')'.print_r($query,true);
			}
			$this->collection[$collection] = $this->db[$h]->selectCollection($collection);
		   if($this->debug)self::$query[] = 'select collection- '.$collection.'  - (time: '.time().')';
			self::$count++;
		}
		self::$count+=$count;
		return $this->collection[$collection];
	}
	
    public function find($collection, $query = array(), $fields=array(),$options = array(),$fetch = true) 
	 {
		 
		if($this->config['find_logs'])
		{
			$this->_command('find_logs','update',array(array('_id'=>$collection),array('$inc'=>array('find_'.str_replace('.','_',HOST).'_'=>1,$func.'_'.str_replace('.','_',HOST).'.'.str_replace('.','_',URL),'do'=>1)),array('upsert'=>true)));
			//$this->_command('find_logs','update',array(array('_id'=>$param[0]),array('$inc'=>array($func.'_'.str_replace('.','_',HOST).'_'=>1,$func.'_'.str_replace('.','_',HOST).'.'.str_replace('.','_',URL)=>1,'do'=>1)),array('upsert'=>true)));
			//$this->_command($collection,'update',array($query,$new,$options));
		}
        $result =  $this->getCollection($collection,1)->find($query, $fields);
		  if($this->debug)self::$query[] = 'find - '.$collection.' - '.print_r($query,true);
        if (isset($options['sort'])) $result->sort($options['sort']);
        if (isset($options['skip'])) $result->skip($options['skip']);
        if (isset($options['limit'])) $result->limit($options['limit']);
		  if($fetch)
		  {
			  $array = array();
			  foreach ($result as $val) $array[] = $val;
	        return count($array)?$array:NULL;
		  }
		  return $result;
	}

    public function insert($collection, $data) 
	 {
		 $h = $this->config['collection'][$collection];
		 //$this->getCollection($h.'_seq',1);
		 $this->getCollection($collection,1);
		 $_id=intval($data['_id']);
		 if(!$_id)
		 {
			 $result = $this->db[$h]->command(array('findandmodify'=>$this->config['host'][$h]['seq'], 'query' => array('_id' => $collection), 'update' => array('$inc' => array('seq' => 1)), 'new' => true, 'upsert' => true, 'fields' => array('seq'=>1)));
			 $data['_id'] = new MongoInt32($result['value']['seq']);
		 }
		 else
		 {
			  $data['_id'] = new MongoInt32($_id);
		 }
		 if($collection=='line')
		 {
			 $data['da'] = $data['ds'] = $data['dc'] = new MongoDate();
			 //$data['ds'] = new MongoDate();
			 $data['ip'] = $_SERVER['REMOTE_ADDR'];
		 }
		 elseif(!isset($data['da']))
		 {
			 $data['da'] = new MongoDate();
		 }
		 # ไม่รอ ให้สมมุติว่าผ่านไว้ก่อน เพราะถ้ารอ บางครั้งเพิ่มข้อมูลเข้า แต่มันก็ยังบอกว่าไม่เข้า
		 return $this->_command($collection,'insert',array($data,array('safe'=>false)))? intval($data['_id']->value):false;
    }
	 
	 public function update($collection, $query = array(), $new= array(), $options = array()) 
	 {
		 if(isset($new['$set'])||isset($new['$push'])||isset($new['$unset'])||isset($new['$pull'])||isset($new['$inc']))
		 {
			 if(!isset($options['upsert']))$options['upsert'] = false;
			 return $this->_command($collection,'update',array($query,$new,$options));
		 }
	 }
	 
	 public function distinct($collection, $key , $query = array(), $options = array())
	 {
		 $h = $this->config['collection'][$collection];
		 if($this->debug)self::$query[] = 'distinct - '.$collection.' - '.print_r($query,true);
		 $this->getCollection($collection,1);
		 $result=$this->db[$h]->command(array('distinct'=>$collection, 'key'=>$key,'query'=>$query));
		 return $result['values'];
	 }
	 
	 public function group($collection, $key , $initial, $reduce, $condition, $return = false)
	 {
		 $result=$this->_command($collection, 'group', array($key, $initial, $reduce, $condition));
		 return $return?$result['retval'][0][$return]:$result['retval'];
	 }
	 
	 public function mapreduce($collection, $map , $reduce, $query)
	 {
		 $h = $this->config['collection'][$collection];
		 if($this->debug)self::$query[] = 'mapreduce - '.$collection.' - '.print_r($query,true);
		 $this->getCollection($collection,1);
		 $result=$this->db[$h]->command(array('mapreduce'=>$collection, 'map'=>new MongoCode($map),'reduce'=>new MongoCode($reduce),'query'=>$query,'out'=>$collection.'_out'));
		 return $this->db[$h]->selectCollection($result['result']);
	 }
	 
    public function lastError($host) 
	 {
        return $this->db[$host]->lastError();
    }
}