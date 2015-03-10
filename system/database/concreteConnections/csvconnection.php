<?php 
class csvconnection extends dbconnection{

    private $WHEREDEF = '';
    private $SELECTDEF = '';
    private $columnNames = array();
    private $file = array();

    function __construct($csvpath){
        parent::__construct('', '', '', $csvpath);
        $this->csvpath = $csvpath;
        $this->arrayWhere = $this->WHEREDEF;
        $this->arraySelect = $this->SELECTDEF;

        $this->getConection();
    }

    public function get($csvpath = null){
        $arrayReturn = array();
        if ($this->arrayWhere != $this->WHEREDEF){
            # code...
        } elseif ($this->arraySelect != $this->SELECTDEF) {
            # code...
        } else {
            $arrayReturn = $this->file;
        }
        return $arrayReturn;
    }

    public function get_where($arrayWhere, $arrayWhere=null){

    }

    public function where($arrayWhere){

    }

    public function select($arraySelect){

    }

    public function update($data, $datas=null){

    }

    public function delete($data = null){

    }

    public function insert($data, $datas = null){
        $handle = fopen($this->csvpath, 'a+');
        fputcsv($handle, $data);
        fclose($handle); 
        $this->getConection();
    }

    public function rawQuery($query){
        return false;
    }

    protected function getConection(){
        if (file_exists($this->csvpath)) {
            $file = file($this->csvpath);
            $count = 0; 
            foreach ($file as $line) {
                if ($count==0) {
                    $this->columnNames = explode(",", $line);
                } else {
                    $tmpfile = explode(",", $line);
                    $finalLine = array();
                    $count = 0;
                    foreach ($this->columnNames as $value) {
                        $finalLine[$this->columnNames[$count]] = $tmpfile[$count];
                        $count++;
                    }
                    $this->file[] = $finalLine;
                }
                $count++;
            }
            return true;
        } else
            return false;
        
    }

    protected function closeConnection(){

    }

    public function write( array $data)
    {
        $handle = fopen($this->file, 'a+');
        fputcsv($handle, $data);
        fclose($handle);    
    }
    public function read()
    {
        $handle = fopen($this->file, 'r+');
        $data = array();
        while (!feof($handle)) 
        {
            $cdata = fgetcsv($handle);
            if (!empty($cdata)) {
                array_push($data, $cdata);    
            }
        }
        fclose($handle);
        return $data;
    }
}