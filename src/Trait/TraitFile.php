<?php

namespace Menus\Shell\Trait;

trait TraitFile
{
    /**
     * Dossier où créer les contrôleurs
     */
    const CONTROLLER_PATH = "./src/Controller/";

    /**
     * Dossier où créer les views
     */
    const VEIW_PATH = "./views/";

    /**
     * Dossier où créer les modèles
     */
    const MODEL_PATH = "./src/Model/";

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

    /**
     * Pour la creation des dossiers 
     * @param string $path chemin à créer
     * @param string $type type de fichier à créer
     * Le type permet de savoir la racine deu dossier à créer
     * 
     * @return string nom du fichier 
     */
    protected static function create_dir($path, $type)
    {
        $arr = [];
        $tok = strtok($path, ".");
        while ($tok !== false) {
            $arr[] = $tok;
            $tok = strtok(".");
        }
        switch ($type) {
            case 'controller':
                $dir = self::CONTROLLER_PATH;
                break;
            case 'view':
                $dir = self::VEIW_PATH;
                break;
            case 'model':
                $dir = self::MODEL_PATH;
                break;
            default:
                echo "Erreur `create_dir`";
                die();
        }
        for ($i = 0; $i < count($arr) - 1; $i++) {
            $dir .= "$arr[$i]/";
        }

        if (!is_dir($dir) and !mkdir($dir, 0777, true)) {
            echo "Erreur de creation du dossier", PHP_EOL;
            die();
        }
        return $arr[count($arr) - 1];
    }
}
