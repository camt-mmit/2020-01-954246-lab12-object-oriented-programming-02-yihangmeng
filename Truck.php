<?php
require_once './Car.php';

class Truck extends Car
{
    private $payload;
    private $fuel;

    function __construct($owner, $pistonv)
    {
        parent::__construct($owner, $pistonv);
        $this->payload = 0;
        $this->fuel = 0;
    }

    function runFor($km)
    {
        $result = parent::runFor($km);
        if($result) {
            $this->fuel += ($km / 20) * ($this->pistonVolume() / 1000) + (($this->payload * $km) / 10000);
        }

        return $result;
    }

    function fuelUsed()
    {
        return $this->fuel;
    }

    function showLongInfo()
    {
        $result = parent::showLongInfo();
        if($result) {
            printf("Current payload:     %10s kg\n",
                number_format($this->payload, 2));
        }

        return $result;
    }

    function load($kg)
    {
        $this->payload = $kg;
        return true;
    }
}