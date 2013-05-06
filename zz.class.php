<?php

class zz {

	private $x; // starting value
	private $y; // ending value
	public $errors = array(); // errors array 
	private $words = array('3'=>'Fizz', '5'=>'Buzz'); // zz words
	private $bingo = 'Bazz'; // bazz word

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
			$series = array(); //array of printed series
			for($x=$this->x; $x<=$this->y; $x++) // loop from starting value to ending value
			{
				$strike = false;
				if($c!=1)
				echo ', ';


				foreach($this->words as $key=>$word) // loop the zz words
					if(($x%$key)==0)
					{
						echo $word; // zz word
						$strike = true; 
						$series[] = $word;
					}

				/////BAZZ CODE START/////	
				if($strike===false)		
				{
					$count_series = count($series);	
					$count_words = count($this->words); 

					if($count_series>=$count_words)	// the bazz word can only come after the zz words
					{
						$words = array_values($this->words);
						for($i=$count_words; $i>0; $i--) // find the zz words in the last 2 positions of series
						{
						
							if(in_array($series[$count_series-$i], $words))
							{
								$key = array_search($series[$count_series-$i], $words);
								unset($words[$key]);
							}

						}
						if(count($words)==0) // if the zz words found then print the bazz word
						{
							echo $this->bingo;
							$series[] = $this->bingo;
							$strike = true;
						}	

					}
				}	
				//////BAZZ CODE END/////

				if($strike===false)	// if no zz/bazz word found then print the integer value	
				{
					echo $x;
					$series[] = $x;
				}
			$c++;	
			}

		}	


	}

	public function setError($key){
		
		switch($key) {
			case 'UNVALID_START':
				$this->errors[$key] = 'Please provide positive integer value of starting';
				break;
			case 'UNVALID_END':
				$this->errors[$key] = 'Please provide positive integer value of ending';
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
