<?php
/* @var $this \yii\web\View view component instance */

use common\infrastructure\DateClass;

/* @var $ExceptionLogModel common\models\engine\ExceptionLogModel */

$this->title = $nameForm;

$styleTdLeft = "    padding: 10px;
                    font-size: 15px;
                    color: #929292;";

$styleTdRight = "   padding: 10px;
                    font-family: 'Time New Roman';
                    font-size: 15px;
                    color: #383838;";
?>

<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto; font-family: 'verdana'; width: 100%;" class="email-container" >
    <tr>
        <td style="<?= $styleTdLeft; ?>">№:</td>
        <td style="<?= $styleTdRight; ?>"><?= $ExceptionLogModel->ID; ?></td>
    </tr>
    <tr>
        <td style="<?= $styleTdLeft; ?>">Сообщение:</td>
        <td style="<?= $styleTdRight; ?>"><?= $ExceptionLogModel->MESSAGE; ?></td>
    </tr>
    <tr>
        <td style="<?= $styleTdLeft; ?>">Дата:</td>
        <td style="<?= $styleTdRight; ?>"><?= DateClass::TimestampToDate($ExceptionLogModel->CREATED_AT) ?></td>
    </tr>
</table>