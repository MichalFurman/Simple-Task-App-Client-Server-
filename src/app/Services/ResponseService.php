<?php
    namespace Myvendor\Actaskman\Services;
 
    class ResponseService
    {
        public function response(array $result) : void
        {
            if (!isset($result['status']) || !isset($result['data'])) {
                http_response_code(500);
                echo json_encode(array('something has wrong, data was corrupted'));	    
            }
            http_response_code($result['status']);
            echo json_encode($result['data']);	    
        }
    }

?>