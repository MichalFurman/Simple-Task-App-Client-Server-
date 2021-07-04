<?php
    namespace Myvendor\Actaskman\Controllers;

    class Controller
    {

		public function notFound()
      	{
			http_response_code(404);
			echo json_encode(array('data'=>'not found'));	
	  	}   

    }
?>