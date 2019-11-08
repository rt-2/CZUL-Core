<?php
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    
    include_once(dirname(__FILE__).'/includes/definitions.inc.php');
    include_once(dirname(__FILE__).'/resources/airports.lib.inc.php');
    
    
    $request = $_SERVER['REQUEST_URI']; 
    $ret_vars = [];
    $cache_file_prefix = urlencode($request);
    //$cache_file_name = $cache_file_prefix.'_'.time();
    $cache_file_name = $cache_file_prefix;
    $cache_file_ext = 'data.cache';
    $cache_file_dir = dirname(__FILE__).'/cache';
    $cache_file_path = $cache_file_dir.'/'.$cache_file_name.'.'.$cache_file_ext;
    $req_data = explode('/', $request);
    $categ = $req_data[2];

    $cacheIsAvail = false;
    if (file_exists($cache_file_path)) {
        $time_diff = time() - filemtime($cache_file_path);
        if($time_diff < 60 * 5)
        {
            $cacheIsAvail = true;
        }
    }

    if($cacheIsAvail)
    {
        $ret_vars = unserialize(implode('', file($cache_file_path)));
    }
    else
    {

        switch($categ)
        {
            case 'airport':
                include 'airports.inc.php';
            break;
            default:
                //die('error, wrong categ');
            break;
        }
        $fp = fopen($cache_file_path, 'w');
        fwrite($fp, serialize($ret_vars));
        fclose($fp);

    }

    $ret_array = [
        'data' => $ret_vars,
    ];


    echo json_encode($ret_array, JSON_PRETTY_PRINT);
?>