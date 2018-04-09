<?php
namespace console\controllers;

use common\rbac\isRoleRule;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
//use yii\rbac\Permission;
//use yii\rbac\Role;
//use yii\validators\RegularExpressionValidator;
use yii\web\NotFoundHttpException;

//use common\models\engine\ExceptionLogModel;
use common\rbac\UserGroupRule;


class RbacController extends Controller
{
    private $_error;
    /**
     *  @var \common\components\AuthManagerWrap $authManagerEx The auth manager application component extension.
     */
    private $authManagerEx;
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authManagerEx = Yii::$app->authManagerWrap;
    }

    private function _setStdout(){
        if(count($this->_error) > 0){
            $this->stdout(implode("\n", $this->_error));
        }
    }


    public function actionTest(){
        $r = 1;
    }
    /*
     * http://developer.uz/blog/rbac-%D1%80%D0%BE%D0%BB%D0%B8-%D0%B8-%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D0%B8-%D0%B2-yii2/
     * http://stuff.cebe.cc/yii2docs-ru/guide-security-authorization.html#nastrojka-authmanager-s-pomosu-dbmanager
     * http://rgblog.ru/page/yii2-i-rbac-kontrol-dostupa-na-osnove-rolej
     */

    /* ROLE */
    public function actionRoleCreate($name, $description = "role"){
        try{
            $this->authManagerEx->createRoleValid($name, $description);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();
            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public function actionRoleRemove($name){
        try{
            $this->authManagerEx->removeRoleValid($name);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();
            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /* PERMISSION */
    /**
     * (name, [description = "permission"])
     * @param string $name
     * @param string $description
     * @return int
     */
    public function actionPermissionCreate($name, $description = "permission"){
        try{
            $this->authManagerEx->createPermissionValid($name, $description);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();
            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
    /**
     * (name)
     * @param string $name
     * @return int
     */
    public function actionPermissionDelete($name){
        try{
            $this->authManagerEx->removePermissionValid($name);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();
            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /* CHILD */
    /**
     * (parentName, childName)
     * @param string $parentName
     * @param string $childName
     * @return int
     */
    public function actionChildAdd($parentName, $childName){
        try{
            $this->authManagerEx->addChildValid($parentName, $childName);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /**
     * (parentName, childName)
     * @param string $parentName
     * @param string $childName
     * @return int
     */
    public function actionChildRemove($parentName, $childName){
        try{
            $this->authManagerEx->removeChildValid($parentName, $childName);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /**
     * ($itemName) - role|permission
     * @param string $itemName - role|permission
     * @return int
     */
    public function actionChildrenRemove($itemName){
        try{
            $this->authManagerEx->removeChildrenValid($itemName);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

//    /* RULE */
//    public function actionRuleAdd($name, $ruleName = "userGroup"){
//        try{
//            $name = $this->_clear($name);
//            $ruleName = $this->_clear($ruleName);
//
//            if(($this->_validate($name, $this->_pattern4Role))
//                && ($this->_validate($ruleName, $this->_pattern4Role)))
//            {
//                $authManager = Yii::$app->authManager;
//
//                $rule = null;
//
//                switch ($ruleName){
//                    case "userGroup":
//                        $rule = new UserGroupRule();
//                        break;
//                    case "userRole":
//                        $rule = new isRoleRule();
//                        break;
//                    default:
//                        $this->_error[] = "Rule \"$ruleName\" is not found";
//                        throw new NotFoundHttpException("Enter correct the name of the rule");
//                        break;
//                }
//
//                if(!$authManager->getRule($rule->name)){
//                    $authManager->add($rule);
//                }
//
//                if($role = $authManager->getRole($name)){
//
//                    $role->ruleName = $rule->name;
//
//                    $authManager->update($name, $role);
//
//                    $this->_error[] = "The \"$name\" role is update rule name \"$ruleName\"";
//                } else {
//                    $this->_error[] = "The role of the \"$name\" is not found";
//                }
//            }
//
//            $this->_setStdout();
//
//            return ExitCode::OK;
//        } catch(\Exception $ex) {
//            $this->_error[] = $ex->getMessage();
//
//            $this->_setStdout();
//
//            return ExitCode::UNSPECIFIED_ERROR;
//        }
//    }
//
    /* ASSIGNE */
    public function actionAssigne($roleName, $idUser){
        try{
            $this->authManagerEx->assignValid($roleName, $idUser);

            $this->_error[] = $this->authManagerEx->getMessage();

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /* common function */
    public function actionDeleteAll(){
        try{
            $this->authManagerEx->removeAll();

            $this->_error[] = "All objects is deleted";

            $this->_setStdout();

            return ExitCode::OK;
        } catch(\Exception $ex) {
            $this->_error[] = $ex->getMessage();

            $this->_setStdout();

            return ExitCode::UNSPECIFIED_ERROR;
        }

    }
}