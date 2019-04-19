<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\EggManager;

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

    public function showUserEgg($id)
    {
        $EggManager = new EggManager();
        $egg = $EggManager->selectUserEgg($id);
        print_r($egg);
       
        return $this->twig->render('Egg/useregg.html.twig', ['useregg' => $egg]);
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
        $egg = $EggManager->selectUserEggRarity($id);
        print_r($egg);
        return $this->twig->render('Egg/useregg.html.twig', ['egg' => $egg]);
    }
}