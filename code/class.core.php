<?php
	class Core
	{
		private $ioc=null;
		public function __construct($ioc)
		{
			$this->ioc=$ioc;
		}
		
		public function processRequest()
		{
			if(isset($_GET["type"]) && strlen($_GET["type"])>0)
			{
				$this->ioc->
			}
		}
	}
?>