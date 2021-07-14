<?php
    namespace Myvendor\Actaskman\Controllers;

    use Myvendor\Actaskman\Services\TaskService;

    class TaskController
    {
	use ControllersTrait;

	private $taskService;

	public function __construct() 
	{
		$this->taskService = new TaskService();
	}

		
	public function index()
      	{
		$result = $this->checkResult($this->taskService->index());
		http_response_code($result['status']);
		echo json_encode($result['data']);	
	}
      
      	public function show($id)  
      	{
		$result = $this->checkResult($this->taskService->show($id));
		http_response_code($result['status']);
		echo json_encode($result['data']);	
      	}

	public function store()  
      	{
		$result = $this->checkResult($this->taskService->store());
		http_response_code($result['status']);
		echo json_encode($result['data']);	
      	}

	public function update($id)  
      	{
		$result = $this->checkResult($this->taskService->update($id));
		http_response_code($result['status']);
		echo json_encode($result['data']);	
      	}

	public function delete($id)  
      	{
		$result = $this->checkResult($this->taskService->delete($id));
		http_response_code($result['status']);
		echo json_encode($result['data']);	
      	}
    }

?>
