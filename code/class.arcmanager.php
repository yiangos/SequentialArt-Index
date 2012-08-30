<?php
	require_once("class.arc.php");
	
	class Arcmanager
	{
		private $ioc=null;
		
		public function __construct($ioc)
		{
			$this->ioc=$ioc;
		}
		
		public function loadById($arcId)
		{
			$stm=$this->ioc->database->prepare("SELECT * FROM arc WHERE id=:id");
			$stm->execute(array(":id"=>$arcId));
			return new arc($stm->fetch(PDO::FETCH_ASSOC));
		}
	}
?>