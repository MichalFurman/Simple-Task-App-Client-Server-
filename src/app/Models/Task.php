<?php
    namespace Myvendor\Actaskman\Models;

    use \mfurman\pdomodel\PDOAccess;
    use \mfurman\pdomodel\dataDb;

    class Task extends dataDb 
    {
        
        private $tasks_table = 'tasks';
        private $tasks_view = 'tasks_view';
        private $commit;

        public function __construct($commit=true) 
        {       
            $this->commit = $commit;  
            parent::__construct(PDOAccess::get(), $commit, false);
        }

        public function getAll() :array
        {
            $this->set_commit(true);
            return $this->read($this->tasks_view,'*',null, 'task_id DESC')->get();
        }
   
        public function getById(int $id) :array
        {
            return $this->read($this->tasks_view,'*','task_id = '.$id)->get();
        }

        public function add(array $data) :int
        {
            $this->set(array(
                    'user_id'=>$data['user_id'],
                    'task_title'=>$data['task_title'],
                    'task_desc'=>$data['task_desc'],
                ));
            return $this->insert($this->tasks_table);
        }

        public function updateOne(array $data, int $id) :bool
        {
            if (empty($this->read($this->tasks_table,'*','id = '.$id)->get())) return false;
            $this->set(array(
                'task_title'=>$data['task_title'],
                'task_desc'=>$data['task_desc'],
            ));
            $this->update_where($this->tasks_table, 'id = '.$id);
            return true;
        }

        public function deleteById(int $id) :bool
        {
            if (empty($this->read($this->tasks_table,'*','id = '.$id)->get())) return false;
            $this->delete_where($this->tasks_table,'id = '.$id);
            return true;
        }
    }

?>
