<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartureDatum
 *
 * @author LeiS
 */
class FlightData_DepartureDatum {
    private $idNumber;
    private $airline;
    private $flightNumber;
    private $cityState;
    private $city;
    private $dateTime;
    private $status;
    private $gate;
    private $dateAmpmTime;
    private $ampmTime;
    private $hour;
    private $time;
    
    function __construct() {
        
    }

    public function getIdNumber(){
        return $this->idNumber;
    }

    public function getAirline(){
        return $this->airline;
    }

    public function getFlightNumber(){
        return $this->flightNumber;
    }

    public function getCityState(){
        return $this->cityState;
    }

    public function getCity(){
        return $this->city;
    }

    public function getDateTime(){
        return $this->dateTime;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getGate(){
        return $this->gate;
    }

    public function getTime(){
        return $this->time;
    }

    public function setIdNumber($idNumber){
        $this->idNumber = $idNumber;
    }

    public function setAirline($airline){
        $this->airline = $airline;
    }

    public function setFlightNumber($flightNumber){
        $this->flightNumber = $flightNumber;
    }

    public function setCityState($cityState){
        $this->cityState = $cityState;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function setDateTime($dateTime){
        $this->dateTime = $dateTime;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setGate($gate){
        $this->gate = $gate;
    }

    public function setTime($time){
        $this->time = $time;
    }

    /**
     * @return the dateAmpmTime
     */
    public function getDateAmpmTime() {
        return $this->dateAmpmTime;
    }

    /**
     * @param dateAmpmTime the dateAmpmTime to set
     */
    public function setDateAmpmTime($dateAmpmTime) {
        $this->dateAmpmTime = $dateAmpmTime;
    }

    /**
     * @return the ampmTime
     */
    public function getAmpmTime() {
        return $this->ampmTime;
    }

    /**
     * @param ampmTime the ampmTime to set
     */
    public function setAmpmTime($ampmTime) {
        $this->ampmTime = $ampmTime;
    }

    /**
     * @return the hour
     */
    public function getHour() {
        return $this->hour;
    }

    /**
     * @param hour the hour to set
     */
    public function setHour($hour) {
        $this->hour = $hour;
    }

}

?>
