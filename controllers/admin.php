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

$title = 'Jessy Fouace - Pannel Administrateur';

if (!empty($_SESSION['name'])) {
    $bdd = Database::BDD();
    if (isset($_GET['contact'])) {
        if ($_GET['contact'] == 'true') {
            $contactManager = new ContactManager($bdd);
            if (!empty($_GET['deleteMessage'])) {
                if ($_GET['deleteMessage'] == "true") {
                    if (!empty($_POST['id'])) {
                        $id = htmlspecialchars($_POST['id']);
                        $message = new Contact([
                            'id' => $id
                        ]);
                        $removeMessage = $contactManager->removeMessage($message);
                    }
                }
            }
            $takeMessages = $contactManager->getMessages();
        }
    } elseif (isset($_GET['add'])) {
        if ($_GET['add'] == 'true') {
            $message = "";
            $color = "";
            if (isset($_POST['name'])) {
                if (isset($_POST['description'])) {
                    if (isset($_FILES['image'])) {
                        $target_dir = "../assets/img/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        // Check if image file is a actual image or fake image
                        if (isset($_POST["submit"])) {
                            $check = getimagesize($_FILES["image"]["tmp_name"]);
                            if ($check !== false) {
                                $message = "Il s'agit bien d'une image.";
                                $color = "colorgreen";
                                $uploadOk = 1;
                            } else {
                                $message = "Désolé, il ne s'agit pas d'une image.";
                                $color = "colorred";
                                $uploadOk = 0;
                            }
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $message = "Désolé, une image porte déjà ce nom là.";
                            $color = "colorred";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif") {
                            $message = "Désolé, uniquement du JPG, JPEG, PNG & GIF.";
                            $color = "colorred";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $message = "Désolé, Votre image n'as pas étais chargée.";
                            $color = "colorred";
                        // if everything is ok, try to upload file
                        } else {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                $name = htmlspecialchars($_POST['name']);
                                $description = htmlspecialchars(strip_tags($_POST['description']));
                                $nextLineTakePost = nl2br($description);
                                $projectManager = new ProjectsManager($bdd);
                                if (isset($_POST['link'])) {
                                    $link = htmlspecialchars($_POST['link']);
                                    $newProject = new Projects([
                                        'title' => $name,
                                        'description' => $nextLineTakePost,
                                        'link' => $link,
                                        'image' => '../assets/img/' . basename($_FILES["image"]["name"])
                                    ]);
                                } else {
                                    $newProject = new Projects([
                                        'title' => $name,
                                        'description' => $nextLineTakePost,
                                        'image' => '../assets/img/' . basename($_FILES["image"]["name"])
                                    ]);
                                }
                                $addProject = $projectManager->addProject($newProject);
                                $message = "Ajout réussis.";
                                $color = "colorgreen";
                            } else {
                                $message = "Désolé, une erreur est intervenue.";
                                $color = "colorred";
                            }
                        }
                    }
                }
            }
        }
    } elseif (isset($_GET['remove'])) {
        if ($_GET['remove'] == 'true') {
            $projectManager = new ProjectsManager($bdd);
            if (isset($_POST['submit'])) {
                if (isset($_POST['id'])) {
                    $id = (int)$_POST['id'];
                    $remove = new Projects([
                        'id' => $id
                    ]);
                    $getProject = $projectManager->getProjectsById($remove);
                    unlink($getProject->getImage());
                    $removeProject = $projectManager->removeProject($remove);
                }
            }
            $showAll = $projectManager->getAllProjects();
        }
    } elseif (isset($_GET['update'])) {
        if ($_GET['update'] == 'true') {
            $projectManager = new ProjectsManager($bdd);
            if (isset($_GET['project'])) {
                $id = $_POST['id'];
                $project = new Projects([
                    'id' => $id
                ]);
                $takeProjectById = $projectManager->getProjectsById($project);
                $lastImage = $takeProjectById->getImage();
                if (isset($_POST['name'])) {
                    $name = htmlspecialchars($_POST['name']);
                } else {
                    $name = $takeProjectById->getTitle();
                }
                if (isset($_POST['link'])) {
                    $link = htmlspecialchars($_POST['link']);
                } else {
                    $link = $takeProjectById->getLink();
                }
                if (isset($_POST['description'])) {
                    $description = htmlspecialchars(strip_tags($_POST['description']));
                    $nextLineTakePost = nl2br($description);
                } else {
                    $description = $takeProjectById->getDescription();
                }
                if (!empty($_FILES['image']['name'])) {
                    $target_dir = "../assets/img/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        if ($check !== false) {
                            $message = "Il s'agit bien d'une image.";
                            $color = "colorgreen";
                            $uploadOk = 1;
                        } else {
                            $message = "Désolé, il ne s'agit pas d'une image.";
                            $color = "colorred";
                            $uploadOk = 0;
                        }
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $message = "Désolé, une image porte déjà ce nom là.";
                        $color = "colorred";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["image"]["size"] > 500000) {
                        $message = "Désolé, votre image est trop volumineuse.";
                        $color = "colorred";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif") {
                        $message = "Désolé, uniquement du JPG, JPEG, PNG & GIF.";
                        $color = "colorred";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $message = "Désolé, Votre image n'as pas étais chargée.";
                        $color = "colorred";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image = '../assets/img/' . basename($_FILES["image"]["name"]);
                            unlink($lastImage);
                        } else {
                            $message = "Désolé, une erreur est intervenue.";
                            $color = "colorred";
                        }
                    }
                } else {
                    $image = $lastImage;
                }
                $updateProject = new Projects([
                    'id' => $takeProjectById->getId(),
                    'title' => $name,
                    'link' => $link,
                    'description' => $nextLineTakePost,
                    'image' => $image
                ]);
                $projectManager->updateProject($updateProject);
            }
            $showAll = $projectManager->getAllProjects();
        }
    }
    require "../views/adminVue.php";
} else {
    header('location: index.php');
}
