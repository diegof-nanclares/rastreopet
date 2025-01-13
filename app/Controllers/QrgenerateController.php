<?php

namespace Controllers;

use Models\Qr\QrModel;

class QrgenerateController extends Admin\BaseController
{
    private $qrModel;

    public function __construct()
    {
       parent::__construct();
    }

    public function index()
    {
        $this->qrModel = new QrModel();
        $this->renderHeader();
        $qrImageGenerated = $this->generateNewQrCode($this->qrModel);
        $this->generateQrMainPage($qrImageGenerated);
        $this->renderFooter();
    }

    public function renderHeader() {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter() {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function getAuthUrl() {
        return 'auth/user/post';
    }

    public function generateQrMainPage($qrImageGenerated) {
        include_once __DIR__ . '/../Views/Qr/Generate.php';
    }

    public function generateNewQrCode() {
        return  $this->qrModel->generateNewQrCode();
    }
}
