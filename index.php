<?php
session_start();
include "partials/_header.php" ?>

<body>

    <?php include "partials/_navbar.php" ?>

    <?php if (!isset($_SESSION["isLogin"])) : ?>
        <h1>Please register or login!!</h1>

    <?php else : ?>
        <h1>Hello World!!</h1>

    <?php endif ?>

</body>

</html>