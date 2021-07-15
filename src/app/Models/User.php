<?php
    namespace Myvendor\Actaskman\Models;

    use \mfurman\pdomodel\PDOAccess;
    use \mfurman\pdomodel\dataDb;

    class User extends dataDb 
    {
    
        private $users_table = 'users';
        private $commit;

        public function __construct($commit=true) 
        {         
            $this->commit = $commit;  
            parent::__construct(PDOAccess::get(), $commit, false);
        }
    
        public function getAll() :array
        {
            return $this->read($this->users_table,'*')->get();
        }
  
        public function getById(int $id) :array
        {
            return $this->read($this->users_table,'*','id = '.$id)->get();
        }

        public function getByName(string $name) 
        {
            return $this->read($this->users_table,'*','user_name = "'.$name.'"')->get();
        }


        public function add(array $data) :int
        {
            $this->set(array('user_name'=>$data['user_name']));        
            return $this->insert($this->users_table);
        }

        public function updateOne(array $data, int $id) :bool
        {
            if (empty($this->read($this->users_table,'*','id = '.$id)->get())) return false;
            $this->set(array('user_name'=>$data['user_name']));
            $this->update($this->users_table, $id);
            return true;
        }

        public function deleteById(int $id) :bool
        {
            if (empty($this->read($this->users_table,'*','id = '.$id)->get())) return false;
            $this->delete_where($this->users_table, 'id = '.$id);
            return true;
        }

    }

?>
