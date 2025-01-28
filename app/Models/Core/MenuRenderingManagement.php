<?php

namespace Models\Core;
use Models\Core\Database;

class MenuRenderingManagement
{
    public const PERMISSIONS_TABLE = 'permission';
    public const PERMISSIONSXROLE_TABLE = 'permissionsxrole';
    public function getMenusByRole($userRole = null)
    {
        $roleId = $userRole ??  $this->getCurrentRoleId();
        $isSuperAdmin = $roleId === 1;
        $db = Database::getInstance();

        $joinCondition = '';
        if (!$isSuperAdmin) {
           $joinCondition  = 'LEFT JOIN ' . self::PERMISSIONSXROLE_TABLE. ' pxr ON p.entity_id = pxr.permission_id' .
            ' WHERE pxr.role_id = :roleid';
        }

        $query = 'SELECT p.entity_id, p.permission_name, p.permission_icon, p.permission_action FROM '
            . self::PERMISSIONS_TABLE . ' p ';
        $query.= $joinCondition;

        $stm = $db->prepare($query);
        if(!$isSuperAdmin) {
            $stm->execute([':roleid' => $roleId]);
        } else {
            $stm->execute();
        }

        $result = $stm->fetchAll();
        return $result;
    }

    private function getCurrentRoleId(): int {
        return (int) $_SESSION['role'];
    }
}
