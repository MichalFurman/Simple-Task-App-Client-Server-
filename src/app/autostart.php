<?php   
    /** plik, w którym możemy sobie zdefiniować poszczególne usługi które mają zastartować zanim ruszą docelowe serwisy
     *  plik conf jest odczytywany do tablicy, która jest czytana globalnie,
     *  konfigurację na apache można przypisać do zmiennych środowiskowych i w ten sposób z niej korzystać
     * 
     *  Dodatkowo mamy inicjowaną instancję singletone dla połączenia z bazą danych, tylko przy pierwszym razie wymaga ona by podać jej
     *  dane konfiguracji do bazy danych, potem każde odpytanie metodą statyczną zwraca jej jedyną już skonfigurowaną instancję
     *  możemy ją wstrzykiwać przez DI
    */
    
    $global_conf = parse_ini_file('../../env.conf');
    \mfurman\pdomodel\PDOAccess::get($global_conf);
?>
