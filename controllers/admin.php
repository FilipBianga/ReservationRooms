<?php

class Admin extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->render('admin/index');
    }

    function allow()
    {
        $this->model->allow();
    }
}