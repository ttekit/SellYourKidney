<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">

                    <div class="card card-blue ">
                        <div class="card-header">
                            <h3 class="card-title">Управление продуктакми в магазине</h3>
                            <a href="./AddProd/" class="border-0"><button class="border-3 bg-success text-white border-success ">Add New Prod</button></a>
                        </div>
                        <?php

                        /** @var $data */
                        foreach ($data["allProd"]
                                 as $index => $post) {
                            ?>
                            <div class="card-body">
                                <div class="post">
                                    <h2><?= $post["name"] ?></h2>
                                    <h3><?= $post["price"] ?></h3>
                                    <div class="row">
                                        <img class='product-img-box-manage' src="<?= $post["img_src"] ?>"
                                             alt="<?= $post["img_alt"] ?>">
                                        <div class="post-manage flex-column">
                                            <div class="hidden id"><?= $post["id"] ?></div>
                                            <button href="#" class="btn btn-info btn-lg product-edit-button blog-btn">
                                                <i class="fas fa-info-circle">Edit</i>
                                            </button>
                                            <button href="#" class="btn btn-danger btn-lg product-delete-button blog-btn">
                                                <i class="fas fa-trash">Delete</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<script src="/assets/js/productwork.js"></script>