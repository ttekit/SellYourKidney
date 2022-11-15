window.addEventListener("load", () => {
    var files;

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
    }


    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {
            let formData = new FormData();
            let id = $("#id").val();
            formData.append('file', files[0]);
            formData.append('productId', id);
            console.log(formData.getAll("productId"));
            $.ajax({
                url: '/admin/uploadPostImage',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,

                success: function (data) {
                    // do smth.
                    swal("Comment is successfully send", {
                        icon: "success",
                    })
                },
                error: function (err, errmsg) {
                    console.log("error: " + errmsg);
                },
                beforeSend: function() {
                    $('#preloader').fadeIn(500);
                },
                complete: function() {
                    $('#preloader').fadeOut(500);
                },
            });

            return false;
        });
})
