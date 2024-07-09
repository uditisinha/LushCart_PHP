<?php
    session_start();
    session_unset();
    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    echo "<script>alert('Logged out successfully')</script>";
    echo "<script>window.location = 'login.php'</script>";
    exit;
?>