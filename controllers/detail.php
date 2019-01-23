<?php

function chargerClasse($classname)
{
    if (file_exists('../model/' . ucfirst($classname) . '.php')) {
        require '../model/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../entities/' . ucfirst($classname) . '.php')) {
        require '../entities/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../traits/' . ucfirst($classname) . '.php')) {
        require '../traits/' . ucfirst($classname) . '.php';
    } else {
        require '../interface/' . ucfirst($classname) . '.php';
    }
}
spl_autoload_register('chargerClasse');
session_start();
$title = 'Jessy Fouace - Détail';

$bdd = Database::BDD();
$projectsManager = new ProjectsManager($bdd);
$message = '';

if (isset($_POST['acceptcookies'])) {
    setCookie('acceptation', 'Accepter', (time() + 60 * 60 * 24 * 365));
    header('location: ' . $_SERVER['REQUEST_URI']);
} elseif (isset($_POST['refusecookies'])) {
    $_SESSION['nocookies'] = 'true';
    header('location: ' . $_SERVER['REQUEST_URI']);
}

if (!isset($_SESSION['pseudo'])) {
    if (isset($_COOKIE['pseudo'])) {
        if (isset($_COOKIE['motdepassecrypte'])) {
            $pseudo = htmlspecialchars($_COOKIE['pseudo']);
            $user = new User([
                'pseudo' => $pseudo
            ]);
            $password = htmlspecialchars($_COOKIE['motdepassecrypte']);
            $checkConnexion = $userManager->getUsers($user);
            if ($checkConnexion) {
                $password = password_verify($password, $checkConnexion->getPassword());
                if ($password) {
                    $_SESSION['pseudo'] = $_COOKIE['pseudo'];
                    $_SESSION['password'] = $_COOKIE['motdepassecrypte'];
                    header('location: ' . $_SERVER['REQUEST_URI']);
                } else {
                    setcookie("pseudo", "", time() - 3600);
                    setcookie("motdepassecrypte", "", time() - 3600);
                    header('location: ' . $_SERVER['REQUEST_URI']);
                }
            } else {
                setcookie("pseudo", "", time() - 3600);
                setcookie("motdepassecrypte", "", time() - 3600);
                header('location: ' . $_SERVER['REQUEST_URI']);
            }
        }
    }
}

if (isset($_GET['project'])) {
    $id = (int)$_GET['project'];
    $project = new Projects([
        'id' => $id
    ]);
    $getProjects = $projectsManager->getProjectsById($project);
    if (!$getProjects) {
        $message = 'Aucun projet n\'as étais trouvé';
        header('Refresh: 1.2; index.php');
    } else {
    }
} else {
    header('location: index.php');
}



require "../views/detailVue.php";
