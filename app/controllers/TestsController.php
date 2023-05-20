<?php
class TestsController extends Controller{
    
    public function __construct()
    {
       
    }

    public function index()
    {
        $this->loadView("notFound404");
    }
    
}
