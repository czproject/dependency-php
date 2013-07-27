<?php
	/** Dependency Class
	 * 
	 * @author		Jan Pecha, <janpecha@email.cz>
	 * @version		2013-01-30-1
	 */
	
	namespace Cz;
	
	class Dependency
	{
		private $items = array();
		
		private $result = array();
		
		private $cache = array();
		
		
		
		/**
		 * @param	string
		 * @param	string[]
		 * @return	$this
		 */
		public function add($item, array $depends = array())
		{
			$this->items[(string)$item] = $depends;
			
			return $this;
		}
		
		
		
		/**
		 * @return	$this
		 */
		public function reset()
		{
			$this->items = array();
			$this->result = array();
			$this->cache = array();
			return $this;
		}
		
		
		
		public function getResolved()
		{
			$this->result = array();
			$this->cache = array();
			
			array_walk($this->items, array($this, 'applyWalk'));
			return $this->result;
		}
		
		
		
		protected function solve($key, $value)
		{
			if(isset($this->cache[$key]))
			{
				return;
			}
			
			$this->cache[$key] = TRUE;
			
			foreach($value as $v)
			{
				$v = (string) $v;
				if(isset($this->items[$v]))
				{
					$this->solve($v, $this->items[$v]);
				}
				elseif(!isset($this->cache[$v]))
				{
					$this->cache[$v] = TRUE;
					$this->result[] = $v; // nedefinovany sirotek
				}
			}
			
			$this->result[] = $key;
		}
		
		
		
		/**
		 * @internal
		 */
		public function applyWalk($value, $key)
		{
			$this->solve($key, $value);
		}
	}

