<div class="container">
    <div class="d-flex justify-content-center">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row justify-content-between mt-4 mb-4">
        <div class="col-auto">Search found 15 results</div>
        <div class="col-auto ml-auto">
            <button class="btn btn-outline-primary rounded-circle" data-toggle="modal" data-target="#createCategoryModal">
                <i class="fa fa-plus"></i>
            </button>

        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category name</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = $startIndex;
                    foreach ($category_list as $item) :
                    ?>
                        <tr data-toggle="modal" data-target="#detailCategoryModal" id="modal_detail<?php echo $item['id']; ?>" style="cursor: pointer;" onclick="detail(<?php echo $item['id']; ?>)">
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $item['category_name']; ?></td>
                            <td>
                                <i class="fa fa-pencil-square-o btn-outline-primary mr-2 modal-update-btn" id="modal_update<?php echo $item['id']; ?>" data-toggle="modal" style="cursor: pointer;" data-target="#updateCategoryModal" data-category-id="<?php echo $item['id']; ?>" onclick="update(<?php echo $item['id']; ?>)"></i>
                                <i class="fa fa-files-o btn-outline-primary mr-2" aria-hidden="true" style="cursor: pointer;"></i>
                                <i class="fa fa-trash btn-outline-primary" aria-hidden="true" style="cursor: pointer;"></i>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <?php if ($i == $currentPage) : ?>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
                            </li>
                        <?php else : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- modal create category -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Tạo danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="create_form">
                    <div class="form-group">
                        <label for="categoryName">Tên danh mục:</label>
                        <input type="text" class="form-control" id="category_name" name="category_name_create" required>
                    </div>
                    <div class="form-group">
                        <label for="parentCategory">Danh mục cha:</label>
                        <select class="form-control" id="parentCategory" name="parent_create">
                            <option value="" selected>--Default--</option>
                            <?php
                            foreach ($category_option as $op) :
                            ?>
                                <option value="<?php echo $op['id']; ?>"><?php echo $op['category_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal update category -->
<div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modelBodyUpdate">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" value="" name="category_id_update" id="category_id_update">
                    <div class="form-group">
                        <label for="category_name_update">Category Name</label>
                        <input type="text" class="form-control" id="category_name_update" name="category_name_update">
                    </div>
                    <div class="form-group">
                        <label for="parent_update">Parent Category</label>
                        <select class="form-control" id="parent_update" name="parent_update">
                            <?php foreach ($cateOption as $option) { ?>
                                <option value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal chi tiết danh mục -->
<div class="modal fade" id="detailCategoryModal" tabindex="-1" role="dialog" aria-labelledby="detailCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailCategoryModalLabel">Chi tiết danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailCategoryModalBody">
                <label for="category_id_detail">Category ID:</label>
                <span id="category_id_detail" style="display: block;"></span>

                <label for="category_name_detail">Category Name:</label>
                <span id="category_name_detail" style="display: block;"></span>

                <label for="category_parent_detail">Category Parent:</label>
                <span id="category_parent_detail" style="display: block;"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($success_message)) {
        echo "<script>alert('" . $success_message . "');</script>";
        echo '<script type="text/javascript">
               window.location.href = "' . $_SERVER['PHP_SELF'] . '";
          </script>';
    }
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function detail(categoryId) {
        var modalId = 'modal_update' + categoryId;
        $.ajax({
            url: '<?php echo $_SERVER['PHP_SELF']; ?>',
            type: 'POST',
            data: {
                category_id_detail: categoryId
            },
            success: function(response) {
                var responseData = JSON.parse(response);
                var optionData = responseData.optionData;
                var cateOption = responseData.cateOption;
                console.log(response);
                $('#category_id_detail').text(optionData.id);
                $('#category_name_detail').text(optionData.category_name);
                var pr = '';
                for (var i = 0; i < cateOption.length; i++) {
                    if (optionData.parent_id == cateOption[i].id) {
                        pr = cateOption[i].category_name;
                    } 
                }
                $('#category_parent_detail').text(pr);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    function update(categoryId) {
        var modalId = 'modal_update' + categoryId;
        $.ajax({
            url: '<?php echo $_SERVER['PHP_SELF']; ?>',
            type: 'POST',
            data: {
                category_id: categoryId
            },
            success: function(response) {
                var responseData = JSON.parse(response);
                var optionData = responseData.optionData;
                var cateOption = responseData.cateOption;
                $('#category_id_update').val(optionData.id);
                $('#category_name_update').val(optionData.category_name);
                // Xóa các tùy chọn cũ
                $('#parent_update').empty();
                // Tạo các tùy chọn mới
                var options = '';
                // Tùy chọn --default--
                options += '<option value="">--default--</option>';

                // Các tùy chọn từ cateOption
                for (var i = 0; i < cateOption.length; i++) {
                    if (optionData.parent_id == cateOption[i].id) {
                        options += '<option value="' + optionData.parent_id + '" selected>' + cateOption[i].category_name + '</option>';
                    }
                    options += '<option value="' + cateOption[i].id + '">' + cateOption[i].category_name + '</option>';
                }

                // Thêm tùy chọn vào select
                $('#parent_update').html(options);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>