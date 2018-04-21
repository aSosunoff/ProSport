<?php
/* @var $this \yii\web\View view component instance */
/* @var $CallMeForm common\models\form\CallMeForm */

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
        <td style="<?= $styleTdLeft; ?>">Имя:</td>
        <td style="<?= $styleTdRight; ?>"><?= $CallMeForm->name; ?></td>
    </tr>
    <tr>
        <td style="<?= $styleTdLeft; ?>">Телефон:</td>
        <td style="<?= $styleTdRight; ?>"><?= $CallMeForm->phone; ?></td>
    </tr>
    <tr>
        <td style="<?= $styleTdLeft; ?>">Сообщение:</td>
        <td style="<?= $styleTdRight; ?>"><?= strlen($CallMeForm->text) > 0 ? $CallMeForm->text : "Пользователь не оставил сообщения. Но ему необходимо перезвонить." ?></td>
    </tr>
    <tr>
        <td style="<?= $styleTdLeft; ?>">Дата и Время отправления:</td >
        <td style = "<?= $styleTdRight; ?>" ><?= $CallMeForm->date; ?></td>
    </tr >
</table>