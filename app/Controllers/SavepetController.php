<?php

namespace Controllers;

use Models\Pet\PetModel;
use Models\Qr\QrModel;

/**
 * Class SavePetController
 * @package Controllers
 */
class SavepetController
{
    /**
     * @throws \Exception
     */
    public function create()
    {
        $preparedData = $this->getData();
        $petModel = new PetModel();
        $qrLocator = $_POST['qr_id'] ?? null;
        $record = $this->createRecord($petModel, $preparedData);

        if($qrLocator && isset($record['recordId'])) {
            $qrModel = new QrModel();
            $locatorData = $qrModel->getQrLocatorByEncodedId($qrLocator);
            if($locatorData) {
                $qrModel->setData(QrModel::OWNER_ID, $preparedData->ownerId);
                $qrModel->setData(QrModel::PET_ID, $record['recordId']);
                $qrModel->setData(QrModel::QRID, $qrLocator);
                $qrModel->setData(QrModel::ENABLED, QrModel::QR_ENABLED_STATUS);
                $response = $qrModel->updateQrLocatorData();
                if($response['success']) {
                    header("Location:/qr/activated/?qrId=" . $qrLocator);
                    return;
                }
            }
        }



        $msj = $record['success'] ? 'Mascota creada correctamente' : 'No se pudo crear el registro: ' . $record['error'];
        header('Location:/userdetail/index/?id=' . $preparedData->ownerId . ' &msg=' . $msj);
    }

    /**
     * @throws \Exception
     */
    public function edit()
    {
        $preparedData = $this->getData();
        $petModel = new PetModel();
        $record = $this->updateRecord($petModel, $preparedData);
        $msj = $record['success'] ? 'Mascota actualizada correctamente' : 'No se pudo modificar el registro: ' . $record['error'];
        header('Location:/userdetail/index/?id=' . $preparedData->ownerId . ' &msg=' . $msj);
    }

    public function getData (): \stdClass {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $petType = $_POST['pet_type'] ?? null;
        $reward = $_POST['reward']?? null;
        $diet = $_POST['diet']?? null;
        $clinicHistory = $_POST['clinic_history']?? null;
        $locatorId = $_POST['locator_id']?? null;
        $alergy = $_POST['alergy']?? null;
        $medicine = $_POST['medicine']?? null;
        $petBreed = $_POST['pet_breed']?? null;
        $petAge = $_POST['age']?? null;
        $weight = $_POST['weight']?? null;
        $imgData = $this->proccessUploadedImage();

        $imgName = $imgData['imageName'];
        $path = $imgData['path'];
        $ownerId = $_POST['owner_id'] ?? null;

        $data = new \stdClass();
        $data->entityId = $id;
        $data->name = $name;
        $data->petType = $petType;
        $data->reward = $reward;
        $data->diet = $diet;
        $data->clinicHistory = $clinicHistory;
        $data->alergy = $alergy;
        $data->imgName = $imgName;
        $data->ImgPath = $path;
        $data->medicine = $medicine;
        $data->locatorId = $locatorId;
        $data->petBreed = $petBreed;
        $data->age = $petAge;
        $data->weight = $weight;
        $data->ownerId = $ownerId;
        return $data;
    }

    /**
     * @param PetModel $userModel
     * @param $objData
     * @return array
     * @throws \Exception
     */
    private function createRecord(PetModel $petModel, $objData) {
        $vars = get_object_vars($objData);
        foreach ($vars as $varName => $value) {
            $petModel->setAttribute($varName, $value);
        }

        return $petModel->save();
    }

    /**
     * @param PetModel $petModel
     * @param $objData
     * @return array
     * @throws \Exception
     */
    private function updateRecord(PetModel $petModel, $objData): array {
        $vars = get_object_vars($objData);
        foreach ($vars as $varName => $value) {
            $petModel->setAttribute($varName, $value);
        }
        return $petModel->save();
    }

    private function proccessUploadedImage(): array {
        $imageName = !empty($_FILES['img']['name']) ? $_FILES['img']['name'] : null;
        if(!$imageName) {
            return ['imageName' => '', 'path' => ''];
        }

        $randomname = uniqid();
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newNameImg = $randomname . '.' . $extension;
        $petImageDir = __DIR__ . '/../../public/static/img/pet/profile/';
        $path = $petImageDir . $newNameImg;
        if(!move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
            return ['error' => 'Image upload failed: ', 'imageName' => '', 'path' => ''];
        }
        return ['imageName' => $newNameImg, 'path' => $path];
    }
}
