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
$title = 'Jessy Fouace - Portfolio';

$bdd = Database::BDD();
$projectsManager = new ProjectsManager($bdd);
$contactManager = new ContactManager($bdd);
$userManager = new UserManager($bdd);

$getProjects = $projectsManager->getProjects();

$message = "";
$color = "";
if (isset($_POST['acceptcookies'])) {
    setCookie('acceptation', 'Accepter', (time() + 60 * 60 * 24 * 365));
    header('location: ' . $_SERVER['REQUEST_URI']);
} elseif (isset($_POST['refusecookies'])) {
    $_SESSION['nocookies'] = 'true';
    header('location: ' . $_SERVER['REQUEST_URI']);
}

if(!isset($_SESSION['pseudo'])){
    if(isset($_COOKIE['pseudo'])) {
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
                    $recipients = ['jessy.fouace62@gmail.com'];
                    $bond = uniqid('np');

                    $to = implode(',', $recipients);

                    $subject = '[PORTFOLIO] Nouveau message';

                    $messageMail = '
                        <html>
                        <head>
                        </head>
                        <body>
                        <p>Un nouveau message à étais reçu.</p>
                        <p>Email expéditeur: ' . ' ' . $mail . '</p>
                        <p>Nom : ' . ' ' . $firstname . '</p>
                        <p>Prénom : ' . ' ' . $lastname . '</p>
                        <p>Numéro de Téléphone : ' . ' ' . $phone . '</p>
                        <p>Message : ' . ' ' . $messageContact . '</p>
                        </body>
                        </html>
                        ';

                    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                    // En-têtes additionnels
                    $headers[] = 'From: Portfolio <noreply@portfoliojessyfouace.fr>';
                    mail($to, $subject, $messageMail, implode("\r\n", $headers));
                    sleep(1);
                }
            }
        }
    }
}

require "../views/indexVue.php";
