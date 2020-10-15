<?php
interface Runnable
{
	function runningDistance();
	function runFor($km);
}
Showinfo.php:
<?php
interface ShowInfo
{
              function showInfo();
	function showLongInfo();
	function takePet();
	function releasePet();
}
pet.php:
<?php
require_once './Runnable.php';
require_once './ShowInfo.php';

class pet implements Runnable, ShowInfo
{
	protected $name;
	protected $distance;
function __construct($name)
{
   $this->name = $name;
   $this->distance = 0;
}
 function runFor($km) 
 {
    $this->distance += $km;
 }
 function showInfo() 
 {
    echo "Name: ".$this->name;
 }
  function showLongInfo() 
  {
    echo "Name: ".$this->name;
    echo "Running distance = {$this->distance} km\n";
  }
}
Person.php:
<?php
require_once './runnable.php';
class Person implements Runnable
{
	protected $name;
	protected $distance;
	function __construct($name)
	{
		 $this->name = $name;
		 $this->distance = 0;
	}
	function runningDistance()
	{
		$this->distance = $distance;
	}
	function runFor($km)
	{
		$this->distance += $km;
	}
}
Petlover.php:
<?php
require_once './person.php';
class petlover extends person implements Showinfo{
function __construct($name,$distance)
  {
    parent::__construct($name,$distance)
  }
function takePet()
{
	return 1;
}
function releasePet()
{
	return 0;
}
function showLongInfo() 
{
    echo "Name: ".$this->name;
	echo "\nRunning distance = {$this->distance} km\n";
    echo "\nTaken pets: ";
}
12.2.php:
<?php
require_once"./pet.php";
require_once"./petlover.php";
require_once"./showinfo.php";
echo"Input pet lover name : ";
$PetLoverName=trim(fgets(STDIN));
$mypet = new petlover($PetLoverName,0);
echo"\nInput number of pets : ";
$Number=trim(fgets(STDIN));
for($i=0;$i<$Number;$i++)
{
	echo"\nInput pet ($i+1) name : ";
	$PetName[$i]=trim(fgets(STDIN));
	$pet[$i]= new pet($PetName[$i],0);
	$pets[$i]=0;
}
for(;;)	
{	
	echo"Command (h for help) : ";
	$a=trim(fgets(STDIN));
	$input=explode(' ',$a);
	if($input[0]=='h')
	{
		echo"t take the given pet name\n
			 re release all taken pets\n
			 r run for the given km\n
			 i show information of pet lover and all pets\n
			 e exit\n
			 h print this help\n";
	}
	if($input[0]=='t')
	{
		for($i=0;$i<$Number;$i++)
		{
			if(input[1]==$PetName[$i])
			{
				$pets[$i]=$mypet->takePet();
			}
		}
	}
	if($input[0]=='re')
	{
		for($i=0;$i<$Number;$i++)
		{
			$pets[$i]=$mypet->releasePet();
		}
	}
	if($input[0]=='r')
	{
		for($i=0;$i<$Number;$i++)
		{
			if($pets[$i]==1)
			{
				$pet[$i]->runFor($input[1]);
			}
		}
		$mypet->runFor($input[1]);
	}
	if($input[0]=='i')
	{
		$mypet->showLongInfo();
		for($i=0;$i<$Number;$i++)
		{
			if($pet[$i]->runningDistance()!=0)
			{
				echo $PetName[$i]." ";
			}
		}
		for($i=0;$i<$Number;$i++)
		{
			echo $pet[$i]->showLongInfo();
		}
	}
	if($input[0]=='e')
	{
		break;
	}
}

