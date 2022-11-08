
window.addEventListener("load", function () {
    let $addToCartBtn = $(".addToCartBtn");
    let cartArr = [];
    $addToCartBtn.on("click", (e) => {
        let product = {
            id: $(e.target).parent().find(".product-id").text(),
            name: $(e.target).parent().find(".name").text().toUpperCase(),
            price: $(e.target).parent().find(".price").text()
        };
        cartArr.push(product);
    })
    
    let $cartButton = $(".cart-button");
    let hasPressed = false;
    let $cartContainer = $(".cart-block");

    $cartButton.on("click", () => {
        $elemContainer = $cartContainer.find("ul");
        //Changing visibility of cart div
        if (hasPressed === false) {
            let summaryPrise = 0;
            $cartContainer.fadeIn(500);
            hasPressed = true;
            for(let i = 0; i < cartArr.length; i++){
                let cartItem = $(`<li class="row cart-li">
                    <p>${cartArr[i].name}</p>
                    <p>${cartArr[i].price}</p>
                    <a type="button" class="remove-cart-elem">del</a>
                </li>`);
                cartItem.find(".remove-cart-elem").on("click", (e)=>{
                    cartArr.splice(i, 1);
                    cartItem.remove();
                })
                $elemContainer.append(cartItem);
                summaryPrise += cartArr[i].price;
            }
            $buyAllButton = $(`<button class='buy-all-button'>Buy All: ${summaryPrise}$</button>`);
            $buyAllButton.on("click", (e)=>{
                    alert("WIP");
            })
        } else {
            $cartContainer.fadeOut(500);
            hasPressed = false;
            $elemContainer.empty();
        }
        //Filling this div
    })
})
