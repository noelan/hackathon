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
class EggManager extends AbstractManager
{
    const TABLE = 'users_eggs';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectUserEgg($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE user_id=:id");
        $statement->bindvalue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(); //array
    }
    
    public function selectUserEggRarity($id)
    {
        echo "ok";
        $statement = $this->pdo->prepare("SELECT firstname, name, rarity  FROM users_eggs JOIN users ON users_eggs.user_id=users.id JOIN eggs ON users_eggs.egg_id=eggs.id WHERE user_id=:id");
        $statement->bindvalue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        echo "okaazazaz";

        return $statement->fetchAll(); //array
    }
}