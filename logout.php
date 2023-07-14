<?php
session_start();
unset($_SESSION['loggedIn']);
unset($_SESSION['username']);
unset($_SESSION['user_role']);
session_destroy();
header("location: login.php");
exit();
