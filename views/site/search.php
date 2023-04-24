<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Результаты поиска';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'column_name_1',
        'column_name_2',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
