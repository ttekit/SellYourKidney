window.addEventListener("load", function () {


    let $addNewSocButtom = $(".add-new-soc-button");
    let $container = $(".soc-media-group");
    $addNewSocButtom.on("click", (e) => {
        $container.append(`
            <li class="inputs-container list-group-item d-flex justify-content-between align-items-center p-3">
                    <input type="text" class="mb-0" placeholder="Name" Name="Name"/>
                    <input type="text" class="mb-0" placeholder="Url" name="Url"/>
                    <input type="button" class="mb-0 border-0 appendSocDataToArray" value="Add"/>
            </li>
        `)
        $(".appendSocDataToArray").on("click", (e) => {
            let allInputs = $(".inputs-container input[type=text]");
            let tmp = {}

            $.ajax({
                type: "POST",
                url: "/ajax/updateSocLinkData",
                data: {
                    name: allInputs[0].value,
                    link: allInputs[1].value
                },
                success: function (msg) {
                    msg = JSON.parse(msg)
                    $container.append(`<li class="inputs-container list-group-item d-flex justify-content-between align-items-center p-3">
                                            ${msg[msg.length-1].name}
                                        </li>`);
                }
            });
        })
    })
})