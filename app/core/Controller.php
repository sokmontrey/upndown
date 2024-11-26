<?php

class Controller {
    public function isLoggedIn(): bool {
        return Session::getSession('login') !== null;
    }

    public function getBasePath(): string {
        // to deal with different environments path
        return rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    }

    public function render($view, $data = []) {
        extract($data);
        $BASE_PATH = $this->getBasePath();
        $THEME = Session::getSession('theme') ?? 'light';
        require_once "app/views/base_layout.php";
        require_once "app/views/{$view}.php";
        require_once "app/views/base_layout_end.php";
        show_source("app/views/{$view}.php");
    }

    function redirect($controller, $action = '', $states = []) {
        // use session to pass state around
        if (session_status() == PHP_SESSION_NONE) session_start();
        foreach ($states as $key => $value) Session::setSession($key, $value);

        $base_path = $this->getBasePath();
        $redirect_url = $base_path . '/' . $controller . '/' . $action;
        header("Location: $redirect_url");
        exit();
    }
}
