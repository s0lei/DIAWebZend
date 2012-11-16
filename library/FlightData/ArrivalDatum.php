<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrivalDatum
 *
 * @author sian
 */
class FlightData_ArrivalDatum {
    private $idNumber;
    private $airline;
    private $flightNumber;
    private $cityState;
    private $city;
    private $dateTime;
    private $time;
    private $status;
    private $gate;
    private $baggage;

    function __construct() {
        
    }

    public function getIdNumber() {
        return $this->idNumber;
    }

    public function getAirline() {
        return $this->airline;
    }

    public function getFlightNumber() {
        return $this->flightNumber;
    }

    public function getCityState() {
        return $this->cityState;
    }

    public function getCity() {
        return $this->city;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function getTime() {
        return $this->time;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getGate() {
        return $this->gate;
    }

    public function getBaggage() {
        return $this->baggage;
    }

    public function setIdNumber($idNumber) {
        $this->idNumber = $idNumber;
    }

    public function setAirline($airline) {
        $this->airline = $airline;
    }

    public function setFlightNumber($flightNumber) {
        $this->flightNumber = $flightNumber;
    }

    public function setCityState($cityState) {
        $this->cityState = $cityState;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setDateTime($dateTime) {
        $this->dateTime = $dateTime;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setGate($gate) {
        $this->gate = $gate;
    }

    public function setBaggage($baggage) {
        $this->baggage = $baggage;
    }

}

?>
