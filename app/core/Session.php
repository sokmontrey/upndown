<?php

class Session
{
    public static function setSession($key, $value): void {
        $_SESSION[$key] = $value;
    }

    public static function getSession($key) {
        if (!isset($_SESSION[$key])) return null;
        return $_SESSION[$key];
    }
}