<?php
require_once "conection.php";

class Wo
{
    private $wo;
    private $ns;
    private $ncts;


    public function __contruct(){
    }

    public function get_wo(){
        return $this->wo;
    }
    public function get_ns(){
        return $this->ns;
    }
    public function get_ncts(){
        return $this->ncts;
    }
    
    public function set_wo($wo){
        $this->wo = $wo;
    }
    public function set_ns($ns){
        $this->ns = $ns;
    }
    public function set_ncts($ncts){
        $this->ncts = $ncts;
    }

}






?>