<?php
session_start();
session_destroy();
setcookie("pseudo", "", time() - 3600);
header('location: index.php');
