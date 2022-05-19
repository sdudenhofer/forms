<?php

Class MConnect {
    public $ip;
    public $username;
    public $password;
    public $database;

    public function mconnect(){
        try{
            $connect = new PDO("mysql:host=$this->ip; dbname=$this->database", $this->username, $this->password);
          }catch(PDOException $e){
            $error = $e->getMessage();
          }
    }
}