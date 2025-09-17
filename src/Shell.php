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

        $path = "./src/Controller/" . $filename . ".php";
        $data = <<<PHP
<?php

namespace Menus\Shell\Controller;

class $filename
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
        $path = "./views/" . $filename . ".php";
        $data = <<<PHP
<div>
    # Bonne continuation
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
}
