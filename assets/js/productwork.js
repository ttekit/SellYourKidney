window.addEventListener("load", function (){
    var $btnsContainer = $(".post-manage");
    var $btnsEdit = $btnsContainer.find(".product-edit-button");
    var $btnsDelete = $btnsContainer.find(".product-delete-button");

    $btnsEdit.on("click", function (e){
        let $postId = $(e.target).closest("div").find(".id").text();
        window.location = "/admin/OneProductEdit?postId="+$postId;
    })

    $btnsDelete.on("click", function (e){
        let $container = $(e.target).closest("div");
        let $prodId = $container.find(".id").text();
        $.ajax({
            url: "/ajax/deleteOneProduct",
            method: "POST",
            data: {
                "prodId": $prodId
            },
            success: (data) => {
                console.log(data);
                $container.parent("div").parent("div").remove();
            },
            error: (msg) => {
                alert(msg);
            }
        })
    })
});