<!doctype html>
<html class="no-js" lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <meta name="description" content="Portfolio de Jessy Fouace, développeur web junior formé chez Yes We Web, Languages connus HTML, CSS (Bootstrap 4), PHP (Symfony 4) , Ajax, JSON, JavaScript, jQuery ">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#26262b">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico"/>
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="../assets/aos-master/dist/aos.css">
  <script src="../assets/aos-master/dist/aos.js"></script>

  <script src="https://unpkg.com/scrollreveal"></script>
  
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top col-12" role="navigation">
    <div class="container col-12">
        <a class="navbar-brand" href="index.php"><i class="fab fa-connectdevelop"><span class="fontmarsek">JESSY</span></i></a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
        </button>
        <div class="collapse navbar-collapse" id="exCollapsingNavbar">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="index.php#realisation" class="nav-link">Réalisation</a></li>
                <li class="nav-item"><a href="index.php#about" class="nav-link">A Propos</a></li>
                <li class="nav-item"><a href="index.php#contact" class="nav-link">Contact</a></li>
                <?php if (!empty($_SESSION['pseudo'])) {
    ?>
                <li class="dropdown order-1">
                    <li class="nav-item"><a class="nav-link" href="admin.php"><span> Pannel Admin</span></a></li>
                </li>
                <li class="dropdown order-1">
                    <li class="nav-item"><a class="nav-link" href="disconnect.php"><span> Déconnexion</span></a></li>
                </li>
                <?php
} ?>
            </ul>
            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <li class="dropdown order-1">
                    <li class="nav-item"><a class="nav-link" href="https://github.com/jessyfouace/" target="_blank"><i class="fab fa-github fa-2x"></i></a></li>
                </li>
                <li class="dropdown order-1">
                    <li class="nav-item"><a class="nav-link" href="https://www.linkedin.com/in/jessy-fouace/" target="_blank"><i class="fab fa-linkedin-in fa-2x"></i></a></li>
                </li>
            </ul>
        </div>
    </div>
</nav>