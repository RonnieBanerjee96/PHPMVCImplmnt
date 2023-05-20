<?php

//IN DEVELOPMENT UPDATE:

//QUERIES NOT
//SANITIZED
//REMEMBER TO
//SANITIZE!!

//

class User
{
    private $db;
    

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {

        $this->db->prepareQuery("INSERT INTO users 
        (email, first_name, last_name, password) VALUES
        (:email,:firstname,:lastname,:password)");

        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":firstname", $data["first_name"]);
        $this->db->bind(":lastname", $data["last_name"]);
        $this->db->bind(":password", $data["password"]);

        $this->db->execute();
            


    }

    public function login($email, $password)
    {
       
        $user = $this->getUserByEmail($email);
        
        
        if(!empty($user))
        {
                
            $userPass = $user->password;
            if(password_verify($password,$userPass))
            {
                
                return true;
                
            }
            else
            {
                return false;
                
            }
                    
        }
        
    }

    public function getUserByEmail($email)
    {
        $this->db->prepareQuery("SELECT * FROM USERS WHERE email = :email");
        $this->db->bind(":email", $email);
        return $this->db->getRow();
    }
}

        


