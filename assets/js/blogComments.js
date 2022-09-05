window.addEventListener("load", function () {
    "use strict"

    var postId = parseInt($(".post-id").text());

    //TODO: дописать метод рендера комментариев, исправить Ajax.php
    if (!isNaN(postId)) {
        $.ajax({
            url: "/ajax/getComments",
            method: "POST",
            data: {
                "postId": postId
            },
            success: (data) => {
                console.log(data);
                var tmp = JSON.parse(data);
                data = tmp;
                var comCont = document.querySelector(".card-body");

                for (let i = 0; i < data.length; i++) {
                    if (data[i].comment_id == null) {
                        var commentBox = document.createElement("div");
                        var personData = document.createElement("div");

                        var avatar = document.createElement("img");
                        var elem = document.createElement("div");
                        var elemText = document.createElement("div");

                        personData.classList.add("flex-shrink-0");
                        commentBox.classList.add("d-flex");
                        commentBox.setAttribute("id", data[i].id)
                        elem.classList.add("ms-3");
                        elem.innerHTML = data[i].comment;
                        elemText.classList.add("fw-bold");
                        elemText.innerHTML = data[i].login;
                        avatar.classList.add("rounded-circle");

                        avatar.setAttribute("src", "https://dummyimage.com/50x50/ced4da/6c757d.jpg");
                        avatar.setAttribute("alt", "...");

                        personData.appendChild(avatar);
                        elem.appendChild(elemText);

                        commentBox.appendChild(personData);
                        commentBox.appendChild(elem);
                        comCont.appendChild(commentBox);
                    } else {
                        var mainCont = document.createElement("div");
                        var avatarCont = document.createElement("div");
                        var avatarImg = document.createElement("img");
                        var nickName = document.createElement("div");
                        var textCont = document.createElement("div");

                        mainCont.classList.add("mt-4");
                        mainCont.classList.add("d-flex");
                        avatarCont.classList.add("flex-shrink-0");
                        avatarImg.classList.add("rounded-circle");
                        textCont.classList.add("ms-3");
                        nickName.classList.add("fw-bold");

                        avatarImg.setAttribute("src", "https://dummyimage.com/50x50/ced4da/6c757d.jpg");
                        avatarImg.setAttribute("alt", "...")

                        textCont.appendChild(nickName);
                        avatarCont.appendChild(avatarImg);
                        mainCont.appendChild(avatarCont);
                        mainCont.appendChild(textCont);

                        for (let j = 0; j < data.length; j++) {
                            if (data[i].comment_id == data[j].id) {
                                nickName.innerHTML = data[i].login;
                                textCont.innerHTML += data[i].comment;
                                document.getElementById(data[j].id).classList.add("mb-4");
                                document.getElementById(data[j].id).querySelector(".ms-3").appendChild(mainCont);
                            }
                        }
                    }
                    console.log(data[i]);
                }

            },
            error: (msg) => {
                alert(msg);
            }
        })
    }
})