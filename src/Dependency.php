<?php
	/** Dependency Class
	 *
	 * @author		Jan Pecha, <janpecha@email.cz>
	 */

	namespace Cz;

	class Dependency
	{
		/** @var  array  [(string) item => (array) depends] */
		private $items = array();

		/** @var  array */
		private $result = array();

		/** @var  array  [(string) item => TRUE] */
		private $cache = array();

		/** @var  bool */
		private $useCached = TRUE;



		/**
		 * @param	string
		 * @param	string|string[]|NULL
		 * @return	self
		 */
		public function add($item, $depends = NULL)
		{
			if($depends !== NULL && !is_array($depends))
			{
				$depends = (array) $depends;
			}

			$this->items[(string)$item] = $depends;
			$this->useCached = FALSE;
			return $this;
		}



		/**
		 * @return	self
		 */
		public function reset()
		{
			$this->items = array();
			$this->result = array();
			$this->cache = array();
			return $this;
		}



		/**
		 * @return	array
		 */
		public function getResolved()
		{
			if($this->useCached)
			{
				return $this->result;
			}

			$this->result = array();
			$this->cache = array();

			array_walk($this->items, array($this, 'applyWalk'));
			$this->useCached = TRUE;
			return $this->result;
		}



		/**
		 * @param	string
		 * @param	array|NULL
		 * @return	void
		 */
		protected function solve($key, array $value = NULL)
		{
			if(isset($this->cache[$key]))
			{
				return;
			}

			$this->cache[$key] = TRUE;

			if($value !== NULL)
			{
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

