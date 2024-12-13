<?php

namespace Models\Qr;

use Models\Core\Database;
use Models\Utils\Util;


require_once __DIR__ . '/../../lib/phpqrcode/qrlib.php';

/**
 * Class UserModel
 * @package Models\User
 */
class QrModel
{
    private $entityId;
    private $qrIdentifier;
    private $imagePath;
    private $enabled;
    private $petId;
    private $ownerId;
    private $imageName;
    private $imageExt;

    const TABLE = 'qr_locator';

    //Properties
    const ENTITY = 'entityId';
    const QRID = 'qrIdentifier';
    const PATH = 'imagePath';
    const ENABLED = 'enabled';
    const PET_ID = 'pet_id';
    const OWNER_ID = 'owner_id';
    const IMAGE_NAME = 'img_name';
    const IMAGE_EXT = 'img_ext';
    const POINTER_URL = 'pointer_url';

    const QR_ENABLED_STATUS = 1;
    const QR_DISABLED_STATUS = 0;

    /**
     * @param $propertyName
     * @return mixed
     */
    public function getData($propertyName) {
        return $this->$propertyName;
    }

    /**
     * @param $propertyName
     * @param $value
     */
    public function setData($propertyName, $value) {
         $this->$propertyName = $value;
    }

    /**
     * @throws \Exception
     */
    public function save()
    {
        $db = Database::getInstance();
        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO " . self::TABLE. " (qr_identifier, image_path, enabled, pet_id, owner_id, img_name, img_ext, pointer_url) VALUES (:qr_id, :image, :enabled, :pet_id, :owner_id, :img_name, :img_ext, :pointer_url)");
            $qrId = $this->getData(self::QRID);
            $path = $this->getData(self::PATH);
            $enabled = $this->getData(self::ENABLED);
            $petId = $this->getData(self::PET_ID);
            $ownerId = $this->getData(self::OWNER_ID);
            $imageName = $this->getData(self::IMAGE_NAME);
            $imageExt = $this->getData(self::IMAGE_EXT);
            $url = $this->getData(self::POINTER_URL);

            // Bind parameters
            $stmt->bindParam(':qr_id', $qrId);
            $stmt->bindParam(':image', $path);
            $stmt->bindParam(':enabled', $enabled);
            $stmt->bindParam(':pet_id', $petId);
            $stmt->bindParam(':owner_id', $ownerId);
            $stmt->bindParam(':img_name', $imageName);
            $stmt->bindParam(':img_ext', $imageExt);
            $stmt->bindParam(':img_ext', $imageExt);
            $stmt->bindParam(':pointer_url', $url);
            $result = $stmt->execute();
            if($result) {
                $lastTransactionId= $db->lastInsertId();
                $db->commit();
            }
        } catch (\PDOException $e) {
            $db->rollBack();
            echo "Error al insertar el registro: " . $e->getMessage();
        }
    }

    public function updateQrLocatorData() {
        $db = Database::getInstance();
        try {
            $db->beginTransaction();
            $stmt = $db->prepare("UPDATE " . self::TABLE. " SET enabled = :enabled, pet_id = :pet_id, owner_id = :owner_id WHERE qr_identifier = :qr_id");
            $qrId = $this->getData(self::QRID);
            $enabled = $this->getData(self::ENABLED);
            $petId = $this->getData(self::PET_ID);
            $ownerId = $this->getData(self::OWNER_ID);

            // Bind parameters
            $stmt->bindParam(':qr_id', $qrId);
            $stmt->bindParam(':enabled', $enabled);
            $stmt->bindParam(':pet_id', $petId);
            $stmt->bindParam(':owner_id', $ownerId);
            $result = $stmt->execute();
            if($result) {
                $lastTransactionId= $db->lastInsertId();
                $db->commit();
                return ['success' => true, 'new' => false , 'recordId' => $lastTransactionId];
            }
        } catch (\PDOException $e) {
            $db->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAll() {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, qr_identifier, image_path, enabled FROM ' . self::TABLE;
        $stm = $db->prepare($query);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllWithAssociatedPet() {
        $db = Database::getInstance();
        $query = 'SELECT ql.entity_id, ql.qr_identifier, ql.image_path, ql.enabled, p.name, p.entity_id pet_id FROM ' . self::TABLE  . ' ql LEFT JOIN pet p on ql.pet_id = p.entity_id';
        $stm = $db->prepare($query);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function getQrLocatorById($id) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, qr_identifier, enabled, image_path FROM ' . self::TABLE . ' WHERE entity_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $id]);
        $result = $stm->fetch();
        return $result;
    }

    /**
     * @param $encodedId
     * @return mixed
     * @throws \Exception
     */
    public function getQrLocatorByEncodedId($encodedId) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, qr_identifier, enabled, image_path, img_name, img_ext, pet_id, owner_id FROM ' . self::TABLE . ' WHERE qr_identifier = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $encodedId]);
        $result = $stm->fetch();
        return $result;
    }

    public function getQrLocatorByPetId($petId) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, qr_identifier, enabled, image_path, img_name, img_ext, pet_id, owner_id FROM ' . self::TABLE . ' WHERE pet_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $petId]);
        $result = $stm->fetch();
        return $result;
    }


    /**
     * @return string
     * @throws \Exception
     */
    public function generateNewQrCode(): string
    {
        $ext = 'png';
        $newFileName = uniqid("qr");
        $newFileNameWithExtension = $newFileName . '.png';
        $fileNameEncoded = base64_encode($newFileName);
        $locatorText = $this->generateLink($fileNameEncoded);
        $logoUrl = __DIR__ . '/../../img/1.png';
        $qrDir = __DIR__ . '/../../../public/static/img/locators/';
        $filePath = $qrDir . $newFileNameWithExtension;
        $this->createQrCodeImg($locatorText, $filePath);

        //open Generated QR file
        $qr = imagecreatefrompng($filePath);
        imagealphablending($qr, true);
        imagesavealpha($qr, true);;

        // Load the logo in center of QR
        $this->markQrWithLogo($logoUrl, $qr, $filePath);
        $this->setData(self::QRID, $fileNameEncoded);
        $this->setData(self::PATH, $filePath);
        $this->setData(self::ENABLED, self::QR_DISABLED_STATUS);
        $this->setData(self::PET_ID, null);
        $this->setData(self::OWNER_ID, null);
        $this->setData(self::IMAGE_NAME, $newFileName);
        $this->setData(self::IMAGE_EXT, $ext);
        $this->setData(self::POINTER_URL, $locatorText);
        $this->save();
        return $newFileNameWithExtension;
    }

    private function generateLink($qrId): string
    {
        return Util::getBaseUrl() . '/checkqrstatus/?qrid=' . $qrId;
    }

    private function createQrCodeImg(string $text, string $filePath)
    {
        \QRcode::png($text, $filePath, QR_ECLEVEL_H, 10, 1);
    }

    /**
     * @param $logoUrl
     * @param $qr
     * @param $filePath
     */
    private function markQrWithLogo($logoUrl, $qr, $filePath)
    {
        $logo = imagecreatefrompng($logoUrl);
        imagealphablending($logo, true);
        imagesavealpha($logo, true);

        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);
        $qrWidth = imagesx($qr);
        $qrHeight = imagesy($qr);
        $dst_x = (int)(($qrWidth - $logoWidth) / 2);
        $dst_y = (int)(($qrHeight - $logoHeight) / 2);
        imagecopy($qr, $logo, $dst_x, $dst_y, 0, 0, $logoWidth,
            $logoHeight);

        // Save Qr with custom name
        imagepng($qr, $filePath);
        imagedestroy($qr);
    }

    /**
     * @param $locatorId
     * @throws \Exception
     */
    public function downloadQr($imgName)
    {
        $imgUrl = __DIR__ . '/../../../public/static/img/locators/'. $imgName;

        if (file_exists($imgUrl)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="RastreoPet_' . $imgName . '"');
            header('Content-Length: ' . filesize($imgUrl));
            readfile($imgUrl);
        } else {
            echo 'La imagen no existe.';
        }
    }
}
