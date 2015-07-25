<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Model */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="model-form">
	
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-inline', 'data-order' => $order_id]]); ?>

<?php 
    $i = 0;
    $len = count($models);
    foreach($models as $key => $model):
      $i++;
?>
	<div class="row-edit" id="row<?= $i; ?>" data-id="<?= $i; ?>">
    <?= $form->field($model, "[$i]id")->hiddenInput(['label' => false])->label(false) ?>
    <?= $form->field($model, "[$i]order_id")->hiddenInput()->label(false) ?>

    <?= $form->field($model, "[$i]price")->textInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, "[$i]description")->textInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, "[$i]available")->checkbox(['label' => ''])->label(false) ?>
	<a class="btn btn-default remove-item" data-id="<?= $i; ?>">-</a>
	</div>
<?php endforeach; ?>	

	<a id='add-item' class='btn btn-default'>+</a>
    <div  class="form-group" id="end-form">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
