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
                <div class="b-line-title_text b-line-title_text_inversion">
                    <?= $menu->TITLE ?>
                </div>
                <div class="b-line-title_description b-line-title_description_inversion">
                    <?= $menu->TITLE_DESCRIPTION ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="big-text">
                Наша стоимость 1кг = 95 руб.
            </div>
        </div>
    </div>
</div>