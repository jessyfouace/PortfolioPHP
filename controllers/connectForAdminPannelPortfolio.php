<?php

function chargerClasse($classname)
{
    if (file_exists('../model/'. ucfirst($classname).'.php')) {
        require '../model/'. ucfirst($classname).'.php';
    } elseif (file_exists('../entities/'. ucfirst($classname).'.php')) {
        require '../entities/'. ucfirst($classname).'.php';
    } elseif (file_exists('../traits/'. ucfirst($classname).'.php')) {
        require '../traits/'. ucfirst($classname).'.php';
    } else {
        require '../interface/'. ucfirst($classname).'.php';
    }
}
spl_autoload_register('chargerClasse');

$title = 'Jessy Fouace - Pannel Administrateur';

$bdd = Database::BDD();
$userManager = new UserManager($bdd);

$message = "";
$color = "";

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
