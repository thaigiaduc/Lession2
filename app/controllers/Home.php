<?php

class Home extends Controller
{
    function __construct()
    {
    }

    function index()
    {
        echo 'home page';
    }

    function detail($id = '', $slug = '')
    {
        echo 'id sản phẩm: ' . $id . '</br>';
        echo 'slug: ' . $slug;
    }
}
