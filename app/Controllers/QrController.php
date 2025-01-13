<?php

namespace Controllers;

use Models\Qr\QrModel;
use Models\Utils\Util;
use Models\Pet;
use Models\Position\PostionTrackingModel;

/**
 * Class QrController
 * @package Controllers
 */
class QrController extends Admin\BaseController
{

    private $pet;

    private $qr;

    private $trackingData;


    public function __construct()
    {
        $this->pet = new Pet\PetModel();
        $this->qr = new QrModel();
        $this->trackingData = new PostionTrackingModel();
    }

    public function index()
    {
        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('menu', 'dashboard'),
            Util::getCssUrl('table', 'dashboard'),
            Util::getCssUrl('datatables.min', 'datatables'),
            Util::getCssUrl('feather', 'feather-icons')
        ];

        $js = [
            Util::getJsUrl('menu', 'dashboard'),
            Util::getJsUrl('feather-execute', 'lib/feather'),
        ];

        $jsHeader = [
            Util::getJsUrl('jquery.min', 'lib/Jquery'),
            Util::getJsUrl('datatables.min', 'lib/DataTables'),
            Util::getJsUrl('sweetalert.min', 'lib/sweetalert'),
            Util::getJsUrl('alert', 'messages'),
            Util::getJsUrl('feather.min', 'lib/feather')
        ];

        $this->renderHeader($styles, $jsHeader);
        $qrRecords = $this->qr->getAllWithAssociatedPet();
        $this->renderQrIndex($qrRecords);
        $this->renderFooter([], $js);
    }


    public function viewQrLocator() {
        if(!$this->autController->isLoggedIn()) {
            $this->autController->closeSession();
        }

        $this->renderHeader();
        $qrModel = new QrModel();
        $qrId = $_GET['id'] ?? null;
        $qrData = $qrModel->getQrLocatorByEncodedId($qrId);
        $this->renderQrLocator($qrData);
        $this->renderFooter();
    }


    public function activated() {

        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('view_public_pet_information', 'pet')
        ];

        $js = [
            Util::getJsUrl('sweetalert.min', 'lib/sweetalert'),
            Util::getJsUrl('activation', 'qr')
        ];

        $this->renderHeader($styles, $js);
        $this->renderActivatedScreen();
        $this->renderFooter([], $js, true);
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = [], $removeFooter = false) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function renderActivatedScreen() {
        require_once __DIR__ . '/../Views/Qr/Activated.phtml';
    }

    public function getAuthUrl() {
        return 'auth/user/post';
    }

    public function renderQrIndex($qrRecords) {
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        require_once __DIR__ . '/../Views/Qr/Index.phtml';
    }

    public function renderQrLocator($qrData) {
        if(!$this->autController->isLoggedIn()) {
            $this->autController->closeSession();
        }
        $petData = $this->pet->getPetById($qrData['pet_id']);
        $placeholder = Util::getImageUrl('pet-picture-placeholder.png', 'placeholders');
        $petImage = !empty($petData['img_name']) ? Util::getImageUrl( $petData['img_name'], 'pet/profile' )  : $placeholder;
        $qrTrackingData = [];
        if(!empty($petData['entity_id'])) {
            $qrTrackingData = $this->trackingData->getTrackingDataByPetId($petData['entity_id']);
        }
        require_once __DIR__ . '/../Views/Qr/view.php';
    }
}
