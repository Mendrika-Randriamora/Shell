<?php

namespace Menus\Shell;

abstract class Mvc
{
    const CONTROLLER_PATH = "./src/Controller/";
    const VEIW_PATH = "./views/";
    const MODEL_PATH = "./src/Model/";

    protected static function create_dir(string $path, string $type): string
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

    protected static function generate_file(string $path, string $data)
    {
        $fl = fopen($path, "x");
        fwrite($fl, $data);
        fclose($fl);
    }
}
