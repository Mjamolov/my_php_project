<?php


class Router
{
    public function index()
    {
        $model = $_GET['model'] ?? 'product';

//         if (isset($_GET['model'])) {
        $model = htmlspecialchars($model);
        $model = ucfirst($model);
        $controller = $model . 'Controller';

        if (!file_exists(__DIR__ . "/../Controller/" . $controller . '.php')) {
            die('Controller not found');
        }
        include_once __DIR__ . "/../Controller/" . $controller . '.php';

        if (isset($_GET['action'])) {
            $action = htmlspecialchars($_GET['action']);
            $objController = new $controller();
            if (method_exists($objController, $action)) {
                return $objController->$action();
            }
            die('Undefined Action');
        }
    }
}




//             if (isset($_GET['model']) && $_GET['model'] === 'category') {
//             $controller = 'CategoryController';
//         }
//         if (isset($_GET['model']) && $_GET['model'] === 'shop') {
//             $controller = 'shopController';
//         }
//         if (isset($_GET['model']) && $_GET['model'] === 'news') {
//             $controller = 'newsController';
//
//         }
//         if (empty($controller)) {
//             die("Controller not found");
//         }
//         include_once __DIR__ . "/../Controller/" . $controller . '.php';

         // CRUD = create, read, update, delete



//         if (isset($_GET['action']) && $_GET['action'] == 'create') {
//             return (new $controller())->create();
//         }
//         if (isset($_GET['action']) && $_GET['action'] == 'update') {
//             return (new $controller())->update();
//         }
//
//         if (isset($_GET['action']) && $_GET['action'] == 'read') {
//             return (new $controller())->read();
//         }
//         if (isset($_GET['action']) && $_GET['action'] == 'delete') {
//             return (new $controller())->delete();
//         }
//         if (isset($_GET['action']) && $_GET['action'] == 'save') {
//             return (new $controller())->save();
//         }
//         die('Undefined Action');

