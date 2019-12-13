<?php
class KlastoException extends Exception 
{
    public $sql;
    public $params;

    public function __construct($msg = "", $sql="", $params="") {
        parent::__construct($msg);
        $this->sql = $sql;
        $this->params = $params;
    }

    public function __toString() {
        ob_start();
        var_dump($this->params);
        $params = ob_get_clean();
        return parent::__toString()
            . PHP_EOL . "SQL: $this->sql"
            . PHP_EOL . "PARAMS: $params";
        
    }
}