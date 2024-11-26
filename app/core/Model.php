<?php

/**
 * DEV NOTE: when a method fails (return false),
 * the $error_message must be set to a proper informative message
 **/
class Model
{
    protected $pdo;
    /**
     * Store error message for better error handling on the front-end code
     * If one of the methods fails, this property can be accessed to display the error message
     **/
    public $error_message;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->error_message = '';
    }
}