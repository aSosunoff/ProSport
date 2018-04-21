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
        <div class="col-lg-12 text-center">
            <div class="big-text">
                Наша стоимость 1кг = 95 руб.
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="b-info-price">
                <div class="b-info-price_title">
                    Цена разборных гантелей за пару:
                    (набор блинов на ваш выбор)
                </div>
                <div class="b-info-price_body">
                    <ul class="b-list">
                        <li>2 по 6 кг - 1 140 р.</li>
                        <li>2 по 8 кг - 1 520 р.</li>
                        <li>2 по 10 кг - 1 900 р.</li>
                        <li>2 по 12 кг - 2 280 р.</li>
                        <li>2 по 14 кг - 2 660 р.</li>
                        <li>2 по 16 кг - 3 040 р.</li>
                        <li>2 по 18 кг - 3 420 р.</li>
                        <li>2 по 20 кг - 3 800 р.</li>
                        <li>2 по 22 кг - 4 180 р.</li>
                        <li>2 по 24 кг - 4 560 р.</li>
                        <li>2 по 26 кг - 4 940 р.</li>
                        <li>2 по 28 кг - 5 320 р.</li>
                        <li>2 по 30 кг - 5 700 р.</li>
                        <li>и тд.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="b-info-price">
                <div class="b-info-price_title">
                    Цена разборных штанг:
                </div>
                <div class="b-info-price_body">
                    <ul class="b-list">
                        <li>
                            <div>30 кг - 3 880 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 4 по 5 кг; 2 по 2 кг. Длина грифа - 1.2 м. )</div>
                        </li>
                        <li>
                            <div>40 кг - 4 830 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 2 по 10 кг; 2 по 5 кг; 2 по 2 кг. Длина грифа - 1.2 м. )</div>
                        </li>
                        <li>
                            <div>50 кг - 6 080 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 2 по 10 кг; 4 по 5 кг; 2 по 2 кг. Длина грифа - 1.5 м. )</div>
                        </li>
                        <li>
                            <div>60 кг - 7 030 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 4 по 10 кг; 2 по 5 кг; 2 по 2 кг. Длина грифа - 1.5 м. )</div>
                        </li>
                        <li>
                            <div>70 кг - 7 980 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 4 по 10 кг; 4 по 5 кг; 2 по 2 кг. Длина грифа - 1.5 м. )</div>
                        </li>
                        <li>
                            <div>80 кг - 9 230 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 2 по 15 кг; 2 по 10 кг; 4 по 5 кг; 2 по 2 кг. Длина грифа - 1.8 м. )</div>
                        </li>
                        <li>
                            <div>90 кг - 10 180 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 2 по 15 кг; 4 по 10 кг; 2 по 5 кг; 2 по 2 кг. Длина грифа - 1.8 м. )</div>
                        </li>
                        <li>
                            <div>100 кг - 11 130 р.</div>
                            <div class="b-list_item-signature">( набор блинов: 4 по 15 кг; 2 по 10 кг; 2 по 5 кг; 2 по 2 кг. Длина грифа - 1.8 м. )</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="b-info-price">
                <div class="b-info-price_title">
                    Цена блинов для штанг и гантелей за штуку:
                </div>
                <div class="b-info-price_body">
                    <ul class="b-list">
                        <li>1 кг - 95 р.</li>
                        <li>2 кг - 190 р.</li>
                        <li>3 кг - 285 р.</li>
                        <li>5 кг - 450 р.</li>
                        <li>10 кг - 950 р.</li>
                        <li>15 кг - 1 425 р.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="b-info-price">
                <div class="b-info-price_title">
                    Цена гантельного грифа (сталь):
                </div>
                <div class="b-info-price_body">
                    <ul class="b-list">
                        <li>260 мм - 400 р.</li>
                        <li>300 мм - 400 р.</li>
                        <li>360 мм - 400 р.</li>
                        <li>400 мм - 500 р.</li>
                        <li>500 мм - 570 р.</li>
                        <li>600 мм - 665 р.</li>
                        <li>700 мм - 760 р.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="b-info-price">
                <div class="b-info-price_title">
                    Цена прямого грифов для штанг:
                </div>
                <div class="b-info-price_body">
                    <ul class="b-list">
                        <li>1200 мм - 1 600 р.</li>
                        <li>1500 мм - 1 900 р.</li>
                        <li>1800 мм - 2 200 р.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="b-info-price">
                <div class="b-info-price_title">
                    Цена изогнутого грифа:
                </div>
                <div class="b-info-price_body">
                    <ul class="b-list">
                        <li>Со слабым изгибом - 1 800 р.</li>
                        <li>С сильным изгибом - 1 800 р.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>