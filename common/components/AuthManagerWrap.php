<?php
namespace common\components;

use Yii;
use yii\base\BaseObject;

use yii\rbac\DbManager;
use yii\rbac\Permission;
use yii\rbac\Role;
use yii\validators\RegularExpressionValidator;

use common\infrastructure\RegexPattern;

class AuthManagerWrap extends DbManager
{
    const ROLE_ROLE = 1;
    const ROLE_PERMISSION = 2;
    const PERMISSION_PERMISSION = 3;

    protected $_message;
    protected $_pattern4Role = RegexPattern::ROLE;
    protected $_pattern4Permission = RegexPattern::PERMISSION;
    protected $_pattern4Description = RegexPattern::DESCRIPTION;


    private function _validate($field, $regex){
        $validator = new RegularExpressionValidator(['pattern' => $regex]);
        if ($validator->validate($field)) {
            return true;
        } else {
            $this->_setMessage("The value \"$field\" contains invalid characters");
            return false;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    private function _isUnique($name)
    {
        $role = $this->getRole($name);
        $permission = $this->getPermission($name);
        if ($permission instanceof Permission) {
            $this->_setMessage("The permission of the \"$name\" exists");
            return false;
        }
        if ($role instanceof Role) {
            $this->_setMessage("The role of the \"$name\" exists");
            return false;
        }
        return true;
    }

    /**
     * @param string $value
     * @return string
     */
    private function _clear($value)
    {
        if (!empty($value)) {
            $value = trim($value, "/ \t\n\r\0\x0B");
        }
        return $value;
    }

    /**
     * clear message
     * @param null $message
     */
    private function _setMessage($message = null){
        if($message != null){
            $this->_message[] = $message;
        }
    }

    /**
     * clear message
     */
    private function _clearMessage(){
        $this->_message = [];
    }

//    public function __construct(array $config = [])
//    {
//        parent::__construct($config);
//    }
//
//    public function init()
//    {
//        parent::init();
//    }

    /**
     * @param string $glue
     * @return null|string
     */
    public function getMessage($glue = ", "){
        if(count($this->_message) > 0){
            return implode($glue, $this->_message);
        }
        return null;
    }

    /**
     * @param string $name
     * @param string $description
     * @return boolean
     * @throws \Exception
     */
    public function createRoleValid($name, $description)
    {
        try{
            $name = $this->_clear($name);
            $description = $this->_clear($description);

            if($this->_validate($name, $this->_pattern4Role)
                && $this->_validate($description, $this->_pattern4Description)
                && $this->_isUnique($name))
            {
                $role = parent::createRole($name);
                $role->description = $description;
                $this->add($role);

                $this->_setMessage("\"$name\" role added");

                return true;
            }

            throw new \Exception("Error not processed");
        } catch(\Exception $ex) {
            $this->_setMessage($ex->getMessage());
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $name
     * @return boolean
     * @throws \Exception
     */
    public function removeRoleValid($name)
    {
        try{
            $name = $this->_clear($name);

            if(($this->_validate($name, $this->_pattern4Role))
                && ($role = parent::getRole($name)))
            {
                parent::remove($role);
                $this->_setMessage("\"$name\" role remove");
                return true;
            }

            throw new \Exception("The role of the \"$name\" is not found");
        } catch(\Exception $ex) {
            $this->_setMessage($ex->getMessage());
            throw new \Exception($this->getMessage());
        }
    }

    public function updateRoleValid($oldName, $newName, $description)
    {
        try{
            $oldName = $this->_clear($oldName);
            $newName = $this->_clear($newName);
            $description = $this->_clear($description);

            if($this->_validate($oldName, $this->_pattern4Role)
                && $this->_validate($newName, $this->_pattern4Role)
                && $this->_validate($description, $this->_pattern4Description)
                && ($role = parent::getRole($oldName)))
            {
                $role->name = $newName;
                $role->description = $description;
                parent::updateItem($oldName, $role);
                $this->_setMessage("{$oldName} is update. New name is {$newName}");
                return true;
            }

            throw new \Exception("The role of the {$oldName} is not found");
        } catch(\Exception $ex) {
            $this->_setMessage($ex->getMessage());
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $name
     * @param string $description
     * @return boolean
     * @throws \Exception
     */
    public function createPermissionValid($name, $description){
        try{
            $name = $this->_clear($name);
            $description = $this->_clear($description);

            if($this->_validate($name, $this->_pattern4Permission)
                && $this->_validate($description, $this->_pattern4Description)
                && $this->_isUnique($name))
            {
                $permission = parent::createPermission($name);
                $permission->description = $description;
                $this->add($permission);

                $this->_setMessage("\"$name\" permission added");

                return true;
            }

            throw new \Exception("Error not processed");
        } catch(\Exception $ex) {
            $this->_setMessage($ex->getMessage());
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $name
     * @return boolean
     * @throws \Exception
     */
    public function removePermissionValid($name){
        try{
            $name = $this->_clear($name);

            if(($this->_validate($name, $this->_pattern4Permission))
                && ($permission = parent::getPermission($name)))
            {
                parent::remove($permission);
                $this->_setMessage("\"$name\" permission remove");
                return true;
            }

            throw new \Exception("The permission of the \"$name\" is not found");
        } catch(\Exception $ex) {
            $this->_setMessage($ex->getMessage());
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $parentName
     * @param string $childName
     * @return boolean
     * @throws \Exception
    */
    public function addChildValid($parentName, $childName){
        try{
            $parentName = $this->_clear($parentName);
            $childName = $this->_clear($childName);

            /* ROLE_ROLE */
            if(
                ($this->_validate($parentName, $this->_pattern4Role) && ($parentRole = parent::getRole($parentName)))
                && ($this->_validate($childName, $this->_pattern4Role) && ($childRole = parent::getRole($childName)))
            ){
                $this->_clearMessage();
                parent::addChild($parentRole, $childRole);
                $this->_setMessage("The object of the \"$parentName\" has become a parent to the \"$childName\"");
                return true;
            }

            /* ROLE_PERMISSION */
            if(
                ($this->_validate($parentName, $this->_pattern4Role) && ($role = parent::getRole($parentName)))
                && ($this->_validate($childName, $this->_pattern4Permission) && ($permission = parent::getPermission($childName)))
            ){
                $this->_clearMessage();
                parent::addChild($role, $permission);
                $this->_setMessage("The object of the \"$parentName\" has become a parent to the \"$childName\"");
                return true;
            }

            /* PERMISSION_PERMISSION */
            if(
                ($this->_validate($parentName, $this->_pattern4Permission) && ($parentPermission = parent::getPermission($parentName)))
                && ($this->_validate($childName, $this->_pattern4Permission) && ($childPermission = parent::getPermission($childName)))
            ){
                $this->_clearMessage();
                parent::addChild($parentPermission, $childPermission);
                $this->_setMessage("The object of the \"$parentName\" has become a parent to the \"$childName\"");
                return true;
            }

            throw new \Exception("Type was not found");

        } catch(\Exception $ex) {
            $this->_message[] = $ex->getMessage();
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $parentName
     * @param string $childName
     * @return boolean
     * @throws \Exception
     */
    public function removeChildValid($parentName, $childName){
        try{
            $parentName = $this->_clear($parentName);
            $childName = $this->_clear($childName);

            /* ROLE_ROLE */
            if(
                ($this->_validate($parentName, $this->_pattern4Role) && ($parentRole = parent::getRole($parentName)))
                && ($this->_validate($childName, $this->_pattern4Role) && ($childRole = parent::getRole($childName)))
            ){
                $this->_clearMessage();
                parent::removeChild($parentRole, $childRole);
                $this->_setMessage("The \"$parentName\" is no longer the parent to the \"$childName\"");
                return true;
            }

            /* ROLE_PERMISSION */
            if(
                ($this->_validate($parentName, $this->_pattern4Role) && ($role = parent::getRole($parentName)))
                && ($this->_validate($childName, $this->_pattern4Permission) && ($permission = parent::getPermission($childName)))
            ){
                $this->_clearMessage();
                parent::removeChild($role, $permission);
                $this->_setMessage("The \"$parentName\" is no longer the parent to the \"$childName\"");
                return true;
            }

            /* PERMISSION_PERMISSION */
            if(
                ($this->_validate($parentName, $this->_pattern4Permission) && ($parentPermission = parent::getPermission($parentName)))
                && ($this->_validate($childName, $this->_pattern4Permission) && ($childPermission = parent::getPermission($childName)))
            ){
                $this->_clearMessage();
                parent::removeChild($parentPermission, $childPermission);
                $this->_setMessage("The \"$parentName\" is no longer the parent to the \"$childName\"");
                return true;
            }

            throw new \Exception("Type was not found");

        } catch(\Exception $ex) {
            $this->_message[] = $ex->getMessage();
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $itemName
     * @return bool
     * @throws \Exception
     */
    public function removeChildrenValid($itemName){
        try{
            $itemName = $this->_clear($itemName);

            /* ROLE */
            if($this->_validate($itemName, $this->_pattern4Role) && ($role = parent::getRole($itemName))){
                $this->_clearMessage();
                parent::removeChildren($role);
                $this->_setMessage("Child elements removed");
                return true;
            }

            /* PERMISSION */
            if($this->_validate($itemName, $this->_pattern4Permission) && ($permission = parent::getRole($itemName))){
                $this->_clearMessage();
                parent::removeChildren($permission);
                $this->_setMessage("Child elements removed");
                return true;
            }

            throw new \Exception("Type was not found");

        } catch(\Exception $ex) {
            $this->_message[] = $ex->getMessage();
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $roleName
     * @param integer $idUser
     * @return bool
     * @throws \Exception
     */
    public function assignValid($roleName, $idUser){
        try{
            $roleName = $this->_clear($roleName);

            if(($idUser = intval($idUser)) == 0){
                throw new \Exception("$idUser is no a integer type");
            }

            if($this->_validate($roleName, $this->_pattern4Role) && ($role = parent::getRole($roleName))){
                $this->_clearMessage();
                parent::assign($role, $idUser);
                $this->_setMessage("Role \"$roleName\" assign to user id - \"$idUser\"");
                return true;
            }

            throw new \Exception("Role $roleName was not found");

        } catch(\Exception $ex) {
            $this->_message[] = $ex->getMessage();
            throw new \Exception($this->getMessage());
        }
    }

    /**
     * @param string $roleName
     * @param integer $idUser
     * @return bool
     * @throws \Exception
     */
    public function revokeValid($roleName, $idUser){
        try{
            $roleName = $this->_clear($roleName);

            if(($idUser = intval($idUser)) == 0){
                throw new \Exception("$idUser is no a integer type");
            }

            if($this->_validate($roleName, $this->_pattern4Role) && ($role = parent::getRole($roleName))){
                $this->_clearMessage();
                parent::revoke($role, $idUser);
                $this->_setMessage("Role \"$roleName\" assign to user id - \"$idUser\"");
                return true;
            }

            throw new \Exception("Role $roleName was not found");

        } catch(\Exception $ex) {
            $this->_message[] = $ex->getMessage();
            throw new \Exception($this->getMessage());
        }
    }
}