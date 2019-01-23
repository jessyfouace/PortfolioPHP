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
$title = 'Jessy Fouace - Connection';

$bdd = Database::BDD();
$userManager = new UserManager($bdd);

$message = "";
$color = "";

if (!isset($_SESSION['pseudo'])) {
} else {
    header('location: index.php');
}

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
                    header('location: index.php');
                } else {
                    setcookie("pseudo", "", time() - 3600);
                    setcookie("motdepassecrypte", "", time() - 3600);
                }
            } else {
                setcookie("pseudo", "", time() - 3600);
                setcookie("motdepassecrypte", "", time() - 3600);
            }
        }
    }
}

if (!empty($_POST['connexion'])) {
    if (!empty($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        if (!empty($_POST['password'])) {
            $password = htmlspecialchars($_POST['password']);
            $user = new User([
                'pseudo' => $pseudo
            ]);
            $checkConnexion = $userManager->getUsers($user);
            if ($checkConnexion) {
                $password = password_verify($password, $checkConnexion->getPassword());
                if ($password) {
                    $color = "colorgreen font-weight-bold";
                    $message = "Connection en cours.";
                    if (isset($_POST['cookies'])) {
                        setCookie('pseudo', $checkConnexion->getPseudo(), (time()+60*60*24*365));
                        setCookie('motdepassecrypte', $_POST['password'], (time()+60*60*24*365));
                    }
                    $_SESSION['pseudo'] = $checkConnexion->getPseudo();
                    $_SESSION['password'] = $checkConnexion->getPassword();
                    header('refresh: 1; url=admin.php');
                } else {
                    $color = "colorred font-weight-bold";
                    $message = "Connection échouée.";
                }
            } else {
                $color = "colorred font-weight-bold";
                $message = "Connection échouée.";
            }
        }
    }
}

require "../views/connectForAdminPannelPortfolioVue.php";
