<?php

    namespace Myvendor\Actaskman\Repositories;

    use Myvendor\Actaskman\Services\RequestService;
    use Myvendor\Actaskman\Models\Task;
    use Myvendor\Actaskman\Models\User;

    class TaskRepository 
    {
        private $task;
        private $user;
        
        public function __construct() 
        {
            $this->task = new Task();
        }
        
        public function index() :array
        {
            return $this->task->getAll();            
        }
    
        public function show(int $id) :array
        {
            return $this->task->getById($id);
        }

        public function store(array $data) :array
        {
            $this->task = new Task(false);
            $this->user = new User(false);
            
            $this->task->begin();
            
            $this->user->getByName($data['user_name']);
            if ($this->user->is()) $data['user_id'] = $this->user->get('id');
            else {
                $this->user->reset();
                $data['user_id'] = $this->user->add($data);
            }

            $id = $this->task->add($data);
            $this->task->commit();
            
            $this->task->set_commit(true);
            return $this->task->getById($id);
        }

        public function update(array $data, int $id) 
        {                   
            $this->task = new Task(false);
            
            $this->task->begin();
            $result = $this->task->updateOne($data, $id);
            $this->task->commit();
            if ($result === false) return $result;
            
            $this->task->set_commit(true);
            return $this->task->getById($id);
        }
    
        public function delete($id) :bool
        {
            return $this->task->deleteById($id);
        }
    
    }
