<?php
use yii\helpers\Html;
use common\models\engine\ProductModel;

/* @var $this yii\web\View */
/* @var ProductModel $product */
?>

<? if(isset($product)){ ?>
    <a
        class="b-catalog-element"
        href=""
        title="<?= $product->avatar->TITLE ?>">
        <div class="b-catalog-element__box-img">
            <div class="b-catalog-element__box-img_table">
                <div class="b-catalog-element__box-img_cell">
                    <?= Html::img($product->avatar->img, [
                        'class' => 'b-catalog-element__img',
                        'alt' => $product->avatar->ALT
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="b-catalog-element__button">
            <div class="b-catalog-element__buttom-row">
                <?= $product->NAME ?>
            </div>
            <div class="b-catalog-element__buttom-row b-catalog-element__buttom-row-price">
                от <?= $product->PRICE ?> руб.
            </div>
        </div>

        <div class="b-catalog-element__button">
            <div class="b-catalog-element__buttom-row-text">
                <?= $product->PREVIEW_TEXT ?>
            </div>
        </div>
    </a>
<? } ?>