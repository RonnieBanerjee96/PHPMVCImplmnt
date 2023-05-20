<?php

class Controller{

public function loadModel($model)
{
    $modelFile = "../app/model/". $model . ".php";

    require_once $modelFile;
    return new $model;
    
}

public function loadView($view, $data =[])
{
    $viewFile = "../app/views/" . $view . ".php";
    if (file_exists($viewFile))
    {
        require_once $viewFile;

    }

    else 
    {
        $viewFile = "../app/views/notFound404.php";
        require_once $viewFile;
    }

}

}