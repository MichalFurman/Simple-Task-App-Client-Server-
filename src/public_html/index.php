<?php
    /** plik startowy serwera, wystarczy by katalog domowy wskazywał na powyższy
     *  Proste uruchomienie serwera dla wbudowanego serwera PHP
     *  komenda:  PHP -S localhost:8001 w katalogu src/public_html
    */
    
    /* autoload.php */
    require '../../vendor/autoload.php';

    /* autostart.php */
    require '../../src/app/autostart.php';

    /* routes.php */
    require '../../src/app/routes.php';

?>
