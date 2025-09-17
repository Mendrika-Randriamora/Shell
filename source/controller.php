<?php

return <<<PHP
<?php

namespace Menus\Shell\Controller;

require_once "./vendor/autoload.php";

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
