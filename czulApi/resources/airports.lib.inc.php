<?php

$GLOBALS['ALL_AIRPORTS'] = array_map('str_getcsv', file(dirname(__FILE__).'/airports.lib.data.csv'));

//var_dump($GLOBALS['ALL_AIRPORTS']);
function GetAirportObject($icao)
{

    foreach($GLOBALS['ALL_AIRPORTS'] as $this_airport)
    {

        //echo '<br>';
        //var_dump($this_airport);
        //echo '<br>';
        //var_dump($ret_arr);
        if($this_airport[APIDATA_AIRPORTS_ICAO] === $icao)
        {
            $ret_obj = new stdClass();

            $ret_obj->icao = $this_airport[APIDATA_AIRPORTS_ICAO];
            $ret_obj->lat = $this_airport[APIDATA_AIRPORTS_LAT];
            $ret_obj->lon = $this_airport[APIDATA_AIRPORTS_LON];
            $ret_obj->name = $this_airport[APIDATA_AIRPORTS_NAME];
            return $ret_obj;
        }
        //echo '<br><br>';
    }
    return null;
}
function GetAirportPosition($icao)
{
    $ret_arr = array(
        "lat"=> null,
        "lon"=> null,
    );

    $this_airport = GetAirportObject($icao);

    $ret_arr["lat"] = $this_airport[APIDATA_AIRPORTS_LAT];
    $ret_arr['lon'] = $this_airport[APIDATA_AIRPORTS_LON];

    return $ret_arr;
}

function GetAirportName($icao)
{
    $ret_str = '';
    $this_airport = GetAirportObject($icao);
    $ret_str = $this_airport[APIDATA_AIRPORTS_NAME];
    break;
    return $ret_str;
}

function IsAirportValid($icao)
{
    foreach($GLOBALS['ALL_AIRPORTS'] as $this_airport)
    {
        if($this_airport[APIDATA_AIRPORTS_ICAO] === $icao)
        {
            return true;
        }
    }
    return false;
}
