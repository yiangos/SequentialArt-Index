<?php
	class Model
	{
		private $ioc=null;
		public function __construct($ioc)
		{
			$this->ioc=$ioc;
		}
		public function arc($arcId)
		{
			return $this->ioc->arcmanager->loadById($arcId)->toArray();
		}
	}
?>