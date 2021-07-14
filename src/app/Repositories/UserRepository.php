<?php

    namespace Myvendor\Actaskman\Repositories;

    use Myvendor\Actaskman\Services\RequestService;
    use Myvendor\Actaskman\Models\User;

    class UserRepository 
    {
        private $user;

        public function __construct() 
        {
            $this->user = new User();
        }

        public function index() :array
        {
            return $this->user->getAll();
        }
    
        public function show() :array
        {
            return $this->user->getById($id);
        }

        public function store()
        {

        }
    
        public function update()
        {

        }

        public function delete()
        {

        }
    
    }
