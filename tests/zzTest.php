<?php
require_once __DIR__.'/../zz.class.php';

class zzTest extends PHPUnit_Framework_TestCase {
	protected $zz;

	protected function setUp() {

        $this->zz = new zz();

    }

	public function testInitialization() {

		$this->assertInstanceOf('zz',$this->zz);
	}

	public function testInitializingVariables() {

		$zz = new zz('1','10');
		$this->assertEquals('1',$zz->x, 'It should be 1');
		$this->assertEquals('10',$zz->y, 'It should be 10');

	}

	public function testSettingVariablesDirectly() {

		$this->zz->x = '2';
		$this->zz->y = '20';

		$this->assertEquals('2',$this->zz->x, 'It should be 2');
		$this->assertEquals('20',$this->zz->y, 'It should be 20');
		
	}

	public function testSettingVariablesbyMethods() {

		$this->zz->setStart('3');
		$this->zz->setEnd('30');

		$this->assertEquals('3',$this->zz->x, 'It should be 3');
		$this->assertEquals('30',$this->zz->y, 'It should be 30');
		
	}

	public function testOutputWithPositiveIntegerString() {

		$this->zz->setStart('1');
		$this->zz->setEnd('5');
		$this->expectOutputString('1, 2, Fizz, 4, Buzz');
		$this->zz->output();

	}

	public function testOutputWithString() {

		$this->zz->setStart('one');
		$this->zz->setEnd('five');
		$this->expectOutputRegex('/provide positive integer value/s');
		$this->zz->output();

	}

	public function testOutputWithPositiveIntegerINT() {	
	
		$this->zz->setStart(1);
		$this->zz->setEnd(5);
		$this->expectOutputString('1, 2, Fizz, 4, Buzz');
		$this->zz->output();		
	
	}	

	public function testOutputWithNegativeInteger() {

		$this->zz->setStart(-1);
		$this->zz->setEnd(5);
		$this->expectOutputString('Please provide positive integer value of starting <br>');
		$this->zz->output();		
		
	}	

	public function testOutputWithPositiveDecimal() {

		$this->zz->setStart(1.5);
		$this->zz->setEnd(5);
		$this->expectOutputString('Please provide positive integer value of starting <br>');
		$this->zz->output();		

	}

	public function testOutputWithZero() {

		$this->zz->setStart(0);
		$this->zz->setEnd(5);
		$this->expectOutputString('FizzBuzz, 1, 2, Fizz, 4, Buzz');
		$this->zz->output();		

	}

	public function testOutputWithInverseRange() {

		$this->zz->setStart(5);
		$this->zz->setEnd(1);
		$this->expectOutputString('Starting value cannot be less than or equal to ending value <br>');
		$this->zz->output();		

	}


	public function testOutputWithEqual() {

		$this->zz->setStart(1);
		$this->zz->setEnd(1);
		$this->expectOutputString('Starting value cannot be less than or equal to ending value <br>');
		$this->zz->output();		

	}

	protected function tearDown() {

        unset($this->zz);
    }
}

?>