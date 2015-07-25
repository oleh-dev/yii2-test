<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Model */

$this->params['breadcrumbs'][] = ['label' => 'Models', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-view">

    <p>
        <?= Html::a('Edit', ['update', 'id' => $order_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $models,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'price',
            'description',
            'available',

		],
    ]); ?>

</div>
