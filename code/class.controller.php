<?php
	class Controller
	{
		private $ioc=null;
		public function __construct($ioc)
		{
			$this->ioc=$ioc;
		}
		
		public function arc($id)
		{
			$this->ioc->load->view(
				"view.json.php",
				$this->ioc->model->arc($id)
			);
		}
	}
?>