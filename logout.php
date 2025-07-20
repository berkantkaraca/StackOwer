<?php
    session_start();
    session_destroy();
    setcookie("name", "", time() - (60 * 60 * 24));
    
    header("Location: index.php");

?>