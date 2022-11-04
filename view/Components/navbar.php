<?php if (!isset($_SESSION["reg"])) {
    ?>

    <a href="/user" class="btn-login mr-2">
        <button>Login</button>
    </a>
    <a href="/user/Register" class="btn-login">
        <button>Register</button>
    </a>

    <?php
} elseif ($_SESSION["reg"]["role"] == "user") {
    ?>

    <a href="/user" class="btn-login mr-2">
        <button>UserCabinet</button>
    </a>
    <a href="/user/LogOut" class="btn-login mr-2">
        <button>Log Out</button>
    </a>

    <?php
} elseif ($_SESSION["reg"]["role"] == "admin") {
    ?>
    <a href="/admin" class="btn-login mr-2">
        <button>AdminPanel</button>
    </a>
    <a href="/user/LogOut" class="btn-login mr-2">
        <button>Log Out</button>
    </a>
    <?
} ?>
