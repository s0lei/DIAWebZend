<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObtainData
 *
 * @author sian
 */
class FlightData_ObtainData {

    private $arrivalDataList = array();
    private $departureDataList = array();
    private $flightDateTime;
    private $date, $time, $am_pm;
    private $start;
    private $end;
    private $stop;
    private $arriveWebPage;
    private $dataStart;
    private $dataEnd;
    private $codeShare = FALSE;

    public function __construct() {
        $start = 0;
        $end = 0;
        $stop = 0;
        $brake = 100;

        $this->dataStart = "<table class=\"resultsData\"";
        $this->dataStart = htmlentities($this->dataStart);

        $this->dataEnd = "</table> </div>";
        $this->dataEnd = htmlentities($this->dataEnd);
    }

    public function getDateAmpmTime($flightDateTime) {
        $flightDateTime = trim($flightDateTime);
        $separator1 = strpos($flightDateTime, " ");
        $timelength = strlen($flightDateTime);

        $time = substr($flightDateTime, 0, $timelength - 2);
        $am_pm = substr($flightDateTime, $separator1);

        $dateAmpmTime = array();
        $dateAmpmTime[0] = trim($time);
        $hourMinute = trim($time);
        $commaPos = strpos($flightDateTime, ":");
        $hour = substr($hourMinute, 0, $commaPos);
        $minute = substr($hourMinute, $commaPos + 1);
        $dateAmpmTime[1] = $hour;
        $dateAmpmTime[2] = $minute;
        $dateAmpmTime[3] = strtolower($am_pm);

        return $dateAmpmTime;
    }

    public function getArrivalDataList() {
        return $this->arrivalDataList;
    }
    
    public function getdepartureDataList() {
        return $this->departureDataList;
    }

    public function FillArrivalData() {
        $webPageArray = $this->GetArriveFlightTextInfo();
        $idTemp = 0;

        foreach ($webPageArray as $wholeWebContent) {
            $timeSlotWebPage = "";
            $timeSlotWebPage = $wholeWebContent;

            $this->start = strpos($timeSlotWebPage, $this->dataStart);
            $this->stop = strpos($timeSlotWebPage, $this->dataEnd, $this->start);

            $dateTimeArray;
            $CityState = "";
            $Status = "";
            //$DateTim = "";
            $Gate = "";
            $Baggage = "";
            $timeString = "";
            while (($this->start + 5000) < $this->stop) {
                $arrivalData1 = new FlightData_ArrivalDatum();
                $idTemp++;
                $idNumber = (string) $idTemp;
                $arrivalData1->setIdNumber($idNumber);

                $arrivalData1->setAirline($this->FillAirline($timeSlotWebPage));
                $arrivalData1->setFlightNumber($this->FillFlightNumber($timeSlotWebPage));

                if ($this->codeShare === FALSE) {
                    $CityState = $this->FillCityState($timeSlotWebPage);
                    $arrivalData1->setCityState($CityState);

                    $Status = $this->FillStatus($timeSlotWebPage);
                    $arrivalData1->setStatus($Status);

                    $flightDateTime = $this->FillDateTime($timeSlotWebPage);
                    $arrivalData1->setDateTime($flightDateTime);

                    $Gate = $this->FillGate($timeSlotWebPage);
                    $arrivalData1->setGate($Gate);

                    $Baggage = $this->FillBaggage($timeSlotWebPage);
                    $arrivalData1->setBaggage($Baggage);

                    $dateTimeArray = $this->getDateAmpmTime($flightDateTime);
                    $hour = $dateTimeArray[1] + 0;
                    if ($dateTimeArray[3] === "pm") {
                        $hour = $hour + 12;
                    }
                    $minute = $dateTimeArray[2] + 0;
                    $ntime = $hour + ($minute / 100);
                    $timeString = strval($ntime);
                    $arrivalData1->setTime($timeString);
                } else {
                    $arrivalData1->setCityState($CityState);
                    $arrivalData1->setStatus($Status);
                    $arrivalData1->setDateTime($flightDateTime);
                    $arrivalData1->setGate($Gate);
                    $arrivalData1->setBaggage($Baggage);
                    $arrivalData1->setTime($timeString);
                }
                $this->codeShare = FALSE;
                $this->arrivalDataList[] = $arrivalData1;
            }
        }
    }
    
