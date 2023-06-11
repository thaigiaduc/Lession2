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
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (isset($_POST['category_name_create'])) {
            $categoryName = $_POST['category_name_create'];
            $parentId = null;

            if (!empty($_POST['parent_create'])) {
                $parentId = $_POST['parent_create'];
                $rsArr = [
                    'category_name' => $categoryName,
                    'parent_id' => $parentId
                ];
            } else {
                $rsArr = [
                    'category_name' => $categoryName,
                ];
            }

            if ($this->categories->create($rsArr)) {
                $this->data['sub_content']['success_message'] = 'Tạo danh mục thành công';
            } else {
                $this->data['sub_content']['success_message'] = 'Tạo danh mục thất bại';
            }
        }
        if (isset($_POST['category_name_update']) && isset($_POST['parent_update']) && isset($_POST['category_id_update'])) {
            if (!empty($_POST['parent_update'])) {
                $rsArr = [
                    'category_name' => $_POST['category_name_update'],
                    'parent_id' => $_POST['parent_update']
                ];
                $condition = "id=" . $_POST['category_id_update'];
            } else {
                $rsArr = [
                    'category_name' => $_POST['category_name_update'],
                ];
                $condition = "id=" . $_POST['category_id_update'];
            }

            if ($this->categories->edit($rsArr, $condition)) {
                $this->data['sub_content']['success_message'] = 'Cập nhật danh mục thành công';
            } else {
                $this->data['sub_content']['success_message'] = 'Cập nhật danh mục thất bại';
            }
        }
        $cateOptions = $getdata = $this->categories->get();
        if (isset($_POST['category_id'])) {
            $optionData = $this->categories->find($_POST['category_id']);
            $cateOption = $getdata = $this->categories->get();
            $this->data['sub_content']['category_update'] = $optionData;
            $this->data['sub_content']['category_update_option'] = $cateOption;
            $responseData = array(
                'optionData' => $optionData,
                'cateOption' => $cateOption
              );
              
            $jsonResponse = json_encode($responseData);
            echo $jsonResponse;
            exit();
        }

        if (isset($_POST['category_id_detail'])) {
            $optionData = $this->categories->find($_POST['category_id_detail']);
            $cateOption = $getdata = $this->categories->get();
            $this->data['sub_content']['category_detail'] = $optionData;
            $this->data['sub_content']['category_detail_option'] = $cateOption;
            $responseData = array(
                'optionData' => $optionData,
                'cateOption' => $cateOption
              );
              
            $jsonResponse = json_encode($responseData);
            echo $jsonResponse;
            exit();
        }
        $pageTitle = "DANH SÁCH DANH MỤC";
        $getdata = $this->categories->get();
        $perPage = 10;
        $totalCategories = count($getdata);
        $totalPages = ceil($totalCategories / $perPage);
        $startIndex = ($page - 1) * $perPage;
        $endIndex = $startIndex + $perPage;
        $data = $this->getCategories($getdata, 0, '', []);
        $pagedData = array_slice($data, $startIndex, $perPage);
        $this->data['sub_content']['category_list'] = $pagedData;
        $this->data['sub_content']['pageTitle'] = $pageTitle;
        $this->data['sub_content']['startIndex'] = $startIndex;
        $this->data['sub_content']['category_option'] = $cateOptions;
        $this->data['pageTitle'] = $pageTitle;
        $this->data['content'] = 'category/list';
        $this->data['sub_content']['currentPage'] = $page;
        $this->data['sub_content']['totalPages'] = $totalPages;
        $this->render('layouts/index', $this->data);
    }

    public function getCategories($categories, $parentId = 0, $chars = '', $result = [])
    {
        if (!empty($categories)) {
            foreach ($categories as $category) {
                if ($category['parent_id'] == $parentId) {
                    if ($category['parent_id'] != null) {
                        $category['category_name'] = '|_' . $category['category_name'];
                    }
                    $category['category_name'] = $chars . $category['category_name'];
                    $result[] = $category;
                    $result = array_merge(
                        $result,
                        $this->getCategories(
                            $categories,
                            $category['id'],
                            $chars . '​​​​​​​​​ ​ ​ ​ ​ ​ ​ ​',
                            [],
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
