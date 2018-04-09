<?php

namespace common\infrastructure;

use Yii;
use yii\validators\Validator;

use common\infrastructure\RegexPattern;

class CheckOnSpam extends Validator
{
    /**
     * @var string the user-defined error message. It may contain the following placeholders which
     * will be replaced accordingly by the validator:
     *
     * - `{attribute}`: the label of the attribute being validated
     * - `{value}`: the value of the attribute being validated
     * - `{requiredValue}`: the value of [[requiredValue]]
     */
    public $message;
    
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} не может быть пустым.');
        }
    }
    
    protected function validateValue($value)
    {
        if(preg_match(RegexPattern::SPAM, $value)){
            return [$this->message, []];
        }
    }
}