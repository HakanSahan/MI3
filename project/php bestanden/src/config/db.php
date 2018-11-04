<?php
       class db {
       private $dbhost = 'localhost';
       private $dbuser = 'root';
       private $dbpass = '';
       private $dbname = 'slimtest';

       public function connect() {
            $mysql_connect_string = "mysql:host=$this->dbhost;dbname=$this->dbname;";
            $dbConnection = new PDO($mysql_connect_string, $this->dbuser,$this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
       }
}