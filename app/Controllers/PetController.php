<?php

namespace Controllers;
use Models\Pet\PetModel;
use Models\Qr\QrModel;
use Models\User\UserModel;
use Models\Utils\Util;
use Models\Core\MenuRenderingManagement;


/**
 * Class PetController
 * @package Controllers
 */
class PetController extends Admin\BaseController
{
    protected AuthController $authController;
    private $menuRenderer;

    public function __construct() {
        $this->authController = new AuthController();
        $this->menuRenderer =  new MenuRenderingManagement();
    }
    public function index()
    {
        $qrId = $_GET['qrId'] ?? null;
        if(!$qrId) {
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
            Util::getJsUrl('view-pet-image-preload', 'pet')
        ];

        $this->renderHeader($styles);
        $userId = $_GET['userid'] ?? null;
        $this->renderCreateNewPetForUser($userId);
        $this->renderFooter([], $js);
    }

    public function petsadmin() {
        if(!$this->authController->isLoggedIn()) {
            $this->authController->closeSession();
        }

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

        $this->renderAdminHeader($styles, $jsHeader);
        $userModel = new PetModel();
        $pets = $userModel->getAllPets();
        $this->renderPetsForAdmin($pets);
        $this->renderAdminFooter([], $js);

    }

    public function renderHeader(array $styles = [], array $js = []) {
        require_once __DIR__ . '/../Views/root/templates/emptyIndexHeaderLayout.php';
    }

    public function renderFooter(array $styles = [], array $js = []) {
        require_once __DIR__ . '/../Views/root/templates/emptyIndexFooterLayout.php';

    }

    public function renderAdminHeader($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexHeaderLayout.php';

    }

    public function renderAdminFooter($styles = [], $js = []) {
        require_once __DIR__ . '/../Views/root/templates/indexFooterLayout.php';

    }

    public function detail() {
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


        $this->renderAdminHeader($styles, $jsHeader);
        $imagePlaceHolder = $this->getPlaceholder('pet-picture-placeholder.png');
        $petId = $_GET['id'] ?? null;
        $petModel = new PetModel();
        $pet = $petModel->getPetById($petId);
        $image = $pet['img_name'] ? Util::getImageUrl( $pet['img_name'], 'pet/profile' )  : $imagePlaceHolder;
        $mypetsIcon = Util::getImageUrl('dogandcat.png', 'pet/icons');
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        $menuRender =  $this->menuRenderer;
        require_once __DIR__ . '/../Views/Pet/ViewPet.php';
        $this->renderAdminFooter([], $js);
    }

    public function updatePet() {

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


        $this->renderAdminHeader($styles, $jsHeader);
        $imagePlaceHolder = $this->getPlaceholder('pet-picture-placeholder.png');
        $petId = $_GET['id'] ?? null;
        $petModel = new PetModel();
        $pet = $petModel->getPetById($petId);
        $image = $pet['img_name'] ? Util::getImageUrl( $pet['img_name'], 'pet/profile' )  : $imagePlaceHolder;
        $userId = $_GET['userid'] ?? null;
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        $menuRender =  $this->menuRenderer;
        require_once __DIR__ . '/../Views/Pet/ModifyPet.php';
        $this->renderAdminFooter([], $js);
    }

    public function renderCreateNewPetForUser() {
        $imagePlaceHolder = $this->getPlaceholder('pet-picture-placeholder.png');
        $userId = $_GET['userid'] ?? null;
        $qrId =  $_GET['qrId'] ?? null;
        if($qrId) {
            $qrModel= new QrModel();
            $qrData = $qrModel->getQrLocatorByEncodedId($qrId);
            $userId = $qrData['owner_id'];
        }
        $infoSectionIcon = Util::getImageUrl('info-white.png', 'pet/sections/light-icons');
        $rewardIcon = Util::getImageUrl('reward-white.png', 'pet/sections/light-icons');
        require_once __DIR__ . '/../Views/Pet/PetsForUser.phtml';
    }

    public function getPlaceholder($imageName) {
        return Util::getImageUrl($imageName, 'placeholders');
    }

    public function find() {
        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('view_public_pet_information', 'pet')
        ];

