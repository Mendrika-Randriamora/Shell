<?php

namespace Menus\Shell\Mvc;

use Menus\Shell\Mvc;

class Model extends Mvc
{
    public static function create(string $filename)
    {
        if (str_contains($filename, ".")) {
            $modelname = self::create_dir($filename, 'model');
        } else {
            $modelname = $filename;
        }
        $filename = str_replace(".", "/", $filename);
        $path = self::MODEL_PATH . $filename . ".php";
        $data = require "./source/model.php";
        self::generate_file($path, $data);
    }
}
