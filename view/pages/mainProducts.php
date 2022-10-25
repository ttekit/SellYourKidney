<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Product Grid</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end inner page section -->
<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
        <?php use Models\products;

        $pm = new products();
        $products = $pm->execQuery("SELECT * FROM products");
        foreach ($products as $key=>$value){
        ?>
            <div class="product-box col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="" class="option1">
                                Add to cart
                            </a>
                            <a href="<?php echo $value->src?>" class="option2">
                                Buy Now
                            </a>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="images/<?php echo $value->img_src?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $value->name?>
                        </h5>
                        <h6>
                            <?php echo $value->price?>
                        </h6>
                    </div>
                </div>
            </div>
        <?}?>
        </div>
    </div>
</section><?php