    public function fillDepartureData() {
        $webPageArray = $this->GetDepartureFlightTextInfo();
        $idTemp = 0;
        
        foreach ($webPageArray as $wholeWebContent) {
            $timeSlotWebPage = "";
            $timeSlotWebPage = $wholeWebContent;

            $this->start = strpos($timeSlotWebPage, $this->dataStart);
            $this->stop = strpos($timeSlotWebPage, $this->dataEnd, $this->start);
            
            $dateTimeArray;
            $CityState = "";
            $Status = "";
            $Gate = "";
            $Baggage = "";
            $timeString = "";
            while (($this->start + 5000) < $this->stop) {
                $departureData = new FlightData_DepartureDatum();
                $idTemp++;
                $idNumber = (string) $idTemp;
                $departureData->setIdNumber($idNumber);

                $departureData->setAirline($this->FillAirline($timeSlotWebPage));
                $departureData->setFlightNumber($this->FillFlightNumber($timeSlotWebPage));
                
                if ($this->codeShare === FALSE) {
                    $CityState = $this->FillCityState($timeSlotWebPage);
                    $departureData->setCityState($CityState);

                    $Status = $this->FillStatus($timeSlotWebPage);
                    $departureData->setStatus($Status);

                    $flightDateTime = $this->FillDateTime($timeSlotWebPage);
                    $departureData->setDateTime($flightDateTime);

                    $Gate = $this->FillGate($timeSlotWebPage);
                    $departureData->setGate($Gate);

                    $dateTimeArray = $this->getDateAmpmTime($flightDateTime);
                    $hour = $dateTimeArray[1] + 0;
                    if ($dateTimeArray[3] === "pm") {
                        $hour = $hour + 12;
                    }
                    $minute = $dateTimeArray[2] + 0;
                    $ntime = $hour + ($minute / 100);
                    $timeString = strval($ntime);
                    $departureData->setTime($timeString);
                } else {
                    $departureData->setCityState($CityState);
                    $departureData->setStatus($Status);
                    $departureData->setDateTime($flightDateTime);
                    $departureData->setGate($Gate);
                    $departureData->setTime($timeString);
                }
                $this->codeShare = FALSE;
                $this->departureDataList[] = $departureData;
            }
        }
    }

