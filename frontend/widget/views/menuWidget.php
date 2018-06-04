<?php
use yii\helpers\Html;
use common\models\engine\MenuModel;

/* @var $this yii\web\View
 * @var MenuModel $itemMenu
 * @var string $phone
 * @var string $email
 * */
?>

<header class="b-menu js-menu">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <a href="/" class="custom-icon-logo"></a>
        </div>
        <div class="col-lg-4 text-center">
          <div class="b-btn-big">Позвони мне</div>
        </div>
        <div class="col-lg-4 text-right">
          <ul class="letter-space-2 font-size-20">
            <li><?= $phone ?></li>
            <li><?= $email ?></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <ul class="nav nav-pills nav-justified b-menu_items js-menu_items">
          <? foreach ($itemMenu as $item) {
            /* @var MenuModel $item */?>
            <li>
              <a href="#<?= $item->ANCHOR ?>" title="<?= $item->TITLE ?>">
                  <span class="title-menu-item"><?= $item->TITLE ?></span>
              </a>
            </li>
          <? } ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
