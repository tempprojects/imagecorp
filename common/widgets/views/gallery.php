<?php

/* @var $this yii\web\View */

?>

<button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#myModalGallery" data-backdrop="static">Выбрать картинку</button>
<div id="myModalGallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel2">Выберите картинку</h4>
            </div>
            <div class="modal-body">
                <ul id="grid" class="row thumbnails">
                <?php
                    foreach ($model as $item) {
                        echo '<li class="col-sm-4">';
                        echo '<span data-id="'.$item->id.'" data-src="'.$item->src.'" class="thumbnail imgGallery">';
                        echo '<img src="'.$item->src.'" alt="">';
                        echo '</span>';
                        echo '</li>';
                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<hr>
    <span class="thumbnail">
        <img src="<?= $img; ?>" alt="" id="viewImg">
    </span>
<hr>

<?php
$this->registerJs('$(".imgGallery").click(function(){$("#'.$idInput.'")[0].value = this.getAttribute("data-id");$("#viewImg")[0].src = this.getAttribute("data-src");$("#myModalGallery").modal("hide")});');