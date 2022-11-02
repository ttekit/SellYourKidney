<div class="product-main-container w-100">
    <div class="product-image">
        <img src="<?= $data["pageData"]["img_src"] ?>"/>
    </div>
    <div class="product-info" style="border:0px solid gray">
        <h3 class="text-white bold"><?= strtoupper($data["pageData"]["name"]) ?></h3>
        <h3 style="margin-top:0px;"><?= $data["pageData"]["price"] ?>$</h3>

        <div class="section" style="padding-bottom:20px;">
            <button class="btn btn-success"><span style="margin-right:20px"
                                                  class="glyphicon gl   yphicon-shopping-cart"
                                                  aria-hidden="true"></span> Buy now
            </button>
            <div class="text-center text-white product-description">
                <?= $data["pageData"]["content"] ?>
            </div>
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&components=buttons"></script>