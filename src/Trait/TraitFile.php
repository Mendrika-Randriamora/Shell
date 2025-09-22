<?php

namespace Menus\Shell\Trait;

trait TraitFile
{
    /**
     * Méthode pour générer un fichier
     * @param string $path chemin du ficher
     * @param string $data donnée à insérer dans le ficher
     * 
     * @return void
     */
    protected static function generate_file($path, $data)
    {
        $fl = fopen($path, "x");
        fwrite($fl, $data);
        fclose($fl);

        echo "File generated", PHP_EOL;
    }
}
