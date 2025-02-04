<?php

namespace App\Core;
class Controller{

    protected function render($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        $viewFile = "../app/views/" . $view . ".php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            throw new \Exception("View {$view} not found");
        }
    }

    protected function getPost($key = null)
    {
        if ($key) {
            return isset($_POST[$key]) ? $_POST[$key] : null;
        }
        return $_POST;
    }
    protected function getQuery($key = null)
    {
        if ($key) {
            return isset($_GET[$key]) ? $_GET[$key] : null;
        }
        return $_GET;
    }

    protected function redirect($url)
    {
        header("Location: " . $url);
        exit();
    }
}