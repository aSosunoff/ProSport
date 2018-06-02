<?php

use common\infrastructure\helpers\HtmlCustom;
use yii\web\View;
use common\models\engine\SectionModel;
use common\models\engine\RecallModel;
use common\infrastructure\DateClass;

/* @var $this View
 * @var MenuModel $menu
 * @var RecallModel $recall
 */
?>

<script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        items: 1,
        dots: false,
        nav:true,
    })
</script>

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
        <div class="col-lg-8 col-lg-offset-2">
            <div class="owl-carousel owl-theme">
                <? foreach ($recall as $item){
                    /* @var RecallModel $item */ ?>
                    <div class="item">
                        <div class="b-item-select b-item-select_hover RobotoCL">
                            <div class="b-item-select__link-img" href="#" title="">
                                <?= HtmlCustom::img($item->img, [
                                    'alt' => 'фотография гостя'
                                ])?>
                            </div>

                            <div class="b-item-select__head OpenSeansCB">
                                <?= $item->NAME ?>
                            </div>
                            <div class="b-item-select__body">
                                <?= $item->TEXT ?>
                            </div>
                            <div class="b-item-select__footer">
                                <?= DateClass::TimestampToDate($item->CREATED_AT) ?>
                            </div>

                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>