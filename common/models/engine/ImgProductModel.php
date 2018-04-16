<?php

namespace common\models\engine;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use common\infrastructure\DateClass;

/**
 * ImgProduct model
 *
 * @property integer $ID
 * @property integer $ID_PRODUCT
 * @property string $IMG
 * @property string $TITLE
 * @property string $ALT
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 *
 * @property ProductModel $product
 */
class ImgProductModel extends MainModel
{
    public $img;
    public $date_create;
    public $date_update;

    public function __construct(array $config = [])
    {
        $this->img = strlen(trim($this->IMG)) == 0 ? self::PHOTO_NOT_FOUND : "/images/product/" . $this->IMG;
        parent::__construct($config);
    }

    public static function tableName()
    {
        return self::_g(get_called_class());
    }

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

    public function afterFind()
    {
        $this->img = strlen(trim($this->IMG)) == 0 ? self::PHOTO_NOT_FOUND : "/images/product/" . $this->IMG;

        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);
    }

    public function getProduct(){
        return $this->hasOne(ProductModel::className(), ['ID' => 'ID_PRODUCT']);
    }
}