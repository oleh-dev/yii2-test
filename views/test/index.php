<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Models';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'order_id',
            'amount',
            [
				'class' => 'yii\grid\ActionColumn', 
				'urlCreator' => function ($action, $model, $key, $index) {
					return '?r=test/'.$action.'&id='.$model['order_id'];
				}
			],
        ],
    ]); ?>

</div>
