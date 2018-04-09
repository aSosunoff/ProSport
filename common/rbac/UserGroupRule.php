<?php
namespace common\rbac;

use Yii;

use common\models\engine\User;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->GROUP;
            if ($item->name === 'admin') {
                return $group == User::ROLE_ADMIN;
            } elseif ($item->name === 'moderator') {
                return $group == User::ROLE_ADMIN || $group == User::ROLE_MODERATOR;
            } elseif ($item->name === 'user') {
                return $group == User::ROLE_ADMIN || $group == User::ROLE_MODERATOR || $group == User::ROLE_USER;
            }
        }
        return false;
    }
}