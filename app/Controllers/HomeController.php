<?php

namespace Controllers;


use Models\Utils\Util;

/**
 * Class HomeController
 * @package Controllers
 */
class HomeController
{

    /**
     * @var \Controllers\AuthController
     */
    private $authController;

    public function index()
    {
        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('bootstrap.min', 'bootstrap'),
            Util::getCssUrl('login', 'login'),
        ];

        $jsHeader = [
            Util::getJsUrl('sweetalert.min', 'lib/sweetalert'),
            Util::getJsUrl('alert', 'messages'),
            Util::getJsUrl('ajaxinput', 'messages')
        ];

        $this->renderHeader($styles, $jsHeader);
        $this->authController = new AuthController();
        $this->authController->authUser();
        $this->renderFooter();
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderFooter($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }
}
