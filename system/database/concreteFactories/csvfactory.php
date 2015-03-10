<?php 

class csvfactory extends dbfactory{

    function __construct($database){
        parent::__construct($database);
    }

    public function getDbConnection(){
        if ( isset($this->database['dbname']) ) {
            return new csvconnection($this->database['dbname']);
        } elseif (isset($this->database['csvpath'])) {
            return new csvconnection($this->database['csvpath']);
        } else{
            echo 404;
        }
    }
}
