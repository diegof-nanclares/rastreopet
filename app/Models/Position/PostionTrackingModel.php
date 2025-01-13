<?php

namespace Models\Position;

use Models\Core\Database;

/**
 * Class PostionTrackingModel
 * @package Models\Position
 */
class PostionTrackingModel extends \Models\Core\AbstractModel
{
    private $entityId;
    private $latitude;
    private $longitude;
    private $petId;
    private $qrIdentifier;
    private $createdAt;


    const TABLE = 'position_track_history';

    public $attr;
    public function getAttribute(string $attr){
        return $this->$attr;
    }

    public function setAttribute($attr, $value): void {
        $this->$attr = $value;
    }
    /**
     * @return array
     * @throws \Exception
     */
    public function save()
    {
        try {
            $db = Database::getInstance();
            $db->beginTransaction();
            $entityId = $this->getAttribute('entityId');
            $name = $this->getAttribute('latitude');
            $petType = $this->getAttribute('longitude');
            $reward = $this->getAttribute('pet_id');
            $diet = $this->getAttribute('qr_identifier');
            $clinicHistory = $this->getAttribute('created_at');

            if($entityId) {
                $stmt = $db->prepare("UPDATE " . self::TABLE.
                    " SET lattitude = :lattitude , longitude = :longitude, pet_id = :pet_id, qr_identifier = :qr_identifier, created_at = :created_at WHERE entity_id = :entity_id");
            } else {
                $stmt = $db->prepare("INSERT INTO " . self::TABLE.
                    " (entity_id, lattitude , longitude, pet_id, qr_identifier, created_at) VALUES (:entity_id, :lattitude, :longitude, :pet_id, :qr_identifier, :created_at);");
            }

            $stmt->bindParam(':entity_id', $entityId);
            $stmt->bindParam(':lattitude', $name);
            $stmt->bindParam(':longitude', $petType);
            $stmt->bindParam(':pet_id', $reward);
            $stmt->bindParam(':qr_identifier', $diet);
            $stmt->bindParam(':created_at', $clinicHistory);

            $result = $stmt->execute();
            if($result) {
                $lastTransactionId= $db->lastInsertId();
                $db->commit();
                return ['success' => true, 'new' => ($entityId ? true: false) , 'recordId' => $lastTransactionId];
            }

        } catch (\PDOException $e) {
            $db->rollBack();
            echo "Error al insertar el registro de Mascota, error: " . $e->getMessage();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllPositionTrackings() {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, lattitude, longitude, pet_id, qr_identifier, created_at FROM ' . self::TABLE;
        $stm = $db->prepare($query);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function getTrackingDataById($id) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, lattitude, longitude, pet_id, qr_identifier, created_at FROM ' . self::TABLE. ' WHERE entity_id = :id';
        $stm = $db->prepare($query);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    /**
     * @param $petId
     * @return array
     * @throws \Exception
     */
    public function getTrackingDataByPetId($petId) {
        $db = Database::getInstance();
        $query = 'SELECT td.entity_id, td.lattitude, td.longitude, td.qr_identifier, td.created_at FROM ' . self::TABLE . ' td WHERE td.pet_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $petId]);
        $result = $stm->fetchAll();
        return $result;
    }
}
