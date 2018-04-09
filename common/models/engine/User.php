<?php
namespace common\models\engine;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use common\infrastructure\DateClass;

/**
 * User model
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $NAME
 * @property string $SURNAME
 * @property string $IMG
 * @property string $PASSWORD_HASH
 * @property string $PASSWORD_RESET_TOKEN
 * @property string $EMAIL
 * @property string $AUTH_KEY
 * @property integer $STATUS
 * @property boolean $I_AGREE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 * @property string $password write-only password
 *
 * @property OrderModel orders
 */
class User extends MainModel implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_ADMIN = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_USER = 3;

    public $image;

    public $date_create;
    public $date_update;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return self::_g(get_called_class());
    }

    public function afterFind()
    {
        $this->image = strlen(trim($this->IMG)) > 0 ? "/images/user/" . $this->IMG : self::PHOTO_GUEST;

        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['CREATED_AT', 'UPDATED_AT'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['UPDATED_AT'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['STATUS', 'default', 'value' => self::STATUS_ACTIVE],
            ['STATUS', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function getOrders(){
        return $this->hasMany(OrderModel::className(), ['ID_USER' => 'ID']);
    }

    /**
     * @inheritdoc
     * Этот метод находит экземпляр identity class, используя ID пользователя. Этот метод используется,
     * когда необходимо поддерживать состояние аутентификации через сессии.
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID' => $id, 'STATUS' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     * Этот метод находит экземпляр identity class, используя токен доступа. Метод используется,
     * когда требуется аутентифицировать пользователя только по секретному токену (например в RESTful приложениях,
     * не сохраняющих состояние между запросами).
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     * Этот метод находит экземпляр identity class, используя USERNAME пользователя. Этот метод используется,
     * когда необходимо поддерживать состояние аутентификации через сессии.
     */
    public static function findByUsername($username)
    {
        return static::findOne(['USERNAME' => $username, 'STATUS' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'PASSWORD_RESET_TOKEN' => $token,
            'STATUS' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     * Этот метод возвращает ID пользователя, представленного данным экземпляром identity.
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     * Этот метод возвращает ключ, используемый для основанной на cookie аутентификации.
     * Ключ сохраняется в аутентификационной cookie и позже сравнивается с версией, находящейся на сервере,
     * чтобы удостоверится, что аутентификационная cookie верная.
     */
    public function getAuthKey()
    {
        return $this->AUTH_KEY;
    }

    /**
     * @inheritdoc
     *  Этот метод реализует логику проверки ключа для основанной на cookie аутентификации.
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->PASSWORD_HASH);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->AUTH_KEY = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = null;
    }
}
