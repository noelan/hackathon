<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class GambleManager extends AbstractManager
{
    const TABLE = 'users_eggs';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    public function randomRarity($rarity)
    {
        $statement = $this->pdo->prepare("SELECT id  FROM eggs where rarity=:rarity ORDER BY RAND() LIMIT 10");
        $statement->bindvalue('rarity', $rarity, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
}