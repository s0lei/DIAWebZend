<?php

class Application_Model_DbTable_Arrivalflightschedule extends Zend_Db_Table_Abstract {

    protected $_name = 'arrivalflightschedule';
    
    public function airlineList() {     
      $select = $this->select()->DISTINCT()->from($this, array('Airline'))->Order('Airline'); 
      return $this->fetchAll($select)->toArray();
    }
    
     public function cityList() {
        $select = $this->select()->DISTINCT()-from($this, array('CityState'))->Order('CityState');
        return $this->fetchAll($select)->toArray();
    }

    public function populateArrivalTable() {
        $this->delete();

        $arrivalData = new FlightData_ObtainData();
        $arrivalData->FillArrivalData();
        $arrivalFlightDataList = $arrivalData->getArrivalDataList();

        foreach ($arrivalFlightDataList as $arrivalDatum) {

            $idNumber = $arrivalDatum->getIdNumber();
            $airline = $arrivalDatum->getAirline();
            $flightNumber = $arrivalDatum->getFlightNumber();
            $cityState = $arrivalDatum->getCityState();
            $dateTime = $arrivalDatum->getDateTime();
            $status = $arrivalDatum->getStatus();
            $gate = $arrivalDatum->getGate();
            $baggage = $arrivalDatum->getBaggage();
            $time = $arrivalDatum->getTime();

            $data = array(
                'idNum' => $idNumber,
                'Airline' => $airline,
                'FlightNumber' => $flightNumber,
                'CityState' => $cityState,
                'Status' => $status,
                'DateTime' => $dateTime,
                'Gate' => $gate,
                'Baggage' => $baggage,
                'Time' => $time,
            );
            $this->insert($data);
        }
    }
}
