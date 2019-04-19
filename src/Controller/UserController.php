<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Service\Session;

class UserController extends AbstractController
{
    // Display every user
    public function index()
    {
        $userManager = new UserManager();
        $users = $userManager->selectAll();

        return $this->twig->render('Users/user.html.twig', ['users' => $users]);

        $userManager = new UserManager();
        $resulta = $userManager->compteur();
        var_dump($userManager);
    }
    // Display a user
    public function show($id)
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        return $this->twig->render('Users/show.html.twig', ['user' => $user]);
    }
    // Edit the user
    public function edit($id)
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user['firstname'] = $_POST['firstname'];
            $user['lastname'] = $_POST['lastname'];
            $user['email'] = $_POST['email'];
            $user['status_ID'] = $_POST['status_ID'];
            $user['image'] = $_POST['image'];
            $user['password'] = $_POST['password'];
            $userManager->update($user);
        }

        return $this->twig->render('Users/user_edit.html.twig', ['user' => $user]);
    }
    // Delete a user with the id
    public function delete(int $id)
    {
        $userManager = new userManager();
        $userManager->delete($id);
        header('Location:/user/index');
    }

    public function addPoint()
    {
        $EggManager = new EggController();
        $user = $EggManager->showRarity();
        $compteur = 0;
        if ($user["Rarity"] == "junk") {
            $compteur += 10;
        } elseif ($user["Rarity"] == "basic") {
            $compteur += 20;
        } elseif ($user["Rarity"] == "fine") {
            $compteur += 30;
        } elseif ($user["Rarity"] == "masterwork") {
            $compteur += 40;
        } elseif ($user["Rarity"] == "rare") {
            $compteur += 50;
        } elseif ($user["Rarity"] == "exotic") {
            $compteur += 60;
        } elseif ($user["Rarity"] == "ascended") {
            $compteur += 70;
        } elseif ($user["Rarity"] == "legendary") {
            $compteur += 100;
        }
    }
    // Create a user
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new userManager();
            $user = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'status_ID' => $_POST['status_ID'],
            'image' => $_POST['image'],
            'password' => $_POST['password']
            ];
            if (!empty($_POST['email']) && $_POST['email'] == $userManager->getEmail($_POST['email'])['email']) {
                echo "Email déja existant";
            } elseif (empty($_POST['email'])) {
                echo "Veuillez renseigner votre email";
            } else {
                $userManager->insert($user);
                ;
                $userid = $userManager->getid($user['email']);
                $createRandom = new userManager();
                $arrayEggsRandom = $createRandom->eggsRandom();
                for ($i = 0 ;$i < 10; $i ++) {
                    $arrayEggsRandom[$i] = $arrayEggsRandom[$i]['id'];
                }
                $userManager = new UserManager();
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[0]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[1]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[2]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[3]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[4]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[5]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[6]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[7]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[8]);
                $userManager->insertEggsRandom($userid['id'], $arrayEggsRandom[9]);
            }
        }
        return $this->twig->render('Users/add_user.html.twig');
    }

    // Connect the user if the password and the email is ok
    public function connection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $userBdd = $userManager->getLog($_POST['email']);
            if (($userBdd['email'] == $_POST['email'])) {
                $session = new Session;
                $session->createSession($userBdd['ID'], $userBdd['status_ID']);
                header('Location:/user/index');
            } else {
                echo "Mot de passe incorect ou email inexistant";
            }
        }
    }
    // Disconnect the user and redirect to login page
    public function logOut()
    {
        session_destroy();
        header('Location:/user/login');
    }
    // Display the login page
    public function logIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $userBdd = $userManager->getLog($_POST['username']);
            if ((!empty($_POST['username']) && $userBdd['email'] == $_POST['username'])) {
                $session = new Session;
                $session->createSession($userBdd['ID'], $userBdd['status_ID']);
                header('Location:/home/index');
                exit();
            } else {
                $this->twig->addGlobal("errorConnection", true);
            }
        }
        return $this->twig->render('Users/login.html.twig');
    }
}