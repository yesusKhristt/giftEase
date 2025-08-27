<?php

//require_once __DIR__ . '/../models/UserModel.php';

class ActivityController
{
    //private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }
}