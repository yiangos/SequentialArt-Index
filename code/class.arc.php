<?php
	require_once("class.dataobject.php");
	
	/*
	Instances of this class should have a subset 
	of the following properties:
	- int id (meant to be used internally)
	- string title (the title of the arc)
	- string description (small description of what goes on 
										in the arc)
	- int strips (number of strips this arc spans)
	*/
	class arc extends dataobject
	{
		public function __construct($data=null)
		{
			parent::__construct($data);
		}
		public function toJSON()
		{
			json_encode($this->data);
		}
	}
?>