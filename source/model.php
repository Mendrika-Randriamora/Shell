<?php
return <<<PHP
<?php

namespace Menus\Shell\Controller;

require_once "./vendor/autoload.php";

use Core\Model;

class $modelname extends Model
{
    # Nom de la table
    protected static \$table = "";

    # Clé primaire de la table
    protected static \$primary_key = "id";

    # Les columes de la table 
    protected static \$cols_fillable = [];

    protected static function current_fillable(): array
    {
        return self::\$cols_fillable;
    }

    protected static function current_table(): string
    {
        return self::\$table;
    }

    protected static function current_primary_key(): string
    {
        return self::\$primary_key;
    }
}
PHP;
