<?php

class SettingController extends Controller
{
    public function switchTheme()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        Session::setSession('theme', Session::getSession('theme') === 'light'
            ? 'dark'
            : 'light');
        $this->redirect('user', 'profile');
    }
}