    public function FillAirline($webPage) {
        $tagStart = "<h4>";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "</h4>";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nAirline = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd) + 1);

        $this->brake = $this->start;
        $this->start = $this->end;

        return trim($nAirline);
    }

    public function FillFlightNumber($webPage) {
        $tagStart = "<td>";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "</td>";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nFlightNumber = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd) + 1);

        $codeShareString = substr($webPage, $this->end, 100);
        $test = "</tr>";
        $test = htmlentities($test);
        $shareInt = strpos($codeShareString, $test);

        if ($shareInt != FALSE) {
            $this->codeShare = TRUE;
        }
        $this->start = $this->end;
        return trim($nFlightNumber);
    }

    public function FillCityState($webPage) {
        $tagStart = "<td>";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "<div";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nCityState = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd) - 3);

        $tagTemp = "<img id";
        $tagTemp = htmlentities($tagTemp);
        $haveImg = strpos($nCityState, $tagTemp);

        if ($haveImg !== FALSE) {
            $tagStart = "left'>";
            $tagStart = htmlentities($tagStart);
            $tagEnd = "</span>";
            $tagEnd = htmlentities($tagEnd);

            $this->start = strpos($webPage, $tagStart, $this->start);
            $this->end = strpos($webPage, $tagEnd, $this->start);

            $nCityState = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd) + 4);
        }

        $this->start = $this->end;
        return trim($nCityState);
    }

    public function FillStatus($webPage) {
        $tagStart = "<td>";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "</span>";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $tagStart = "\">";
        $tagStart = htmlentities($tagStart);
        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nStatus = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd));

        $this->start = $this->end;
        return trim($nStatus);
    }

    public function FillDateTime($webPage) {
        $tagStart = "<td";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "</span>";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $tagStart = "<span>";
        $tagStart = htmlentities($tagStart);
        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nDateTime = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd));

        $this->start = $this->end;
        return trim($nDateTime);
    }

    public function FillGate($webPage) {
        $tagStart = "<td>";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "</td>";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nGate = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd));

        $this->start = $this->end;
        $nGate = trim($nGate);

        if (ctype_alnum($nGate))
            return $nGate;
        else
            return "";
    }

    public function FillBaggage($webPage) {
        $tagStart = "<td>";
        $tagStart = htmlentities($tagStart);
        $tagEnd = "</td>";
        $tagEnd = htmlentities($tagEnd);

        $this->start = strpos($webPage, $tagStart, $this->start);
        $this->end = strpos($webPage, $tagEnd, $this->start);

        $nBaggage = substr($webPage, $this->start + strlen($tagStart), $this->end - $this->start - strlen($tagEnd));

        $this->start = $this->end;
        $nBaggage = trim($nBaggage);

        if (ctype_alnum($nBaggage))
            return $nBaggage;
        else
            return "";
    }

    private function GetArriveFlightTextInfo() {
        $webContentArray = array();

        $urlArray = array();
        $urlArray[] = "http://www.flydenver.com/flights?ArrivingAirlineCode=&ArrivingFlightNumber=&FlightStatus=IsArriving&SourceAirportCode=&DestinationAirportCode=DEN&SourceAirportCodeValue=&Arrive_FlightRange=12AM-6AM&Arrive_FlightRange_Value=1&TravelDate=0";
        //$urlArray[] = "http://www.flydenver.com/flights?ArrivingAirlineCode=&ArrivingFlightNumber=&FlightStatus=IsArriving&SourceAirportCode=&DestinationAirportCode=DEN&SourceAirportCodeValue=&Arrive_FlightRange=6AM-9AM&Arrive_FlightRange_Value=1&TravelDate=0";

        foreach ($urlArray as $url) {
            $read = fopen("$url", "r")
                    or die("Couldn't open file");

            $webContent = '';
            while (!feof($read)) {
                $webContent .= fread($read, 8192);
            }

            $webContent = htmlentities($webContent);
            $webContent = "<pre>$webContent</pre>";
            $webContentArray[] = $webContent;
        }

        return $webContentArray;
    }

    private function GetDepartureFlightTextInfo() {
        $webContentArray = array();

        $urlArray = array();
        $urlArray[] = "http://www.flydenver.com/flights?DepartingAirlineCode=&DepartingFlightNumber=&FlightStatus=IsDeparting&SourceAirportCode=DEN&DestinationAirportCode=&DestinationAirportCodeValue=&Depart_FlightRange=12AM-6AM&Depart_FlightRange_Value=1&TravelDate=0";
        //$urlArray[] = "http://www.flydenver.com/flights?DepartingAirlineCode=&DepartingFlightNumber=&FlightStatus=IsDeparting&SourceAirportCode=DEN&DestinationAirportCode=&DestinationAirportCodeValue=&Depart_FlightRange=6AM-8AM&Depart_FlightRange_Value=1&TravelDate=0";

        foreach ($urlArray as $url) {
            $read = fopen("$url", "r")
                    or die("Couldn't open file");

            $webContent = '';
            while (!feof($read)) {
                $webContent .= fread($read, 8192);
            }

            $webContent = htmlentities($webContent);
            $webContent = "<pre>$webContent</pre>";
            $webContentArray[] = $webContent;
        }

        return $webContentArray;
    }

}

?>
