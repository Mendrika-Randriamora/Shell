<?php

namespace Menus\Shell\Cli;

class AgrIn
{
    private int $argc;
    private array $argv;
    private array $data;

    public function __construct()
    {
        $this->argc = $_SERVER["argc"];
        $this->argv = $_SERVER["argv"];
    }

    /**
     * Vérifiction de la validité de la commande
     * 
     * @return bool
     */
    private function is_valid()
    {
        return $this->argv[0] == "shell" and str_contains($this->argv[1], ":");
    }

    /**
     * Préparation des données avec de les utilisés
     * 
     * @return array
     */
    public function prepare()
    {
        if (!$this->is_valid())
            die();

        $tok = strtok($this->argv[1], ":");
        while ($tok !== false) {
            $this->data[] = $tok;
            $tok = strtok(":");
        }
        if (isset($this->argv[2]))
            $this->data[] = $this->argv[2];
        else
            $this->data[] = null;

        return $this->data;
    }
}
