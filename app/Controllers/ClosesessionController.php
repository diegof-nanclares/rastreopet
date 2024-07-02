<?php

namespace Controllers;

/**
 * Class ClosesessionController
 * @package Controllers
 */
class ClosesessionController
{
    public function index()
    {
        session_destroy();
        header("Location: /home");
    }
}

?>