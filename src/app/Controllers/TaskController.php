<?php
    namespace Myvendor\Actaskman\Controllers;

    use Myvendor\Actaskman\Services\TaskService;
    use Myvendor\Actaskman\Services\ResponseService;

    class TaskController
    {

		private $taskService;
		private $responseService;

		public function __construct() 
		{
			$this->taskService = new TaskService();
			$this->responseService = new ResponseService();
		}
			

		public function index()
		{
			$this->responseService->response($this->taskService->index());
		}
		
		public function show($id)  
		{
			$this->responseService->response($this->taskService->show($id));
		}

		public function store()  
		{
			$this->responseService->response($this->taskService->store());
		}

		public function update($id)  
		{
			$this->responseService->response($this->taskService->update($id));
		}

		public function delete($id)  
		{
			$this->responseService->response($this->taskService->delete($id));
		}
	}

?>
