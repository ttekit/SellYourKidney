window.addEventListener("load", function () {
    let $table = $(".datatable");
    let pressed = false;
    let $newOptionBtn = $table.find(".newOptionBtn");
    $newOptionBtn.on("click", function () {
        $addOptionBlock = $table.find(".addBlock");
        if (pressed == false) {
            $addOptionBlock.removeClass("hidden");
            pressed = true;
        } else {
            $addOptionBlock.addClass("hidden");
            pressed = false;
        }
    })
    let editBtns = document.getElementsByClassName(".editBtn");

    for(let i = 0; i < editBtns.length; i++){
        editBtns[i].addEventListener("click", function (){
            
        })
    }
})