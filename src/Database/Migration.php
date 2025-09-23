<?php

namespace Menus\Shell\Database;

use Menus\Shell\Trait\TraitFile;

class Migration
{
    use TraitFile;

    const MIGRATION_PATH = "./migrations/";
    const MIGRATION_SOURCE = "./source/migration.php";

    private static function pdo()
    {
        $pdo = new Database();
        return $pdo->connexion();
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

    public static function generate_sql($filename)
    {
        if (!strpos($filename, "_migration.php"))
            $filename .= "_migration.php";

        /**
         * Information concernant la table
         * @var array $data_table 
         */
        $data_table = require self::MIGRATION_PATH . $filename;

        $request = require "./src/Database/init_table.php";

        try {
            self::pdo()->exec($request);
            echo "Table created successfully", PHP_EOL;
        } catch (\Throwable $th) {
            die("Erreur : " . $th->getMessage());
        }
    }

    public static function migrate(string $filename)
    {
        self::generate_sql($filename);
    }
}
