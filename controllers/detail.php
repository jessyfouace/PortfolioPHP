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
