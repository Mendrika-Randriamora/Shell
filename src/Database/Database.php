<?php

namespace Menus\Shell\Database;

class Database
{
    const DB_PATH = "./source/database.sqlite";
    private \PDO|null $pdo = null;

    public function connexion(): \PDO | null
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
