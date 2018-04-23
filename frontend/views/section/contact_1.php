<?php
use yii\helpers\Html;
use yii\web\View;
use common\models\form\CallMeForm;

/* @var $this View
 * @var MenuModel $menu
 * @var $model CallMeForm
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
        <div class="col-lg-6" id="js-call-me-body">
            <?= $this->render('//site/call-me-partial', [
                'model' => $model
            ])?>

            <p>
                Оставьте необходимый вопрос, который Вас интересует и мы вам перезвоним.
            </p>

            <p>
                Наш сотрудник проконсультирует по товару, поможет с выбором, расскажет о доставке.
            </p>

            <p>
                Нам важны Ваши отзывы
            </p>
        </div>

        <div class="col-lg-6 contact-img">

        </div>
    </div>
</div>

<script>
    $(function(){
    /*
     * https://github.com/RobinHerbots/Inputmask
     */
        $("#js-call-me__phone").inputmask("+7 (999) 999 - 99 - 99");
    })
</script>