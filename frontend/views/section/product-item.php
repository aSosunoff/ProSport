<?php
use yii\helpers\Html;
use common\models\engine\ProductModel;

/* @var $this yii\web\View */
/* @var ProductModel $product */
?>

<? if(isset($product)){ ?>
    <script>
        //initiate the plugin and pass the id of the div containing gallery images
        $("#<?= $product->nameId ?>").elevateZoom({
            zoomType: "inner",
            gallery:'gallery_<?= $product->nameId ?>',
            cursor: 'crosshair',
            galleryActiveClass: 'active',
            tintColour:'#000',
            tintOpacity:0.5,

            //zoomWindowFadeIn: 50  0,
            //zoomWindowFadeOut: 500,
            //lensFadeIn: 500,
            //lensFadeOut: 500,

            easing : true,

            //scrollZoom : true
        });

        $("#<?= $product->nameId ?>").on("click", function(e) {
            var galleryList = $(this).next(".gallery_images").find(".gallery_image"),
                arObject = [];

            galleryList.each(function(i, e){
                var nameImage = $(e).data("nameImage");

                arObject.push({
                    src: '#' + $(e).attr('id'),
                    type: 'inline',
                    opts : {
                        loop : true,
                        toolbar : false,
                    },
                });
            });

            $.fancybox.open(arObject);

            return false;
        });
    </script>

    <span
        class="b-catalog-element"
        title="<?= $product->avatar->TITLE ?>">
        <div class="b-catalog-element__box-img">
            <div class="b-catalog-element__box-img_table">
                <div class="b-catalog-element__box-img_cell">

                    <div class="elevateZoomWrap">
                        <?= Html::img($product->avatar->img, [
                            'class' => 'b-catalog-element__img',
                            'id' => $product->nameId,
                            'data-name-product' => $product->NAME,
                            'title' => $product->NAME,
                            'alt' => $product->NAME
                        ]); ?>

                        <div class="gallery_images">
                            <? foreach($product->images as $image){ ?>
                                <div
                                        class="gallery_image"
                                        id="item_<?= $product->nameId ?>_<?= $image->ID ?>"
                                        data-name-image="<?= $image->TITLE ?>">
                                    <div class="picture">
                                        <?= Html::img($image->img, [
                                            'alt' => $image['ALT'],
                                            'title' => $product->NAME . (!empty($image['TITLE']) ? ' - ' . $image['TITLE'] : '')
                                        ])?>
                                    </div>
                                    <div class="description">
                                        <p class="OpenSeansCB">
                                            <?= $product->NAME ?>
                                        </p>

                                        <p>
                                            <?= $product->DESCRIPTION ?>
                                        </p>

                                        <p class="price">
                                            Цена от <?= $product->PRICE ?> руб.
                                        </p>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="b-catalog-element__button">
            <div class="b-catalog-element__buttom-row">
                <?= $product->NAME ?>
            </div>
            <div class="b-catalog-element__buttom-row price">
                от <?= $product->PRICE ?> руб.
            </div>
        </div>

        <div class="b-catalog-element__button">
            <div class="b-catalog-element__buttom-row-text">
                <?= $product->PREVIEW_TEXT ?>
            </div>
        </div>
    </span>
<? } ?>