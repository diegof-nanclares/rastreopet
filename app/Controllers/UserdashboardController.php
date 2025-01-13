<?php

namespace Controllers;
use Models\Pet\PetModel;
use Models\Utils\Logger;
use Models\Utils\Util;

class UserdashboardController extends Admin\BaseController
{
    private $logger;

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->logger = $errorLogger = new Logger();
        parent::__construct();
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
        $petModel = new PetModel();
        $pets = $petModel->getPetsByUserId($_SESSION['userid']);
        $this->renderDashboard($pets);
        $this->renderFooter([], $js);
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }


    public function renderDashboard($pets) {
        $mypetsIcon = Util::getImageUrl('dogandcat.png', 'pet/icons');
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        require_once __DIR__ . '/../Views/User/UserDashboard.phtml';
    }
}
