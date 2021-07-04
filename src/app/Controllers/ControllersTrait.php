<?php
    namespace Myvendor\Actaskman\Controllers;
 
    trait ControllersTrait
    {
        public function checkResult(array $result) :array
        {
            if (isset($result['status']) && isset($result['data'])) return $result;
            else return array('data'=>'something was wrong', 'status'=>500);
        }
    }

?>