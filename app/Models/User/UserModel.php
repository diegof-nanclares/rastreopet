<?php

namespace Models\User;

use Models\Core\Database;

/**
 * Class UserModel
 * @package Models\User
 */
class UserModel extends \Models\Core\AbstractModel
{

    private $entityId;
    private $name;
    private $lastName;
    private $phone;
    private $address;
    private $userRole;
    private $password;
    private $userName;
    private $isPhoneWhatsapp;

    const TABLE = 'user';

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
            $lastName = $this->getAttribute('lastname');
            $phone = $this->getAttribute('phone');
            $address = $this->getAttribute('address');
            $userRole = $this->getAttribute('userRole');
            $password = \Models\Utils\Util::generateSafePassword($this->getAttribute('password'));
            $email = $this->getAttribute('email');
            $isPhoneWhatsapp = $this->getAttribute('isPhoneWhatsapp');
            $entityId = $this->getAttribute('entityId');


            if($entityId) {
                $stmt = $db->prepare("UPDATE " . self::TABLE.
                    " SET name = :name , lastname = :lastname, phone = :phone, address = :address, user_role = :user_role, password = :password, username = :username, is_phone_whatsapp = :is_phone_whatsapp WHERE entity_id = :entity_id");
            } else {
                $stmt = $db->prepare("INSERT INTO " . self::TABLE.
                    " (entity_id, name, lastname, phone, address, user_role, password, username, is_phone_whatsapp) VALUES " .
                    "(:entity_id, :name, :lastname, :phone, :address, :user_role, :password, :username, :is_phone_whatsapp );");
            }

            $stmt->bindParam(':entity_id', $entityId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':lastname', $lastName);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':user_role', $userRole);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':username', $email);
            $stmt->bindParam(':is_phone_whatsapp', $isPhoneWhatsapp);

            $result = $stmt->execute();
            if($result) {
                $lastTransactionId= $db->lastInsertId();
                $db->commit();
                return ['success' => true, 'new' => ($entityId ? true: false) , 'recordId' => $lastTransactionId];
            }

        } catch (\PDOException $e) {
            $db->rollBack();
            echo "Error al insertar el registro de Usuario, error: " . $e->getMessage();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @param $username
     * @param $password
     * @return array
     * @throws \Exception
     */
    public function getUserAuth($username, $password)
    {
        $data = [
            'authenticated' => false,
            'user' => null,
        ];

        $db = Database::getInstance();
        $pstmt = $db->prepare('SELECT entity_id, name, lastname, phone, address, user_role, username, password FROM user where username = :username');
        $pstmt->bindParam(':username', $username);
        $pstmt->execute();
        $row = $pstmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            $passwordValid = password_verify($password, $row['password']);
            if ($passwordValid) {
                $data['authenticated'] = true;
                $data['user'] = $row;
                $this->sessionStart($data);
            }
        }

        return $data;
    }

    private function sessionStart($data) {
        $_SESSION['username'] = $data['user']['username'];
        $_SESSION['name'] = $data['user']['name'];
        $_SESSION['lastname'] = $data['user']['lastname'];
        $_SESSION['role'] = $data['user']['user_role'];
        $_SESSION['password'] = $data['user']['password'];
        $_SESSION['userid'] = $data['user']['entity_id'];
    }

    public function getAllUsers() {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, name, lastname, phone, address, user_role, username, is_phone_whatsapp FROM ' . self::TABLE;
        $stm = $db->prepare($query);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    public function getUserById($id) {
        $db = Database::getInstance();
        $query = 'SELECT entity_id, name, lastname, phone, address, user_role, username, is_phone_whatsapp FROM ' . self::TABLE. ' WHERE entity_id = :id';
        $stm = $db->prepare($query);
        $stm->execute([':id' => $id]);
        $result = $stm->fetch();
        return $result;
    }
}
