<?php

namespace Controllers;
use Models\Qr\QrModel;
use Models\Utils\Logger;
/**
 * Class CheckQrStatusController
 * @package Controllers
 */
class CheckqrstatusController
{
    private $logger;
    private $qrModel;

    /**
     * CheckQrStatusController constructor.
     */
    public function __construct()
    {
        $this->logger = new Logger();
        $this->qrModel = new QrModel();
    }

    public function index()
    {
        $this->renderHeader();
        $qrParam = $_GET['qrid'] ?? null;
        $this->verifyQrStatus($qrParam);
        $this->renderFooter();
    }

    public function renderHeader() {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter() {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    private function verifyQrStatus($qrId) {
       $locatorData =  $this->qrModel->getQrLocatorByEncodedId($qrId);

       if(!$locatorData['owner_id']) {
           header("Location:/usercreate/index/?qrId=" . $qrId);
           return;
       }

       if(!$locatorData['pet_id']) {
           header("Location:/pet/index/?qrId=" . $qrId);
           return;
       }

        header("Location:/pet/find/?qrId=" . $qrId);
    }
}
