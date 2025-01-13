<?php

namespace Controllers\Admin;

use \Controllers\AuthController;

class BaseController
{

    public const ADMIN = 1;

    public const STANDARD_USER = 2;

    protected $autController;

    public function __construct()
    {
        $this->autController = new AuthController();
        if(!$this->autController->isLoggedIn()) {
            $this->autController->closeSession();
        }
    }
}
