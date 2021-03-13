<?php

	namespace CzProject\DependencyPhp;


	class Resolver
	{
		/** @var  array<string, string[]|NULL>  [(string) item => (array) depends] */
		private $items = [];

		/** @var  array<string> */
		private $result = [];

		/** @var  array<string, TRUE>  [(string) item => TRUE] */
		private $cache = [];

		/** @var  bool */
		private $useCached = TRUE;



		/**
		 * @param  string $item
		 * @param  string|string[]|NULL $depends
		 * @return self
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
		 * @return self
		 */
		public function reset()
		{
			$this->items = [];
			$this->result = [];
			$this->cache = [];
			return $this;
		}



		/**
		 * @return array<string>
		 */
		public function getResolved()
		{
			if($this->useCached)
			{
				return $this->result;
			}

			$this->result = [];
			$this->cache = [];

			array_walk($this->items, function ($value, $key) {
				$this->solve($key, $value);
			});
			$this->useCached = TRUE;
			return $this->result;
		}



		/**
		 * @param  string $key
		 * @param  string[]|NULL $value
		 * @return void
		 */
		private function solve($key, array $value = NULL)
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
	}
