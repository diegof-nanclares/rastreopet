<?php

namespace Controllers;


use Models\Utils\Util;

/**
 * Class HomeController
 * @package Controllers
 */
class Page500Controller
{

    /**
     * @var \Controllers\AuthController
     */
    private $authController;

    public function index()
    {
        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('500', 'error'),
        ];

        $jsHeader = [
            Util::getJsUrl('jquery.min', 'lib/Jquery'),
            Util::getJsUrl('500', 'error')
        ];

        $this->renderHeader($styles, $jsHeader);
        $this->renderPage();
        $this->renderFooter();
    }

    public function renderHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';
    }

    public function renderFooter($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function renderPage() {
        require_once __DIR__ . '/../Views/Errors/Error500.php';
    }
}
