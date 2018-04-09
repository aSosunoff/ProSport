<?php

namespace common\widgets;

use yii\bootstrap\Widget;

class DialogWidget extends Widget
{
    public $title;

    public $info;

    public $body;

    public $id_box = "modDialog";

    public $id_box_dialog = "dialogContent";

    public function init()
    {
        parent::init();
        if ($this->title === null) { $this->title = 'Title'; }
        if ($this->id_box === null) { $this->title = 'modDialog'; }
        if ($this->id_box_dialog === null) { $this->title = 'dialogContent'; }
    }

    public function run(){
        return $this->render('dialogWidget', [
            'title' => $this->title,
            'info' => $this->info,
            'body' => $this->body,
            'idBox' => $this->id_box,
            'idBoxDialog' => $this->id_box_dialog
        ]);
    }
}