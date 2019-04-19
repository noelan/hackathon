<?php
/**
* Created by PhpStorm.
* User: aurelwcs
* Date: 08/04/19
* Time: 18:40
*/

namespace App\Controller;

use App\Model\GambleManager;

class GambleController extends AbstractController
{
    public function Gamble()
    {
        $eggController = new EggController();
        echo "aqoeirhaeopri";
        $gambledEgg = $eggController->showRarity($_SESSION['id']);
        print_r($gambledEgg);

        $userEgg= $gambledEgg;
        $chosenEgg=$gambledEgg[0]['rarity'];
        echo $chosenEgg;
        $betResult=rand(0, 100);
        if ($chosenEgg=="junk") {
            if ($betResult>80) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="basic") {
            if ($betResult>70) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="fine") {
            if ($betResult>60) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="masterwork") {
            if ($betResult>50) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="rare") {
            if ($betResult>40) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="exotic") {
            if ($betResult>30) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="ascended") {
            if ($betResult>20) {
                $result = true;
            } else {
                $result = false;
            }
        } elseif ($chosenEgg=="legendary") {
            if ($betResult>10) {
                $result = true;
            } else {
                $result = false;
            }
        }
        echo $result;
        echo $gambledEgg[0]['rarity'];
        //if  {$gambledEgg[0]['rarity'] == "junk") {}
    //}
    }
}
