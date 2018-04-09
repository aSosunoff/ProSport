<?php

use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */

use common\models\engine\ContactModel;

$contacts = ContactModel::find()->all();
?>

<?php $this->beginPage() ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <!--    <meta http-equiv='Content-Type' content='text/html' charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title><?= Html::encode($this->title) ?></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
      <?php $this->head() ?>
  </head>
  <body>
  <?php $this->beginBody() ?>

  <!--    <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">-->
  <!--        (Optional) This text will appear in the inbox preview, but not the email body.-->
  <!--    </div>-->

  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" class="email-container"
         style="margin: auto; table-layout= fixed;">
    <col align="center" valign="middle" width="33%"/>
    <col align="center" valign="middle" width="33%"/>
    <col align="center" valign="middle" width="33%"/>
    <tr>
      <td colspan="3" style="
                text-align: center;
                font-family: impact;
                background-color: #da6334;">
        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/'); ?>"
           style="
                   text-decoration: none;
                   width: 100%;
                   height: 60px;
                   padding: 20px 0px;
                   display: block;
                   font-size: 40px;
                   color: #fff"><?= Yii::$app->name ?></a>
    </tr>
      <? if(!empty(Html::encode($this->title))){ ?>
        <tr>
          <td colspan="3" style="
                text-align: center;
                padding: 5px;
                font-family: verdana;
                font-size: 15px;
                background-color: #fd966d;
                line-height: 1.5em;
                letter-spacing: 1px;
                color: #ffffff;"><?= Html::encode($this->title) ?></td>
        </tr>
      <? } ?>
    <tr>
      <td></td>
      <td>
          <?= $content ?>
      </td>
      <td></td>
    </tr>
      <?  $styleTd = "padding: 10px; font-size: 15px;";
      $styleTdRight = $styleTd . " text-align: right;";
      /* @var ContactModel $contact */
      foreach ($contacts as $contact){ ?>
        <tr style="color: #fff;">
          <td style="background-color: #fd966d; border-bottom: 1px solid #fff;"></td>
          <td style="background-color: #fd966d; border-bottom: 1px solid #fff;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto; font-family: 'verdana'; width: 100%;" class="email-container" >
              <tr>
                <td style="<?= $styleTd; ?>">Адресс:</td>
                <td style="<?= $styleTdRight; ?>"><?= $contact->ADDRESS; ?></td>
              </tr>
              <tr>
                <td style="<?= $styleTd; ?>">Телефон:</td>
                <td style="<?= $styleTdRight; ?>"><?= $contact->PHONE; ?></td>
              </tr>
              <tr>
                <td style="<?= $styleTd; ?>">Почта</td>
                <td style="<?= $styleTdRight; ?>"><?= $contact->MAIL; ?></td>
              </tr>
            </table>
          </td>
          <td style="background-color: #fd966d; border-bottom: 1px solid #fff;"></td>
        </tr>
      <? } ?>
  </table>

  <?php $this->endBody() ?>
  </body>
  </html>
<?php $this->endPage() ?>