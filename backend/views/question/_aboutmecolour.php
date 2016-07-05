<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Gallery;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $answers_models */
/* @var $id */
/* $var $isNew*/
?>


<?php $form = ActiveForm::begin(['action' => ['question/' . ($isNew ? "save" : "update") . 'answers/*?id=' . $id], 'options' => ['method' => 'post']]); ?>
<div class="row">
    <?php
    $cnt = 1;


    $format = <<< SCRIPT
function format(state) {
    if (!state.id) return state.text;
    var stateId = $('<span style="background-color: '+state.text+';width:90px;height:50px; display:block; color:'+state.text+'; " >' + state.id + '</span>');
    return stateId;
}
SCRIPT;
    $escape = new JsExpression("function(m) { return m; }");
    $this->registerJs($format, View::POS_HEAD);

    foreach ($answers_models as $key => $value) {
        if(!$isNew){
            $data = [];
            foreach (unserialize($value->title) as $item) {
                $data[] = (int)$item;
            }
        }
        echo "<div class='col-md-4 col-md-offset-2'>";
        echo "Вариант # " . $cnt++;
        //For id of current record in db. In this case we lose the need to pass this parameter in get request!!!
        echo (!$isNew) ? $form->field($value, '[' . $key . ']id')->hiddenInput()->label(false) : "";

        echo $form->field($value, '[' . $key . ']question_id')->hiddenInput()->label(false);

        echo $form->field($value, '[' . $key . ']value')->textInput(['required' => 'required']);

        echo $form->field($value, '[' . $key . ']description')->textInput();

        echo $form->field($value, '[' . $key . ']buttton_text')->textInput();
        echo "</div>";
        echo "<div class='col-md-4'>";

        $img = is_object($value->mainImage) ? $value->mainImage->getAttribute('src') : null;
        echo $form->field($value, '[' . $key . ']main_image_id')->hiddenInput(['maxlength' => true])->label("Photo");
        echo Gallery::widget(['type' => 'tests', 'idInput' => 'answer-' . $key . '-main_image_id', 'img' => $img]);

        $color = array('1' => '#efefef', '2' =>'#747474', '3' => '#945858', '4' => '#282828', '5' => '#642554', '6' => '#59945c','7' => '#efefef','8' => '#04e2e5','9' => '#ebdf19','10' => '#ff05c7','11' => '#01ecb4', '12' => '#282828');
        echo Select2::widget([
            'name' => 'Answer['.$key.'][title]',
            'data' => $color,
            'value' => $data,
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите цвета ...','id' => 'answer-' . $key . '-color_id'],
            'pluginOptions' => [
                'maximumSelectionLength' => 6,
                'templateResult' => new JsExpression('format'),
                'templateSelection' => new JsExpression('format'),
                'escapeMarkup' => $escape,
                'allowClear' => true
            ],
        ]);

        echo "</div>";
        echo '<div class="clearfix"></div>';
    }
    ?>
    <div class='col-md-6'>
        <div class="form-group">
            <?= Html::submitButton(($isNew ? "Create" : "Update"), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJsFile('js/myscript.js', ['depends' => 'frontend\assets\AppAsset']); ?>