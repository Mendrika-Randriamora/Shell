**Command**

Generate a controller

```sh
php shell make:controller PublicController
```

**Result**
A file `src/Controller/PublicController.php` is created. this is a controller example

**Othes commands**

```sh
php shell make:model User
php shell make:view UserView
```

You can create a folder and a file in one command

```sh
php shell make:controller Admin.UserController
```

This will create the folder `src/Controller/Admin` and the file `UserController.php` inside it.

You can show all command with

```sh
php shell doc:list
```
