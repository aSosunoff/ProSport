<?php
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $title string */
/* @var $info string */
/* @var $body string */
/* @var $idBox string */
/* @var $idBoxDialog string */

$script = <<< JS
    ;(function(_window, $){
        var _jQueryElement = null;
        
        function _set(option){
            (option && option.title) ? _jQueryElement.find('.modal-title').html(option.title) : null;
            (option && option.info) ? _jQueryElement.find('.modal-info').html(option.info) : null;
            (option && option.body) ? _jQueryElement.find('.modal-body').html(option.body) : null;
            (option && option.idBox) ? _jQueryElement.attr({ id : option.idBox } ) : null;
            (option && option.idBoxDialog) ? _jQueryElement.find('.modal-dialog').attr({ id : option.idBoxDialog } ) : null;
            
            if(option && option.modalDialog){
                (option.modalDialog.class) ? _jQueryElement.find('.modal-dialog').addClass(option.modalDialog.class) : null;
            }
        }
        
        var _library = function () {
            return {
                run: function(option){
                    _set(option);
                    _jQueryElement.modal('show');
                    if(option && option.callback && typeof option.callback == 'function'){
                        option.callback();
                    }
                },
                replace: function(option){
                    _set(option);
                    if(option && option.callback && typeof option.callback == 'function'){
                        option.callback();
                    }
                },
                hide: function(option){
                    _jQueryElement.modal('hide');
                    if(option && option.callback && typeof option.callback == 'function'){
                        option.callback();
                    }
                }
            };
        };

        _window.DialogWidget = function(selector){
            _jQueryElement = $(selector);
            
            if(_jQueryElement.length === 0) return null;
            
            return new _library();
        };
    })(window, jQuery);
JS;

$this->registerJs($script, View::POS_END);

?>


<div class="modal fade" tabindex="-1" role="dialog" id="<?= $idBox ?>">
    <div class="modal-dialog" role="document" id="<?= $idBoxDialog ?>">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><?= $title ?></h4>
                <div class="close" data-dismiss="modal" aria-hidden="true">&times;</div>
            </div>

            <div class="modal-info">
                <?= $info ?>
            </div>

            <div class="modal-body">
                <?= $body ?>
            </div>

<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

