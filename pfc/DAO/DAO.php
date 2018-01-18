<?php
    class DAO{
        protected $PDO;
        private $host;
        private $user;
        private $password;
        private $name;
        private $charset;

        //Makes the PDO Object
        public function __construct() {
            $this->host = HOST;
            $this->user = USERDB;
            $this->password = PASSDB;
            $this->name = NAMEDB;
            $this->charset = CHARSETDB;

            try {
                $this->PDO = new \PDO("mysql:host=".$this->host.";dbname=".$this->name.";charset=".$this->charset, $this->user, $this->password);
            } catch(PDOException $e ){
            $e->getMessage();
            } 
        }
    }