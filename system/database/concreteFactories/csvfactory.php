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
            error::showError('La configuración de la base de datos parece no ser correcta');
            die();
        }
    }
}
