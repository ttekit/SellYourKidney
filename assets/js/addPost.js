window.addEventListener("load", () => {
    var files;

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
        console.log(files)
    }


    // Отсыл данных на сервер
    $(document).on('click',
        '#submit',
        function () {
            let postForm = $(".addNewPost");
            let formData = new FormData();

            formData.append('logo', files[0]);

            formData.append('title', $("[name='title']").val());
            formData.append('slogan', $("[name='slogan']").val());
            formData.append('content', $("[name='content']").val());

            console.log(formData.getAll("slogan"));
            $.ajax({
                url: '/user/addNewPost',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,

                success: function (data) {
                    // do smth.
                    alert(data);
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
