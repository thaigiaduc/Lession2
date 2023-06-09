<?php

class Category extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = $this->model('CategoryModel');
    }

    public function index()
    {
        echo 'category page';
    }
}
