<?php

class Application_Model_DbTable_Departureflightschedule extends Zend_Db_Table_Abstract {

    protected $_name = 'departureflightschedule';

    public function airlineList() {
        $select = $this->select()->DISTINCT()->from($this, array('Airline'))->Order('Airline');
        return $this->fetchAll($select)->toArray();
    }
    
    public function cityList() {
        $select = $this->select()->DISTINCT()-from($this, array('CityState'))->Order('CityState');
        return $this->fetchAll($select)->toArray();
    }

    public function populateDepartureTable() {
        $this->delete();

        $departureData = new FlightData_ObtainData();
        $departureData->fillDepartureData();
        $departureFlightDataList = $departureData->getdepartureDataList();

        foreach ($departureFlightDataList as $departureDatum) {

            $idNumber = $departureDatum->getIdNumber();
            $airline = $departureDatum->getAirline();
            $flightNumber = $departureDatum->getFlightNumber();
            $cityState = $departureDatum->getCityState();
            $dateTime = $departureDatum->getDateTime();
            $status = $departureDatum->getStatus();
            $gate = $departureDatum->getGate();
            $time = $departureDatum->getTime();

            $data = array(
                'idNum' => $idNumber,
                'Airline' => $airline,
                'FlightNumber' => $flightNumber,
                'CityState' => $cityState,
                'Status' => $status,
                'DateTime' => $dateTime,
                'Gate' => $gate,
                'Time' => $time,
            );
            $this->insert($data);
        }
    }

}

