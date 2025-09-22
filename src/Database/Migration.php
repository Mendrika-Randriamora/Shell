<?php

namespace Menus\Shell\Database;

class Migration
{
    const MIGRATION_PATH = "./migrations/";
    const MIGRATION_SOURCE = "./source/migration.php";
    public string $migration_name;

    public static function generate_file($filename)
    {
        $data = @file_get_contents(self::MIGRATION_SOURCE) or
            die("Erreur de récuperation des données de la migration");

        $file = fopen(self::MIGRATION_PATH . $filename . "_migration.php", "x");
        fwrite($file, $data);
        fclose($file);

        echo "File generated", PHP_EOL;
    }

    public function generate_sql($filename)
    {
        if (!strpos($filename, "_migration.php"))
            $filename .= "_migration.php";

        $data = @require self::MIGRATION_PATH . $filename or
            die("data non obtenu");

        var_dump($data);
    }

    public function migrate() {}
}
