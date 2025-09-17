<?php

namespace Menus\Shell;

class Shell
{
    private function is_valid(int $argc, array $argv): bool
    {
        return $argc == 4 and $argv[0] == "shell";
    }

    public function execute(int $argc, array $argv)
    {
        if ($this->is_valid($argc, $argv)) {

            switch ($argv[1]) {
                case 'make':
                    $this->create($argv[3], $argv[2]);
                    break;
                case '':
                    break;
                default:
                    echo "Commande invalide", PHP_EOL;
                    break;
            }
        } else {
            echo "Commande invalide", PHP_EOL;
            exit();
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
        $path = "./src/Controller/" . $filename . ".php";
        $data = <<<PHP
<?php

namespace Menus\Shell\Controller;

class $classname
{
    public function index()
    {
        return function(/* vos paramètres */) 
        {
            # Votre code ici .....
        };    
    }
}
PHP;
        $this->gererate_file($path, $data);
    }

    private function view(string $filename)
    {
        if (str_contains($filename, '.')) {
            $viewname = $this->create_dir($filename, 'view');
        } else {
            $viewname = $filename;
        }

        $filename = str_replace(".", "/", $filename);
        $path = "./views/" . $filename . ".php";
        $data = <<<PHP
<div>
    # Bonne continuation 
    # Nom du view : $viewname
</div>
PHP;
        $this->gererate_file($path, $data);
    }

    private function gererate_file(string $path, string $data)
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
                $dir = "./src/Controller/";
                break;
            case 'view':
                $dir = "./views/";
                break;
            default:
                echo "Erreur `create_dir`";
                die();
        }
        for ($i = 0; $i < count($arr) - 1; $i++) {
            $dir .= "$arr[$i]/";
        }

        if (!mkdir($dir, 0777, true)) {
            echo "Erreur de creation du dossier", PHP_EOL;
            die();
        }
        return $arr[count($arr) - 1];
    }
}
