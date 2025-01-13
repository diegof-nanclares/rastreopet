<?php

namespace Controllers;

use Models\Qr\QrModel;

/**
 * Class QrGenerateController
 * @package Controllers
 */
class QrdownloadController extends Admin\BaseController
{

    private $qrModel;

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $this->qrModel = new QrModel();
        $data = $_GET['img'] ?? null;
        $this->qrModel->downloadQr($data);
    }


    public function getAuthUrl() {
        return 'auth/user/post';
    }
}
