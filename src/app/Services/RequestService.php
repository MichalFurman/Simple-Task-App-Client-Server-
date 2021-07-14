<?php
    /**
     *  Prosty Request Service z odczytem danych i parsowaniem ich do JSON-a 
     *  Metodę walidacji danych można rozbudować o kolejne typy danych - wg potrzeb,
     *  Zastosowany jest chaining dla wykonywania metod,
     */

    namespace Myvendor\Actaskman\Services;

    class RequestService 
    {

        private $data;
        private $fail = null;
 
        public function validationToString($errArray)
        {
            $valArr = array();
            $errString = '';
            foreach ($errArray->toArray() as $key => $value) { 
                $errStr = $value[0];
                array_push($valArr, $errStr);
            }
            if(!empty($valArr)){
                $errString = implode('</br>', $valArr);
            }
            return $errString;
        }
        
        public function read()
        {
            if (strlen(file_get_contents('php://input')) > 0) {
                $request = json_decode(file_get_contents('php://input'), true);
                if (json_last_error() == JSON_ERROR_NONE) {
                    $this->data = $request;
                    return $this;
                }
                $this->data = array('data'=>'The data is corrupted. Bad JSON data.');
                $this->fail = true;
                return $this;
            }
            $this->data = array('data'=>'Bad JSON data. No data in request');
            $this->fail = true;
            return $this;
        }

        public function get() 
        {
            if ($this->fail === false) return $this->data;
            return null;
        }

        public function errors() 
        {
            if ($this->fail === true) {
                return $this->data;
            }
            return null;
        }

        public function validate(array $validationRules)
        {
            if ($this->fail === true) return $this;
            
            $errors = array();

            foreach ($validationRules as $rule) {
                if (isset($rule['input'])) {
                   if (isset($this->data[$rule['input']])) {
                        if ($rule['type'] === 'string' || $rule['type'] === 'text') {
                            !is_string($this->data[$rule['input']]) ? $errors[] = ('Field '.$rule['input'].' is not a string.') : null;
                            if (isset($rule['size'])) {
                                (strlen($this->data[$rule['input']]) > $rule['size']) ? $errors[] = ('Field '.$rule['input'].' is too large. Max size must be '.$rule['size'].' chars') : null;
                            }
                        }
                        if ($rule['type'] === 'mail' || $rule['type'] === 'email') {
                            !filter_var($this->data[$rule['input']], FILTER_VALIDATE_EMAIL) ? $errors[] = ('Field '.$rule['input'].' is not a email address.') : null;
                            if (isset($rule['size'])) {
                                (strlen($this->data[$rule['input']]) > $rule['size']) ? $errors[] = ('Field '.$rule['input'].' is too large. Max size must be '.$rule['size'].' chars') : null;
                            }
                        }
                        if ($rule['type'] === 'number' || $rule['type'] === 'int') {
                            !is_numeric($this->data[$rule['input']]) ? $errors[] = ('Field '.$rule['input'].' is not a number.') : null;
                            if (isset($rule['size'])) {
                                (strlen($this->data[$rule['input']]) > $rule['size']) ? $errors[] = ('Field '.$rule['input'].' is too large. Max size must be '.$rule['size'].' chars') : null;
                            }
                        }
                   }
                   else $errors[] = ('Field '.$rule['input'].' is not exist in send data.');
                }
            }

            if (!empty($errors)) {
                $this->fail = true;
                $this->data = $errors;
                return $this;
            }
            else {
                $this->fail = false;
                return $this;
            }
        }
    }
    
?>
