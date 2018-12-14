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

$title = 'Jessy Fouace - Portfolio';

$bdd = Database::BDD();
$projectsManager = new ProjectsManager($bdd);
$contactManager = new ContactManager($bdd);

$getProjects = $projectsManager->getProjects();

$message = "";
$color = "";
if (!empty($_POST['send'])) {
    if (!empty($_POST['firstname'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        if (!empty($_POST['lastname'])) {
            $lastname = htmlspecialchars($_POST['lastname']);
            if (!empty($_POST['mail'])) {
                $mail = htmlspecialchars($_POST['mail']);
                if (!empty($_POST['message'])) {
                    $messageContact = htmlspecialchars($_POST['message']);
                    $message = "Message envoyé";
                    $color = 'colorgreen font-weight-bold';
                    if (isset($_POST['phone'])) {
                        $phone = htmlspecialchars($_POST['phone']);
                    } else {
                        $phone = null;
                    }
                    $newMessage = new Contact([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'phone' => $phone,
                        'email' => $mail,
                        'message' => $messageContact
                    ]);
                    $contactManager->addMessage($newMessage);
                    sleep(1);
                }
            }
        }
    }
}

require "../views/indexVue.php";
