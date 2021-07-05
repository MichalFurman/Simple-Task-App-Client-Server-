<?php

    namespace Myvendor\Actaskman\Services;

    use Myvendor\Actaskman\Services\RequestService;
    use Myvendor\Actaskman\Repositories\TaskRepository;

    class TaskService 
    {
        private $task;
        private $requestService;
        
        public function __construct() {
            $this->task = new TaskRepository();
            $this->requestService = new RequestService();
        }

        public function index() :array
        {         
            $result = $this->task->index();
            return array('data'=>$result, 'status'=>200);
        }

        public function show($id) :array
        {
            $id = (int)$id;
            $result = $this->task->show($id);
            if (empty($result)) return array('data'=> 'not found', 'status'=>404);
            return array('data'=>$result, 'status'=>200);
        }

        public function store() :array
        {
            $validationRules = array(
                ['input'=>'user_name', 'type'=>'string','size'=>64],
                ['input'=>'task_title', 'type'=>'string','size'=>64],
                ['input'=>'task_desc', 'type'=>'string','size'=>256],
            );
            $result = $this->requestService->read()->validate($validationRules)->get();
            if ($result === null) return array('data'=> $this->requestService->errors(), 'status'=>400);

            $result = $this->task->store($result);
            return array('data'=>$result, 'status'=>201);
        }

        public function update($id) :array
        {
            $validationRules = array(
                ['input'=>'task_title', 'type'=>'string','size'=>64],
                ['input'=>'task_desc', 'type'=>'string','size'=>256],
            );
            $result = $this->requestService->read()->validate($validationRules)->get();
            if ($result === null) return array('data'=> $this->requestService->errors(), 'status'=>400);

            $result = $this->task->update($result, $id);
            if ($result === false) return array('data'=> 'not found', 'status'=>404);
            return array('data'=>$result, 'status'=>201);
        }

        public function delete($id) :array
        {
            $id = (int)$id;
            $result = $this->task->delete($id);
            if ($result === false) return array('data'=> 'not found', 'status'=>404);
            return array('data'=>array('delete success'), 'status'=>200);
        }

    }    
