<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">

                    <div class="card card-blue ">
                        <div class="card-header">
                            <h3 class="card-title">Управление постами в блоге</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <input type="text" name="Id" readonly value="Id" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="name" readonly value="Название свойства"
                                           class="form-control">
                                </div>
                                <div class="col-4">
                                    <input type="text" readonly class="form-control" value="Значение свойства">
                                </div>
                                <div class="col-2">
                                    <input type="text" readonly class="form-control" value="Группирование">
                                </div>
                                <div class="col-3">
                                    <div class="btn-group w-100">
                                        <p>
                                            <a class="btn btn-success" data-toggle="collapse" href="#collapseExample"
                                               role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Создать новое свойство
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="card-body">
                                        <form action="/admin/addNewOption" method="post">
                                            <div class="row">
                                                <div class="col-2">
                                                    <input type="text" name="name" placeholder="Название свойства"
                                                           class="form-control">
                                                </div>
                                                <div class="col-6">
                                                    <textarea rows="1" name="value" class="form-control"> </textarea>
                                                </div>
                                                <div class="col-2">
                                                    <input type="text" name="group" class="form-control"
                                                           placeholder="Группирование">
                                                </div>
                                                <div class="col-2"
                                                <div class="btn-group w-100">
                                                    <p>
                                                        <button class="btn btn-success" aria-controls="collapseExample">
                                                            Создать
                                                        </button>
                                                        <button type="reset" class="btn btn-danger"
                                                                aria-controls="collapseExample">
                                                            Отмена
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $postM = new \Models\post();
                        $posts = $postM->executeQuery("SELECT blogposts.id, blogposts.title, blogposts.state, blogposts.imgSrc, blogposts.altSrc FROM blogposts");
                        $data["status"] = ["created", "published", "archived"];
                        foreach ($posts

                                 as $index => $post) {
                            ?>
                            <div class="card-body">
                                <div class="post">
                                    <h2><?= $post->title ?></h2>
                                    <div class="row">
                                        <img class='blog-img-box-manage' src="/images/<?= $post->imgSrc ?>.png"
                                             alt="<?= $post->altSrc ?>">
                                        <div class="post-manage flex-column">
                                            <div class="hidden id"><?= $post->id ?></div>
                                            <button href="#" class="btn btn-info btn-lg blog-edit-button blog-btn">
                                                <i class="fas fa-info-circle">Edit</i>
                                            </button>
                                            <button href="#" class="btn btn-info btn-lg blog-update-button blog-btn" disabled>
                                                <i class="fas fa-info-circle">Update</i>
                                            </button>
                                            <button href="#" class="btn btn-danger btn-lg blog-delete-button blog-btn">
                                                <i class="fas fa-trash">Delete</i>
                                            </button>
                                            <select class="form-control">
                                                <?php
                                                foreach ($data["status"] as $key => $value) {
                                                    if (!strcmp($value, $post->state)) {
                                                        echo "<option selected>$value</option>";
                                                    } else {
                                                        echo "<option>$value</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
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
<script src="/assets/js/postwork.js"></script>