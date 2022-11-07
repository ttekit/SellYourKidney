window.addEventListener("load", function () {
    let $addToCartBtn = $(".addToCartBtn");
    let cartArr = [];
    $addToCartBtn.on("click", (e) => {
        let product = {
            id: $(e.target).parent().find(".product-id").text(),
            name: $(e.target).parent().find(".name").text(),
            price: $(e.target).parent().find(".price").text()
        };
        cartArr.push(product);
    })
    
    let $cartButton = $(".cart-button");
    let hasPressed = false;
    let $cartContainer = $(".cart-block");
    $cartButton.on("click", () => {
        //Changing visibility of cart div
        if (hasPressed === false) {
            $cartContainer.fadeIn(500);
            hasPressed = true;
            $elemContainer = $cartContainer.find("ul");
            for(let i = 0; i < cartArr.length; i++){
                $elemContainer.append(`<li class="row cart-li">
                    <p>${cartArr[i].name}</p>
                    <p>${cartArr[i].price}</p>
                    <a type="button" class="remove-cart-elem">-</a>
                </li>`);
                console.log(cartArr[i]);
            }
        } else {
            $cartContainer.fadeOut(500);
            hasPressed = false;
        }
        //Filling this div
    })
})
