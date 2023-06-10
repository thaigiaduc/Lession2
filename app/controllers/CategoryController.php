<?php

class CategoryController extends Controller
{
    public $categories;
    public $data = [];
    public function __construct()
    {
        $this->categories = $this->model('Category');
    }

    public function index($page = 1)
    {
        $pageTitle = "DANH SÁCH DANH MỤC";
        $getdata = $this->categories->get();
        $perPage = 10; 
        $data = $this->getCategories($getdata, 0, '', [], $page, $perPage);
        $this->data['sub_content']['category_list'] = $data;
        $this->data['sub_content']['pageTitle'] = $pageTitle; 
        $this->data['pageTitle'] = $pageTitle;
        $this->data['content'] = 'category/list';
        $this->data['sub_content']['currentPage'] = $page; 
        $this->data['sub_content']['totalPages'] = ceil(count($getdata) / $perPage); 
        $this->render('layouts/index', $this->data);
    }


    public function getCategories($categories, $parentId = 0, $chars = '', $result = [], $page = 1, $perPage = 10)
    {
        $startIndex = ($page - 1) * $perPage;
        $endIndex = $startIndex + $perPage;
        $categoryCount = 0;

        if (!empty($categories)) {
            foreach ($categories as $category) {
                if ($category['parent_id'] == $parentId) {
                    if ($category['parent_id'] != null) {
                        $category['category_name'] = '|_' . $category['category_name'];
                    }
                    $category['category_name'] = $chars . $category['category_name'];
                    if ($categoryCount >= $startIndex && $categoryCount < $endIndex) {
                        $result[] = $category;
                    }

                    $categoryCount++;

                    if ($categoryCount >= $endIndex) {
                        break;
                    }

                    $result = array_merge(
                        $result,
                        $this->getCategories(
                            $categories,
                            $category['id'],
                            $chars . '​​​​​​​​​ ​ ​ ​ ​ ​ ​ ​',
                            [],
                            $page,
                            $perPage
                        )
                    );
                }
            }
        }

        return $result;
    }



    public function detail()
    {
        $this->render('category/detail');
    }
}
