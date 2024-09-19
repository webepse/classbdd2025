<?php
    namespace App;
    use PDO;

    class Database{
        private string $dbName;
        private string $dbUser;
        private string $dbPass;
        private string $dbHost;

        private $bdd;

        public function __construct(string $dbName, string $dbUser = "root", string $dbPass='', string $dbHost='localhost' )
        {
            $this->dbName = $dbName;
            $this->dbUser = $dbUser;
            $this->dbPass = $dbPass;
            $this->dbHost = $dbHost;
        }

        private function getBDD()
        {
            if($this->bdd === NULL)
            {
               try{
                    $this->bdd = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName.";charset=utf8", $this->dbUser, $this->dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

               }catch(\Exception $e)
               {
                die('ERREUR: '.$e->getMessage());
               }
            }

            return $this->bdd;
        }

        public function query($statement)
        {
            $req = $this->getBDD()->query($statement);
            $data = $req->fetchAll();
            $req->closeCursor();
            return $data;
        }
    }

