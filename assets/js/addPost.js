window.addEventListener("load", () => {
    let files;

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

            if(files != null){
                formData.append('logo', files[0]);
            }

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
                    console.log(data);
                    swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to share"+data,
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                swal("Poof! Your post is on checking!", {
                                    icon: "success",
                                }).then((willDelete) => {
                                    location.href = "/Blog/";
                                });
                            } else {
                                swal("Why are you so close?");
                            }
                        });
                },
                error: function (err, errmsg) {
                    swal({
                        title: "Error",
                        text: "Try later pls: " + errmsg,
                        icon: "error"
                    })
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
