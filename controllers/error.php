<?php

class ErrorPage extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        echo 'ERROR!';
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    
}