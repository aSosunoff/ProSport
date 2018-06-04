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
            <div class="b-line-title b-line-title_color-white">
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
        <div class="col-lg-4">
            <div class="text-center OpenSeansCB font-size-24">
                Для заказа товара самовывозом.
            </div>
            <div class="font-size-24">
                <ul class="b-list">
                    <li>
                        &#9998; Вес заказа,
                    </li>
                    <li>
                        &#9998; Пару или одну гантель
                    </li>
                    <li>
                        &#9998; Номер телефона.
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="text-center OpenSeansCB font-size-24">
                Для заказа товара нашим курьером.
            </div>
            <div class="font-size-24">
                <ul class="b-list">
                    <li>
                        &#9998; Вес заказа,
                    </li>
                    <li>
                        &#9998; Пару или одну гантель,
                    </li>
                    <li>
                        &#9998; Номер телефона,
                    </li>
                    <li>
                        &#9998; Адрес ( доставка до подъезда ).
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="text-center OpenSeansCB font-size-24">
                Для заказа товара в другие регионы России.
            </div>
            <div class="font-size-24">
                <ul class="b-list">
                    <li>
                        &#9998; Ф.И.О,
                    </li>
                    <li>
                        &#9998; Город отправки,
                    </li>
                    <li>
                        &#9998; Вес заказа,
                    </li>
                    <li>
                        &#9998; Пару или одну гантель,
                    </li>
                    <li>
                        &#9998; Номер телефона,
                    </li>
                    <li>
                        &#9998; Паспортные данные (номер и серия) Это необходимо для того что бы не кто другой кроме вас не смог получить товар.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>