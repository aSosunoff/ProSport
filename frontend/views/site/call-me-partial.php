<?php
use yii\helpers\Html;
use common\infrastructure\ActiveForm;
use common\models\form\CallMeForm;

/* @var $this yii\web\View */
/* @var $form ActiveForm */
/* @var $model CallMeForm */

?>

<?php $form = ActiveForm::begin([
    'action' => ['site/call-me'],
    'id' => 'call-me-form']); ?>

<?= $form->field($model, 'name')->textInput(['class' => 'b-input', 'id' => 'js-call-me__name']) ?>

<?= $form->field($model, 'phone')->textInput(['class' => 'b-input', 'id' => 'js-call-me__phone']) ?>

<?= $form->field($model, 'text')->textarea(['class' => 'b-textarea', 'id' => 'js-call-me__text']) ?>

<?= $form->field($model, 'iAgree')->checkbox([
    'id' => 'js-call-me__iAgree',
    'labelLinkConfig' => [
        'href' => ['site/privacy-policy'],
        'class' => 'b-btn-link',
        'target' => '_blank'
    ]
]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'b-btn', 'name' => 'call-me-button', 'id' => 'call-me-submit']) ?>
    </div>

<?php ActiveForm::end(); ?>