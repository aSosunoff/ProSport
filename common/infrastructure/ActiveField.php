<?php


namespace common\infrastructure;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


class ActiveField extends \yii\bootstrap\ActiveField
{
    public $checkboxTemplate = "<div class=\"checkbox box-switch\">\n{beginLabel}\n{input}\n<div class=\"button\"></div>\n{endLabel}\n{beginLabel}\n{beginLabelLink}\n{labelTitle}\n{endLabelLink}\n{endLabel}\n{error}\n{hint}\n</div>";
//    public $checkboxTemplate = "<div class=\"checkbox box-switch\">\n{beginLabel}\n{input}\n<div class=\"button\"></div>\n{endLabel}\n{beginLabel}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>";
    public $horizontalCheckboxTemplate = "{beginWrapper}\n<div class=\"checkbox box-switch\">\n{beginLabel}\n{input}\n<div class=\"button\"></div>\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}";
    public $hiddenInput = "{input}";

    /**
     * @var array options for the wrapper tag, used in the `{beginWrapper}` placeholder
     */
    public $labelLinkConfig = [];

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function hiddenInput($options = [])
    {
        $this->template = $this->hiddenInput;

        return parent::hiddenInput($options);
    }

    /**
     * @inheritdoc
     */
    public function checkbox($options = [], $enclosedByLabel = true)
    {
        if (isset($options['labelLinkConfig']) && (!empty($options['labelLinkConfig']))) {
            $this->labelLinkConfig = $options['labelLinkConfig'];

            if(isset($this->labelLinkConfig['href']) && is_array($this->labelLinkConfig['href'])){
                $this->labelLinkConfig['href'] = Yii::$app->urlManager->createUrl($this->labelLinkConfig['href']);
            }

            $linkOptions = $this->labelLinkConfig;
            $tag = ArrayHelper::remove($linkOptions, 'tag', 'a');
            $this->parts['{beginLabelLink}'] = Html::beginTag($tag, $linkOptions);
            $this->parts['{endLabelLink}'] = Html::endTag($tag);
            unset($options['labelLinkConfig']);
        } else {
            $this->parts['{beginLabelLink}'] = '';
            $this->parts['{endLabelLink}'] = '';
        }

        return parent::checkbox($options, $enclosedByLabel);
    }

    public function fileInputCustom($options = [])
    {
        if(isset($options['labelOption'])){
            if(isset($options['labelOption']['class'])){
                $this->labelOptions['class'] = $this->labelOptions['class'] . ' ' . $options['labelOption']['class'];
            }
        }

        // https://github.com/yiisoft/yii2/pull/795
        if ($this->inputOptions !== ['class' => 'form-control']) {
            $options = array_merge($this->inputOptions, $options);
        }
        // https://github.com/yiisoft/yii2/issues/8779
        if (!isset($this->form->options['enctype'])) {
            $this->form->options['enctype'] = 'multipart/form-data';
        }
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);

        // add a hidden field so that if a model only has a file field, we can
        // still use isset($_POST[$modelClass]) to detect if the input is submitted
        $hiddenOptions = ['id' => null, 'value' => ''];
        if (isset($options['name'])) {
            $hiddenOptions['name'] = $options['name'];
        }

        $this->parts['{input}'] = Html::activeHiddenInput($this->model, $this->attribute, $hiddenOptions)
            . Html::activeInput('file', $this->model, $this->attribute, $options);


        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render($content = null)
    {
        return parent::render($content);
    }
}