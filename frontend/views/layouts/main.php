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

      <div class="footer-up">
          <div class="container">
              <div class="row">
                  <div class="col-sm-4">
                      <ui class="b-footer-list">
                          <li class="b-footer-list__item b-footer-list__item_head">Информация</li>
                          <li class="b-footer-list__item">
                              Данный сайт носит информационно‑справочный характер
                              и ни при каких условиях не является публичной офертой.
                          </li>
                      </ui>
                  </div>
                  <div class="col-sm-4">
                      <ui class="b-footer-list">
                          <li class="b-footer-list__item b-footer-list__item_head">Важно</li>
                          <li class="b-footer-list__item">
                              <a href="<?= Yii::$app->urlManager->createUrl(['site/privacy-policy'])?>">Политика конфиденциальности</a>
                          </li>
                      </ui>
                  </div>
                  <div class="col-sm-4">
                      <ui class="b-footer-list">
                          <li class="b-footer-list__item b-footer-list__item_head">Как связаться</li>
                          <li class="b-footer-list__item b-footer-list__item_selected OpenSeansCLI letter-space-2"><?= PHONE_1; ?></li>
<!--                          <li class="b-footer-list__item b-footer-list__item_selected OpenSeansCLI letter-space-2">--><?//= PHONE_2; ?><!--</li>-->
                          <li class="b-footer-list__item b-footer-list__item_selected OpenSeansCLI letter-space-2"><?= E_MAIL; ?></li>
                      </ui>
                  </div>
              </div>
          </div>

          <div class="container">
              <div class="row">

                  <div class="col-lg-3 col-sm-12 nopadding">
                      <div class="col-sm-12 col-lg-12">
                          <ui class="b-footer-list">
<!--                              <li class="b-footer-list__item b-footer-list__item_head">Мы в социальных сетях</li>-->
<!--                              <li class="b-footer-list__item_f-left b-footer-list__item_social b-footer-list__item_f">-->
<!--                                  <i class="fa fa-facebook" aria-hidden="true"></i>-->
<!--                              </li>-->
                              <li class="b-footer-list__item_f-left b-footer-list__item_social b-footer-list__item_vk">
                                  <a href="https://vk.com/club95299093" target="_blank">
                                      <i class="fa fa-vk" aria-hidden="true"></i>
                                  </a>
                              </li>
                              <li class="b-footer-list__item_f-left b-footer-list__item_social b-footer-list__item_i">
                                  <a href="https://www.instagram.com/iuliiafomiheva19474/" target="_blank">
                                      <i class="fa fa-instagram" aria-hidden="true"></i>
                                  </a>
                              </li>
                              <li class="b-footer-list__item_f-left b-footer-list__item_social b-footer-list__item_ok">
                                  <a href="https://ok.ru/profile/567074841495" target="_blank">
                                      <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
                                  </a>
                              </li>
                          </ui>
                      </div>
                  </div>

              </div>
          </div>
      </div>

      <div class="footer-down">
          <div class="container">
              <div class="row">
                  <div class="col-xs-5">
                      <?= date('Y') ?> &copy; <?= strtoupper(Yii::$app->name) ?>
                  </div>
                  <div class="col-xs-7">
                      <div class="pull-right">
                          <a class="b-creator" href="https://vk.com/berg_it" target="_blank">
                              <div class="b-creator__text">Создание сайтов</div>
                              <div class="b-creator__icon dev-icon-web-cook"></div>
                          </a>
                      </div>

                  </div>
              </div>
          </div>
      </div>


  </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
