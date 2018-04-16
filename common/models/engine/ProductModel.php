<?php

namespace common\models\engine;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

use common\infrastructure\DateClass;

/**
 * Product model
 *
 * @property integer $ID
 * @property string $NAME
 * @property integer $PRICE
 * @property string $DESCRIPTION
 * @property string $PREVIEW_TEXT
 * @property string $META_TAG_DESC
 * @property string $META_TAG_KEY
 * @property boolean $ACTIVE_FLAG
 * @property boolean $IS_NEW_PRODUCT
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 *
 * @property ImgProductModel $images
 * @property ImgProductModel $avatar
 */
class ProductModel extends MainModel
{
    const IS_NEW_PRODUCT = 1;
    const FILE_PATH = '../../frontend/web/images/product/';

    public $date_create;
    public $date_update;
    public $isActive;

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
        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);

        $this->isActive = $this->ACTIVE_FLAG == self::IS_ACTIVE ? true : false ;
    }

    public static function find(){
        return new ProductQuery(get_called_class());
    }

    // Получение связных данных картинок на товар
    public function getImages(){
        return $this->hasMany(ImgProductModel::className(), ['ID_PRODUCT' => 'ID']);
    }

    /**
     * Получить картинку представления продукта
     */
    public function getAvatar(){
        $images = $this->images;
        if(count($images) > 0){
            return $images[0];
        } else {
            return new ImgProductModel();
        }
    }
}

class ProductQuery extends ActiveQuery{
    /**
     * Только активные записи
     */
    public function isActive(){
        return $this->andWhere(['ACTIVE_FLAG' => ProductModel::IS_ACTIVE]);
    }

    /**
     * Только новые продукты
     */
    public function isNew(){
        return $this->andWhere(['IS_NEW_PRODUCT' => ProductModel::IS_NEW_PRODUCT]);
    }
}