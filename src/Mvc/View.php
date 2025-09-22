<?php

namespace Menus\Shell\Mvc;

use Menus\Shell\Mvc;

class View extends Mvc
{
    /**
     * Créer un fichier avec le code minimum pour un view
     * @param string $filename nom du fichier.
     * 
     * Le ficher peut être créé à l'interieure d'une dossier
     * voir la doc pour voir comment faire
     * 
     * @return void
     * 
     */
    public static function create($filename)
    {
        if (str_contains($filename, '.')) {
            $viewname = self::create_dir($filename, 'view');
        } else {
            $viewname = $filename;
        }

        $filename = str_replace(".", "/", $filename);
        $path = self::VEIW_PATH . $filename . ".php";
        $data = require "./source/views.php";
        self::generate_file($path, $data);
    }
}
