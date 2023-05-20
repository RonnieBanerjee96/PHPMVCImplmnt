<?php

class UsersController extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->loadModel("User");
    }

    //These are the view methods
    //these load the view
    //they are executed by userfunc array
    //in the router class/file.

    public function register(){
        
        
        
        

        if(($_SERVER["REQUEST_METHOD"] == "POST"))

        {
            $data =[
                "email" => "",
                "password" => "",
                "firstname" => "",
                "lastname" => "",
                "rptpass" => "",
                "error" => "",
                "fnameerr" => "",
                "lnameerr" => "",
                
            ];
    
            $data["email"] = $_POST["email"];
            $data["first_name"] = $_POST["fname"];
            $data["last_name"] = $_POST["lname"];
            $data["password"] = $_POST["password"];
            $data["rptpass"] = $_POST["rpt"];
            
            
            //verify data
            //on button click

            $verifiedData = $this->handleUserData($data);
            
            //load view on
            //Button click
            
            
            if(!empty($this->userModel->getUserByEmail($verifiedData["email"])))
            {
                $verifiedData["error"] = "email already exists!";
                
            }


            if(empty($verifiedData["error"]))
                
            {
                $this->userModel->register($verifiedData);
                header("Location: http://localhost/mvclogin/users/login");
            }

            else
            {
                
                $this->loadView("/users/register",$verifiedData);
                
            }

        }

        else
        {
            $verifiedData = [
                "email" => "",
                "password" => "",
                "firstname" => "",
                "lastname" => "",
                "rptpass" => "",
                "error" => "",
            ];
            
            $this->loadView("/users/register",$verifiedData);
            
            
        }

        
        

    }

    public function login(){

        
            
        $data["error"] ="";
        
        

        

        if(($_SERVER["REQUEST_METHOD"] == "POST"))
        {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            if(!empty($email) && !empty($password))
            {

                $LoggedIn = $this->userModel->login($email, $password);

                if($LoggedIn)
                {
                    header("Location: http://localhost/mvclogin/");

                }
                else
                {
                    $data["error"] = "Credentials don't match!";
                    
                }
                
            }

            else
            {
                $data["error"] = "Credentials Can't be empty!";
                    
            }

            $this->loadView("/users/login", $data);
            
        }

        $this->loadView("/users/login", $data);

    }

    


    
    public function handleUserData($data)
    {
        //verify contains input
        //sanitize input
        //return errors or data

        if(!empty($data["email"]) && (str_contains($data["email"], "@"))){

            $data["email"] = filter_var($data["email"], FILTER_SANITIZE_EMAIL);
            $data["error"] ="";
        }
            
        elseif(empty($data["email"])){
                $data["email"] = filter_var($data["email"], FILTER_SANITIZE_EMAIL);
                $data["error"] ="Email address cannot be empty";
        }
                
            
        elseif(!empty($data["email"]) && !(str_contains($data["email"], "@"))){
                $data["error"] ="email entered is invalid!";
        }


        
        

        

        
        
        if(empty($data["password"])){
            $data["error"] = "password Cannot be blank!";
        }
        elseif(!empty($data["password"]) && strlen($data["password"])<8){
            $data["error"] = "Password must be more than 8 characters!";
        }
        elseif(!empty($data["password"]) && ($data["password"] != $data["rptpass"]))
        {
            $data["error"] = "Passwords Don't Match!";
        }
        elseif(!empty($data["password"]) && empty($data["error"]))
        {
            $data["password"] = password_hash($data["password"],PASSWORD_DEFAULT);
            
        }


        if(!empty($data["first_name"])){
            $data["first_name"] = filter_var($data["first_name"], FILTER_SANITIZE_STRING);
            $data["firstnameerr"] ="";
        }
        elseif(empty($data["first_name"])){
            $data["first_name"] = "";
            $data["firstnameerr"] ="First name cannot be empty!";
        }
        if(!empty($data["last_name"])){
            $data["last_name"] = filter_var($data["last_name"], FILTER_SANITIZE_STRING);
            $data["lastnameerr"] ="";
        }
        elseif(empty($data["last_name"])){
            $data["last_name"] = "";
            $data["lastnameerr"] ="Last name cannot be empty!";
        }

        
        return $data;
    }

    
}