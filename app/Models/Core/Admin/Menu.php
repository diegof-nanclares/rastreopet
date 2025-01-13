<?php

namespace Models\Core\Admin;

use Models\Core\Database;

/**
 * Class Menu
 * @package Models\Core\Database
 */
class Menu extends \Models\Core\AbstractModel
{
    const TABLE = 'permissions';

    public $attr;
    public function getAttribute(string $attr){
        return $this->$attr;
    }

    public function setAttribute($attr, $value): void {
        $this->$attr = $value;
    }

    public function save()
    {

    }

    public function getAllMenu() {

    }

    public function getMenuById($id) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, name, pet_type, reward, diet, clinic_history, locator_id, alergy, img_name, img_path, medicine, pet_breed, weight, age,  owner_id FROM ' . self::TABLE . ' WHERE entity_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $id]);
        $result = $stm->fetch();
        return $result;
    }
}
