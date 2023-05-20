<?php

use function PHPSTORM_META\type;

class Database{



    private $dsn;
    private $username;
    

    private $dbh;
    private $stmt;
    private $error;
    
    
    

    public function __construct()
    {
        $this->dsn = "mysql:host=localhost;dbname=blogpods";
        $this->username = "lionheart";
        $this->password = "12345";

        $options = [PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
            

        try
        {
            $this->dbh = new PDO($this->dsn,$this->username,$this->password, $options);
            
        }
        catch(PDOException $error)
        {
            $this->error = $error->getMessage();
            echo $this->error;
        }
        
    }

    public function prepareQuery($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($placeholder, $value, $type=null)
    {
        if($type==null)
        {
            if(is_int($value)){
            $type = PDO::PARAM_INT;
            }
            

            elseif(is_bool($value)){
            $type = PDO::PARAM_BOOL;
            }
            

            elseif (is_string($value)) {
            $type = PDO::PARAM_STR;
            }

            elseif (is_null($value)) {
            $type = PDO::PARAM_NULL;
            }
        }
        
        $this->stmt->bindValue($placeholder, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function getAllResults()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function getRow(){
        $this->execute();
        return $this->stmt->fetch();
    }

    public function numberOfRows(){
        return $this->stmt->rowcount();
    }


    
}
