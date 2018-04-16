<?php
use yii\web\View;
use common\models\engine\SectionModel;

/* @var $this View
 * @var array $content
 * @var SectionModel $section
 */
?>
<section class="b-section_item <?= $section->VIEW ?>">
    <?= $this->render($section->VIEW, $content)?>
</section>