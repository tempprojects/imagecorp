<?php
use yii\helpers\Html;
use yii\web\JsExpression;
use dektrium\user\models\RegistrationForm;

$model = Yii::createObject(RegistrationForm::className());

/**
 * @var yii\web\View              $this
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\User $user
 */
?>
    <p class="control">
        <?= Html::activeTextInput($model, 'username', ['placeholder' => 'Логин', 'type' => 'text', 'class' => 'input is-medium']); ?>
        <?= Html::error($model, 'username'); ?>
    </p>
    <p class="control">
        <?= Html::activeTextInput($model, 'email', ['placeholder' => 'E-mail', 'type' => 'email', 'class' => 'input is-medium']); ?>
        <?= Html::error($model, 'email'); ?>
    </p>
    <p class="control">
        <?= Html::activeTextInput($model, 'password', ['placeholder' => 'Пароль', 'type' => 'password', 'class' => 'input is-medium']); ?>
        <?= Html::error($model, 'password'); ?>
    </p>
<input name="test" type="hidden" value="<?= Yii::$app->request->get('test')?>" class="input is-medium" />

<input type="hidden" name="DataOrder[summ]" value="100" id="summ" />
<input type="hidden" name="DataOrder[for]"  value="<?= Yii::$app->request->get('test'); ?>"/>
<input type="hidden" name="DataOrder[user]" value="<?= Yii::$app->user->id; ?>"/>
