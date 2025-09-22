<?php

namespace Menus\Shell;

use Menus\Shell\Cli\AgrIn;
use Menus\Shell\Database\Migration;
use Menus\Shell\Mvc\Controller;
use Menus\Shell\Mvc\Model;
use Menus\Shell\Mvc\View;

class Shell
{

    public function execute(AgrIn $input)
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

    private function create(string $filename, string $type)
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

    private function doc(string $type)
    {
        $data = @file_get_contents("./source/doc/" . $type . ".txt") or
            die("Impossible d'excecuter\n");
        echo $data, PHP_EOL;
        exit();
    }

    public function do(string $filename, string $type)
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
