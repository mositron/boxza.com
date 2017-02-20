<?php
class parentarray
{
	public $list = array();
	private $cache = array();
	private $title = 'title';
	private $parent = 'parent';
	public $arrow = ' > ';
	private $amount = false;
	public function __construct()
	{
	}
	public function get($arr,$title='title',$parent='parent',$amount=false)
	{
		$this->clear();
		$this->title=$title;
		$this->parent=$parent;
		$this->amount=$amount;
		$this->create($arr);
		return $this->list;
	}
	public function clear()
	{
		$this->list=array();
		$this->cache=array();
	}
	public function create($cate=false)
	{
		$this->clear();
		$arr=array();
		$cat_tree=array();
		if(is_array($cate))
		{
			foreach($cate as $category)
			{
				$category['children'] = array();
				$category['in_id'] = array($category['_id']);
				if($this->amount)$category['in_amount'] = array($category[$this->parent]);
				$cat_tree = $this->add($cat_tree, $category[$this->parent], $category, $category['_id']);
			}
			$this->build($cat_tree,'','',0);
			foreach($this->list as $k=>$v)
			{
				unset($this->list[$k]['children']);
			}
		}
	}
	public function find($id,$type=false)
	{
		if(!$id)return false;
		if(!isset($this->cache[$id]))
		{
			foreach($this->list as $val)
			{
				if($val['_id']==$id)
				{
					$this->cache[$id]=$val;
					return $type?$val[$type]:$val;
				}
			}
		}
		else
		{
			return $type?$this->cache[$id][$type]:$this->cache[$id];
		}
	}
	public function gen($key,$val)
	{
		$arr=array();
		foreach($this->list as $value)
		{
			$arr[$value[$key]]=$value[$val];
		}
		return count($arr)?$arr:false;
	}
	public function build($cat_array, $item = '',$itemlink = '', $depth = 0,$link='',$amount=0)
	{
		if(is_array($cat_array))
		{
			foreach($cat_array as $category)
			{
				$loop_amount = $this->amount?$amount+$category[$this->amount]:0;
				$loop_item = $item.$category[$this->title];
				$category['depth']=$depth;
				$category['long_title']=$loop_item;
				$category['long_title_link']=$loop_item_link;
				$this->list[] = $category;
				if(count($category['children']) > 0)
				{
					$depth++;
					$this->build($category['children'], $loop_item.$this->arrow, $loop_item_link.$this->arrow, $depth,$category['url'].'/',$loop_amount);
					$depth--;
				}
				$loop_item = '';
			}
		}
		return $this->list;
	}
	private function add(&$tree, $parent_id, $object, $id)
	{
		if(intval($parent_id) == 0 and $object['_id'] == $id)
		{
			$tree[$object['_id']] = &$object;
			return $tree;
		}
		if($tree)
		{
			foreach($tree as $key => $value)
			{
				$current = $tree[$key];
				if($current['_id'] == $parent_id)
				{
					$tree[$key]['in_id'][]=$object['_id'];
					if($this->amount)$tree[$key]['in_amount'][]=$object['amount'];
					foreach($object['in_id'] as $v)
					{
						$tree[$key]['in_id'][]=$v;
					}
					$tree[$key]['children'][$object['_id']] = $object;
					
				}
				else
				{
					$tree[$key]['children'] = $this->add($current['children'], $parent_id, $object, $id);
				}
			}
		}
		return $tree;
	}
}
?>