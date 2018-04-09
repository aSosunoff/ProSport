<?php
namespace common\rbac;

use Yii;

use common\models\engine\User;
use yii\rbac\Rule;

class isRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        /**
         *  @var \common\components\AuthManagerWrap $authManagerEx The auth manager application component extension.
         */
        if (!Yii::$app->user->isGuest) {
            $roles = $authManagerEx->getRolesByUser($user);
            foreach ($roles as $role){
                $rolesAll = $authManagerEx->getChildRoles($role->name);
                if($rolesAll[$item->name]){
                    return true;
                }
            }
        }
        return false;
    }
}