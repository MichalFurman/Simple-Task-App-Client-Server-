<?php
    namespace Myvendor\Actaskman\Models;

    use \mfurman\pdomodel\PDOAccess;
    use \mfurman\pdomodel\dataDb;

    class User extends dataDb 
    {
    
        private $users_table = 'users';

        public function __construct($commit=true) 
        {         
            parent::__construct(PDOAccess::get(), $this->users_table, $commit, false);
        }
    
        public function getAll() :array
        {
            return $this->read('*')->get();
        }
  
        public function getById(int $id) :array
        {
            return $this->read('*','id = '.$id)->get();
        }

        public function getByName(string $name) 
        {
            return $this->read('*','user_name = "'.$name.'"')->get();
        }


        public function add(array $data) :int
        {
            $this->set(array('user_name'=>$data['user_name']));        
            return $this->insert();
        }

        public function updateOne(array $data, int $id) :bool
        {
            if (empty($this->read('*','id = '.$id)->get())) return false;
            $this->set(array('user_name'=>$data['user_name']));
            $this->update($id);
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
