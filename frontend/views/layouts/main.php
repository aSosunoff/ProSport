<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widget\MenuWidget;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="RobotoCL">
<?php $this->beginBody() ?>

<div class="b-scroll-up_box">
  <div class="b-scroll-up_backgroung">
    <div class="b-scroll-up_button">
      <span class="b-scroll-up_button-text">Наверх</span>
      <i class="fa fa-arrow-circle-up b-scroll-up_button-icon" aria-hidden="true"></i>
    </div>
  </div>
</div>

<div class="wrapper">
  <div class="content">
      <?= MenuWidget::widget(); ?>
      <?= $content ?>
  </div>

  <div class="footer">

    <footer class="footer_info">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <ul class="nav nav-pills social-button">
              <li><a href="https://vk.com/" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
              <li><a href="https://instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              <li><a href="https://facebook.com/" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
              <li><a href="https://ok.ru/" target="_blank"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <footer class="footer_bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="law">&#169; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> - Все права защищены</div>
          </div>
          <div class="col-sm-6 developer-box">
            <a href="https://vk.com/berg_it" target="_blank" id="developer">
              <span class="dev-icon-berg"></span>
              <span class="developer-description">Разработка: Alexander Berg</span>
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
