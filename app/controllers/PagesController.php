
<?php

Class PagesController extends Controller{

    public function __construct()
    {
       
    }

    public function index()
    {
        $data=[];
        $this->loadView("/pages/index",$data);
    }

    

}