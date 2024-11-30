<?php

class Controller {
    public function isLoggedIn(): bool {
        return Session::getSession('login') !== null;
    }

    public function render($view, $data = []) {
        extract($data);
        require_once "app/views/base_layout.php";
        require_once "app/views/{$view}.php";
        echo "<div style='padding-top: 10rem;'>Code:</div>";
        show_source("app/views/{$view}.php");
        require_once "app/views/base_layout_end.php";
    }

    function redirect($controller, $action = '', $states = []) {
        // use session to pass state around
        if (session_status() == PHP_SESSION_NONE) session_start();
        foreach ($states as $key => $value) Session::setSession($key, $value);

        $redirect_url = BASE_PATH . '/' . $controller . '/' . $action;
        header("Location: $redirect_url");
        exit();
    }
}
