<?php
	abstract class dataobject
	{
		protected $data=array();
		public function __construct($data)
		{
			if ($data!=null)
			{
				$this->data=$data;
			}
		}
		public function __get($key)
		{
			return (count($data)>0 && isset($this->data[$key]))?$this->data[$key]:null;
		}
		public function toArray()
		{
			return $this->data;
		}
		public abstract function toJSON();
	}
?>