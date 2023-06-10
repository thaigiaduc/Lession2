<?php

class CategoryController extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = $this->model('Category');
    }

    public function index()
    {
        $data = $this->model->getCategoryList();
        $pageTitle = "DANH SÁCH DANH MỤC";
        $this->data['sub_content']['category_list'] = $data;
        $this->data['sub_content']['pageTitle'] = $pageTitle; 
        $this->data['pageTitle'] = $pageTitle;
        $this->data['content'] = 'category/list';
        $this->render('layouts/index', $this->data);
    }

    public function detail()
    {
        $this->render('category/detail');
    }
}
