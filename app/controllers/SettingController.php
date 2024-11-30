<?php

class SettingController extends Controller
{
    public function switchTheme()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        Session::setSession('theme', Session::getSession('theme') === 'dark'
            ? 'light'
            : 'dark');
        $this->redirect('user', 'profile');
    }
}