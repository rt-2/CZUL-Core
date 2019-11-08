<?php

    include_once(dirname(__FILE__).'/includes/definitions.inc.php');
    include_once(dirname(__FILE__).'/resources/airports.lib.inc.php');
    
    $icao = strtoupper($req_data[3]);
    $ret_vars[] = GetAirportObject($icao);



?>