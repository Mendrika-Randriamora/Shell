<?php

namespace Menus\Shell\Database;

use Menus\Shell\Trait\TraitFile;

class Migration
{
    use TraitFile;

    const MIGRATION_PATH = "./migrations/";
    const MIGRATION_SOURCE = "./source/migration.php";

    /**
     * Connexion à la base de donnée
     * 
     * @return \PDO|null
     */
    private static function pdo()
    {
        try {
            $pdo = new Database();
            return $pdo->connexion();
        } catch (\PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    /**
     * Créer un ficher de migration
     * @param string $filename nom du fichier
     * 
     * @return void
     */
    public static function create($filename)
    {
        $data = @file_get_contents(self::MIGRATION_SOURCE) or
            die("Erreur de récuperation des données de la migration");

        $path = self::MIGRATION_PATH . $filename . "_migration.php";
        self::generate_file($path, $data);
    }

    /**
     * Génération de la table 
     * @param $filename nom du fichier à qui on va prendre l'info
     * 
     * @return void
     */
    public static function generate_sql($filename)
    {
        if (!strpos($filename, "_migration.php"))
            $filename .= "_migration.php";

        /**
         * Information concernant la table
         * @var array $data_table 
         */
        $data_table = require self::MIGRATION_PATH . $filename;

        /**
         * Requête à éxcécuter pour la création de la table
         * @var string $request
         */
        $request = require "./src/Database/init_table.php";

        try {
            self::pdo()->exec($request);
            echo "Table created successfully", PHP_EOL;
        } catch (\Throwable $th) {
            die("Erreur : " . $th->getMessage());
        }
    }

    /**
     * Fonction de la migration
     * @param strin $filename nom du fichier à créer une table
     * 
     * @return void
     */
    public static function migrate($filename)
    {
        self::generate_sql($filename);
    }
}
