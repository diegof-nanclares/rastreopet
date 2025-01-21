<?php

namespace Controllers;

use Models\Qr\QrModel;
use Models\User\UserModel;

/**
 * Class QrController
 * @package Controllers
 */
class SaveuserController
{

    public function __construct(){

    }

    /**
     * @throws \Exception
     */
    public function create()
    {
        $preparedData = $this->getData();
        $userModel = new UserModel();
        $record = $this->createRecord($userModel, $preparedData);
        $qrLocator = $_POST['qrlocator'] ?? null;
        if($qrLocator && isset($record['recordId'])) {
            $qrModel = new QrModel();
            $locatorData = $qrModel->getQrLocatorByEncodedId($qrLocator);
            if($locatorData) {
                $qrModel->setAttribute('ownerId', $record['recordId']);
                $qrModel->setAttribute('petId', null);
                $qrModel->setAttribute('qrIdentifier', $qrLocator);
                $qrModel->setAttribute('enabled', QrModel::QR_DISABLED_STATUS);
                $response = $qrModel->updateQrLocatorData();
                if($response['success']) {
                    header("Location:/pet/index/?qrId=" . $qrLocator);
                    return;
                }
            }
        }

        $msj = $record['success'] ? 'Usuario creado correctamente' : 'No se pudo crear el registro: ' . $record['error'];
        header('Location:/dashboard/index/?msg=' . $msj);
    }

    /**
     * @throws \Exception
     */
    public function edit()
    {
        $preparedData = $this->getData();
        $userModel = new UserModel();
        $record = $this->updateRecord($userModel, $preparedData);
        $msj = $record['success'] ? 'Usuario actualizado correctamente' : 'No se pudo crear el registro: ' . $record['error'];
        header('Location:/dashboard/index/?msg=' . $msj);
    }

    /**
     * @return \stdClass
     */
    public function getData () {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $lastname = $_POST['lastname'] ?? null;
        $cellphone = $_POST['cellphone']?? null;
        $checkedWhatsaap = $_POST['is_phone_whatsapp'];
        $useWhatsapp = !empty($checkedWhatsaap) &&  $checkedWhatsaap === 'si' ? 1 : 0;
        $address = $_POST['address']?? null;
        $email = $_POST['email']?? null;
        $userRole = $_POST['user_role']?? 2;
        $password = $_POST['password']?? null;

        $data = new \stdClass();
        $data->entityId = $id;
        $data->name =$name;
        $data->lastName = $lastname;
        $data->phone = $cellphone;
        $data->isPhoneWhatsapp = $useWhatsapp;
        $data->address = $address;
        $data->userName = $email;
        $data->password = $password;
        $data->userRole = $userRole;
        return $data;
    }

    /**
     * @param UserModel $userModel
     * @param $objData
     * @return array
     * @throws \Exception
     */
    private function createRecord(\Models\User\UserModel $userModel, $objData) {
        $vars = get_object_vars($objData);
        foreach ($vars as $varName => $value) {
            $userModel->setAttribute($varName, $value);
        }

        return $userModel->save();
    }

    /**
     * @param UserModel $userModel
     * @param $objData
     * @return array
     * @throws \Exception
     */
    private function updateRecord(\Models\User\UserModel $userModel, $objData) {
        $vars = get_object_vars($objData);
        foreach ($vars as $varName => $value) {
            $userModel->setAttribute($varName, $value);
        }
        return $userModel->save();
    }
}
