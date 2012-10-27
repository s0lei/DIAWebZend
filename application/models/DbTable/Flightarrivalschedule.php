<?php

class Application_Model_DbTable_Flightarrivalschedule extends Zend_Db_Table_Abstract {

    protected $_name = 'flightarrivalschedule';

    public function populateArrivalTable() {
        $arrivalData = new FlightData_ObtainData();
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

            //mysql_select_db('diaflight');

            $data = array(
                'idNum' => $idNumber,
                'Airline' => $airline,
                'FlightNumber' => $flightNumber,
                'CityState' => $cityState,
                'Status' => $status,
                'DateTime' => $dateTime,
                'Gate' => $gate,
                'Baggage' => $baggage,
            );
            $this->insert($data);
        }
    }

}
