<?php

namespace Models\Pet;

use Models\Core\Database;

/**
 * Class PetModel
 * @package Models\Pet
 */
class PetModel extends \Models\Core\AbstractModel
{
    public const DOG = 'Perro';
    public const CAT = 'Gato';

    private $entityId;
    private $name;
    private $petType;
    private $reward;
    private $diet;
    private $clinicHistory;
    private $alergy;
    private $imgName;
    private $imgPath;
    private $medicine;
    private $petBreed;
    private $weight;
    private $locatorId;
    private $ownerId;
    private $age;

    const TABLE = 'pet';

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
            $name = $this->getAttribute('name');
            $petType = $this->getAttribute('petType');
            $reward = $this->getAttribute('reward');
            $diet = $this->getAttribute('diet');
            $clinicHistory = $this->getAttribute('clinicHistory');
            $locatorId = $this->getAttribute('locatorId');
            $alergy = $this->getAttribute('alergy');
            $imgName = $this->getAttribute('imgName');
            $imgPath = $this->getAttribute('imgPath');
            $medicine = $this->getAttribute('medicine');
            $petBreed = $this->getAttribute('petBreed');
            $weight = $this->getAttribute('weight');
            $age = $this->getAttribute('age');
            $ownerId = $this->getAttribute('ownerId');
            $entityId = $this->getAttribute('entityId');
            $imgData = !empty($imgName) ? 'img_name = :img_name, img_path = :img_path,' : '';

            if($entityId) {
                $stmt = $db->prepare("UPDATE " . self::TABLE.
                    " SET name = :name , pet_type = :pet_type, reward = :reward, diet = :diet, clinic_history = :clinic_history, locator_id = :locator_id, alergy = :alergy,
                    " . $imgData . " medicine = :medicine, pet_breed = :pet_breed, weight = :weight, age = :age, owner_id = :owner_id  WHERE entity_id = :entity_id");
            } else {
                $stmt = $db->prepare("INSERT INTO " . self::TABLE.
                    " (entity_id, name, pet_type, reward, diet, clinic_history, locator_id, alergy, img_name, img_path, medicine, pet_breed, weight, age,  owner_id) VALUES " .
                    "(:entity_id, :name, :pet_type, :reward, :diet, :clinic_history, :locator_id, :alergy, :img_name, :img_path, :medicine, :pet_breed, :weight, :age, :owner_id);");
            }

            $stmt->bindParam(':entity_id', $entityId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':pet_type', $petType);
            $stmt->bindParam(':reward', $reward);
            $stmt->bindParam(':diet', $diet);
            $stmt->bindParam(':clinic_history', $clinicHistory);
            $stmt->bindParam(':locator_id', $locatorId);
            $stmt->bindParam(':alergy', $alergy);

            if(!$entityId || $imgData) {
                $stmt->bindParam(':img_name', $imgName);
                $stmt->bindParam(':img_path', $imgPath);
            }

            $stmt->bindParam(':medicine', $medicine);
            $stmt->bindParam(':pet_breed', $petBreed);
            $stmt->bindParam(':weight', $weight);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':owner_id', $ownerId);

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
    public function getAllPets() {
        $db = Database::getInstance();
        $query = 'SELECT p.entity_id, p.name, p.pet_type, p.reward, p.diet, p.clinic_history, p.locator_id, p.alergy, p.img_name, p.img_path, p.medicine, p.pet_breed, p.weight, p.age,  p.owner_id, ql.qr_identifier FROM ' . self::TABLE . ' p left join qr_locator ql ON  ql.pet_id = p.entity_id';
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
    public function getPetById($id) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, name, pet_type, reward, diet, clinic_history, locator_id, alergy, img_name, img_path, medicine, pet_breed, weight, age,  owner_id FROM ' . self::TABLE . ' WHERE entity_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $id]);
        $result = $stm->fetch();
        return $result;
    }

    /**
     * @param $userId
     * @return array
     * @throws \Exception
     */
    public function getPetsByUserId($userId) {
        $db = Database::getInstance();
        $query = 'SELECT p.entity_id, p.name, p.pet_type, p.reward, p.diet, p.clinic_history, p.locator_id, p.alergy, p.img_name, p.img_path, p.medicine, p.pet_breed, p.weight, p.age, p.owner_id, ql.qr_identifier FROM '
            . self::TABLE .
            ' p LEFT JOIN qr_locator ql ON p.entity_id = ql.pet_id'
            .
            ' WHERE p.owner_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $userId]);
        $result = $stm->fetchAll();
        return  $result;
    }
}
