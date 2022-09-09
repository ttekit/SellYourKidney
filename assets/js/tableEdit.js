window.addEventListener("load", function (){
    let $table = $(".datatable");
    let pressed = false;
    let $newOptionBtn = $table.find(".newOptionBtn");
    $newOptionBtn.on("click", function (){
        $addOptionBlock = $table.find(".addBlock");
        if(pressed == false){
            $addOptionBlock.removeClass("hidden");
            pressed = true;
            $addOptionBlock.find(".addOptionFrom").submit(function (e) {
                e.preventDefault();
                var $nameInput = $addOptionBlock.find("input[name*='name']");

                var $valueInput = $addOptionBlock.find("input[name*='value']");

                var newOption = {
                    name: $nameInput.val(),
                    value : $valueInput.val(),
                };
                console.log(newOption);

                $.ajax({
                    url: "/ajax/saveOption",
                    method: "POST",
                    data: newOption,
                    success: (data) => {
                        switch (data) {
                            case "1 row affected": {
                                alert("Comment is successfully send to moderation validation");
                                break;
                            }
                            case "0 row affected": {
                                alert("Some data in comment is unavailable, refill form");
                                break;
                            }
                        }

                    },
                    error: (msg) => {
                        alert(msg);
                    }
                })
            })
        }
        else{
            $addOptionBlock.addClass("hidden");
            pressed = false;
        }

    })
})