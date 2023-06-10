<?php

class HomeController extends Controller
{
    public $data = [];
    function __construct()
    {
    }

    function index()
    {
        $pageTitle = "Dashboard";
        $this->data['pageTitle'] = $pageTitle;
        $this->data['content'] = 'Dashboard';
        $this->data['sub_content']['pageTitle'] = $pageTitle;
        $this->render('layouts/index', $this->data);
    }

    function detail($id = '', $slug = '')
    {
        echo 'id sản phẩm: ' . $id . '</br>';
        echo 'slug: ' . $slug;
    }
}
