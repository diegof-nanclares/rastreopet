<?php

namespace Controllers;
use Models\User\UserModel;
use Models\Utils\Logger;
use Models\Utils\Util;
use Models\Core\MenuRenderingManagement;

/**use
 * Class DashboardController
 * @package Controllers
 */
class DashboardController extends Admin\BaseController
{
    private $logger;

    private $menuRenderer;
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->logger = $errorLogger = new Logger();
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

        $this->renderHeader($styles, $jsHeader);
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        $this->renderDashboard($users);
        $this->renderFooter([], $js);
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';
    }


    public function renderDashboard($users) {
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        $usersIcon = Util::getImageUrl('users.png', 'user/icons');
        $menuRender =  $this->menuRenderer;
        require_once __DIR__ . '/../Views/User/Dashboard.phtml';
    }
}
