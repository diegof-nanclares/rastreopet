<?php

namespace Controllers;

use Models\Pet\PetModel;
use Models\User\UserModel;
use Models\Utils\Util;

/**
 * Class UserDetailController
 * @package Controllers
 */
class UserdetailController
{
    private $authController;
    public function __construct() {
        $this->authController = new AuthController();
    }

    public function index()
    {
        if(!$this->authController->isLoggedIn()) {
            $this->authController->closeSession();
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
        $this->authController = new UserModel();
        $userModel = new UserModel();
        $id = $_GET['id'];
        $record = $userModel->getUserById($id);
        $this->renderUserDetails($record);
        $this->renderFooter([], $js);
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function renderUserDetails($user) {
        $petsModel = new PetModel();
        $id = $_GET['id'] ?? null;
        $petsbyUser = $petsModel->getPetsByUserId($id);
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        require_once __DIR__ . '/../Views/User/View.php';
    }
}
