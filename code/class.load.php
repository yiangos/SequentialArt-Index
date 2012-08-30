<?php
class Load{
	
	public function __construct(){}
	
	function view ($filename, $data=null, $doExtraction=false)
	{
		if(is_array($data) && $doExtraction)
		{
			extract($data);
		}
		include("views/".$filename);
	}
}
?>