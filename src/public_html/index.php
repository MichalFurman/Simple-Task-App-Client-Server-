<?php
    /** plik startowy serwera, wystarczy by katalog domowy wskazywał na powyższy
     *  Proste uruchomienie serwera dla wbudowanego serwera PHP
     *  komenda:  PHP -S localhost:8001 w katalogu src/public_html
    */
    
    /* autoload.php */
    if (file_exists(__DIR__ . '../../../vendor/autoload.php')) require __DIR__ . '../../../vendor/autoload.php';
    else if (file_exists(__DIR__ . '/../../../vendor/autoload.php')) require __DIR__ . '/../../../vendor/autoload.php';
    else if (file_exists('../../../vendor/autoload.php')) require '../../../vendor/autoload.php';
    else exit ('Can not load file "autoload.php" in: "src/public_html/index.php", plase check path and file.');

    /* autostart.php */
    if (file_exists(__DIR__ . '../../../src/app/autostart.php')) require __DIR__ . '../../../src/app/autostart.php';
    else if (file_exists(__DIR__ . '/../../../src/app/autostart.php')) require __DIR__ . '/../../../src/app/autostart.php';
    else if (file_exists('../../../src/app/autostart.php')) require '../../../src/app/autostart.php';
    else exit ('Can not load file "autostart.php" in: "src/public_html/index.php", plase check path and file.');

    /* routes.php */
    if (file_exists(__DIR__ . '../../../src/app/routes.php')) require __DIR__ . '../../../src/app/routes.php';
    else if (file_exists(__DIR__ . '/../../../src/app/routes.php')) require __DIR__ . '/../../../src/app/routes.php';
    else if (file_exists('../../../src/app/routes.php')) require '../../../src/app/routes.php';
    else exit ('Can not load file "routes.php" in: "src/public_html/index.php", plase check path and file.');

?>
