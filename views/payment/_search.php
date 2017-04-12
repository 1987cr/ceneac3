<?php
/**
 * /home/criera/Projects/ceneac_yii/runtime/giiant/eeda5c365686c9888dbc13dbc58f89a1
 *
 * @package default
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
 * @var yii\web\View $this
 * @var app\models\PaymentSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="payment-search">

    <?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

    		<?php echo $form->field($model, 'id') ?>

		<?php echo $form->field($model, 'preregister_id') ?>

		<?php echo $form->field($model, 'amount') ?>

		<?php echo $form->field($model, 'payment_type') ?>


		<?php // echo $form->field($model, 'payment_date') ?>

		<?php // echo $form->field($model, 'remaining_amount') ?>

		<?php // echo $form->field($model, 'comments') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
