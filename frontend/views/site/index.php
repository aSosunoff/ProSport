<?php

use common\models\engine\MenuModel;
use common\models\engine\SectionModel;
use yii\web\View;

/* @var $this View
 * @var MenuModel $menu
 * @var MenuModel $item
 * @var SectionModel $section
 * @var string $sectionJson
 */

//$this->title = 'My Yii Application';

$script = <<< JS
    var sectionObj = JSON.parse($sectionJson);

    var go = function(sectionObj){
        if(sectionObj.length) {
            var arrayCopy = sectionObj.slice(0, sectionObj.length),
                e = arrayCopy.shift(),
                currentSelection = $(e.elementId),
                currentSelectionTop = currentSelection.offset().top,
                windowScrollTop = $(window).scrollTop(),
                windowHeight = $(window).height(),
                windowTopAddWidth = windowScrollTop + windowHeight;

                //if(windowTopAddWidth >= currentSelectionTop){
                    AJAXGlobals({
                        url: e.url,
                        data: {
                            id: e.data.id 
                        },
                        success: function (data) {
                            var section = $(data.result.html);
                            section
                                .css({
                                    'display': 'none',
                                    'min-height': currentSelection.css('min-height')
                                })
                                .fadeIn(200);
                            
                            $(e.elementId).append(section);
    
                            //$(window).scroll(function() {
                                go(arrayCopy);
                            //});
                        }
                    });
                //}
        }
    }
    
    go(sectionObj);
JS;

$this->registerJs($script, View::POS_READY);

?>

<? foreach ($menu as $item) { ?>
    <div id="<?= $item->ANCHOR ?>">
        <? foreach ($item->sections as $section) { ?>
            <div id="<?= $section->VIEW ?>"></div>
        <? } ?>
    </div>
<? } ?>