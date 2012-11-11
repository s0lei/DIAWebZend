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

        $this->FillArrivalData();
    }

    public function getArrivalDataList() {
        return $this->arrivalDataList;
    }

    public function FillArrivalData() {
        $webPageArray = $this->GetArriveFlightTextInfo();
        $idTemp = 0;

        foreach ($webPageArray as $wholeWebContent) {
            $timeSlotWebPage = "";
            $timeSlotWebPage = $wholeWebContent;

            $this->start = strpos($timeSlotWebPage, $this->dataStart);
            $this->stop = strpos($timeSlotWebPage, $this->dataEnd, $this->start);

            $CityState = "";
            $Status = "";
            $DateTim = "";
            $Gate = "";
            $Baggage = "";
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

                    $DateTim = $this->FillDateTime($timeSlotWebPage);
                    $arrivalData1->setDateTime($DateTim);

                    $Gate = $this->FillGate($timeSlotWebPage);
                    $arrivalData1->setGate($Gate);

                    $Baggage = $this->FillBaggage($timeSlotWebPage);
                    $arrivalData1->setBaggage($Baggage);
                } else {
                    $arrivalData1->setCityState($CityState);
                    $arrivalData1->setStatus($Status);
                    $arrivalData1->setDateTime($DateTim);
                    $arrivalData1->setGate($Gate);
                    $arrivalData1->setBaggage($Baggage);
                }
                $this->codeShare = FALSE;
                $this->arrivalDataList[] = $arrivalData1;
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

    public function fillDepartureList() {
        $departureData1 = new ArrivalFlightData();
        $departureData2 = new ArrivalFlightData();

        $departureData1->setIdNumber("1");
        $departureData1->setAirline("3");
        $departureData1->setFlightNumber("4");
        $departureData1->setCityState("5");
        $departureData1->setCity("6");
        $departureData1->setDateTime("7");
        $departureData1->setTime("2");
        $departureData1->setStatus("8");
        $departureData1->setGate("9");

        $this->arrivalDataList[] = $departureData1;

        $departureData2->setIdNumber("10");
        $departureData2->setAirline("30");
        $departureData2->setFlightNumber("40");
        $departureData2->setCityState("50");
        $departureData2->setCity("60");
        $departureData2->setDateTime("70");
        $departureData2->setTime("20");
        $departureData2->setStatus("80");
        $departureData2->setGate("90");

        $this->arrivalDataList[] = $departureData2;
    }

    private function GetArriveFlightTextInfo() {
        $webContentArray = array();

        $urlArray = array();
        $urlArray[] = "http://www.flydenver.com/flights?ArrivingAirlineCode=&ArrivingFlightNumber=&FlightStatus=IsArriving&SourceAirportCode=&DestinationAirportCode=DEN&SourceAirportCodeValue=&Arrive_FlightRange=12AM-6AM&Arrive_FlightRange_Value=1&TravelDate=0";
        $urlArray[] = "http://www.flydenver.com/flights?ArrivingAirlineCode=&ArrivingFlightNumber=&FlightStatus=IsArriving&SourceAirportCode=&DestinationAirportCode=DEN&SourceAirportCodeValue=&Arrive_FlightRange=6AM-9AM&Arrive_FlightRange_Value=1&TravelDate=0";

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
