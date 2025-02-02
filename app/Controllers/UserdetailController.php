<?php

namespace Controllers;

use Models\Pet\PetModel;
use Models\User\UserModel;
use Models\Utils\Util;
use Models\Core\MenuRenderingManagement;


/**
 * Class UserDetailController
 * @package Controllers
 */
class UserdetailController extends Admin\BaseController
{
    private $menuRenderer;
    public function __construct() {
        $this->menuRenderer =  new MenuRenderingManagement();
        parent::__construct();
    }

    public function index()
    {
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
        $menuRender =  $this->menuRenderer;
        require_once __DIR__ . '/../Views/User/View.php';
    }
}
