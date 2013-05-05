<?php

class zz {

	private $x;
	private $y;

	public function __construct($x='' , $y= '') {
		
		if($x)
			$this->x = $x;
		if($y)
			$this->y = $y;
		
	}

	public function __set($name, $value) {
		
		if($name=='x' || $name=='y') 
		{
			if(!is_integer($value))
				return $this->setError('UNVALID_'.$name);
			else
				$this->unsetError('UNVALID_'.$name);
		}

		$this->$name = $value;
	}

	public function setStart($v='') {

		if($v=="")
			return $this->setError('START_MISSING');				
		else
			$this->unsetError('START_MISSING');				

		$this->x = $v;

	}

	public function setEnd($v='') {
		
		if($v=="")
			return $this->setError('END_MISSING');				
		else
			$this->unsetError('END_MISSING');				

		$this->y = $v;

	}

	public function output() {
		
		if($this->x=="")
			$this->setError('START_MISSING');
		else
			$this->unsetError('START_MISSING');				

		if($this->y=="")
			$this->setError('END_MISSING');
		else
			$this->unsetError('END_MISSING');				

		if($errors = $this->getErrors())
		{
			foreach($errors as $error)
				echo $error.'/r/n <br>';
		}
		else
		{

		}	


	}

	public function setError($key){
		
		switch($key) {
			case 'UNVALID_x':
				$this->errors[$key] = 'Please enter the valid (integer) starting value';
			case 'UNVALID_y':
				$this->errors[$key] = 'Please enter the valid (integer) ending value';
			case 'START_MISSING':
				$this->errors[$key] = 'Start value missing';
			case 'END_MISSING':
				$this->errors[$key] = 'End value missing';
			case 'UNVALID':
				$this->errors[$key] = 'Please enter the valid integer value';
			case 'UNVALID':
				$this->errors[$key] = 'Please enter the valid integer value';


		}
		return false;
	}

	public function unsetError($key){
		
		unset($this->errors[$key]);
		return true;

	}

	public function getErrors(){
		
		if(count($this->errors)>0)
			return $this->errors;
		return true;

	}

}
?>
