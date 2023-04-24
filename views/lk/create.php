<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="article-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'image')->fileInput() ?>

<?= $form->field($model, 'idCategory')->dropDownList($category) ?>

<?= $form->field($model, 'date')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>


<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

</div>
