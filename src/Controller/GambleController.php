<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class EggController extends AbstractController
{
    public function Gamble()
    {
        $userEgg= "egg de l'user";
        $chosenEgg="egg choisi";
        $betResult=rand(0,100);
        switch($betResult)
        {
            case 'junk':
            if ($betResult>80);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'basic':
            if ($betResult>70);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'fine':
            if ($betResult>60);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'masterwork':
            if ($betResult>50);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'rare':
            if ($betResult>40);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'exotic':
            if ($betResult>30);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'ascended':
            if ($betResult>20);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;

            case 'lengendary':
            if ($betResult>10);
            {
                return true;
            }
            else
            {
                return false;
            }
            break;
        }
    }
}
