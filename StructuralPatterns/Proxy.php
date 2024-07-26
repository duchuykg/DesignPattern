<?php

interface IUserRepository
{
    public function getById($id);
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

class UserRepository implements IUserRepository
{
    public function getAll(){
        echo 'getAll';
    }

    public function getById($id){
        echo 'getById';
    }

    public function create(array $data){
        echo 'create';
    }
    
    public function update(int $id, array $data){
        echo 'update';
    }

    public function delete(int $id){
        echo 'delete';
    }
}

class UserProxy implements IUserRepository
{
    private IUserRepository $realRepo;

    public function __construct(IUserRepository $realRepo){
        $this->realRepo = $realRepo;
    }

    public function login()
    {
        echo 'login'; 
    }

    public function __call($method, $arguments)
    {
        echo "Đang gọi phương thức: $method";
        return call_user_func_array([$this->realRepo, $method], $arguments);
    }

    public function getByName(){
        echo 'getByName';
    }

    public function getAll(){
        return $this->realRepo->getAll();
    }

    public function getById($id){
        return $this->realRepo->getById($id);
    }

    public function create(array $data){
        return $this->realRepo->create($data);
    }
    
    public function update(int $id, array $data){
        return $this->realRepo->update($id, $data);
    }

    public function delete(int $id){
        return $this->realRepo->delete($id);
    }
}
$userRepository = new UserRepository();
$proxy = new UserProxy($userRepository);
$proxy->getAll(); 
$proxy->getByName();