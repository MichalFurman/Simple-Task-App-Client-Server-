<?php
    /** plik startowy serwera, wystarczy by katalog domowy wskazywał na powyższy
     *  Proste uruchomienie serwera dla wbudowanego serwera PHP
     *  komenda:  PHP -S localhost:8001 w katalogu src/public_html
    */
    
    require_once __DIR__ . '../../../vendor/autoload.php';
    require_once __DIR__ . '../../../src/app/autostart.php';  
    require_once __DIR__ . '../../../src/app/routes.php';
?>
