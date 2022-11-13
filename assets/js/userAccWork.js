window.addEventListener("load", function () {
    let $btnsDelete = $(".ban-user");

    $btnsDelete.on("click", function (e){
        let $container = $(e.target).parent();
        let $userId = $container.find("#id").val();
        console.log($userId);

        $.ajax({
            url: "/ajax/banUser",
            method: "POST",
            data: {
                "id": $userId
            },
            success: (data) => {
                    $container.parent("div").remove();
            },
            error: (msg) => {
                alert(msg);
            }
        })
    })

});