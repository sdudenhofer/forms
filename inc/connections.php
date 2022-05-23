<?php

class mConnect
{
    public $ip = '';
    public $username = '';
    public $password = '';
    public $database = '';

    static public function mconnect(){
        try{
            $connect = new PDO("mysql:host=$ip; dbname=$database", $this->username, $this->password);
          }catch(PDOException $e){
            $error = $e->getMessage();
          }
        return $connect;
    }
}