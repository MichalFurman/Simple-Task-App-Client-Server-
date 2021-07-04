<?php
    /** definicja CORS Policy dla odpytań serwera
     *  oczywiście możemy sobie zdefiniować zarówno domenę jak i dopuszczalne metody i nagłówki
     *  na razie jest ruch w pełni dopuszczony dla każdego odpytania i każdej domeny
    */


    if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
        header("HTTP/1.1 200 OK");
        die();
    }
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");

?>