<?php
namespace Controllers;


use Models\Utils\Logger;
use Models\Utils\Util;
use Models\Qr\QrModel;
use Controllers\AuthController;

/**
 * Class QrController
 * @package Controllers
 */
class UsercreateController extends Admin\BaseController
{

    private $qrModel;

    private $authController;

    public function __construct()
    {
        $this->logger = new Logger();
        $this->qrModel = new QrModel();
        $this->authController = new AuthController();
    }

    public function index()
    {
        $qrId = $_GET['qrId'] ?? null;
        if(!$this->authController->isLoggedIn() && !$qrId ) {
            $this->authController->closeSession();
        }

        if($qrId) {
            $this->verifyQrStatus($qrId);
        }
        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('view_public_pet_information', 'pet')
        ];

        $js = [
            Util::getJsUrl('password-validation', 'user/locator'),
            Util::getJsUrl('sweetalert.min', 'lib/sweetalert'),
            Util::getJsUrl('terms-and-conditions-user', 'user/terms')
        ];

        $this->renderHeader($styles);
        $this->renderUserCreateView();
        $this->renderFooter([], $js);
    }

    public function renderHeader(array $styles = [], array $js = []) {
        require_once __DIR__ . '/../Views/root/templates/emptyIndexHeaderLayout.php';
    }

    public function renderFooter(array $styles = [], array $js = []) {
        require_once __DIR__ . '/../Views/root/templates/emptyIndexFooterLayout.php';
    }

    public function renderUserCreateView() {
        $qrId = $_GET['qrId'] ?? null;
        $terms = Util::getDocUrl('terminos_y_condiciones.pdf');
        $infoSectionIcon = Util::getImageUrl('info-white.png', 'pet/sections/light-icons');
        require_once __DIR__ . '/../Views/User/Create.php';
    }

    private function verifyQrStatus($qrId) {
        $locatorData =  $this->qrModel->getQrLocatorByEncodedId($qrId);

        if($locatorData['owner_id']) {
            header("Location:/pet/index/?qrId=" . $qrId);
        }
    }
}
