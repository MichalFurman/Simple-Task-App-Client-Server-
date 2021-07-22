<?php
    namespace Myvendor\Actaskman\Models;

    use \mfurman\pdomodel\PDOAccess;
    use \mfurman\pdomodel\dataDb;

    class Task extends dataDb 
    {
        
        private $tasks_table = 'tasks';
        private $tasks_view = 'tasks_view';

        public function __construct($commit=true) 
        {       
            parent::__construct(PDOAccess::get(), $this->tasks_table, $commit, false);
        }

        public function getAll() :array
        {
            $this->set_commit(true);
            $this->set_table($this->tasks_view);
            return $this->read('*',null, 'task_id DESC')->get();
        }
   
        public function getById(int $id) :array
        {
            $this->set_table($this->tasks_view);
            return $this->read('*','task_id = '.$id)->get();
        }

        public function add(array $data) :int
        {
            $this->set(array(
                    'user_id'=>$data['user_id'],
                    'task_title'=>$data['task_title'],
                    'task_desc'=>$data['task_desc'],
                ));
            return $this->insert();
        }

        public function updateOne(array $data, int $id) :bool
        {
            if (empty($this->read('*','id = '.$id)->get())) return false;
            $this->set(array(
                'task_title'=>$data['task_title'],
                'task_desc'=>$data['task_desc'],
            ));
            $this->update_where('id = '.$id);
            return true;
        }

        public function deleteById(int $id) :bool
        {
            if (empty($this->read('*','id = '.$id)->get())) return false;
            $this->delete_where('id = '.$id);
            return true;
        }
    }

?>
