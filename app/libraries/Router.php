<?php

Class Router {


   protected $currentController;
   protected $currentControllerFile;
   protected $currentMethod;
   protected $args = [];

    public function __construct()
    {
        //Break URL:
        $url = $this->breakUrl();


        //Get Current Controller:
        $this->currentController = $this->getCurrentController($url)[0];
        require_once $this->getCurrentController($url)[1]."Controller.php";

        //Instantiate Current Controller:
        
        $this->currentController = $this->currentController . "Controller";
        
        $this->currentController = new $this->currentController;
        // ^^ corresponding controller's __contructor is called here.

        unset($url[0]);

        
        //Get Current Method:
        $this->currentMethod = $this->getCurrentMethod($url,$this->currentController);
        unset($url[1]);
        
        
        
        //Get Current Parameters

        $this->args[] = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController,$this->currentMethod], $this->args);

        // print_r($this->currentController);
        // print_r($this->currentMethod);
        

        
    }





   public function breakUrl(){
       if(isset($_GET["url"])){
           $url = rtrim($_GET["url"] , "/");
           $url = filter_var($url, FILTER_SANITIZE_URL);
           $url = explode("/" , $url);
           return $url;
       }
   }



   //Checks the file existance and returns Controller name and File:

   function getCurrentController($url)
   {
    $currentControllerName = "Pages";
    $currentControllerFile = "../app/controllers/" . $currentControllerName;
    $currentControllerSet = [$currentControllerName , $currentControllerFile];



    if (!empty($url) && (file_exists("../app/controllers/" .ucwords($url[0]) . "Controller.php")))
    {
        $currentControllerName = ucwords($url[0]);
        $currentControllerFile = "../app/controllers/" . $currentControllerName;
        $currentControllerSet = [$currentControllerName , $currentControllerFile];
        
        
       
    }

    return $currentControllerSet;

    }

    //Checks the file existance and returns method name in the controller:

    function getCurrentMethod($url,$controller)
    {
        $currentMethod = "index";
        

        if(!empty($url) && method_exists($controller,$url[1]))
        {
            $currentMethod = $url[1];
        }

        return $currentMethod;
        

    }
    
}