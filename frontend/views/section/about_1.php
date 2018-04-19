<?php
use yii\web\View;
use common\models\engine\MenuModel;
use common\infrastructure\helpers\HtmlCustom;

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
            <div class="b-item-select b-item-select_hover RobotoCL">
                <div class="b-item-select__link-img" href="#" title="">
                    <?= HtmlCustom::img('/images/guest.png', [
                        'alt' => 'фотография гостя'
                    ])?>
                </div>

                <div class="b-item-select__head OpenSeansCB">
                    Евгений
                </div>
                <div class="b-item-select__body">
                    Компания Гантели-НН.ru занимается производством спортивного инвентаря С 2013 года.
                </div>
                <div class="b-item-select__footer">
                    Основатель компании
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="b-item-select b-item-select_hover RobotoCL">
                <div class="b-item-select__link-img" href="#" title="">
                    <?= HtmlCustom::img('/images/guest.png', [
                        'alt' => 'фотография гостя'
                    ])?>
                </div>

                <div class="b-item-select__head OpenSeansCB">
                    Юлия
                </div>
                <div class="b-item-select__body">
                    Индивидуальный подход к любому клиенту. Любая информция по приобретению, доставке, оплаты.
                </div>
                <div class="b-item-select__footer">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="b-item-select b-item-select_hover RobotoCL">
<!--                <div class="b-item-select__link-img" href="#" title="">-->
<!--                    --><?//= HtmlCustom::img('/images/guest.png', [
//                        'alt' => 'фотография гостя'
//                    ])?>
<!--                </div>-->

                <div class="b-item-select__head OpenSeansCB">
                </div>
                <div class="b-item-select__body">
                    За это время мы улучшили качество нашей продукции. т Производственная площадка компании расположенная в городе Навашино Нижегородской области.
                </div>
                <div class="b-item-select__footer">
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="b-item-select b-item-select_hover RobotoCL">
                <!--                <div class="b-item-select__link-img" href="#" title="">-->
                <!--                    --><?//= HtmlCustom::img('/images/guest.png', [
                //                        'alt' => 'фотография гостя'
                //                    ])?>
                <!--                </div>-->

                <div class="b-item-select__head OpenSeansCB">
                </div>
                <div class="b-item-select__body">
                    На сегодняшний день компания Гантели-НН.ru является одной из самых популярных заказываемых спортивных товаров по самым низким ценам городов России.
                </div>
                <div class="b-item-select__footer">
                </div>

            </div>
        </div>
    </div>

</div>