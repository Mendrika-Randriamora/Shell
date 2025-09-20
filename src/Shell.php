<?php

namespace Menus\Shell;

use Menus\Shell\Cli\AgrIn;

class Shell
{
    const CONTROLLER_PATH = "./src/Controller/";
    const VEIW_PATH = "./views/";
    const MODEL_PATH = "./src/Model/";

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
                $this->controller($filename);
                break;
            case 'view':
                $this->view($filename);
                break;
            case 'model':
                $this->model($filename);
                break;
            default:
                echo "Commande invalide", PHP_EOL;
                break;
        }
    }

    private function controller(string $filename)
    {
        if (str_contains($filename, ".")) {
            $classname = $this->create_dir($filename, 'controller');
        } else {
            $classname = $filename;
        }
        $filename = str_replace(".", "/", $filename);
        $path = self::CONTROLLER_PATH . $filename . ".php";
        $data = require "./source/controller.php";
        $this->generate_file($path, $data);
    }

    private function view(string $filename)
    {
        if (str_contains($filename, '.')) {
            $viewname = $this->create_dir($filename, 'view');
        } else {
            $viewname = $filename;
        }

        $filename = str_replace(".", "/", $filename);
        $path = self::VEIW_PATH . $filename . ".php";
        $data = require "./source/views.php";
        $this->generate_file($path, $data);
    }

    private function model(string $filename)
    {
        if (str_contains($filename, ".")) {
            $modelname = $this->create_dir($filename, 'model');
        } else {
            $modelname = $filename;
        }
        $filename = str_replace(".", "/", $filename);
        $path = self::MODEL_PATH . $filename . ".php";
        $data = require "./source/model.php";
        $this->generate_file($path, $data);
    }

    private function generate_file(string $path, string $data)
    {
        $fl = fopen($path, "x");
        fwrite($fl, $data);
        fclose($fl);
    }

    private function create_dir(string $path, string $type): string
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

    private function doc(string $type)
    {
        $data = @file_get_contents("./source/doc/" . $type . ".txt") or
            die("Impossible d'excecuter\n");
        echo $data, PHP_EOL;
        exit();
    }
}
