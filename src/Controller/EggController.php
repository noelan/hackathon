<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\EggManager;
use App\Model\UserManager;

class EggController extends AbstractController
{
    public function showEggRandom()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://easteregg.wildcodeschool.fr/api/']);
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'eggs/random');
        $body = $response->getBody();
        $body = $body->getContents();
        $egg = json_decode($body);
        // or
        // Send request https://foo.com/api/test?key=maKey&name=toto
    }

    public function showUserEggs()
    {
        echo "ok";
        $EggManager = new EggManager();
        $eggs = $EggManager->selectUserEggs($_SESSION['id']);
        return $this->twig->render('Egg/userEggs.html.twig', ['eggs' => $eggs]);
    }

    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }

    public function showRarity(int $id)
    {
        $EggManager = new EggManager();
        echo "ok";
        $egg = $EggManager->selectUserEggRarity($id);
        $compteur=0;
        print_r($egg);
        //foreach ($egg as $key => $value) {
        //        $egg[$key] = $egg[$value];
        //    }
        for ($i=0; $i < count($egg); $i++) {
            if ($egg[$i]['rarity'] == "junk") {
                $compteur += 10 ;
            } elseif ($egg[$i]['rarity'] == "basic") {
                $compteur += 20 ;
            } elseif ($egg[$i]['rarity'] == "fine") {
                $compteur += 30 ;
            } elseif ($egg[$i]['rarity'] == "masterwork") {
                $compteur += 40 ;
            } elseif ($egg[$i]['rarity'] == "rare") {
                $compteur += 50 ;
            } elseif ($egg[$i]['rarity'] == "exotic") {
                $compteur += 60 ;
            } elseif ($egg[$i]['rarity'] == "ascended") {
                $compteur += 70 ;
            } elseif ($egg[$i]['rarity'] == "legendary") {
                $compteur += 100 ;
            }
        }
        $UserManager = new UserManager();
        $user = $UserManager->insertPoint($compteur, $id);
    }
}