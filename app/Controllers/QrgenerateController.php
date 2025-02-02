<?php

namespace Controllers;

use Models\Qr\QrModel;
use Models\Utils\Util;
use Models\Core\MenuRenderingManagement;


class QrgenerateController extends Admin\BaseController
{
    private $qrModel;
    private $menuRenderer;

    public function __construct()
    {
        $this->menuRenderer =  new MenuRenderingManagement();
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

        $this->qrModel = new QrModel();
        $this->renderHeader($styles, $jsHeader);
        $qrImageGenerated = $this->generateNewQrCode($this->qrModel);
        $this->generateQrMainPage($qrImageGenerated);
        $this->renderFooter([], $js);
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = [], $removeFooter = false) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function getAuthUrl() {
        return 'auth/user/post';
    }

    public function generateQrMainPage($qrImageGenerated) {
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        $menuRender =  $this->menuRenderer;
        include_once __DIR__ . '/../Views/Qr/Generate.php';
    }

    public function generateNewQrCode() {
        return  $this->qrModel->generateNewQrCode();
    }
}
