<?php
require_once './Vehicle.php';

class Car extends Vehicle
{
    private $pistonv;
    
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
            printf("Fuel used:           %10s L\n",
                number_format($this->fuelUsed(), 2));
        } else {
            return false;
        }
        return true;
    }
}
