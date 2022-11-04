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
            foreach ($products as $key => $value) {
                ?>
                <div class=" col-sm-6 col-md-4 col-lg-3">
                    <div class="product-box box">
                        <div class="option_container">
                            <div class="options">
                                <a href="" class="option1 addToCartBtn">
                                    Add to cart
                                </a>
                                <a href="/products/product?device=<?php echo $value["id"] ?>" class="option2">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="<?php echo $value["img_src"] ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                <?php echo $value["name"] ?>
                            </h5>
                            <h6 class="ml-2">
                                <?php echo $value["price"] ?>$
                            </h6>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</section>
<script src="../../assets/js/cartScript.js"></script>
