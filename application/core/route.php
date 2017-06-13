<?php

class route {

    static function start() {
        session_start();
        // контроллер и действие по умолчанию
        $NameController = 'main';
        $actionName = 'index';
        $actionId = null;

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            $NameController = $routes[1];
        }


        // получаем имя экшена
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        // получаем id
        if (!empty($routes[3])) {
            $actionId = $routes[3];
        }
        // добавляем префиксы
        $NameModel = $NameController . 'model';
        $NameController = $NameController . 'controller';
        $actionName = 'action' . $actionName;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($NameModel) . '.php';
        $model_path = "application/models/" . $model_file;
        if (file_exists($model_path)) {
            include "application/models/" . $model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($NameController) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            Route::errorpage404();
        }

        // создаем контроллер
        $controller = new $NameController;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action($actionId);
        } else {
            route::errorpage404();
        }
    }

    function errorpage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'error');
    }

}
