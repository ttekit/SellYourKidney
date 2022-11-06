window.addEventListener("load", function () {
    let $addToCartBtn = $(".addToCartBtn");
    $addToCartBtn.on("click", (e)=>{
       let id = $(e.target).parent().find(".product-id").text();
        $.ajax(
            {
                url: "/products/addProductToCart",
                method: "POST",
                data: {
                    prodId: id
                },
                success: (data) => {
                    console.log(data);
                },
                error: (msg) => {
                    alert(msg);
                }
            },
        )
    })
})

$(document).ready(function() {
    $('#preloader').fadeOut(400);
});