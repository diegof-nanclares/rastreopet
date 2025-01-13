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

    }
}
