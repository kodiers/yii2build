<?php
/**
 * Created by PhpStorm.
 * User: kodiers
 * Date: 31/01/16
 * Time: 04:14
 */
namespace common\models;

class ValueHelpers
{
    /**
     * return value of a role name handed in as string
     * example: 'Admin'
     *
     * @param mixed $role_name
     */
    public static function getRoleValue($role_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT role_value FROM role WHERE role_name=:role_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":role_name", $role_name);
        $result = $command->queryOne();
        return $result['role_value'];
    }

    /**
     * return value of a status name handed in as string
     * example: 'Active'
     *
     * @param mixed $status_name
     */
    public static function getStatusValue($status_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT status_value FROM status WHERE status_name=:status_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":status_name", $status_name);
        $result = $command->queryOne();
        return $result['status_value'];
    }

    /**
     * return value of user_type_name so that you can used in PermissionHelpers model
     *
     * @param mixed $user_type_name
     */
    public static function getUserTypeValue($user_type_name)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT user_type_value FROM user_type WHERE user_type_name=:user_type_name";
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_type_name", $user_type_name);
        $result = $command->queryOne();
        return $result['user_type_value'];
    }
}