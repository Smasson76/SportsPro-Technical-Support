<?php
class Technician {
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $phone;
    private string $password;

    public function __construct() {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
    }

    public function getFirstName() {
        return $this->first_name;
    }
    
    public function setFirstName(string $value){
        $this->first_name = $value;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName(string $value){
        $this->last_name = $value;
    }
 
    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $value){
        $this->email = $value;
    }
 
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone(string $value){
        $this->phone = $value;
    }

    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword(string $value){
        $this->password = $value;
    }
 
    public function getFullName(){
        $full = $this->first_name . ' ' . $this->last_name;
        return $full;
    }

}