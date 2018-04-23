<?php
use yii\web\View;
use common\models\engine\SectionModel;

/* @var $this View
 * @var MenuModel $menu
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
    <div class="row">
        <div class="col-lg-6">
            <div class="text-center OpenSeansCB font-size-24">
                Доставка
            </div>
            <div class="font-size-20">
                Доставка во много городов своим транспортом  (уточнять).
                Так же работаем с транспортными компаниями (доставка до транспортной компании бесплатная) Деловыи линии,  КИТ, ПЭК, так же работаем и с другими компаниями.
            </div>
        </div>

        <div class="col-lg-6">
            <div class="text-center OpenSeansCB font-size-24">
                Оплата
            </div>
            <div class="font-size-20">
                Оплата в большинстве регионах при получение . Или на карту сбербанка.
            </div>
        </div>
    </div>
</div>