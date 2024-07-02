<?php

namespace Controllers;

use Models\Qr\QrModel;
use Controllers\AuthController;

/**
 * Class QrGenerateController
 * @package Controllers
 */
class QrdownloadController
{

    private $authController;

    private $qrModel;

    public function __construct(){
        $this->authController = new AuthController();
    }

    public function index()
    {
        if(!$this->authController->isLoggedIn()) {
            $this->authController->closeSession();
        }
        $this->qrModel = new QrModel();
        $data = $_GET['img'] ?? null;
        $this->qrModel->downloadQr($data);
    }


    public function getAuthUrl() {
        return 'auth/user/post';
    }
}
