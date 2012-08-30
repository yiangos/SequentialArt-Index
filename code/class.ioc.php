<?php

class ioc{
	private $_params=array();
	private $_instances=array();
	
	public function __construct($config)
	{
		if(is_array($config))
		{
			array_merge($this->_params, $config);	
		}
		if (file_exists(str_replace("code","",__DIR__).$config))
		{
			$this->_params=array_merge(
				$this->_params,
				$this->getConfigFromIni(str_replace("code","",__DIR__).$config)
			);
		}		
	}
	
	public function __get($name)
	{
		//If we already have it (case insensitive), return it.
		if (isset($this->_instances[strtolower($name)]))
		{
			return $this->_instances[strtolower($name)];
		}
		//if it is defined in the configuration, create it and return it
		else if(array_key_exists($name, $this->_params))
		{
			$this->_instances[strtolower($name)]=$this->createInstance($name);
			return $this->_instances[strtolower($name)];
		}
		//last resort. If a file with a certain filename exists, include it and 
		//try to create an instance using a specific type of constructor
		//and return it. The name of the class must be the same as the
		//argument passed, with the first letter uppercase and all other
		//letters lowercase. The name of the file must be of the form
		// "class.nameofclass.php, where <nameofclass> is the argument
		//with all letters in lowercase. The class constructor must accept
		//this class as its only argument.
		else if (file_exists("class.".strtolower($name).".php"))
		{
			try
			{
				require_once("class.{$name}.php");
				$refl=new ReflectionClass(ucfirst(strtolower($name)));
				$this->_instances[strtolower($name)]=$refl->newInstanceArgs(array($this));
				return $this->_instances[strtolower($name)];	
			}
			catch(Exception $e)
			{
				return null;
				//test
			}
		}
		//everything has failed. Return null.
		return null;
	}
		
	protected function getConfigFromIni($filename)
	{
		return parse_ini_file($filename, true);	
	}
	
	protected function createInstance($name)
	{
		$args=array();
		foreach($this->_params[$name] as $key=>$value)
		{
			if($key!="file" && $key!="type")
			{
				$args[]=$value;	
			} 	
		}
		
		if (strtolower($this->_params[$name]["file"])!="system")
		{
			require_once($this->_params[$name]["file"]);
			array_unshift($args, $this);
		}
		$refl=new ReflectionClass($this->_params[$name]["type"]);
		return $refl->newInstanceArgs($args);			
	}
}

?>