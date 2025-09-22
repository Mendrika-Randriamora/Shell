<?php

namespace Menus\Shell\Mvc;

use Menus\Shell\Mvc;

class Controller extends Mvc
{

    public static function create(string $filename)
    {
        if (str_contains($filename, ".")) {
            $classname = self::create_dir($filename, 'controller');
        } else {
            $classname = $filename;
        }
        $filename = str_replace(".", "/", $filename);
        $path = self::CONTROLLER_PATH . $filename . ".php";
        $data = require "./source/controller.php";
        self::generate_file($path, $data);
    }
}
