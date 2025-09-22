<?php

namespace Menus\Shell\Database;

class Database
{
    const DB_PATH = "./source/database.sqlite";
    private \PDO|null $pdo = null;

    /**
     * Connexion à la base de donnée
     * 
     * @return \PDO|null
     */
    public function connexion()
    {
        try {
            if (!$this->pdo)
                $this->pdo = new \PDO("sqlite:" . self::DB_PATH);

            return $this->pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage(), PHP_EOL;
            return null;
        }
    }
}
