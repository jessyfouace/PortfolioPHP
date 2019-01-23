<?php
session_start();
session_destroy();
setcookie("pseudo", "", time() - 3600);
setcookie("motdepassecrypte", "", time() - 3600);
setcookie("acceptation", "", time() - 3600);
header('location: index.php');
