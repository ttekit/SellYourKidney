<!DOCTYPE html>
<!-- TODO: 2) cange texts in normal-->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- popper js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<!-- bootstrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script

<?php use Models\Navigate; ?>
<html lang="<?= /** @var array $data */
$data['options']['lang']?>">
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="/images/favicon.png" type="">
    <title>Main | IDKSHOP</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css"/>
    <!-- font awesome style -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="/assets/css/responsive.css" rel="stylesheet"/>
</head>
<body>
<div id="preloader" class="visible"></div>
<div class="">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">

                <a class="navbar-brand" href="/"><img width="250"
                                                      src="/<?php echo $data['options']['logo'] ?>"
                                                      alt="#"/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <ul class="collapse navbar-collapse navbar-nav" id="navbarSupportedContent">
                        <?php
                        $navigate = $data["navigation"];
                        foreach ($navigate as $key => $navElem) {
                            if (count($navElem["childs"]) == 0) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $navElem["title"] ?>"
                                       href="<?= $navElem["href"] ?>"><?= $navElem["title"] ?></a>
                                </li>
                                <?php
                            } else { ?>
                                <li class="nav-item dropdown"><a href="<?= $navElem['href'] ?>"
                                                                 class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                                 role="button" aria-expanded="true">
                                        <span class="nav-label"><?= $navElem["title"] ?><span
                                                    class="caret"></span></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($navElem["childs"] as $childsKey => $child) {
                                            ?>
                                            <li><a href="<?= $child['href'] ?>"><?= $child["title"] ?></a></li>

                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        } ?>

                        <?php require_once(COMPONENTS_PATH . "navbar.php") ?>
                    </ul>
        </div>
    </header>
</div>


<!-- end header section -->
<main>
    <?php /** @var $contentView */
    require_once $contentView; ?>
</main>
<!-- footer start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="full">
                    <div class="logo_footer">
                        <a href="#"><img width="210" src="/images/logo.png" alt="#"/></a>
                    </div>
                    <div class="information_f">
                        <p><strong>ADDRESS:</strong> <?php echo($data["options"]["address"]); ?></p>
                        <p><strong>TELEPHONE:</strong> <?php echo($data["options"]["tel"]); ?></p>
                        <p><strong>EMAIL:</strong> <?php echo($data["options"]["email"]); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="widget_menu">
                            <h3>Newsletter</h3>
                            <div class="information_f">
                                <p>Subscribe by our newsletter and get update protidin.</p>
                            </div>
                            <div class="form_sub">
                                <form action="/Contact/addEmailingList" method="post">
                                    <fieldset>
                                        <div class="field">
                                            <label>
                                                <input type="email" placeholder="Enter Your Mail" name="email"/>
                                            </label>
                                            <!-- TODO: new database for same info(mb use js + php)-->
                                            <input type="submit" value="Subscribe"/>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
<div class="cpy_">
    <p>© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
</div>

<!-- custom js -->
<script src="/assets/js/custom.js"></script>
<!-- chane color of item on nav panel-->
<script src="/assets/js/nav-item-color.js"></script>
</body>
</html>