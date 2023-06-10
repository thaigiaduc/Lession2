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
        <button class="btn btn-outline-primary rounded-circle">
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
                        $i = 0;
                        foreach ($category_list as $item):
                    ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo $item['category_name']; ?></td>
                        <td>
                            <i class="fa fa-pencil-square-o btn-outline-primary mr-2" aria-hidden="true" style="cursor: pointer;"></i>
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
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i == $currentPage): ?>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>