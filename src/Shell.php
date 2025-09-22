<?php

namespace Menus\Shell;

use Menus\Shell\Cli\AgrIn;
use Menus\Shell\Database\Migration;
use Menus\Shell\Mvc\Controller;
use Menus\Shell\Mvc\Model;
use Menus\Shell\Mvc\View;

class Shell
{
    /**
     * Methode d'entrée dans la classe Shell
     * @param AgrIn $input parametres de la ligne de commande
     * 
     * @return void
     */
    public function execute($input)
    {

        list($action, $type, $filename) = $input->prepare();

        switch ($action) {
            case 'make':
                if ($filename != null) {
                    $this->create($filename, $type);
                } else {
                    echo "Filename doesn't exist", PHP_EOL;
                    die();
                }
                break;
            case 'do':
                $this->do($filename, $type);
                break;
            case 'doc':
                $this->doc($type);
                break;
            default:
                echo "Commande invalide", PHP_EOL;
                break;
        }
    }

    /**
     * Methode de création de tous les types de fichier dispo dans le doc
     * @param string $filename nom du fichier
     * @param string $type type de fichier à créer
     * 
     * @return void
     */
    private function create($filename, $type)
    {
        switch ($type) {
            case 'controller':
                Controller::create($filename);
                break;
            case 'view':
                View::create($filename);
                break;
            case 'model':
                Model::create($filename);
                break;
            case 'migration':
                Migration::create($filename);
                break;
            default:
                echo "Commande invalide", PHP_EOL;
                break;
        }
    }

    /**
     * Afficher le doc du projet (ex: toutes les commandes)
     * @param string $type type de doc qu'on veut voir
     * 
     * @return void
     */
    private function doc($type)
    {
        $data = @file_get_contents("./source/doc/" . $type . ".txt") or
            die("Impossible d'excecuter\n");
        echo $data, PHP_EOL;
        exit();
    }

    /**
     * Excecuter un ficher ou une suite de logique de programme
     * @param string $filename nom du ficher à éxcecuter
     * @param string $type type d'éxcecution 
     * 
     * @return void
     */
    private function do($filename, $type)
    {
        switch ($type) {
            case 'migration':
                Migration::migrate($filename);
                break;

            default:
                # code...
                break;
        }
    }
}
