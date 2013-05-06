<?php

class zz {

	private $x; // starting value
	private $y; // ending value
	public $errors = array(); // errors array 
	private $words = array('3'=>'Fizz', '5'=>'Buzz'); // zz words

	public function __construct($x='' , $y= '') {
		
		if($x) // set x "starting" value if provided in initialization
			$this->setStart($x);
		if($y) // set y "ending" value if provided in initialization
			$this->setEnd($y);
		
	}

	public function __set($name, $value) {
		

		if($name=='x') // check if x "starting value" is set from outside
			$this->setStart($value);

		elseif($name=='y') // check if y "ending value" is set from outside
			$this->setEnd($value);
		
		else
			$this->$name = $value;
	}	

	public function __get($name) {
		
			return $this->$name;
	}	

	public function setStart($v='') { // setter function for setting the starting value

		if($v==="") // check if value is not provided
			return $this->setError('START_MISSING');				
		else
			$this->unsetError('START_MISSING');				

		if((string)(int)$v == $v && (int)$v >= 0) //check if value is positive integer
			$this->unsetError('UNVALID_START');
		else
			return $this->setError('UNVALID_START');


		$this->x = $v;

	}

	public function setEnd($v='') { // setter function for setting the ending value
		
		if($v==="") // check if value is not provided
			return $this->setError('END_MISSING');				
		else
			$this->unsetError('END_MISSING');				

		if((string)(int)$v == $v && (int)$v >= 0) //check if value is positive integer
			$this->unsetError('UNVALID_END');
		else
			return $this->setError('UNVALID_END');
		
		$this->y = $v;

	}

	public function output() { // prints the range / output
		
		if($this->getErrors()===false) //check if errors already triggered in set methods
		{

			if($this->x==="") // check if starting value is missing/not available
				$this->setError('START_MISSING');
			else
				$this->unsetError('START_MISSING');				

			if($this->y==="") // check if ending value is missing / not available
				$this->setError('END_MISSING');
			else
				$this->unsetError('END_MISSING');					

		}

		if($this->getErrors()===false) //check if errors already triggered
		{
			if($this->x >= $this->y)
				$this->setError('RANGE_MISMATCH');
			else
				$this->unsetError('RANGE_MISMATCH');
		}	

		if($errors = $this->getErrors()) //get errors again
		{
			foreach($errors as $error) 
				echo $error.' <br>'; //print errors
		}
		else
		{
			
			$c = 1;
			for($x=$this->x; $x<=$this->y; $x++)
			{
				$strike = false;
				if($c!=1)
				echo ', ';

				foreach($this->words as $key=>$word)
					if(($x%$key)==0)
					{
						echo $word;
						$strike = true;
					}

				if($strike===false)		
				echo $x;
			$c++;	
			}

		}	


	}

	public function setError($key){
		
		switch($key) {
			case 'UNVALID_START':
				$this->errors[$key] = 'Please enter the valid (integer) starting value';
				break;
			case 'UNVALID_END':
				$this->errors[$key] = 'Please enter the valid (integer) ending value';
				break;
			case 'START_MISSING':
				$this->errors[$key] = 'Start value missing';
				break;
			case 'END_MISSING':
				$this->errors[$key] = 'End value missing';
				break;		
			case 'RANGE_MISMATCH':
				$this->errors[$key] = 'Starting value cannot be less than or equal to ending value';
				break;		
			default:
				$this->errors['NO_MATCH'] = 'key:'.$key.' not found in errors';		

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

		return false;

	}

}
?>
