<?php
use yii\web\View;
use common\models\engine\SectionModel;
use common\models\engine\ProductModel;

/* @var $this View
 * @var MenuModel $menu
 * @var ProductModel $products
 */
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="b-line-title">
                <div class="b-line-title_text">
                    <?= $menu->TITLE ?>
                </div>
                <div class="b-line-title_description">
                    <?= $menu->TITLE_DESCRIPTION ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <? // Достаём все товары данного каталога

    $i = 0;

    if (count($products) > 0){ ?>

        <? while (count($products) > 0) { ?>
            <? $arSplice = array_splice($products, 0, 4);?>
            <div class="row">
                <div class="col-sm-6 col-xs-12 nopadding">
                    <div class="col-xs-6 max-400">
                        <?= $this->render('product-item', [
                            'product' => $arSplice[0]
                        ])?>
                    </div>

                    <? if(isset($arSplice[1])){ ?>
                        <div class="col-xs-6 max-400">
                            <?= $this->render('product-item', [
                                'product' => $arSplice[1]
                            ])?>
                        </div>
                    <? } ?>
                </div>
                <div class="col-sm-6 col-xs-12 nopadding">
                    <? if(isset($arSplice[2])){ ?>
                        <div class="col-xs-6 max-400">
                            <?= $this->render('product-item', [
                                'product' => $arSplice[2]
                            ])?>
                        </div>
                    <? } ?>

                    <? if(isset($arSplice[3])){ ?>
                        <div class="col-xs-6 max-400">
                            <?= $this->render('product-item', [
                                'product' => $arSplice[3]
                            ])?>
                        </div>
                    <? } ?>
                </div>
            </div>
        <? } ?>

    <? } ?>
</div>