window.addEventListener("load", function () {
    "use strict"
    var postId = parseInt($(".post-id").text());
    var getAnswerFrom = function ($parent, oldData) {
        console.log(oldData.id);
        let $data;
        $data = $(`<form action="saveComment" method="post" id="comment-form" class="form-horizontal form-wizzard">
                            <h3 class="h3">Answer a comment</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="login" type="name" class="form-control" placeholder="Enter your name ..."/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" placeholder="Enter your email ..."/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="8" class="form-control" placeholder="Your comment ..."></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Answer comment" class="btn btn-default sumbit-btn"/>
                            </div>
                        </form>`);


        $data.submit(function (e) {
            e.preventDefault();

            var $nameInput = $data.find("input[name*='login']");
            var $emailInput = $data.find("input[name*='email']");
            var $messageInput = $data.find("textarea[name*='message']");

            var userMessage = {
                postId: postId,
                login: $nameInput.val(),
                email: $emailInput.val(),
                message: $messageInput.val(),
                messageId: oldData.id
            }
            $.ajax({
                url: "/ajax/saveComment",
                method: "POST",
                data: userMessage,
                success: (data) => {
                    console.log(data);
                    switch (data) {
                        case "1 row affected": {
                            $(".comments-form").trigger("reset");
                            alert("Comment is successfully send to moderation validation");
                            break;
                        }
                        case "0 row affected": {
                            alert("Some data in comment is unavailable, refill form");
                            //показать вспл окно с неуспехом операции и дальнешей попыткой разобраться
                            break;
                        }
                    }
                    ;
                },
                error: (msg) => {
                    alert(msg);
                }
            })
            $data.remove();
            $parent.find(".comment-answer-btn").removeClass("hidden");
        })
        return $data;
    }
    var getOneCommentBlock = function (comment) {
        var $block = $(`<li class="media">
                                <div class="comment-id">${comment.id}</div>
                                
                                <div class="media-left">
                                    <img class="comment-ava"src="/assets/images/blog/mike.jpg" alt="">
                                </div>
                                <div class="media-body">
                                <div class = "comment-header">
                                    <h4 class="media-heading">${comment.login}</h4>
                                    <button class = "comment-btn">+</button>
                                    <button class="comment-answer-btn">answ</button>
                                </div>

                                    <div class="media-date">${comment.dateOfCreated}</div>
                                    <div class="media-content">
                                        <p>${comment.comment}</p>
                                    </div>
                                </div>
                 </li>`);

        $block.find(".comment-btn").on("click", function (e) {
            getSubComments(comment.id, $block);
            $(e.target).remove();
        });
        $block.find(".comment-answer-btn").on("click", function (e) {
            $(e.target).addClass("hidden");
            $block.append(getAnswerFrom($block, comment));
        })
        return $block;
    }
    var getOneChildBlock = function (data) {
        var $block = $(`<li class="media child">
                                <div class="comment-id">${data.id}</div>
                                <div class="media-left">
                                    <img class="comment-ava"src="/assets/images/blog/mike.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class = "comment-header">
                                        <h4 class="media-heading">${data.login}</h4>
                                        <button class = "comment-btn">+</button>
                                        <button class="comment-answer-btn">answ</button>
                                    </div>
                                    <div class="media-date">${data.dateOfCreated}</div>
                                    <div class="media-content">
                                        <p>${data.comment}</p>
                                    </div>
                                </div>
                 </li>`);

        $block.find(".comment-btn").on("click", function (e) {
            getSubComments(data.id, $block);
            $(e.target).remove();
        });
        $block.find(".comment-answer-btn").on("click", function (e) {
            $(e.target).addClass("hidden");
            $block.append(getAnswerFrom($block, data));
        })
        return $block;
    }
    var getSubComments = function (parent_id, $block) {
        $.ajax({
            url: "/ajax/getSubComments",
            method: "POST",
            data: {
                "parentId": parent_id
            },
            success: (data) => {
                var comments = JSON.parse(data);
                for (let i = 0; i < comments.length; i++) {
                    $block.append(getOneChildBlock(comments[i]));
                }
            },
            error: (msg) => {
                alert(msg);
            }
        })
    }

//TODO: change css
    if (!isNaN(postId)) {
        $.ajax({
            url: "/ajax/getComments",
            method: "POST",
            data: {
                "postId": postId
            },
            success: (data) => {
                var comments = JSON.parse(data);
                if (comments.length > 0) {
                    var $commContainer = $('.card-body');
                    comments.forEach((item, index) => {
                        $commContainer.append(getOneCommentBlock(item))
                    })
                }

            },
            error: (msg) => {
                alert(msg);
            }
        })
    }

    var $messageForm = $("#comment-form");

    $messageForm.submit(function (e) {
        e.preventDefault();
        var $nameInput = $messageForm.find("input[name*='login']");
        var $emailInput = $messageForm.find("input[name*='email']");
        var $messageInput = $messageForm.find("textarea[name*='message']");

        var userMessage = {
            postId: postId,
            login: $nameInput.val(),
            email: $emailInput.val(),
            message: $messageInput.val(),
            messageId: null
        };

        $.ajax({
            url: "/ajax/saveComment",
            method: "POST",
            data: userMessage,
            success: (data) => {
                console.log(data);
                switch (data) {
                    case "1 row affected": {
                        $(".comments-form").trigger("reset");
                        alert("Comment is successfully send to moderation validation");
                        break;
                    }
                    case "0 row affected": {
                        alert("Some data in comment is unavailable, refill form");
                        //показать вспл окно с неуспехом операции и дальнешей попыткой разобраться
                        break;
                    }
                }

            },
            error: (msg) => {
                alert(msg);
            }
        })
    })
})