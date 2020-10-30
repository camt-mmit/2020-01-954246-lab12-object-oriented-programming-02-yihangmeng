<?php
require_once './Vehicle.php';
class Car extends Vehicle
{
	protected $pistonv;
	function __construct($owner, $pistonv)
	{
		parent::__construct($owner);
		$this->pistonv = $pistonv;
	}
	function pistonVolume()
	{
		return $this->pistonv;
	}
	function fuelUsed()
	{
		return ($this->runningDistance() / 20) * ($this->pistonv / 1000);
	}
	function showLongInfo()
	{
		if(parent::showLongInfo()) {
			printf("Fuel used:        %6.2f L\n",
				$this->fuelUsed());
		} else {
			return false;
		}
		return true;
	}
}
Vehicle.php
<?php
require_once './Runnable.php';
require_once './ShowInfo.php';
class Vehicle implements Runnable, ShowInfo
{
	private $owner;
	private $isEngineOn;
	private $distance;
	function __construct($owner)
	{
		$this->owner = $owner;
		$this->isEngineOn = false;
		$this->distance = 0;
	}
	function engineStart()
	{
		$this->isEngineOn = true;
	}
	function engineStop()
	{
		$this->isEngineOn = false;
	}
	function runningDistance()
	{
		return $this->distance;
	}
	function runFor($km)
	{
		if(!$this->isEngineOn) {
			fprintf(STDERR, "Cannot run, engine is off\n");
			return false;
		}
		$this->distance += $km;
		return true;
	}
	function showInfo()
	{
		if($this->isEngineOn) {
			fprintf(STDERR, "Cannot show, engine is on\n");
			return false;
		}
		printf("Owner: %s\n", $this->owner);
		return true;
	}
	function showLongInfo()
	{
		if($this->showInfo()) {
			printf("Running distance: %6d km\n",
				$this->distance);
		} else {
			return false;
		}
		return true;
	}
}
Runnable.php
<?php
interface Runnable
{
	/**
	 * Get accumulated distance.
	 */
	function runningDistance();
	/**
	 * Run for $km kilometer(s).
	 */
	function runFor($km);
}
Showinfo.php
<?php
interface ShowInfo
{
	/**
	 * Show the short information.
	 */
	function showInfo();
	/**
	 * Show the long information.
	 */
	function showLongInfo();
}
12.1.php
<?php
require_once"car.php";
class bus extends Car
{
  private $numberPassenger;
  function __construct($owner,$pistonv)
  {
    parent::__construct($owner,$pistonv); 
  }
  function fuelUsed()
	{
		return ($this->runningDistance() / 20) * ($this->pistonv / 1000)+((70*($this->numberPassenger)*$this->runningDistance())/10000);
	}
  function showLongInfo()
	{
		if(parent::showLongInfo()) {
			#printf("Fuel used:        %6.2f L\n",
			#$this->fuelUsed());
		} 
		else {
			return false;
		}
		echo"Number of Passenger : ".$this->numberPassenger."\n";
		return true;
	}
	function setPassengerNumber($numberPassenger)
  {
    $this->numberPassenger = $numberPassenger;
  }
}
#$A= new bus("Phasit",2000);
#$A-> setPassengerNumber(20);
#$A-> engineStart();
#$A-> runFor(150);
#$A-> runFor(10);
#$A-> engineStop();
#$A-> showLongInfo();

echo"Input (owner cc):";
	$a=trim(fgets(STDIN));
	$input=explode(' ',$a);
	$owner=$input[0];
	$cc=$input[1];
$mybus = new bus($owner,$cc);
while(True)
{
	echo"\nCommand (h for help):";
	$a=trim(fgets(STDIN));
	$input=explode(' ',$a);
	if($input[0]=='h')
	{
		echo"0 stop engine\n
		     1 start engine\n
			 r run for the given km\n
			 p set number of passengers with the given number\n
			 i show information (engine is off only)\n
			 e exit\n
			 h print this help\n";
	}
	if($input[0]=='0')
	{
		$mybus->engineStop();
	}
	if($input[0]=='1')
	{
		$mybus->engineStart();
	}
	if($input[0]=='r')
	{
		$mybus->runFor($input[1]);
	}
	if($input[0]=='p')
	{
		$mybus->setPassengerNumber($input[1]);
	}
	if($input[0]=='i')
	{
		$mybus-> showLongInfo();
	}
	if($input[0]=='e')
	{
		break;
	}
}