        $js = [
            Util::getJsUrl('jquery.min', 'lib/Jquery'),
            Util::getJsUrl('view-pet-scroll', 'pet'),
            Util::getJsUrl('view-pet-zoom', 'pet'),
            Util::getJsUrl('view-pet-controls-navigator', 'pet'),
            Util::getJsUrl('mapsapi', 'lib/googlemaps'),
            Util::getJsUrl('rendermap', 'map'),
        ];

        $this->renderHeader($styles);
        $imagePlaceHolder = $this->getPlaceholder('pet-picture-placeholder.png');
        $qrId = $_GET['qrId'] ?? null;
        $petModel = new PetModel();
        $qrModel = new QrModel();
        $qrData = $qrModel->getQrLocatorByEncodedId($qrId);
        $petId = $qrData['pet_id'];
        $pet = $petModel->getPetById($petId);
        $userModel = new UserModel();
        $user = $userModel->getUserById($qrData['owner_id']);
        $image = $pet['img_name'] ? Util::getImageUrl( $pet['img_name'], 'pet/profile' )  : $imagePlaceHolder;
        $petTypeIcon = $pet['pet_type'] === \Models\Pet\PetModel::CAT ? Util::getImageUrl( 'type_cat.png', 'pet/icons'):  Util::getImageUrl( 'type_dog.png', 'pet/icons') ;
        $petViewIcons = $this->getPetSectionIcons();
        require_once __DIR__ . '/../Views/Pet/ViewPublicPetInformation.phtml';
        $this->renderFooter([], $js);
    }

    public function preview() {
        $styles = [
            Util::getCssUrl('font_face'),
            Util::getCssUrl('view_public_pet_information', 'pet')
        ];

        $js = [
            Util::getJsUrl('jquery.min', 'lib/Jquery'),
            Util::getJsUrl('view-pet-scroll', 'pet'),
            Util::getJsUrl('view-pet-zoom', 'pet'),
            Util::getJsUrl('view-pet-controls-navigator', 'pet'),
            Util::getJsUrl('mapsapi', 'lib/googlemaps'),
            Util::getJsUrl('renderpreviewmap', 'map'),
        ];

        $this->renderHeader($styles);
        $imagePlaceHolder = $this->getPlaceholder('pet-picture-placeholder.png');
        $qrId = $_GET['qrId'] ?? null;
        $petModel = new PetModel();
        $qrModel = new QrModel();
        $qrData = $qrModel->getQrLocatorByEncodedId($qrId);
        $petId = $qrData['pet_id'];
        $pet = $petModel->getPetById($petId);
        $userModel = new UserModel();
        $user = $userModel->getUserById($qrData['owner_id']);
        $image = $pet['img_name'] ? Util::getImageUrl( $pet['img_name'], 'pet/profile' )  : $imagePlaceHolder;
        $petTypeIcon = $pet['pet_type'] === \Models\Pet\PetModel::CAT ? Util::getImageUrl( 'type_cat.png', 'pet/icons'):  Util::getImageUrl( 'type_dog.png', 'pet/icons') ;
        $petViewIcons = $this->getPetSectionIcons();
        require_once __DIR__ . '/../Views/Pet/Preview.phtml';
        $this->renderFooter([], $js);
    }

    private function getPetSectionIcons() {
        $icons = [
            'info-section' => 'info',
            'reward-section' => 'reward',
            'health-section' => 'health',
            'food-section' => 'food',
            'map-section' => 'map',
            'whatsapp-section' => 'whatsapp',
            'phone-section' => 'phone'
        ];

        $sectionIcons = [];
        foreach($icons as $key => $icon) {
            $sectionIcons['dark'][$key] = Util::getImageUrl( $icon . '-black.png' , 'pet/sections/dark-icons');
            $sectionIcons['white'][$key] = Util::getImageUrl( $icon . '-white.png' , 'pet/sections/light-icons');
        }

        return $sectionIcons;
    }

    private function verifyQrStatus($qrId) {
        $qrModel = new QrModel();
        $locatorData =  $qrModel->getQrLocatorByEncodedId($qrId);

        if($locatorData['pet_id']) {
            header("Location:/qr/activated/?qrId=" . $qrId);
        }
    }
    private function renderPetsForAdmin($pets) {
        $logo = Util::getImageUrl('rastreopet_white.png', 'logos');
        $petsIcon = Util::getImageUrl('dogandcat.png', 'pet/icons');
        $menuRender =  $this->menuRenderer;
        require_once __DIR__ . '/../Views/Pet/PetsForAdmin.phtml';
    }
}
