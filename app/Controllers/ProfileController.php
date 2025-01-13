<?php

namespace Controllers;

use Models\Utils\Util;
use Models\User;

class ProfileController extends Admin\BaseController
{

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User\UserModel();
    }

    public function index()
    {
        if(!$this->autController->isLoggedIn()) {
            $this->autController->closeSession();
        }

        $styles = [
            Util::getCssUrl('bootstrap.min', 'bootstrap'),
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
        $this->renderMyProfileView();
        $this->renderFooter([], $js);
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = [], $removeFooter = false) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function renderMyProfileView() {
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        $loggedUserId = $_SESSION['userid'];
        $loggedUserInfo = $this->user->getUserById($loggedUserId);
        require_once __DIR__ . '/../Views/User/Profile.phtml';
    }
}
